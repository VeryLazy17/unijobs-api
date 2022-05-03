<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Debtor;
use App\Models\Debtor_history_payment;
use App\Models\Factory_product;
use App\Models\Sale;
use App\Models\Sale_payment;
use App\Models\Storage;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Sale::with('product:id,code,name', 'client:id,name')
            ->whereRelation('product', 'product_category_id', '=', \request('category_id'))
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->whereLike(['.product[name,code]', '.client[name]', 'amount', 'price', 'total_price'], request('search'))
            ->select(['id', 'product_id', 'client_id', 'amount', 'price', 'total_price', 'created_at'])
            ->paginate(10);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'product_id' => 'required',
            'client_id' => 'required',
            'amount' => 'required|max:12',
            'price' => 'required|max:12',
            'total_price' => 'required|max:12',
            'paid' => 'max:12',
            'created_at' => 'required'
        ],
            [
                'product_id.required' => 'Iltimos,mahsulotni tanlang !',
                'client_id.required' => 'Iltimos,xaridorni kiriting !',
                'amount.required' => 'Iltimos,miqdorni kiriting !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'price.required' => 'Iltimos,narxni kiriting !',
                'price.max' => 'Iltimos,narx 12 ta belgidan oshmasin !',
                'total_price.required' => 'Iltimos,umumiy summani kiriting !',
                'total_price.max' => 'Iltimos,umumiy summa 12 ta belgidan oshmasin !',
                'paid.max' => 'Iltimos,summa 12 ta belgidan oshmasin !',
                'created_at' => 'Iltimos,sanani tanlang !'
            ]
        );

        if ($request['total_price'] < $request['paid']) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        $storage = Storage::whereStorageTypeId(3)->whereProductId($request['product_id'])->whereProductCase('ready')->first();

        if (!$storage) {
            return response()->json(['success' => false, 'message' => 'Skladda bu tovar yo\'q!'], 409);
        }

        if ($storage->amount < $request['amount']) {
            return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda tovar yo\'q!'], 409);
        }

        $sale = new Sale();
        $sale->product_id = $request['product_id'];
        $sale->client_id = $request['client_id'];
        $sale->amount = $request['amount'];
        $sale->price = $request['price'];
        $sale->total_price = $request['total_price'];
        if ($request['total_price'] == $request['paid']) {
            $sale->is_debt = '0';
        } else {
            $sale->is_debt = '1';
        }
        $sale->created_at = $request['created_at'];
        $sale->save();

        $debtor = Debtor::whereClientId($request['client_id'])->first();

        if ($debtor) {
            $totalDebt = $debtor->total_debt;
            $totalPaid = $debtor->total_paid;
            $totalDebt += $request['total_price'];
            $totalPaid += $request['paid'];
            $debtor->total_debt = $totalDebt;
            $debtor->total_paid = $totalPaid;
            $debtor->update();

            if ($request['paid'] != 0) {
                Debtor_history_payment::insert([
                    'debtor_id' => $debtor->id,
                    'sum' => $request['paid'],
                    'created_at' => $request['created_at']
                ]);
            }
        } else {
            $debtors = Debtor::create([
                'client_id' => $request['client_id'],
                'total_debt' => $request['total_price'],
                'total_paid' => $request['paid'],
                'created_at' => $request['created_at']
            ]);

            if ($request['paid'] != 0) {
                Debtor_history_payment::insert([
                    'debtor_id' => $debtors->id,
                    'sum' => $request['paid'],
                    'created_at' => $request['created_at']
                ]);
            }
        }

        //storage update product amount
        $amountOfStorage = $storage->amount;
        $amountOfStorage -= $request['amount'];
        $storage->amount = $amountOfStorage;
        $storage->update();

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Mahsulot sotildi.');
    }

    public function show(Sale $sale)
    {
        return $sale;
    }

    public function update(Request $request, Sale $sale)
    {
        $this->validate(request(), [
            'amount' => 'required|max:12',
            'price' => 'required|max:12',
            'total_price' => 'required|max:12'
        ],
            [
                'amount.required' => 'Iltimos,miqdorni kiriting !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'price.required' => 'Iltimos,narxni kiriting !',
                'price.max' => 'Iltimos,narx 12 ta belgidan oshmasin !',
                'total_price.required' => 'Iltimos,umumiy summani kiriting !',
                'total_price.max' => 'Iltimos,umumiy summa 12 ta belgidan oshmasin !'
            ]
        );

        $debtor = Debtor::whereClientId($sale->client_id)->first();

        if ($debtor->total_debt < $sale->total_price) {
            return response()->json(['success' => false, 'message' => 'Xatolik qayta uruning!'], 409);
        }

        $storage = Storage::whereStorageTypeId(3)->whereProductId($sale->product_id)
            ->whereProductCase('ready')->first();

        if (!$storage && ($sale->amount < $request['amount'])) {
            return response()->json(['success' => false, 'message' => 'Skladda bu tovar yo\'q!'], 409);
        }

        if ($storage) {
            $amountOfStorage = $storage->amount;
            $amountOfStorage += $sale->amount;
            if ($amountOfStorage < $request['amount']) {
                return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda tovar yo\'q!'], 409);
            }
        } else {
            Storage::create([
                'storage_type_id' => '3',
                'product_id' => $sale->product_id,
                'amount' => $sale->amount,
                'product_case' => 'ready',
            ]);
            $storage = Storage::whereStorageTypeId(3)->whereProductId($sale->product_id)
                ->whereProductCase('ready')->first();
            $amountOfStorage = $storage->amount;
        }
        $amountOfStorage -= $request['amount'];
        $storage->amount = $amountOfStorage;
        $storage->update();

        $sale->update($request->only('amount', 'price', 'total_price'));

        return $this->respondOk('Muvaffaqiyatli yangilandi.');
    }

    public function destroy(Sale $sale)
    {
        $storage = Storage::whereStorageTypeId(2)->whereProductId($sale->product_id)
            ->whereProductCase('ready')->first();

        if (!$storage) {
            return response()->json(['success' => false, 'message' => 'Skladdada bu tovar yo\'q!'], 409);
        }

        if ($storage->amount < $sale->amount) {
            return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda tovar yo\'q!'], 409);
        }

        $amountOfStorage = $storage->amount;
        $amountOfStorage -= $sale->amount;
        $storage->amount = $amountOfStorage;
        $storage->update();

        $sale->delete();

        return $this->respondOk('Muvaffaqiyatli o\'chirildi.');
    }
}
