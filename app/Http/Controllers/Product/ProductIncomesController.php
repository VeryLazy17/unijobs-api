<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Factory_product;
use App\Models\Product_income;
use App\Models\Product_income_payment;
use App\Models\Storage;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class ProductIncomesController extends Controller
{
    use ApiResponseHelpers;

    public function index(): \Illuminate\Http\JsonResponse
    {
        $productIncome = Product_income::with('product_payments', 'product.product_category')
            ->whereLike(['from_where', 'amount', 'total_price', 'price', '.product[name,code]'], request('search'))
            ->orderByDesc('created_at')
            ->paginate(10);

        return $this->respondWithSuccess($productIncome);
    }

    public function getProductAccessory(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Product_income::with('product:id,name,code,product_category_id', 'product.product_category:id,name')
            ->whereRelation('product.product_category', 'parent_id', '=', request('status'))
            ->orderByDesc('created_at')
            ->select(['id', 'code', 'from_where', 'product_id', 'amount', 'price', 'total_price', 'created_at'])
            ->whereLike(['from_where', 'amount', 'price', 'total_price', '.product[name,code]'], request('search'))
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function getProductThread()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Product_income::with('product:id,name,code')
            ->whereRelation('product.product_category', 'type', '=', request('type'))
            ->select(['id', 'product_id', 'from_where', 'amount', 'price', 'total_price', 'created_at'])
            ->whereLike(['from_where', 'amount', 'price', 'total_price', '.product[name,code]'], request('search'))
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate(request(), [
            'from_where' => 'required|max:120',
            'product_id' => 'required',
            'amount' => 'required|max:12',
            'price' => 'required|max:12',
            'total_price' => 'required|max:15',
            'code' => 'max:8',
            'paid' => 'max:12',
            'created_at' => 'required'
        ],
            [
                'from_where.max' => 'Iltimos, 120 ta belgidan oshmasin !',
                'from_where.required' => 'Iltimos,maydonni to\'ldiring !',
                'product_id.required' => 'Iltimos,mahsulotni kiriting !',
                'amount.required' => 'Iltimos,maydonni to\'ldiring !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'price.required' => 'Iltimos,maydonni to\'ldiring !',
                'price.max' => 'Iltimos,narx 12 ta belgidan oshmasin !',
                'total_price.required' => 'Iltimos,maydonni to\'ldiring !',
                'total_price.max' => 'Iltimos,jami summa 12 ta belgidan oshmasin !',
                'code.max' => 'Iltimos,kod 8 ta belgidan oshmasin !',
                'paid.max' => 'Iltimos,to\'lanadigan summa 12 ta belgidan oshmasin !',
                'created_at' => 'Iltimos,sanani tanlang !'
            ]
        );

        if ($request['total_price'] < $request['paid']) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        $productIncome = new Product_income();
        $productIncome->from_where = $request['from_where'];
        $productIncome->code = $request['code'];
        $productIncome->product_id = $request['product_id'];
        $productIncome->amount = $request['amount'];
        $productIncome->price = $request['price'];
        $productIncome->total_price = $request['total_price'];
        if ($productIncome->total_price == $request['paid']) {
            $productIncome->is_debt = '0';
        } else {
            $productIncome->is_debt = '1';
        }
        $productIncome->created_at = $request['created_at'];
        $productIncome->save();

        if ($request['paid'] != 0) {
            Product_income_payment::insert([
                'product_income_id' => $productIncome->id,
                'sum' => $request['paid'],
                'created_at' => $request['created_at']
            ]);
        }

        $storage = Storage::whereProductId($request['product_id'])
            ->whereStorageTypeId($request['type'] === 'accessory' ? 2 : 1)->first();

        if ($storage) {
            $amountOfStorage = $storage->amount;
            $amountOfStorage += $request['amount'];
            $storage->amount = $amountOfStorage;
            $storage->update();
        } else {
            Storage::create([
                'storage_type_id' => $request['type'] == 'accessory' ? 2 : 1,
                'product_id' => $request['product_id'],
                'color' => $request['color'],
                'amount' => $request['amount'],
                'created_at' => $request['created_at']
            ]);
        }

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Mahsulotlar sotib olindi.');
    }

    public function show(Product_income $product_income): \Illuminate\Http\JsonResponse
    {
        return $this->respondWithSuccess($product_income);
    }

    public function update(Request $request, Product_income $product_income)
    {
        $this->validate(request(), [
            'from_where' => 'required|max:120',
            'amount' => 'required|max:12',
            'price' => 'required|max:12',
            'total_price' => 'required|max:15',
        ],
            [
                'from_where.max' => 'Iltimos, 120 ta belgidan oshmasin !',
                'from_where.required' => 'Iltimos,maydonni to\'ldiring !',
                'amount.required' => 'Iltimos,maydonni to\'ldiring !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'price.required' => 'Iltimos,maydonni to\'ldiring !',
                'price.max' => 'Iltimos,narx 12 ta belgidan oshmasin !',
                'total_price.required' => 'Iltimos,maydonni to\'ldiring !',
                'total_price.max' => 'Iltimos,jami summa 12 ta belgidan oshmasin !'
            ]
        );

        $sum = 0;
        foreach ($product_income->product_payments as $item) {
            $sum += $item->sum;
        }

        if (($product_income->total_price != $request['total_price']) && $request['total_price'] < $sum) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        $storage = Storage::whereProductId($product_income->product_id)
            ->whereStorageTypeId($request['type'] === 'accessory' ? 2 : 1)->first();

        if ($storage) {
            if ($storage->amount < $product_income->amount) {
                return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda tovar yo\'q!'], 409);
            }
            $amountOfStorage = $storage->amount;
            $amountOfStorage -= $product_income->amount;
            $amountOfStorage += $request['amount'];
            $storage->amount = $amountOfStorage;
            $storage->update();
        } else {
            return response()->json(['success' => false, 'message' => 'Skladda bu tovar yo\'q!'], 409);
        }

        $product_income->update($request->only('from_where', 'amount', 'price', 'total_price'));

        Storage::where('amount', 0)->delete();

        return $this->respondOk('Muvaffaqiyatli yangilandi.');
    }

    public function destroy(Request $request, Product_income $product_income)
    {
        $storage = Storage::whereProductId($product_income->product_id)
            ->whereStorageTypeId($request['type'] === 'accessory' ? 2 : 1)->first();

        if ($storage) {
            if ($storage->amount < $product_income->amount) {
                return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda tovar yo\'q!'], 409);
            }
            $amountOfStorage = $storage->amount;
            $amountOfStorage -= $product_income->amount;
            $storage->amount = $amountOfStorage;
            $storage->update();
        } else {
            return response()->json(['success' => false, 'message' => 'Skladda bu tovar yo\'q!'], 409);
        }

        Product_income_payment::whereProductIncomeId($product_income->id)->delete();

        $product_income->delete();

        return $this->respondOk('Muvaffaqiyatli o\'chirildi.');
    }
}
