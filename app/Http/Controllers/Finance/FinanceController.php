<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Debtor;
use App\Models\Expense;
use App\Models\Order;
use App\Models\Order_payment;
use App\Models\Product_income;
use App\Models\Product_income_payment;
use App\Models\Sewing_payment;
use App\Models\Sewing_report;
use Carbon\Carbon;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FinanceController extends Controller
{
    use ApiResponseHelpers;

    public function getFinanceIncome()
    {
        return Debtor::select(['id', 'client_id', 'total_debt', 'total_paid', 'created_at'])
            ->with('client:id,name,phone_number')->paginate(20);
    }

    public function getProductDebtor()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Product_income::where('is_debt', '1')
            ->with('product:code,name,id')
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->select(['id', 'code', 'from_where', 'product_id', 'amount', 'price', 'total_price', 'created_at'])
            ->withSum('product_payments', 'sum')->paginate(10);
    }

    public function getOutgoingPayments()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Order_payment::with('order:id,factory_id,product_id,amount,price,total_price', 'order.factory:id,name', 'order.product:id,name')
            ->select(['id', 'order_id', 'sum', 'created_at'])
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->paginate(20);
    }

    public function getProductIncomePayments()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Product_income_payment::with('product_income:id,product_id,amount,price,total_price,from_where', 'product_income.product:id,name,code')
            ->select(['id', 'product_income_id', 'sum', 'created_at'])
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->paginate(20);
    }

    public function getSewingPayments()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Sewing_payment::with('sewing_report:id,product_id,amount,total_price,color', 'sewing_report.product:id,code,name')
            ->select(['id', 'sewing_report_id', 'sum', 'created_at'])
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->paginate(20);
    }

    public function getExpenses()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Expense::select(['id', 'description', 'sum', 'created_at'])
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->paginate(20);
    }

    public function getDebtAnalytics()
    {
        $currentDate = Carbon::now();

        $orderPayment = Order_payment::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('sum');

        $productIncome = Product_income::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('total_price');

        $buyProductPayment = Product_income_payment::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('sum');

        $orderTotalDebt = Order::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('total_price');

        $sewingTotalDebt = Sewing_report::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('total_price');

        $sewingPayment = Sewing_payment::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('sum');

        //Qarzdorlik
        $debt = 0;
        $orderTotalDebt -= $orderPayment;
        $productIncome -= $buyProductPayment;
        $sewingTotalDebt -= $sewingPayment;
        $debt = $orderTotalDebt + $sewingTotalDebt; //without product income
//        $debt = $orderTotalDebt + $productIncome + $sewingTotalDebt;

        //Mato to'quv qarzdorlik
        $orders = Order::whereRelation('factory.factory_category', 'type', '=', 'material')
            ->select(['id', 'total_price'])
            ->withSum('order_payments', 'sum')->get();

        $sumOrderTotalPriceMaterial = 0;
        $sumOrderPaymentsMaterial = 0;
        $materialDebtors = 0;

        foreach ($orders as $item) {
            $sumOrderTotalPriceMaterial += $item->total_price;
            $sumOrderPaymentsMaterial += $item->order_payments_sum_sum;
        }
        $materialDebtors = $sumOrderTotalPriceMaterial - $sumOrderPaymentsMaterial;

        //Yoqa to'quv qarzdorlik
        $orders = Order::whereRelation('factory.factory_category', 'type', '=', 'collar')
            ->select(['id', 'total_price'])
            ->withSum('order_payments', 'sum')->get();

        $sumOrderTotalPriceCollar = 0;
        $sumOrderPaymentsCollar = 0;
        $collarDebtors = 0;

        foreach ($orders as $item) {
            $sumOrderTotalPriceCollar += $item->total_price;
            $sumOrderPaymentsCollar += $item->order_payments_sum_sum;
        }
        $collarDebtors = $sumOrderTotalPriceCollar - $sumOrderPaymentsCollar;

        //Bo'yoqxona qarzdorlik
        $orders = Order::whereRelation('factory.factory_category', 'type', '=', 'paint')
            ->select(['id', 'total_price'])
            ->withSum('order_payments', 'sum')->get();

        $sumOrderTotalPricePainting = 0;
        $sumOrderPaymentsPainting = 0;
        $paintingDebtors = 0;

        foreach ($orders as $item) {
            $sumOrderTotalPricePainting += $item->total_price;
            $sumOrderPaymentsPainting += $item->order_payments_sum_sum;
        }
        $paintingDebtors = $sumOrderTotalPricePainting - $sumOrderPaymentsPainting;


        //Fabrikalar qarzdorlik
        $orders = Order::whereRelation('factory.factory_category', 'type', '=', 'factory')
            ->select(['id', 'total_price'])
            ->withSum('order_payments', 'sum')->get();

        $sumOrderTotalPriceFactory = 0;
        $sumOrderPaymentsFactory = 0;
        $factoryDebtors = 0;

        foreach ($orders as $item) {
            $sumOrderTotalPriceFactory += $item->total_price;
            $sumOrderPaymentsFactory += $item->order_payments_sum_sum;
        }
        $factoryDebtors = $sumOrderTotalPriceFactory - $sumOrderPaymentsFactory;

        //Bichuvxona qarzdorlik
        $sewingDebtors = 0;
        $sewingDebtors = $sewingTotalDebt - $sewingPayment;

        return response()->json([
            'debt' => $debt,
            'materialDebtors' => $materialDebtors,
            'collarDebtors' => $collarDebtors,
            'paintingDebtors' => $paintingDebtors,
            'factoryDebtors' => $factoryDebtors,
            'sewingDebtors' => $sewingDebtors
        ]);
    }

    public function getFactoryDebt()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Order::where('is_debt', '1')
            ->whereRelation('factory.factory_category', 'type', '=', request('factory_type'))
            ->whereLike(['code', '.factory[name]', '.product[name,code]', 'color_code', 'amount', 'price', 'total_price'], request('search'))
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->where(function ($query) {
                if (!empty(\request('factory'))) {
                    $query->where('factory_id', \request('factory'));
                }
            })
            ->with('factory:id,name', 'product:id,name,code')
            ->select(['id', 'total_price', 'created_at', 'factory_id', 'product_id', 'amount', 'color_code', 'price'])
            ->withSum('order_payments', 'sum')
            ->paginate(10);
    }

    public function getFactorySewedDebt()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Sewing_report::where('is_debt', '1')
            ->select(['id', 'total_price', 'created_at', 'amount', 'color', 'amount_using', 'amount_sewed'])
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->withSum('sewing_payments', 'sum')
            ->paginate(10);
    }

    public function paidOrderIncome(Request $request)
    {
        if (!empty($request['sewing_report_id'])) {
            $this->validate(request(), [
                'sewing_report_id' => 'required',
                'paid' => 'max:12',
                'created_at' => 'required'
            ],
                [
                    'sewing_report_id.required' => 'Iltimos,bichuv idsini tanlang !',
                    'paid.max' => 'Iltimos,summa 12 ta belgidan oshmasin !',
                    'created_at' => 'Iltimos,sanani tanlang !'
                ]
            );

            $sewingReport = Sewing_report::findOrFail($request['sewing_report_id']);

            $sum = 0;
            foreach ($sewingReport->sewing_payments as $item) {
                $sum += $item->sum;
            }
            $sum += $request['paid'];

            if ($sewingReport->total_price < $sum) {
                return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
            }

            if ($sewingReport->total_price == $sum) {
                $sewingReport->is_debt = '0';
                $sewingReport->update();
            }

            Sewing_payment::create([
                'sewing_report_id' => $request['sewing_report_id'],
                'sum' => $request['paid'],
                'created_at' => $request['created_at']
            ]);

            return $this->respondOk('Pul berildi.');
        }

        $this->validate(request(), [
            'order_id' => 'required',
            'paid' => 'max:12',
            'created_at' => 'required'
        ],
            [
                'order_id.required' => 'Xatolik yuz berdi. Id noto\'g\'ri belgilangan !',
                'paid.max' => 'Iltimos,summa 12 ta belgidan oshmasin !',
                'created_at' => 'Iltimos,sanani tanlang !'
            ]
        );

        $order = Order::findOrFail($request['order_id']);

        $sum = 0;
        foreach ($order->order_payments as $item) {
            $sum += $item->sum;
        }
        $sum += $request['paid'];

        if ($order->total_price < $sum) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        if ($order->total_price == $sum) {
            $order->is_debt = '0';
            $order->update();
        }

        Order_payment::create([
            'order_id' => $request['order_id'],
            'sum' => $request['paid'],
            'created_at' => $request['created_at']
        ]);


        return $this->respondOk('Pul berildi.');
    }

    public function getAllExpenses()
    {
        $expenses = Expense::all();
        $orderPayments = Order_payment::all();
        $productIncomePayments = Product_income_payment::all();
        $sewingPayments = Sewing_payment::all();

        $allExpenses = [];

        foreach ($expenses as $item) {
            $allExpenses[] = (object)[
                'expense_name' => $item->description,
                'sum' => $item->sum,
                'created_at' => $item->created_at
            ];
        }

        foreach ($orderPayments as $item) {
            $allExpenses[] = (object)[
                'expense_name' => $item->order->factory->name,
                'sum' => $item->sum,
                'created_at' => $item->created_at
            ];
        }

        foreach ($productIncomePayments as $item) {
            $allExpenses[] = (object)[
                'expense_name' => $item->product_income->product->name,
                'sum' => $item->sum,
                'created_at' => $item->created_at
            ];
        }

        foreach ($sewingPayments as $item) {
            $allExpenses[] = (object)[
                'expense_name' => "Bichuvga",
                'sum' => $item->sum,
                'created_at' => $item->created_at
            ];
        }

        array_multisort(array_column($allExpenses, 'created_at'), SORT_DESC, $allExpenses);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 20;
        $currentItems = array_slice($allExpenses, $perPage * ($currentPage - 1), $perPage);
        //with path of current page
        $allExpenses = (new LengthAwarePaginator($currentItems, count($allExpenses), $perPage, $currentPage));

        //Convert array of array to array of object
        $allExpenses->each(function ($item, $itemKey) use ($allExpenses) {
            $allExpenses[$itemKey] = (object)$item;
        });


        return $allExpenses;
    }

    public function paidProductIncome(Request $request)
    {
        $this->validate(request(), [
            'product_income_id' => 'required',
            'paid' => 'required|max:12',
            'created_at' => 'required'
        ],
            [
                'product_income_id.required' => 'Iltimos,id ni tanlang !',
                'paid.required' => 'Iltimos,summani kiriting !',
                'paid.max' => 'Iltimos,summa 12 ta belgidan oshmasin !',
                'created_at' => 'Iltimos,sanani tanlang !'
            ]
        );

        $productIncome = Product_income::findOrFail($request['product_income_id']);
        $sum = 0;
        foreach ($productIncome->product_payments as $item) {
            $sum += $item->sum;
        }
        $sum += $request['paid'];

        if ($productIncome->total_price < $sum) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        if ($productIncome->total_price == $sum) {
            $productIncome->is_debt = '0';
            $productIncome->update();
        }

        Product_income_payment::create([
            'product_income_id' => $request['product_income_id'],
            'sum' => $request['paid'],
            'created_at' => $request['created_at']
        ]);


        return $this->respondOk('Pul berildi.');

    }
}
