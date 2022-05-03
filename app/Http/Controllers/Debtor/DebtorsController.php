<?php

namespace App\Http\Controllers\Debtor;

use App\Http\Controllers\Controller;
use App\Models\Debtor;
use App\Models\Debtor_history_payment;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class DebtorsController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        return Debtor::with('client:id,name', 'payment_history:id,sum,created_at,debtor_id')
            ->whereLike(['total_paid', 'total_debt', '.client[name]'], \request('search'))
            ->select(['id','client_id','total_debt','total_paid','created_at'])
            ->paginate(10);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'debtor_id' => 'required',
            'paid' => 'required|max:12',
            'created_at' => 'required'
        ],
            [
                'debtor_id.required' => 'Iltimos, qarzdorni tanlang !',
                'paid.required' => 'Iltimos, summani kiriting !',
                'paid.max' => 'Iltimos, berilgan pul 12 ta belgidan oshmasin !',
                'created_at.required' => 'Iltimos, sanani tanlang !',
            ]
        );

        $debtor = Debtor::findOrFail($request['debtor_id']);
        $totalPaid = $debtor->total_paid;
        $totalPaid += $request['paid'];

        if ($debtor->total_debt < $totalPaid) {
            return response()->json(['success' => false, 'message' => 'Jami qarzdorlikdan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        $debtor->total_paid = $totalPaid;
        $debtor->update();

        Debtor_history_payment::create([
            'debtor_id' => $request['debtor_id'],
            'sum' => $request['paid'],
            'created_at' => $request['created_at']
        ]);

        return $this->respondOk('Pul berildi.');
    }
}
