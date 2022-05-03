<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Factory_product;
use App\Models\Product;
use App\Models\Sewing_payment;
use App\Models\Sewing_report;
use App\Models\Storage;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        if (request('status')) {
            return Product::with('product_category:id,name')
                ->whereProductCategoryId(request('status'))
                ->whereLike(['name', 'code'], request('search'))
                ->paginate(20);
        } else if (request('type')) {
            return Product::with('product_category')
                ->whereRelation('product_category', 'parent_id', '=', request('type'))
                ->whereLike(['name', 'code'], request('search'))
                ->paginate(20);
        } else {
            return $this->respondWithSuccess(Product::with('product_category')->paginate(20));
        }

    }

    public function getProductFilteredParentId()
    {
        return Product::whereProductCategoryId(request('type_id'))
            ->whereLike(['name', 'code'], request('search'))
            ->select(['id', 'code', 'name'])
            ->paginate(20);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate(request(), [
            'code' => 'required|max:8|unique:products,code',
            'product_category_id' => 'required',
            'name' => 'required|max:100|unique:products,name',
            'description' => 'max:100'
        ],
            [
                'code.required' => 'Iltimos,kodni kiriting !',
                'code.max' => 'Iltimos,kod 8 ta belgidan oshmasin !',
                'code.numeric' => 'Iltimos,kodga faqat raqam ishlating !',
                'code.unique' => 'Bu kod oldin kiritilgan !',
                'name.unique' => 'Bu nom oldin kiritilgan !',
                'product_category_id.required' => 'Iltimos,mahsulot kategoriyasini tanlang !',
                'name.required' => 'Iltimos, yangi mahsulot nomini kiriting !',
                'name.max' => 'Iltimos, nom 100 ta belgidan oshmasin !',
                'description.max' => 'Iltimos, tavsif 100 ta belgidan oshmasin !',
            ]
        );

        $createProduct = Product::create($request->only('code', 'product_category_id', 'name', 'description'));

        if (!$createProduct) {
            return $this->respondError('Xatolik yuz berdi, iltimos qayta urining.');
        }
        return $this->respondWithSuccess(['success' => 'Yangi mahsulot qo\'shildi.', 'id' => $createProduct->id, 'name' => $createProduct->name]);
    }

    public function getExchangeRawToProduct(Request $request)
    {
        $this->validate(request(), [
            'product_id' => 'required',
            'amount' => 'required|max:12',
            'amount_using' => 'required|max:12',
            'amount_sewed' => 'required|max:12',
            'waste_percentage' => 'required',
            'waste_amount' => 'required|max:12',
            'total_price' => 'required|max:12',
            'paid' => 'max:12',
            'created_at' => 'required',
            'color_code' => 'required'
        ],
            [
                'product_id.required' => 'Iltimos,mahsulotni kiriting !',
                'amount.required' => 'Iltimos,olingan donani kiriting !',
                'amount.max' => 'Iltimos,olingan dona 12 ta belgidan oshmasin !',
                'amount_using.required' => 'Iltimos,ishlatilgan miqdorni kiriting !',
                'amount_using.max' => 'Iltimos,ishlatilgan mahsulot 12 ta belgidan oshmasin !',
                'amount_sewed.required' => 'Iltimos,bichilgan miqdorni kiriting !',
                'amount_sewed.max' => 'Iltimos,bichilgan mahsulot 12 ta belgidan oshmasin !',
                'percentage_amount.required' => 'Iltimos,ispareniyani kiriting !',
                'total_price.required' => 'Iltimos,narxni kiriting !',
                'total_price.max' => 'Iltimos,narx 12 ta belgidan oshmasin !',
                'paid.max' => 'Iltimos,to\'langan summa 12 ta belgidan oshmasin !',
                'created_at.required' => 'Iltimos,sanani tanlang !',
                'color_code.required' => 'Iltimos,mahsulot rangini tanlang !',
            ]
        );

        if ($request['total_price'] < $request['paid']) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        $storage = Storage::whereStorageTypeId(2)->whereProductId($request['product_id'])
            ->whereColor($request['color_code'])->whereProductCase('painted')->first();

        if (!$storage) {
            return response()->json(['success' => false, 'message' => 'Skladda bu tovar yo\'q!'], 409);
        }

        if ($storage->amount < $request['amount_using']) {
            return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda tovar yo\'q!'], 409);
        }

        $sewingReport = new Sewing_report();
        $sewingReport->product_id = $request['product_id'];
        $sewingReport->color = $storage->color;
        $sewingReport->amount = $request['amount'];
        $sewingReport->amount_using = $request['amount_using'];
        $sewingReport->amount_sewed = $request['amount_sewed'];
        $sewingReport->waste_percentage = $request['waste_percentage'];
        $sewingReport->waste_amount = $request['waste_amount'];
        $sewingReport->total_price = $request['total_price'];
        $sewingReport->created_at = $request['created_at'];
        if ($sewingReport->total_price == $request['paid']) {
            $sewingReport->is_debt = '0';
        } else {
            $sewingReport->is_debt = '1';
        }
        $sewingReport->save();

        if ($request['paid'] != 0) {
            Sewing_payment::insert([
                'sewing_report_id' => $sewingReport->id,
                'sum' => $request['paid'],
                'created_at' => $request['created_at']
            ]);
        }

        $storageProduct = Storage::whereStorageTypeId(2)->whereColor($request['color_code'])
            ->whereProductId($request['product_id'])->whereProductCase('sewed')->first();

        if ($storageProduct) {
            $amountOfStorageProduct = $storageProduct->amount;
            $amountOfStorageProduct += $request['amount'];
            $storageProduct->amount = $amountOfStorageProduct;
            $storageProduct->update();
        } else {
            Storage::create([
                'storage_type_id' => '2',
                'product_id' => $request['product_id'],
                'amount' => $request['amount'],
                'color' => $storage->color,
                'product_case' => 'sewed',
            ]);
        }

        //storage update product amount
        $amountOfStorage = $storage->amount;
        $amountOfStorage -= $request['amount_using'];
        $storage->amount = $amountOfStorage;
        $storage->update();

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Mahsulot bichildi.');
    }

    public function show(Product $product): \Illuminate\Http\JsonResponse
    {
        return $this->respondWithSuccess($product);
    }

    public function update(Request $request, Product $product): \Illuminate\Http\JsonResponse
    {
        $this->validate(request(), [
            'code' => 'required|max:8',
            'product_category_id' => 'required',
            'name' => 'required|max:100',
            'description' => 'max:100'
        ],
            [
                'code.required' => 'Iltimos,kodni kiriting!',
                'code.max' => 'Iltimos,kod 8 ta belgidan oshmasin!',
                'code.numeric' => 'Iltimos,kodga faqat raqam ishlating!',
                'code.unique' => 'Bu kod oldin kiritilgan!',
                'product_category_id.required' => 'Iltimos,mahsulot kategoriyasini tanlang!',
                'name.required' => 'Iltimos, yangi mahsulot nomini kiriting!',
                'name.max' => 'Iltimos, nom 100 ta belgidan oshmasin !',
                'description.max' => 'Iltimos, tavsif 100 ta belgidan oshmasin!',
            ]
        );

        if (!$product->update($request->only('code', 'product_category_id', 'name', 'description'))) {
            return $this->respondError('Xatolik yuz berdi, iltimos qayta urining.');
        }

        return $this->respondWithSuccess(['message' => 'Mahsulot  yangilandi !']);
    }

    public function destroy(Product $product): \Illuminate\Http\JsonResponse
    {
        if (!$product->delete()) {
            return $this->respondError('Xatolik yuz berdi, iltimos qayta urining.');
        }

        return $this->respondNoContent();
    }
}
