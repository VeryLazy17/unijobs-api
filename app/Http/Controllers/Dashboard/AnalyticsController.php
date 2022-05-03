<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Debtor;
use App\Models\Debtor_history_payment;
use App\Models\Expense;
use App\Models\Factory;
use App\Models\Factory_product;
use App\Models\Order;
use App\Models\Order_income;
use App\Models\Order_payment;
use App\Models\Product_income;
use App\Models\Product_income_payment;
use App\Models\Sale;
use App\Models\Sale_payment;
use App\Models\Sewing_payment;
use App\Models\Sewing_report;
use App\Models\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{

    public function getDashboardAnalytics()
    {
        $requestDate = new Carbon(request('date'));
        $requestLastMonth = $requestDate->month - 1;

        $currentDate = Carbon::now();
        $lastMonth = $currentDate->month - 1;

        if (!empty(\request('date'))) {

            $incomePaymentLastDate = Debtor_history_payment::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestLastMonth)->sum('sum');
            $incomePayment = Debtor_history_payment::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestDate->month)->sum('sum');

            $orderPaymentLastDate = Order_payment::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestLastMonth)->sum('sum');
            $orderPayment = Order_payment::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestDate->month)->sum('sum');

            $sewingPaymentLastDate = Sewing_payment::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestLastMonth)->sum('sum');
            $sewingPayment = Sewing_payment::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestDate->month)->sum('sum');

            $buyProductPaymentLastDate = Product_income_payment::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestLastMonth)->sum('sum');
            $buyProductPayment = Product_income_payment::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestDate->month)->sum('sum');

            $expensePaymentLastDate = Expense::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestLastMonth)->sum('sum');
            $expensePayment = Expense::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestDate->month)->sum('sum');

            $creditLastDate = Sale::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestLastMonth)->sum('total_price');
            $creditCurrentDate = Sale::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestDate->month)->sum('total_price');

            $productIncomeLastDate = Product_income::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestLastMonth)->sum('total_price');
            $productIncomeCurrentDate = Product_income::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestDate->month)->sum('total_price');

            $orderTotalDebtLastDate = Order::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestLastMonth)->sum('total_price');
            $orderTotalDebtCurrentDate = Order::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestDate->month)->sum('total_price');

            $sewingTotalDebtLastDate = Sewing_report::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestLastMonth)->sum('total_price');
            $sewingTotalDebtCurrentDate = Sewing_report::whereYear('created_at', $requestDate->year)->whereMonth('created_at', $requestDate->month)->sum('total_price');

            //Chiqim
            $expenseTotalCurrentDate = 0;
            $expenseTotalLastDate = 0;
            $expenseTotalCurrentDate = $orderPayment + $sewingPayment + $expensePayment + $buyProductPayment;
            $expenseTotalLastDate = $orderPaymentLastDate + $sewingPaymentLastDate + $expensePaymentLastDate + $buyProductPaymentLastDate;

            //Foyda
            $profitTotalCurrentDate = $incomePayment - $expenseTotalCurrentDate;
            $profitTotalLastDate = $incomePaymentLastDate - $expenseTotalLastDate;

            //Nasiya
            $creditTotalCurrentDate = 0;
            $creditTotalLastDate = 0;
            $creditTotalCurrentDate = $creditCurrentDate - $incomePayment;
            $creditTotalLastDate = $creditLastDate - $incomePaymentLastDate;

            //Qarzdorlik
            $debtTotalCurrentDate = 0;
            $debtTotalLastDate = 0;
            $orderTotalDebtCurrentDate -= $orderPayment;
            $orderTotalDebtLastDate -= $orderPaymentLastDate;
            $productIncomeCurrentDate -= $buyProductPayment;
            $productIncomeLastDate -= $buyProductPaymentLastDate;
            $sewingTotalDebtCurrentDate -= $sewingPayment;
            $sewingTotalDebtLastDate -= $sewingPaymentLastDate;
            $debtTotalCurrentDate = $orderTotalDebtCurrentDate + $productIncomeCurrentDate + $sewingTotalDebtCurrentDate;
            $debtTotalLastDate = $orderTotalDebtLastDate + $productIncomeLastDate + $sewingTotalDebtLastDate;

            return response()->json([
                'incomeCurrentDate' => $incomePayment,//Kirim shu oygi
                'incomeLastDate' => $incomePaymentLastDate, //Kirim o'tgan oygi
                'expenseTotalCurrentDate' => $expenseTotalCurrentDate, //Chiqim shu oygi
                'expenseTotalLastDate' => $expenseTotalLastDate, //Chiqim o'tgan oygi
                'profitTotalCurrentDate' => $profitTotalCurrentDate,//Foyda shu oygi
                'profitTotalLastDate' => $profitTotalLastDate,//Foyda o'tgan oygi
                'creditTotalCurrentDate' => $creditTotalCurrentDate,//Nasiya shu oygi
                'creditTotalLastDate' => $creditTotalLastDate,//Nasiya o'tgan oygi
                'debtTotalCurrentDate' => $debtTotalCurrentDate,//Qarzdorlik shu oygi
                'debtTotalLastDate' => $debtTotalLastDate,//Qarzdorlik o'tgan oygi
            ]);
        }

        $incomePaymentLastDate = Debtor_history_payment::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $lastMonth)->sum('sum');
        $incomePayment = Debtor_history_payment::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('sum');

        $orderPaymentLastDate = Order_payment::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $lastMonth)->sum('sum');
        $orderPayment = Order_payment::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('sum');

        $sewingPaymentLastDate = Sewing_payment::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $lastMonth)->sum('sum');
        $sewingPayment = Sewing_payment::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('sum');

        $buyProductPaymentLastDate = Product_income_payment::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $lastMonth)->sum('sum');
        $buyProductPayment = Product_income_payment::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('sum');

        $expensePaymentLastDate = Expense::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $lastMonth)->sum('sum');
        $expensePayment = Expense::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('sum');

        $creditLastDate = Sale::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $lastMonth)->sum('total_price');
        $creditCurrentDate = Sale::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('total_price');

        $productIncomeLastDate = Product_income::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $lastMonth)->sum('total_price');
        $productIncomeCurrentDate = Product_income::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('total_price');

        $orderTotalDebtLastDate = Order::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $lastMonth)->sum('total_price');
        $orderTotalDebtCurrentDate = Order::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('total_price');

        $sewingTotalDebtLastDate = Sewing_report::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $lastMonth)->sum('total_price');
        $sewingTotalDebtCurrentDate = Sewing_report::whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->sum('total_price');

        //Chiqim
        $expenseTotalCurrentDate = 0;
        $expenseTotalLastDate = 0;
        $expenseTotalCurrentDate = $orderPayment + $sewingPayment + $expensePayment + $buyProductPayment;
        $expenseTotalLastDate = $orderPaymentLastDate + $sewingPaymentLastDate + $expensePaymentLastDate + $buyProductPaymentLastDate;

        //Foyda
        $profitTotalCurrentDate = $incomePayment - $expenseTotalCurrentDate;
        $profitTotalLastDate = $incomePaymentLastDate - $expenseTotalLastDate;

        //Nasiya
        $creditTotalCurrentDate = 0;
        $creditTotalLastDate = 0;
        $creditTotalCurrentDate = $creditCurrentDate - $incomePayment;
        $creditTotalLastDate = $creditLastDate - $incomePaymentLastDate;

        //Qarzdorlik
        $debtTotalCurrentDate = 0;
        $debtTotalLastDate = 0;
        $orderTotalDebtCurrentDate -= $orderPayment;
        $orderTotalDebtLastDate -= $orderPaymentLastDate;
        $productIncomeCurrentDate -= $buyProductPayment;
        $productIncomeLastDate -= $buyProductPaymentLastDate;
        $sewingTotalDebtCurrentDate -= $sewingPayment;
        $sewingTotalDebtLastDate -= $sewingPaymentLastDate;
        $debtTotalCurrentDate = $orderTotalDebtCurrentDate + $productIncomeCurrentDate + $sewingTotalDebtCurrentDate;
        $debtTotalLastDate = $orderTotalDebtLastDate + $productIncomeLastDate + $sewingTotalDebtLastDate;

        return response()->json([
            'incomeCurrentDate' => $incomePayment,//Kirim shu oygi
            'incomeLastDate' => $incomePaymentLastDate, //Kirim o'tgan oygi
            'expenseTotalCurrentDate' => $expenseTotalCurrentDate, //Chiqim shu oygi
            'expenseTotalLastDate' => $expenseTotalLastDate, //Chiqim o'tgan oygi
            'profitTotalCurrentDate' => $profitTotalCurrentDate,//Foyda shu oygi
            'profitTotalLastDate' => $profitTotalLastDate,//Foyda o'tgan oygi
            'creditTotalCurrentDate' => $creditTotalCurrentDate,//Nasiya shu oygi
            'creditTotalLastDate' => $creditTotalLastDate,//Nasiya o'tgan oygi
            'debtTotalCurrentDate' => $debtTotalCurrentDate,//Qarzdorlik shu oygi
            'debtTotalLastDate' => $debtTotalLastDate,//Qarzdorlik o'tgan oygi
        ]);
    }

    public function getDashboardProductAnalytics()
    {
        $storageThread = Storage::whereStorageTypeId(1)->whereProductCase('raw')->whereRelation('product.product_category', 'type', '=', 'thread')->sum('amount');
        $storageMaterialRaw = Storage::whereStorageTypeId(1)->whereProductCase('raw')->whereRelation('product.product_category', 'parent_id', '=', 2)->sum('amount');
        $storageCollarRaw = Storage::whereStorageTypeId(1)->whereProductCase('raw')->whereRelation('product.product_category', 'parent_id', '=', 3)->sum('amount');
        $storageMaterialPainted = Storage::whereStorageTypeId(2)->whereProductCase('painted')->whereRelation('product.product_category', 'parent_id', '=', 2)->sum('amount');
        $storageCollarPainted = Storage::whereStorageTypeId(2)->whereProductCase('painted')->whereRelation('product.product_category', 'parent_id', '=', 3)->sum('amount');
        $storageAccessory = Storage::whereStorageTypeId(2)->whereProductCase('raw')->whereRelation('product.product_category', 'parent_id', '=', 4)->sum('amount');
        $storageMaterialSewed = Storage::whereStorageTypeId(2)->whereProductCase('sewed')->whereRelation('product.product_category', 'parent_id', '=', 2)->sum('amount');
        $storageCollarSewed = Storage::whereStorageTypeId(2)->whereProductCase('sewed')->whereRelation('product.product_category', 'parent_id', '=', 3)->sum('amount');
        $storageProductReady = Storage::whereStorageTypeId(3)->whereProductCase('ready')->whereRelation('product.product_category', 'parent_id', '=', 5)->sum('amount');
        $factoryReadyProduct = Factory_product::whereProductCase('sewed')->whereRelation('product.product_category', 'parent_id', '=', 5)->sum('amount');

        return response()->json([
            'thread' => $storageThread,
            'materialRaw' => $storageMaterialRaw,
            'collarRaw' => $storageCollarRaw,
            'materialPainted' => $storageMaterialPainted,
            'collarPainted' => $storageCollarPainted,
            'accessoryRaw' => $storageAccessory,
            'materialSewed' => $storageMaterialSewed,
            'collarSewed' => $storageCollarSewed,
            'readyProduct' => $storageProductReady,
            'factoryReadyProduct' => $factoryReadyProduct
        ]);
    }

    public function getDashboardChartAnalytics()
    {
        $currentDate = Carbon::now();

        $month = [];
        for ($m = 1; $m <= 12; $m++) {
            $month[] = date('m', mktime(0, 0, 0, $m, 1, date('Y')));
        }

        //Kirim
        $januarySalePayments = DB::table('debtor_history_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[0])->sum('sum');
        $februarySalePayments = DB::table('debtor_history_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[1])->sum('sum');
        $marchSalePayments = DB::table('debtor_history_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[2])->sum('sum');
        $aprilSalePayments = DB::table('debtor_history_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[3])->sum('sum');
        $maySalePayments = DB::table('debtor_history_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[4])->sum('sum');
        $juneSalePayments = DB::table('debtor_history_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[5])->sum('sum');
        $julySalePayments = DB::table('debtor_history_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[6])->sum('sum');
        $augustSalePayments = DB::table('debtor_history_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[7])->sum('sum');
        $septemberSalePayments = DB::table('debtor_history_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[8])->sum('sum');
        $octoberSalePayments = DB::table('debtor_history_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[9])->sum('sum');
        $novemberSalePayments = DB::table('debtor_history_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[10])->sum('sum');
        $decemberSalePayments = DB::table('debtor_history_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[11])->sum('sum');

        //Chiqim
        $januaryExpensePayments = DB::table('expenses')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[0])->sum('sum');
        $februaryExpensePayments = DB::table('expenses')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[1])->sum('sum');
        $marchExpensePayments = DB::table('expenses')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[2])->sum('sum');
        $aprilExpensePayments = DB::table('expenses')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[3])->sum('sum');
        $mayExpensePayments = DB::table('expenses')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[4])->sum('sum');
        $juneExpensePayments = DB::table('expenses')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[5])->sum('sum');
        $julyExpensePayments = DB::table('expenses')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[6])->sum('sum');
        $augustExpensePayments = DB::table('expenses')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[7])->sum('sum');
        $septemberExpensePayments = DB::table('expenses')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[8])->sum('sum');
        $octoberExpensePayments = DB::table('expenses')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[9])->sum('sum');
        $novemberExpensePayments = DB::table('expenses')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[10])->sum('sum');
        $decemberExpensePayments = DB::table('expenses')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[11])->sum('sum');

        //Chiqim bichuv
        $januarySewingPayments = DB::table('sewing_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[0])->sum('sum');
        $februarySewingPayments = DB::table('sewing_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[1])->sum('sum');
        $marchSewingPayments = DB::table('sewing_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[2])->sum('sum');
        $aprilSewingPayments = DB::table('sewing_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[3])->sum('sum');
        $maySewingPayments = DB::table('sewing_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[4])->sum('sum');
        $juneSewingPayments = DB::table('sewing_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[5])->sum('sum');
        $julySewingPayments = DB::table('sewing_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[6])->sum('sum');
        $augustSewingPayments = DB::table('sewing_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[7])->sum('sum');
        $septemberSewingPayments = DB::table('sewing_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[8])->sum('sum');
        $octoberSewingPayments = DB::table('sewing_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[9])->sum('sum');
        $novemberSewingPayments = DB::table('sewing_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[10])->sum('sum');
        $decemberSewingPayments = DB::table('sewing_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[11])->sum('sum');

        //Chiqim product sotib olish uchun
        $januaryProductIncomePayments = DB::table('product_income_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[0])->sum('sum');
        $februaryProductIncomePayments = DB::table('product_income_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[1])->sum('sum');
        $marchProductIncomePayments = DB::table('product_income_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[2])->sum('sum');
        $aprilProductIncomePayments = DB::table('product_income_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[3])->sum('sum');
        $mayProductIncomePayments = DB::table('product_income_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[4])->sum('sum');
        $juneProductIncomePayments = DB::table('product_income_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[5])->sum('sum');
        $julyProductIncomePayments = DB::table('product_income_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[6])->sum('sum');
        $augustProductIncomePayments = DB::table('product_income_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[7])->sum('sum');
        $septemberProductIncomePayments = DB::table('product_income_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[8])->sum('sum');
        $octoberProductIncomePayments = DB::table('product_income_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[9])->sum('sum');
        $novemberProductIncomePayments = DB::table('product_income_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[10])->sum('sum');
        $decemberProductIncomePayments = DB::table('product_income_payments')->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $month[11])->sum('sum');

        //Total expense
        $totalExpensesJanuary = 0;
        $totalExpensesFebruary = 0;
        $totalExpensesMarch = 0;
        $totalExpensesApril = 0;
        $totalExpensesMay = 0;
        $totalExpensesJune = 0;
        $totalExpensesJuly = 0;
        $totalExpensesAugust = 0;
        $totalExpensesSeptember = 0;
        $totalExpensesOctober = 0;
        $totalExpensesNovember = 0;
        $totalExpensesDecember = 0;
        //Calculate
        $totalExpensesJanuary = $januaryExpensePayments + $januarySewingPayments + $januaryProductIncomePayments;
        $totalExpensesFebruary = $februaryExpensePayments + $februarySewingPayments + $februaryProductIncomePayments;
        $totalExpensesMarch = $marchExpensePayments + $marchSewingPayments + $marchProductIncomePayments;
        $totalExpensesApril = $aprilExpensePayments + $aprilSewingPayments + $aprilProductIncomePayments;
        $totalExpensesMay = $mayExpensePayments + $maySewingPayments + $mayProductIncomePayments;
        $totalExpensesJune = $juneExpensePayments + $juneSewingPayments + $juneProductIncomePayments;
        $totalExpensesJuly = $julyExpensePayments + $julySewingPayments + $julyProductIncomePayments;
        $totalExpensesAugust = $augustExpensePayments + $augustSewingPayments + $augustProductIncomePayments;
        $totalExpensesSeptember = $septemberExpensePayments + $septemberSewingPayments + $septemberProductIncomePayments;
        $totalExpensesOctober = $octoberExpensePayments + $octoberSewingPayments + $octoberProductIncomePayments;
        $totalExpensesNovember = $novemberExpensePayments + $novemberSewingPayments + $novemberProductIncomePayments;
        $totalExpensesDecember = $decemberExpensePayments + $decemberSewingPayments + $decemberProductIncomePayments;

        return response()->json([
            //Kirim
            'januarySalePayments' => $januarySalePayments,
            'februarySalePayments' => $februarySalePayments,
            'marchSalePayments' => $marchSalePayments,
            'aprilSalePayments' => $aprilSalePayments,
            'maySalePayments' => $maySalePayments,
            'juneSalePayments' => $juneSalePayments,
            'julySalePayments' => $julySalePayments,
            'augustSalePayments' => $augustSalePayments,
            'septemberSalePayments' => $septemberSalePayments,
            'octoberSalePayments' => $octoberSalePayments,
            'novemberSalePayments' => $novemberSalePayments,
            'decemberSalePayments' => $decemberSalePayments,
            //Chiqim
            'januaryExpenses' => $totalExpensesJanuary,
            'februaryExpenses' => $totalExpensesFebruary,
            'marchExpenses' => $totalExpensesMarch,
            'aprilExpenses' => $totalExpensesApril,
            'mayExpenses' => $totalExpensesMay,
            'juneExpenses' => $totalExpensesJune,
            'julyExpenses' => $totalExpensesJuly,
            'augustExpenses' => $totalExpensesAugust,
            'septemberExpenses' => $totalExpensesSeptember,
            'octoberExpenses' => $totalExpensesOctober,
            'novemberExpenses' => $totalExpensesNovember,
            'decemberExpenses' => $totalExpensesDecember,
        ]);
    }

    public function getDashboardFactoryAnalytics()
    {

        $factories = Factory::whereRelation('factory_category', 'type', '=', 'factory')->get();
        $orders = Order::where('is_debt', '1')->whereRelation('factory.factory_category', 'type', '=', 'factory')
            ->withSum('order_payments', 'sum')->get();

        $debtors = [];
        $totalPrice = 0;
        $sumAllOrderPayments = 0;
        foreach ($factories as $factory) {
            $totalPrice = 0;
            $sumAllOrderPayments = 0;
            foreach ($orders as $order) {
                if ($order->factory_id == $factory->id) {
                    $totalPrice += $order->total_price;
                    $sumAllOrderPayments += $order->order_payments_sum_sum;
                }
            }
            $debtors[] = (object)[
                'name' => $factory->name,
                'debts' => $totalPrice - $sumAllOrderPayments,
            ];
        }

        return $debtors;
    }
}
