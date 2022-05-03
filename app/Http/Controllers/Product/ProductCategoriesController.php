<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product_category;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        return Product_category::whereLike(['name'], request('search'))
            ->select(['id', 'name', 'parent_id', 'type'])
            ->get();
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate(request(), [
            'parent_id' => 'required',
            'name' => 'required|unique:product_categories,name',
            'description' => 'max:100'
        ],
            [
                'parent_id.required' => 'Iltimos,kategoriyani tanlang !',
                'name.required' => 'Iltimos, yangi turni nomini kiriting !',
                'name.unique' => 'Bu nom oldin kiritilgan !',
                'description.max' => 'Iltimos, tavsif 100 ta belgidan oshmasin !',
            ]
        );

        $productCategory = Product_category::create($request->only('parent_id', 'name', 'description'));

        return $this->respondWithSuccess(['Yangi tur qo\'shildi !', $productCategory]);
    }

    public function show(Product_category $product_category): \Illuminate\Http\JsonResponse
    {
        return $this->respondWithSuccess($product_category);
    }

    public function update(Request $request, Product_category $product_category): \Illuminate\Http\JsonResponse
    {
        $this->validate(request(), [
            'parent_id' => 'required',
            'name' => 'required',
            'description' => 'max:100'
        ],
            [
                'parent_id.required' => 'Iltimos,kategoriyani tanlang !',
                'name.required' => 'Iltimos, yangi turni nomini kiriting !',
                'description.max' => 'Iltimos, tavsif 100 ta belgidan oshmasin !',
            ]
        );

        $product_category->update($request->only('parent_id', 'name', 'description'));

        return $this->respondWithSuccess(['message' => 'Yangi tur yangilandi !']);
    }

    public function destroy(Product_category $product_category): \Illuminate\Http\JsonResponse
    {
        $product_category->delete();

        return $this->respondNoContent();
    }
}
