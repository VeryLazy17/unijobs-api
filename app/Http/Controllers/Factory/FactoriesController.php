<?php

namespace App\Http\Controllers\Factory;

use App\Http\Controllers\Controller;
use App\Models\Factory;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class FactoriesController extends Controller
{
    use ApiResponseHelpers;

    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->respondWithSuccess(
            Factory::with('factory_category:id,name,type')
                ->whereLike(['name'], request('search'))
                ->select(['id', 'name', 'factory_category_id'])->get());
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate(request(), [
            'name' => 'required|unique:factories,name',
            'description' => 'max:100',
            'factory_category_id' => 'required',
        ],
            [
                'name.required' => 'Iltimos,nomni kiriting!',
                'name.unique' => 'Bu nom avval kiritilgan!',
                'description.max' => 'Iltimos, tavsif 100 ta belgidan oshmasin!',
                'factory_category_id.required' => 'Iltimos,fabrika kategoriyasini tanlang!',
            ]
        );

        $factoryCreate = Factory::create($request->only('factory_category_id', 'name', 'description'));

        if (!$factoryCreate) {
            return $this->respondError('Xatolik yuz berdi, iltimos qayta urining.');
        }

        return $this->respondOk('Yangi fabrika qo\'shildi.');
    }

    public function show(Factory $factory): \Illuminate\Http\JsonResponse
    {
        return $this->respondWithSuccess($factory);
    }

    public function update(Request $request, Factory $factory): \Illuminate\Http\JsonResponse
    {
        $this->validate(request(), [
            'name' => 'required',
            'description' => 'max:100',
            'factory_category_id' => 'required',
        ],
            [
                'name.required' => 'Iltimos,nomni kiriting!',
                'name.unique' => 'Bu nom oldin kiritilgan!',
                'description.max' => 'Iltimos, tavsif 100 ta belgidan oshmasin!',
                'factory_category_id.required' => 'Iltimos,fabrika kategoriyasini tanlang!',
            ]
        );

        if (!$factory->update($request->only('factory_category_id', 'name', 'description'))) {
            return $this->respondError('Xatolik yuz berdi, iltimos qayta urining.');
        }

        return $this->respondWithSuccess(['message' => 'Fabrika  yangilandi !']);
    }

    public function destroy(Factory $factory): \Illuminate\Http\JsonResponse
    {
        if (!$factory->delete()) {
            return $this->respondError('Xatolik yuz berdi, iltimos qayta urining.');
        }

        return $this->respondNoContent();
    }
}
