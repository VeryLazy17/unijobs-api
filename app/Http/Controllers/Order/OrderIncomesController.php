<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Factory_product;
use App\Models\Order;
use App\Models\Order_income;
use App\Models\Order_payment;
use App\Models\Storage;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class OrderIncomesController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        return Order_income::with('order')->get();
    }

    public function getStorageIncomeOrder()
    {

        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        if (request('factory_id')) {
            return Order_income::whereRelation('order', 'factory_id', '=', request('factory_id'))
                ->whereRelation('order.product.product_category', 'parent_id', '=', request('status'))
                ->whereRelation('order', 'type', '=', request('type')) //type=material,collar,painting,sewed
                ->where(function ($query) use ($date) {
                    if (!empty($date[0]) && !empty($date[1])) {
                        $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                    } else if (!empty($date[0])) {
                        $query->whereDate('created_at', $date[0]);
                    }
                })
                ->search(request('search'))
//                ->whereLike(['amount', '.order.factory[name]', '.order.product[code,name]', '.order[price,color_code]'], request('search'))
                ->with(['order.factory:id,name', 'order.product:id,name,code,product_category_id', 'order:id,amount,price,total_price,factory_id,product_id,color_code', 'order.product.product_category:id,name'])
                ->select(['order_id', 'amount', 'created_at'])
                ->orderByDesc('created_at')
                ->paginate(10);
        }

        return Order_income::whereRelation('order.product.product_category', 'parent_id', '=', request('status'))
            ->whereRelation('order', 'type', '=', request('type')) //type=material,collar,painting,sewed
            ->whereHas('order', function ($query) {
                if (!empty(\request('factory'))) {
                    $query->where('factory_id', \request('factory'));
                }
            })
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->search(request('search'))
//            ->whereLike(['amount', '.order.factory[name]', '.order.product[code,name]', '.order[price,color_code]'], request('search'))
            ->with(['order.factory:id,name', 'order.product:id,name,code,product_category_id', 'order:id,amount,price,total_price,factory_id,product_id,color_code', 'order.product.product_category:id,name'])
            ->select(['order_id', 'amount', 'created_at'])
            ->orderByDesc('created_at')
            ->paginate(10);

    }

    public function getReadyRaw()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        if (request('parent_id') == 'mato_va_yoqa') {
            return Order_income::with('order:id,code,factory_id,color_code,product_id', 'order.product:id,name,code,product_category_id', 'order.factory:id,name', 'order.product.product_category:id,name')
                ->whereRelation('order', 'factory_id', '=', \request('factory'))
                ->select(['id', 'order_id', 'amount', 'percentage', 'created_at'])
                ->where(function ($query) use ($date) {
                    if (!empty($date[0]) && !empty($date[1])) {
                        $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                    } else if (!empty($date[0])) {
                        $query->whereDate('created_at', $date[0]);
                    }
                })
                ->search(request('search'))
//                ->whereLike(['amount', '.order.factory[name]', '.order.product[code,name]', '.order[price,color_code]'], request('search'))
                ->orderByDesc('created_at')
                ->paginate(10);
        }

        return Order_income::with('order:id,code,factory_id,color_code,product_id', 'order.product:id,name,code', 'order.factory:id,name')
            ->whereRelation('order.factory.factory_category', 'type', '=', \request('factory'))
            ->whereRelation('order', 'type', '=', \request('type'))
            ->whereRelation('order.product.product_category', 'parent_id', '=', \request('parent_id'))
            ->select(['id', 'order_id', 'amount', 'percentage', 'created_at'])
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->search(request('search'))
//            ->whereLike(['amount', '.order.factory[name]', '.order.product[code,name]', '.order[price,color_code]'], str_replace('+', ' ', request('search')))
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function getReadyOrderIncome()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Order_income::whereRelation('order', 'type', '=', 'sewing')
            ->whereRelation('order.product', 'product_category_id', '=', \request('category_id'))
            ->with('order:id,product_id,factory_id,amount,price,total_price', 'order.product:id,code,name', 'order.factory:id,name')
            ->select(['id', 'order_id', 'amount', 'created_at'])
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->search(request('search'))
//            ->whereLike(['amount', '.order.product[name,code]', '.order.factory[name]'], \request('search'))
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function getOrderReadyProduct(Request $request)
    {
        $this->validate(request(), [
            'order_id' => 'required',
            'product_id' => 'required',
            'amount' => 'required|max:12',
            'percentage' => 'required',
            'paid' => 'max:12',
            'created_at' => 'required',
            'order_income_extra_products.*.product_id' => 'required',
            'order_income_extra_products.*.percentage' => 'required',
            'order_income_extra_products.*.amount' => 'required',
            'order_income_extra_products.*.waste_percentage' => 'required',
            'order_income_extra_products.*.waste_amount' => 'required',
            'storage_incomes.*.product_id' => 'required',
            'storage_incomes.*.percentage' => 'required',
            'storage_incomes.*.amount' => 'required',
            'storage_incomes.*.waste_percentage' => 'required',
            'storage_incomes.*.waste_amount' => 'required',
            'storage_incomes.*.factory_id' => 'required',
        ],
            [
                'order_id.required' => 'Iltimos,buyurtma qilingan idni kiriting !',
                'code.required' => 'Iltimos,partiya kodini kiriting !',
                'created_at.required' => 'Iltimos,sanani kiriting !',
                'product_id.required' => 'Iltimos,mahsulotni tanlang !',
                'amount.required' => 'Iltimos,miqdorni kiriting !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'percentage.required' => 'Iltimos,ispareniyani kiriting !',
                'paid.max' => 'Iltimos,summa 12 ta belgidan oshmasin !',
                'order_income_extra_products.*.product_id.required' => 'Mahsulotni id sini kiriting! ',
                'order_income_extra_products.*.percentage.required' => 'Mahsulotni foizini kiriting! ',
                'order_income_extra_products.*.amount.required' => 'Mahsulotni miqdorini kiriting! ',
                'order_income_extra_products.*.waste_percentage.required' => 'Mahsulotni ispareniyasini foizini kiriting! ',
                'order_income_extra_products.*.waste_amount.required' => 'Mahsulotni ispareniyasini miqdorini kiriting! ',
                'storage_incomes.*.product_id.required' => 'Mahsulotni id sini kiriting! ',
                'storage_incomes.*.percentage.required' => 'Mahsulotni foizini kiriting! ',
                'storage_incomes.*.amount.required' => 'Mahsulotni miqdorini kiriting! ',
                'storage_incomes.*.waste_percentage.required' => 'Mahsulotni ispareniyasini foizini kiriting! ',
                'storage_incomes.*.waste_amount.required' => 'Mahsulotni ispareniyasini miqdorini kiriting! ',
                'storage_incomes.*.factory_id.required' => 'Mahsulot qaysi fabrikaga tegishliligini kiriting! ',
            ]
        );

        $order = Order::findOrFail($request['order_id']);
        $orderIncome = new Order_income();

        $sumOfAmount = 0;
        foreach ($order->order_incomes as $item) {
            $sumOfAmount += $item->amount;
        }
        $sumOfAmount += $request['amount'];

        if ($order->amount < $sumOfAmount) {
            return response()->json(['success' => false, 'message' => 'Buyurtma berilgan miqdordan ko\'p tovar olyapsiz !'], 409);
        }

        $sum = 0;
        foreach ($order->order_payments as $item) {
            $sum += $item->sum;
        }
        $sum += $request['paid'];

        if ($order->total_price < $sum) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        foreach ($request['order_income_extra_products'] as $item) {
            $factoryProduct = Factory_product::whereProductId($item['product_id'])->whereFactoryId($request['factory_id'])
                ->whereProductCase('raw')->first();

            if (!$factoryProduct) {
                return response()->json([
                    'success' => false,
                    'message' => $factoryProduct->factory->name . 'da bu tovar yo\'q!'
                ], 409);
            }

            if ($factoryProduct->amount < $item['amount'] + $item['waste_amount']) {
                return response()->json([
                    'success' => false,
                    'message' => $factoryProduct->factory->name . 'da bu miqdorda tovar yo\'q!'
                ], 409);
            }


            $totalWasteAmount = $item['amount'] + $item['waste_amount']; //Mahsulotni ispareniyasi bilan o'zini yig'indisi
            $amountOfFactoryProduct = $factoryProduct->amount;
            $amountOfFactoryProduct -= $totalWasteAmount;
            $factoryProduct->amount = $amountOfFactoryProduct;
            $factoryProduct->update();
        }

        if ($order->total_price == $sum) {
            $order->is_debt = '0';
            $order->update();
        }

        $order->update([
            'status' => $order->amount == $sumOfAmount ? 'finished' : 'in_process',
        ]);

        if ($request['paid'] != 0) {
            Order_payment::insert([
                'order_id' => $order->id,
                'sum' => $request['paid'],
                'created_at' => $request['created_at']
            ]);
        }

        $orderIncome->order_id = $request['order_id'];
        $orderIncome->amount = $request['amount'];
        $orderIncome->percentage = $request['percentage'];
        $orderIncome->created_at = $request['created_at'];
        $orderIncome->save();

        $orderIncome->order_extra_income()->createMany($request['order_income_extra_products']);

        $orderIncome->order_storage_income()->createMany($request['storage_incomes']);

        $storage = Storage::whereProductId($request['product_id'])->whereProductCase('raw')
            ->whereStorageTypeId(1)->first();

        if ($storage) {
            $amountOfStorage = $storage->amount;
            $amountOfStorage += $request['amount'];
            $storage->amount = $amountOfStorage;
            $storage->update();
        } else {
            Storage::create([
                'storage_type_id' => 1,
                'product_id' => $request['product_id'],
                'amount' => $request['amount'],
                'product_case' => 'raw',
                'created_at' => $request['created_at']
            ]);
        }

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Mahsulot olindi.');
    }

    public function getProductPainting(Request $request)
    {
        $this->validate(request(), [
            'order_id' => 'required',
            'product_id' => 'required',
            'type' => 'required',
            'amount' => 'required|max:12',
            'percentage' => 'required',
            'paid' => 'max:12',
            'created_at' => 'required'
        ],
            [
                'order_id.required' => 'Iltimos,buyurtma qilingan idni kiriting !',
                'product_id.required' => 'Iltimos,mahsulotni tanlang !',
                'type.required' => 'Iltimos,turini tanlang !',
                'amount.required' => 'Iltimos,miqdorni kiriting !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'percentage.required' => 'Iltimos,ispareniyani kiriting !',
                'paid.max' => 'Iltimos,summa 12 ta belgidan oshmasin !',
                'created_at' => 'Iltimos,sanani tanlang !'
            ]
        );

        $order = Order::findOrFail($request['order_id']);
        $orderIncome = new Order_income();

        $sumOfAmount = 0;
        foreach ($order->order_incomes as $item) {
            $sumOfAmount += $item->amount;
        }
        $sumOfAmount += $request['amount'];

        if ($order->amount < $sumOfAmount) {
            return response()->json(['success' => false, 'message' => 'Buyurtma berilgan miqdordan ko\'p tovar olyapsiz !'], 409);
        }

        $sum = 0;
        foreach ($order->order_payments as $item) {
            $sum += $item->sum;
        }
        $sum += $request['paid'];

        if ($order->total_price < $sum) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        $factoryProduct = Factory_product::whereProductId($order->product_id)->whereFactoryId($order->factory_id)
            ->whereProductCase('painted')->first();

        if (!$factoryProduct) {
            return response()->json(['success' => false, 'message' => $order->factory->name . 'da bu tovar yo\'q!'], 409);
        }

        if ($factoryProduct->amount < $request['amount']) {
            return response()->json(['success' => false, 'message' => $order->factory->name . 'da bu miqdorda tovar yo\'q!'], 409);
        }

        $amountOfFactoryProduct = $factoryProduct->amount;
        $amountOfFactoryProduct -= $order->amount;
        $factoryProduct->amount = $amountOfFactoryProduct;
        $factoryProduct->update();

        if ($request['paid'] != 0) {
            Order_payment::insert([
                'order_id' => $order->id,
                'sum' => $request['paid'],
                'created_at' => $request['created_at']
            ]);
        }

        $orderIncome->order_id = $request['order_id'];
        $orderIncome->amount = $request['amount'];
        $orderIncome->percentage = $request['percentage'];
        $orderIncome->created_at = $request['created_at'];
        $orderIncome->save();

        if ($order->total_price == $sum) {
            $order->is_debt = '0';
            $order->update();
        }

        $order->update([
            'status' => 'finished'
        ]);

        $storage = Storage::whereProductId($request['product_id'])->whereStorageTypeId(2)
            ->whereColor($order->color_code)->whereProductCase($request['type'])->first(); //TODO color_code check correctly

        if ($storage) {
            $amountOfStorage = $storage->amount;
            $amountOfStorage += $request['amount'];
            $storage->amount = $amountOfStorage;
            $storage->update();
        } else {
            Storage::create([
                'storage_type_id' => 2,
                'product_id' => $request['product_id'],
                'amount' => $request['amount'],
                'product_case' => $request['type'],
                'color' => $order->color_code,
                'created_at' => $request['created_at']
            ]);
        }

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Mahsulot olindi.');
    }

    public function getReadyProduct(Request $request)
    {
        $this->validate(request(), [
            'order_id' => 'required',
            'amount' => 'required|max:12',
            'paid' => 'max:12',
            'price' => 'required|max:12',
            'created_at' => 'required'
        ],
            [
                'order_id.required' => 'Iltimos,buyurtma qilingan idni kiriting !',
                'amount.required' => 'Iltimos,miqdorni kiriting !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'paid.max' => 'Iltimos,summa 12 ta belgidan oshmasin !',
                'price.required' => 'Iltimos,dona narxini kiriting !',
                'price.max' => 'Iltimos,dona narxi 12 ta belgidan oshmasin !',
                'created_at' => 'Iltimos,sanani tanlang !'
            ]
        );

        $order = Order::findOrFail($request['order_id']);
        $orderIncome = new Order_income();

        $sumOfAmount = 0;
        foreach ($order->order_incomes as $item) {
            $sumOfAmount += $item->amount;
        }
        $sumOfAmount += $request['amount'];

        if ($order->amount < $sumOfAmount) {
            return response()->json(['success' => false, 'message' => 'Buyurtma berilgan miqdordan ko\'p tovar olyapsiz !'], 409);
        }

        $sum = 0;
        foreach ($order->order_payments as $item) {
            $sum += $item->sum;
        }
        $sum += $request['paid'];

        if ($order->total_price < $sum) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        $factoryProduct = Factory_product::whereProductId($order->product_id)->whereFactoryId($order->factory_id)
            ->whereProductCase('sewed')->first();

        if (!$factoryProduct) {
            return response()->json(['success' => false, 'message' => $order->factory->name . 'da bu tovar yo\'q!'], 409);
        }

        if ($factoryProduct->amount < $request['amount']) {
            return response()->json(['success' => false, 'message' => $order->factory->name . 'da bu miqdorda tovar yo\'q!'], 409);
        }

        $amountOfFactoryProduct = $factoryProduct->amount;
        $amountOfFactoryProduct -= $request['amount'];
        $factoryProduct->amount = $amountOfFactoryProduct;
        $factoryProduct->update();


        if ($order->total_price == $sum) {
            $order->is_debt = '0';
            $order->update();
        }

        if ($request['paid'] != 0) {
            Order_payment::insert([
                'order_id' => $order->id,
                'sum' => $request['paid'],
                'created_at' => $request['created_at']
            ]);
        }

        $orderIncome->order_id = $request['order_id'];
        $orderIncome->amount = $request['amount'];
        $orderIncome->created_at = $request['created_at'];
        $orderIncome->save();

        $storage = Storage::whereProductId($order->product_id)->whereStorageTypeId(3)
            ->whereProductCase('ready')->first();

        if ($storage) {
            $amountOfStorage = $storage->amount;
            $amountOfStorage += $request['amount'];
            $storage->amount = $amountOfStorage;
            $storage->price = $request['price'];
            $storage->update();
        } else {
            Storage::create([
                'storage_type_id' => 3,
                'product_id' => $order->product_id,
                'amount' => $request['amount'],
                'price' => $request['price'],
                'product_case' => 'ready',
                'created_at' => $request['created_at']
            ]);
        }

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Mahsulot olindi.');
    }
}
