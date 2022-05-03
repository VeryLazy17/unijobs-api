<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Storage_type;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class StorageTypesController extends Controller
{
    use ApiResponseHelpers;

    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->respondWithSuccess(Storage_type::all());
    }
}
