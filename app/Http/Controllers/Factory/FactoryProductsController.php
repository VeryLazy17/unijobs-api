<?php

namespace App\Http\Controllers\Factory;

use App\Http\Controllers\Controller;
use App\Models\Factory_product;
use App\Models\Storage;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class FactoryProductsController extends Controller
{
    use ApiResponseHelpers;

    public function index(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Factory_product::with('product.product_category', 'factory.factory_category')->paginate(20);
    }

    public function getFactoryProductThread(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Factory_product::whereProductCase(request('product_case'))
            ->whereFactoryId(request('factory'))
            ->whereRelation('product.product_category', 'type', '=', 'thread')
            ->select(['id', 'product_id', 'amount'])
            ->whereLike(['.product[name,code]', 'amount','.factory[name]'], request('search'))
            ->with('product:id,name,code')
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function transferProduct(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate(request(), [
            'factory_id' => 'required',
            'which_factory_id' => 'required',
            'product_id' => 'required',
            'amount' => 'required|max:12'
        ],
            [
                'factory_id.required' => 'Iltimos,fabrikani tanlang !',
                'which_factory_id.required' => 'Iltimos,o\'tkazadigan fabrikani tanlang !',
                'product_id.required' => 'Iltimos,mahsulotni kiriting !',
                'amount.required' => 'Iltimos,maydonni to\'ldiring !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
            ]
        );


        $factoryProduct = Factory_product::whereProductId($request['product_id'])
            ->whereProductCase('raw')->whereFactoryId($request['factory_id'])->first();

        if ($factoryProduct->amount < $request['amount']) {
            return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda tovar yo\'q!']);
        }
        $amountOfFactoryProduct = $factoryProduct->amount;
        $amountOfFactoryProduct -= $request['amount'];
        $factoryProduct->amount = $amountOfFactoryProduct;
        $factoryProduct->update();

        if ($request['which_factory_id'] != 'storage') {
            $transferFactoryProduct = Factory_product::whereProductId($request['product_id'])
                ->whereProductCase('raw')->whereFactoryId($request['which_factory_id'])->first();
            if (!$transferFactoryProduct) {
                Factory_product::create([
                    'factory_id' => $request['which_factory_id'],
                    'product_id' => $request['product_id'],
                    'amount' => $request['amount'],
                    'product_case' => 'raw',
                ]);
            } else {
                $amountOfTransferFactoryProduct = $transferFactoryProduct->amount;
                $amountOfTransferFactoryProduct += $request['amount'];
                $transferFactoryProduct->amount = $amountOfTransferFactoryProduct;
                $transferFactoryProduct->update();
            }
        } else {
            $storage = Storage::whereProductId($request['product_id'])->whereStorageTypeId(1)->first();
            $amountOfStorage = $storage->amount;
            $amountOfStorage += $request['amount'];
            $storage->amount = $amountOfStorage;
            $storage->update();
        }

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Mahsulot o\'tkazildi.');
    }
}
