<?php

namespace App\Http\Controllers\Factory;

use App\Http\Controllers\Controller;
use App\Models\Factory_category;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class FactoryCategoriesController extends Controller
{
    use ApiResponseHelpers;

    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->respondWithSuccess(Factory_category::all());
    }
}
