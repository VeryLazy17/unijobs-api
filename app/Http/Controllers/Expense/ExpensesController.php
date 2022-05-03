<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    use ApiResponseHelpers;

    public function store(Request $request)
    {
        $this->validate(request(), [
            'sum' => 'required|max:12',
            'description' => 'max:100',
            'created_at' => 'required',
        ],
            [
                'sum.required' => 'Iltimos,summani kiriting !',
                'sum.max' => 'Iltimos,summa 12 ta belgidan oshmasin !',
                'description.max' => 'Iltimos, tavsif 100 ta belgidan oshmasin!',
                'created_at.required' => 'Iltimos,sanani tanlang!',
            ]
        );

        Expense::create($request->only('sum', 'description', 'created_at'));

        return $this->respondOk('Xarajat qo\'shildi.');
    }
}
