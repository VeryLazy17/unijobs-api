<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Storage;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class StoragesController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        return Storage::with('product')
            ->whereLike(['.product[name,code]', 'amount'], request('search'))
            ->orderByDesc('created_at')
            ->paginate(20);
    }

    public function getStorageThread()
    {
        return Storage::whereStorageTypeId(1)
            ->with('product:id,name,code')
            ->select(['id', 'product_id', 'amount'])
            ->whereHas('product.product_category', function ($query) {
                return $query->whereType('thread');
            })
            ->whereLike(['.product[name,code]', 'amount'], request('search'))
            ->paginate(20);
    }

    public function getStorageMaterial(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Storage::whereStorageTypeId(1)
            ->with('product:id,code,name')
            ->whereHas('product.product_category', function ($query) {
                $query->whereType('material');
            })
            ->whereLike(['.product[name,code]', 'amount', 'color'], request('search'))
            ->orderByDesc('created_at')
            ->paginate(20);
    }

    public function getStorageProduct()
    {
        if (!empty(request('parent_id'))) {
            return Storage::whereStorageTypeId(request('storage_type'))
                ->with('product:id,name,code,product_category_id', 'product.product_category:id,name')
                ->select(['id', 'product_id', 'color', 'amount'])
                ->whereHas('product', function ($query) {
                    $query->whereProductCategoryId(request('parent_id'));
                })
                ->whereLike(['.product[name,code]', 'amount', 'color'], request('search'))
                ->orderByDesc('created_at')
                ->paginate(20);
        }

        if (!empty(\request('category_id'))) {
            return Storage::whereStorageTypeId(request('storage_type'))
                ->with('product:id,name,code,product_category_id', 'product.product_category:id,name')
                ->select(['id', 'product_id', 'color', 'amount'])
                ->whereRelation('product', 'product_category_id', '=', \request('category_id'))
                ->whereLike(['.product[name,code]', 'amount', 'color'], request('search'))
                ->orderByDesc('created_at')
                ->paginate(20);
        }


        return Storage::whereStorageTypeId(request('storage_type'))
            ->with('product:id,name,code,product_category_id', 'product.product_category:id,name')
            ->select(['id', 'product_id', 'color', 'amount'])
            ->whereHas('product.product_category', function ($query) {
                $query->whereParentId(request('status'));
            })
            ->whereLike(['.product[name,code]', 'amount', 'color'], request('search'))
            ->orderByDesc('created_at')
            ->paginate(20);
    }

    public function getStoragePaintedProduct()
    {
        return Storage::whereStorageTypeId(2)
            ->whereRelation('product.product_category', 'parent_id', '=', request('parent_id'))
            ->whereProductCase(\request('product_case'))
            ->whereLike(['.product[name,code]', 'amount', 'color'], request('search'))
            ->with('product:id,code,name,product_category_id', 'product.product_category:id,name')
            ->select(['id', 'product_id', 'color', 'amount'])
            ->orderByDesc('created_at')
            ->paginate(20);//60
    }

    public function getStorageSewed()
    {
        return Storage::whereStorageTypeId(2)
            ->whereProductCase(\request('product_case'))
            ->whereLike(['.product[name,code]', 'amount', 'color'], request('search'))
            ->with('product:id,code,name,product_category_id', 'product.product_category:id,name')
            ->select(['id', 'product_id', 'color', 'amount'])
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function getStorageFilteredSewed()
    {
        return Storage::whereStorageTypeId(2)
            ->whereProductCase(\request('product_case'))
            ->whereRelation('product', 'product_category_id', '=', \request('product_category_id'))
            ->whereLike(['.product[name,code]', 'amount', 'color'], request('search'))
            ->with('product:id,code,name,product_category_id', 'product.product_category:id,name')
            ->select(['id', 'product_id', 'color', 'amount'])
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function getReadyStorageProduct()
    {
        return Storage::whereProductCase('ready')
            ->whereRelation('product', 'product_category_id', '=', \request('category_id'))
            ->whereLike(['.product[name,code]', 'amount', 'price'], request('search'))
            ->with('product:id,code,name')
            ->select(['id', 'product_id', 'amount', 'price'])
            ->orderByDesc('created_at')
            ->paginate(20);
    }

    public function show(Storage $storage)
    {
        return $storage;
    }

    public function update(Request $request, Storage $storage)
    {
        $this->validate(request(), [
            'amount' => 'required|max:12',
            'price' => 'max:12'
        ],
            [
                'amount.required' => 'Iltimos,miqdorni kiriting !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'price.max' => 'Iltimos,narx 12 ta belgidan oshmasin !',
            ]
        );

        if (!empty($request['price'])) {
            $storage->update($request->only('amount', 'price'));
        }

        $storage->update($request->only('amount'));

        return $this->respondOk('Muvaffaqiyatli yangilandi.');

    }

    public function destroy(Storage $storage)
    {
        $storage->delete();

        return $this->respondOk('Muvaffaqiyatli o\'chirildi.');
    }
}
