<?php

namespace App\Http\Controllers\Sewing;

use App\Http\Controllers\Controller;
use App\Models\Factory_product;
use App\Models\Sewing_payment;
use App\Models\Sewing_report;
use App\Models\Storage;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class SewingReportsController extends Controller
{
    use ApiResponseHelpers;

    public function getHistorySewed()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Sewing_report::with('product:id,code,name')
            ->select(['id', 'product_id', 'amount', 'amount_using', 'amount_sewed', 'waste_amount', 'waste_percentage', 'total_price', 'created_at', 'color'])
            ->whereLike(['.product[name,code]', 'amount', 'amount_using', 'color', 'amount_sewed', 'waste_amount', 'waste_percentage', 'total_price',], \request('search'))
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

    public function historyUpdateSewed(Request $request, $id)
    {
        $this->validate(request(), [
            'amount' => 'required|max:12',
            'amount_using' => 'required|max:12',
            'amount_sewed' => 'required|max:12',
            'waste_percentage' => 'required',
            'waste_amount' => 'required|max:12',
            'total_price' => 'required|max:12',
        ],
            [
                'amount.required' => 'Iltimos,olingan donani kiriting !',
                'amount.max' => 'Iltimos,olingan dona 12 ta belgidan oshmasin !',
                'amount_using.required' => 'Iltimos,ishlatilgan miqdorni kiriting !',
                'amount_using.max' => 'Iltimos,ishlatilgan mahsulot 12 ta belgidan oshmasin !',
                'amount_sewed.required' => 'Iltimos,bichilgan miqdorni kiriting !',
                'amount_sewed.max' => 'Iltimos,bichilgan mahsulot 12 ta belgidan oshmasin !',
                'percentage_amount.required' => 'Iltimos,ispareniyani kiriting !',
                'total_price.required' => 'Iltimos,narxni kiriting !',
                'total_price.max' => 'Iltimos,narx 12 ta belgidan oshmasin !',
            ]
        );

        $sewing_report = Sewing_report::findOrFail($id);

        $sum = 0;
        foreach ($sewing_report->sewing_payments as $item) {
            $sum += $item->sum;
        }

        if (($sewing_report->total_price != $request['total_price']) && $request['total_price'] < $sum) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        $storageProduct = Storage::whereStorageTypeId(2)->whereColor($sewing_report->color)
            ->whereProductId($sewing_report->product_id)->whereProductCase('sewed')->first();

        if (!$storageProduct) {
            return response()->json(['success' => false, 'message' => 'Skladda bichilgan tovar yo\'q!'], 409);
        }

        if ($storageProduct->amount < $sewing_report->amount) {
            return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda bichilgan tovar yo\'q!'], 409);
        }

        if ($request['total_price'] != $sum) {
            $sewing_report->is_debt = '1';
        } else {
            $sewing_report->is_debt = '0';
        }
        $sewing_report->update();

        $storage = Storage::whereStorageTypeId(2)->whereProductId($sewing_report->product_id)
            ->whereColor($sewing_report->color)->whereProductCase('painted')->first();

        if ($storage) {
            $amountOfStorage = $storage->amount;
            $amountOfStorage += $sewing_report->amount_using;
        } else {
            Storage::create([
                'storage_type_id' => '2',
                'product_id' => $sewing_report->product_id,
                'amount' => $sewing_report->amount_using,
                'color' => $sewing_report->color,
                'product_case' => 'painted',
            ]);

            $storage = Storage::whereStorageTypeId(2)->whereProductId($sewing_report->product_id)
                ->whereColor($sewing_report->color)->whereProductCase('painted')->first();
            $amountOfStorage = $storage->amount;
        }
        $amountOfStorage -= $request['amount_using'];
        $storage->amount = $amountOfStorage;
        $storage->update();

        //storage update product amount
        $amountOfStorageProduct = $storageProduct->amount;
        $amountOfStorageProduct -= $sewing_report->amount;
        $amountOfStorageProduct += $request['amount'];
        $storageProduct->amount = $amountOfStorageProduct;
        $storageProduct->update();

        $sewing_report->update($request->only('amount', 'amount_using', 'amount_sewed', 'waste_percentage', 'waste_amount', 'total_price'));

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Muvaffaqiyatli yangilandi.');
    }

    public function historyDeleteSewed($id)
    {
        $sewing_report = Sewing_report::findOrFail($id);

        $storageProduct = Storage::whereStorageTypeId(2)->whereColor($sewing_report->color)
            ->whereProductId($sewing_report->product_id)->whereProductCase('sewed')->first();

        if (!$storageProduct) {
            return response()->json(['success' => false, 'message' => 'Skladda bichilgan tovar yo\'q!'], 409);
        }

        if ($storageProduct->amount < $sewing_report->amount) {
            return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda bichilgan tovar yo\'q!'], 409);
        }

        //storage update product amount
        $amountOfStorageProduct = $storageProduct->amount;
        $amountOfStorageProduct -= $sewing_report->amount;
        $storageProduct->amount = $amountOfStorageProduct;
        $storageProduct->update();

        $storage = Storage::whereStorageTypeId(2)->whereProductId($sewing_report->product_id)
            ->whereColor($sewing_report->color)->whereProductCase('painted')->first();

        if ($storage) {
            $amountOfStorage = $storage->amount;
            $amountOfStorage += $sewing_report->amount_using;
            $storage->amount = $amountOfStorage;
            $storage->update();
        } else {
            Storage::create([
                'storage_type_id' => '2',
                'product_id' => $sewing_report->product_id,
                'amount' => $sewing_report->amount_using,
                'color' => $sewing_report->color,
                'product_case' => 'painted',
            ]);
        }

        $sewing_report->sewing_payments()->delete();
        $sewing_report->delete();

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Muvaffaqiyatli o\'chirildi.');
    }
}
