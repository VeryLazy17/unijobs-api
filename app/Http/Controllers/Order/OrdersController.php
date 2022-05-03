<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Factory_income;
use App\Models\Factory_product;
use App\Models\Order;
use App\Models\Order_payment;
use App\Models\Product;
use App\Models\Storage;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    use ApiResponseHelpers;

    public function index(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        if (request('type') != 'painting') {
            return Order::whereType(request('type'))
                ->whereFactoryId(request('factory'))
                ->whereStatus(request('status'))
                ->where(function ($query) {
                    $query->where('code', 'like', '%' . request('search') . '%');
                })
                ->where(function ($query) use ($date) {
                    if (!empty($date[0]) && !empty($date[1])) {
                        $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                    } else if (!empty($date[0])) {
                        $query->whereDate('created_at', $date[0]);
                    }
                })
                ->with('product:id,code,name', 'order_incomes:id,amount,order_id')
                ->orderByDesc('created_at')
                ->paginate(10);
        }

        return Order::whereType(request('type'))
            ->whereFactoryId(request('factory'))
            ->whereStatus(request('status'))
            ->where(function ($query) {
                $query->where('code', 'like', '%' . request('search') . '%');
            })
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->select(['id', 'code', 'amount', 'color_code', 'created_at', 'product_id'])
            ->with('product:id,code,name,product_category_id', 'product.product_category:id,name')
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function getStorageOutgoingProduct()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        if (request('parent_id') == 'mato_va_yoqa') {
            return Factory_income::whereFactoryId(request('factory'))
                ->whereRelation('product.product_category', 'parent_id', '=', '2')
                ->orWhereRelation('product.product_category', 'parent_id', '=', '3')
                ->search(request('search'))
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
                ->select(['id', 'factory_id', 'product_id', 'order_id', 'created_at'])
                ->with('product:id,code,name,product_category_id', 'order:id,code,color_code,amount,price,total_price', 'product.product_category:id,name')
                ->orderByDesc('created_at')
                ->paginate(10);
        }

        return Factory_income::whereRelation('product.product_category', 'parent_id', '=', request('parent_id'))
            ->whereRelation('factory.factory_category', 'type', '=', 'paint')
            ->search(request('search'))
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
            ->select(['id', 'factory_id', 'product_id', 'amount', 'order_id', 'created_at'])
            ->with('product:id,code,name,product_category_id', 'factory:id,name', 'order:id,code,color_code,amount,price,total_price', 'product.product_category:id,name')
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function getFilteredFactorySewingHistory()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Order::whereFactoryId(\request('factory_id'))
            ->whereStatus(\request('status'))
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->with('product:id,code,name', 'order_incomes:id,amount,order_id', 'order_extra_product.product.product_category:id,name,parent_id',
                'order_extra_product.product:id,name,code,product_category_id', 'order_extra_product:id,order_id,amount,product_id')
            ->select(['id', 'factory_id', 'product_id', 'amount', 'price', 'total_price', 'created_at'])
//            ->whereLike(['code', '.factory[name]', '.product[name,code]', 'color_code', 'amount', 'price', 'total_price'], request('search'))
            ->search(request('search'))
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate(request(), [
            'code' => 'required|unique:orders,code',
            'factory_id' => 'required',
            'product_id' => 'required',
            'type' => 'required',
            'amount' => 'required|max:12',
            'price' => 'required|max:12',
            'paid' => 'max:12',
            'total_price' => 'required|max:12',
            'created_at' => 'required'
        ],
            [
                'code.required' => 'Iltimos,partiya kodini kiriting !',
                'code.unique' => 'Bu partiya kodi oldin kiritilgan !',
                'factory_id.required' => 'Iltimos,fabrikani kiriting !',
                'product_id.required' => 'Iltimos,mahsulotni kiriting !',
                'type.required' => 'Iltimos,mahsulot turini kiriting !',
                'amount.required' => 'Iltimos,miqdorni kiriting !',
                'price.required' => 'Iltimos,narxni kiriting !',
                'price.max' => 'Iltimos,narx 12 ta belgidan oshmasin !',
                'paid.max' => 'Iltimos,to\'langan summa 12 ta belgidan oshmasin !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'total_price.required' => 'Iltimos,umumiy summani kiriting !',
                'total_price.max' => 'Iltimos,umumiy summa 12 ta belgidan oshmasin !',
                'created_at.required' => 'Iltimos,sanani tanlang !',
            ]
        );

        if ($request['total_price'] < $request['paid']) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        $order = new Order();
        $order->factory_id = $request['factory_id'];
        $order->product_id = $request['product_id'];
        $order->amount = $request['amount'];
        $order->price = $request['price'];
        $order->total_price = $request['total_price'];
        if ($order->total_price == $request['paid']) {
            $order->is_debt = '0';
        } else {
            $order->is_debt = '1';
        }
        $order->code = $request['code'];
        $order->type = $request['type'];
        $order->created_at = $request['created_at'];
        $order->save();

        if ($request['paid'] != 0) {
            Order_payment::insert([
                'order_id' => $order->id,
                'sum' => $request['paid'],
                'created_at' => $request['created_at']
            ]);
        }

        return $this->respondOk('Buyurtma berildi.');
    }

    public function sendingProductPainting(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate(request(), [
            'code' => 'required',
            'factory_id' => 'required',
            'product_id' => 'required',
            'amount' => 'required|max:12',
            'type' => 'required',
            'color_code' => 'required',
            'price' => 'required|max:12',
            'paid' => 'max:12',
            'total_price' => 'required|max:12',
            'created_at' => 'required'
        ],
            [
                'code.required' => 'Iltimos,partiya kodini kiriting !',
                'code.unique' => 'Bu partiya kodi oldin kiritilgan !',
                'factory_id.required' => 'Iltimos,fabrikani kiriting !',
                'product_id.required' => 'Iltimos,mahsulotni kiriting !',
                'amount.required' => 'Iltimos,miqdorni kiriting !',
                'type.required' => 'Iltimos,mahsulot turini kiriting !',
                'color_code.required' => 'Iltimos,rang kodini kiriting !',
                'price.required' => 'Iltimos,narxni kiriting !',
                'price.max' => 'Iltimos,narx 12 ta belgidan oshmasin !',
                'paid.max' => 'Iltimos,to\'langan summa 12 ta belgidan oshmasin !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'total_price.required' => 'Iltimos,umumiy summani kiriting !',
                'total_price.max' => 'Iltimos,umumiy summa 12 ta belgidan oshmasin !',
                'created_at.required' => 'Iltimos,sanani tanlang !',
            ]
        );

        if ($request['total_price'] < $request['paid']) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        $storage = Storage::whereStorageTypeId(1)->whereProductId($request['product_id'])->whereProductCase('raw')->first();

        if (!$storage) {
            return response()->json(['success' => false, 'message' => 'Skladda bu tovar yo\'q!'], 409);
        }

        if ($storage->amount < $request['amount']) {
            return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda tovar yo\'q!'], 409);
        }


        $order = new Order();
        $order->color_code = $request['color_code'];
        $order->factory_id = $request['factory_id'];
        $order->product_id = $request['product_id'];
        $order->amount = $request['amount'];
        $order->price = $request['price'];
        $order->total_price = $request['total_price'];
        if ($order->total_price == $request['paid']) {
            $order->is_debt = '0';
        } else {
            $order->is_debt = '1';
        }
        $order->code = $request['code'];
        $order->type = $request['type'];
        $order->created_at = $request['created_at'];
        $order->save();

        if ($request['paid'] != 0) {
            Order_payment::insert([
                'order_id' => $order->id,
                'sum' => $request['paid'],
                'created_at' => $request['created_at']
            ]);
        }

        Factory_income::create([
            'factory_id' => $request['factory_id'],
            'product_id' => $request['product_id'],
            'amount' => $request['amount'],
            'order_id' => $order->id,
            'created_at' => $request['created_at']
        ]);

        $factoryProduct = Factory_product::whereFactoryId($request['factory_id'])
            ->whereProductId($request['product_id'])->whereProductCase('painted')->first();

        if ($factoryProduct) {
            $amountOfFactoryProduct = $factoryProduct->amount;
            $amountOfFactoryProduct += $request['amount'];
            $factoryProduct->amount = $amountOfFactoryProduct;
            $factoryProduct->update();
        } else {
            Factory_product::create([
                'factory_id' => $request['factory_id'],
                'product_id' => $request['product_id'],
                'amount' => $request['amount'],
                'product_case' => 'painted',
            ]);
        }

        //storage update product amount
        $amountOfStorage = $storage->amount;
        $amountOfStorage -= $request['amount'];
        $storage->amount = $amountOfStorage;
        $storage->update();

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Buyurtma berildi.');
    }

    public function sendingProductSewing(Request $request)
    {
        $this->validate(request(), [
            'factory_id' => 'required',
            'product_id' => 'required',
            'type' => 'required',
            'amount' => 'required|max:12',
            'price' => 'required|max:12',
            'paid' => 'max:12',
            'total_price' => 'required|max:12',
            'created_at' => 'required',
            'order_extra_products.*.product_id' => 'required',
            'order_extra_products.*.amount' => 'required',
            'order_extra_products.*.product_case' => 'required',
            'order_extra_products.*.color_code' => 'required',
        ],
            [
                'factory_id.required' => 'Iltimos,fabrikani kiriting !',
                'product_id.required' => 'Iltimos,mahsulotni kiriting !',
                'type.required' => 'Iltimos,mahsulot turini kiriting !',
                'amount.required' => 'Iltimos,miqdorni kiriting !',
                'price.required' => 'Iltimos,narxni kiriting !',
                'price.max' => 'Iltimos,narx 12 ta belgidan oshmasin !',
                'paid.max' => 'Iltimos,to\'langan summa 12 ta belgidan oshmasin !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'total_price.required' => 'Iltimos,umumiy summani kiriting !',
                'total_price.max' => 'Iltimos,umumiy summa 12 ta belgidan oshmasin !',
                'created_at.required' => 'Iltimos,sanani tanlang !',
                'order_extra_products.*.product_id.required' => 'Mahsulotni id sini kiriting! ',
                'order_extra_products.*.amount.required' => 'Mahsulotni miqdorini kiriting! ',
                'order_extra_products.*.product_case.required' => 'Skladni turini kiriting! ',
                'order_extra_products.*.color_code.required' => 'Mahsulot rangini kiriting! ',
            ]
        );

        if ($request['total_price'] < $request['paid']) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        foreach ($request['order_extra_products'] as $item) {
            if (!($item['color_code'] == 'accessory')) {
                $storage = Storage::whereStorageTypeId(2)->whereProductId($item['product_id'])->whereColor($item['color_code'])
                    ->whereProductCase($item['product_case'])->first();
            } else {
                $storage = Storage::whereStorageTypeId(2)->whereProductId($item['product_id'])
                    ->whereProductCase($item['product_case'])->first();
            }


            if (!$storage) {
                $product = Product::findOrFail($item['product_id']);
                return response()->json(['success' => false, 'message' => $product->name . ' mahsuloti skladda yo\'q!'], 409);
            }

            if ($storage->amount < $item['amount']) {
                $product = Product::findOrFail($item['product_id']);
                return response()->json(['success' => false, 'message' => 'Bu miqdorda ' . $product->name . ' mahsulotidan skladda yo\'q!'], 409);
            }
        }

        $order = new Order();
        $order->factory_id = $request['factory_id'];
        $order->product_id = $request['product_id'];
        $order->amount = $request['amount'];
        $order->price = $request['price'];
        $order->total_price = $request['total_price'];
        if ($order->total_price == $request['paid']) {
            $order->is_debt = '0';
        } else {
            $order->is_debt = '1';
        }
        $order->type = $request['type'];
        $order->created_at = $request['created_at'];
        $order->save();

        Factory_income::create([
            'factory_id' => $request['factory_id'],
            'product_id' => $request['product_id'],
            'amount' => $request['amount'],
            'order_id' => $order->id,
            'created_at' => $request['created_at']
        ]);


        $factoryProduct = Factory_product::whereFactoryId($request['factory_id'])
            ->whereProductId($request['product_id'])->whereProductCase('sewed')->first();

        if ($factoryProduct) {
            $amountOfFactoryProduct = $factoryProduct->amount;
            $amountOfFactoryProduct += $request['amount'];
            $factoryProduct->amount = $amountOfFactoryProduct;
            $factoryProduct->update();
        } else {
            Factory_product::create([
                'factory_id' => $request['factory_id'],
                'product_id' => $request['product_id'],
                'amount' => $request['amount'],
                'product_case' => 'sewed',
            ]);
        }

        if ($request['paid'] != 0) {
            Order_payment::insert([
                'order_id' => $order->id,
                'sum' => $request['paid'],
                'created_at' => $request['created_at']
            ]);
        }

        $order->order_extra_product()->createMany($request['order_extra_products']);

        foreach ($request['order_extra_products'] as $item) {
            if (!($item['color_code'] == 'accessory')) {
                $storage = Storage::whereStorageTypeId(2)->whereProductId($item['product_id'])->whereColor($item['color_code'])
                    ->whereProductCase($item['product_case'])->first();
            } else {
                $storage = Storage::whereStorageTypeId(2)->whereProductId($item['product_id'])
                    ->whereProductCase($item['product_case'])->first();
            }
            //storage update product amount
            $amountOfStorage = $storage->amount;
            $amountOfStorage -= $item['amount'];
            $storage->amount = $amountOfStorage;
            $storage->update();
        }

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Buyurtma berildi.');
    }

    public function setFinishedOrder(Request $request)
    {
        $this->validate(request(), [
            'order_id' => 'required'
        ],
            [
                'order_id.required' => 'Iltimos,buyurtma qilingan idni kiriting !',
            ]
        );

        $order = Order::findOrFail($request['order_id']);
        $order->status = 'finished';
        $order->update();

        return $this->respondOk('Buyurtmangiz yopildi.');
    }

    public function show(Order $order): Order
    {
        return $order;
    }

    public function update(Request $request, Order $order)
    {
        $this->validate(request(), [
            'factory_product_case' => 'required',
            'storage_product_case' => 'required',
            'storage_type_id' => 'required',
            'code' => 'required',
            'amount' => 'required|max:12',
            'color_code' => 'required',
            'price' => 'required|max:12',
            'total_price' => 'required|max:12',
        ],
            [
                'factory_product_case.required' => 'Iltimos,fabrika turini yuboring !',
                'storage_product_case.required' => 'Iltimos,sklad turini yuboring !',
                'storage_type_id.required' => 'Iltimos,sklad idsini yuboring !',
                'code.required' => 'Iltimos,partiya kodini kiriting !',
                'code.unique' => 'Bu partiya kodi oldin kiritilgan !',
                'amount.required' => 'Iltimos,miqdorni kiriting !',
                'color_code.required' => 'Iltimos,rang kodini kiriting !',
                'price.required' => 'Iltimos,narxni kiriting !',
                'price.max' => 'Iltimos,narx 12 ta belgidan oshmasin !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'total_price.required' => 'Iltimos,umumiy summani kiriting !',
                'total_price.max' => 'Iltimos,umumiy summa 12 ta belgidan oshmasin !',
            ]
        );

        if ($order->status == 'finished') {
            return response()->json(['success' => false, 'message' => 'Bu buyurtma allaqachon yopilgan!'], 409);
        }

        $sum = 0;
        foreach ($order->order_payments as $item) {
            $sum += $item->sum;
        }

        if (($order->total_price != $request['total_price']) && ($request['total_price'] < $sum)) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        $factoryProduct = Factory_product::whereFactoryId($order->factory_id)
            ->whereProductId($order->product_id)->whereProductCase($request['factory_product_case'])->first();

        if (!$factoryProduct) {
            return response()->json(['success' => false, 'message' => $order->factory->name . 'da bu tovar yo\'q!'], 409);
        }

        if ($factoryProduct->amount < $order->amount) {
            return response()->json(['success' => false, 'message' => $order->factory->name . 'da bu miqdorda tovar yo\'q!'], 409);
        }

        $storage = Storage::whereStorageTypeId($request['storage_type_id'])->whereProductId($order->product_id)
            ->whereProductCase($request['storage_product_case'])->first();

        if (!$storage && ($order->amount < $request['amount'])) {
            return response()->json(['success' => false, 'message' => 'Skladda bu tovar yo\'q!'], 409);
        }

        if ($storage) {
            $amountOfStorage = $storage->amount;
            $amountOfStorage += $order->amount;
            if ($amountOfStorage < $request['amount']) {
                return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda tovar yo\'q!'], 409);
            }
        } else {
            Storage::create([
                'storage_type_id' => $request['storage_type_id'],
                'product_id' => $order->product_id,
                'amount' => $order->amount,
                'product_case' => $request['storage_product_case'],
                'color' => $order->color_code
            ]);
            $storage = Storage::whereStorageTypeId($request['storage_type_id'])->whereProductId($order->product_id)
                ->whereProductCase($request['storage_product_case'])->first();
            $amountOfStorage = $storage->amount;
        }
        $amountOfStorage -= $request['amount'];
        $storage->amount = $amountOfStorage;
        $storage->update();

        if ($request['total_price'] != $sum) {
            $order->is_debt = '1';
        } else {
            $order->is_debt = '0';
        }
        $order->update();

        $amountOfFactoryProduct = $factoryProduct->amount;
        $amountOfFactoryProduct -= $order->amount;
        $amountOfFactoryProduct += $request['amount'];
        $factoryProduct->amount = $amountOfFactoryProduct;
        $factoryProduct->update();

        $order->update($request->only('amount', 'price', 'total_price', 'color_code', 'code'));
        //Factory Income update process
        $factoryIncome = Factory_income::where('order_id', $order->id)->first();
        $factoryIncome->amount = $request['amount'];
        $factoryIncome->update();

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Muvaffaqiyatli yangilandi.');
    }

    public function orderUpdateSewed(Request $request, $id)
    {
        $this->validate(request(), [
            'code' => 'required',
            'amount' => 'required|max:12',
            'price' => 'required|max:12',
            'total_price' => 'required|max:12',
        ],
            [
                'code.required' => 'Iltimos,partiya kodini kiriting !',
                'amount.required' => 'Iltimos,miqdorni kiriting !',
                'price.required' => 'Iltimos,narxni kiriting !',
                'price.max' => 'Iltimos,narx 12 ta belgidan oshmasin !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'total_price.required' => 'Iltimos,umumiy summani kiriting !',
                'total_price.max' => 'Iltimos,umumiy summa 12 ta belgidan oshmasin !',
            ]
        );

        $order = Order::findOrFail($id);

        $sum = 0;
        foreach ($order->order_payments as $item) {
            $sum += $item->sum;
        }

        if (($order->total_price != $request['total_price']) && $request['total_price'] < $sum) {
            return response()->json(['success' => false, 'message' => 'Jami summadan berilgan summa ko\'p tekshirib qayta kiriting!'], 409);
        }

        if ($request['total_price'] != $sum) {
            $order->is_debt = '1';
        } else {
            $order->is_debt = '0';
        }
        $order->update();

        $order->update($request->only('amount', 'price', 'total_price', 'color_code', 'code'));

        return $this->respondOk('Muvaffaqiyatli yangilandi.');
    }

    public function destroy(Request $request, Order $order)
    {
        $factoryProduct = Factory_product::whereFactoryId($order->factory_id)
            ->whereProductId($order->product_id)->whereProductCase($request['factory_product_case'])->first();

        if (!$factoryProduct) {
            return response()->json(['success' => false, 'message' => $order->factory->name . 'da bu tovar yo\'q!'], 409);
        }

        if ($factoryProduct->amount < $order->amount) {
            return response()->json(['success' => false, 'message' => $order->factory->name . 'da bu miqdorda tovar yo\'q!'], 409);
        }

        $amountOfFactoryProduct = $factoryProduct->amount;
        $amountOfFactoryProduct -= $order->amount;
        $factoryProduct->amount = $amountOfFactoryProduct;
        $factoryProduct->update();

        $storage = Storage::whereStorageTypeId($request['storage_type_id'])->whereProductId($order->product_id)
            ->whereProductCase($request['storage_product_case'])->first();

        if ($storage) {
            $amountOfStorage = $storage->amount;
            $amountOfStorage += $order->amount;
            $storage->amount = $amountOfStorage;
            $storage->update();
        } else {
            Storage::create([
                'storage_type_id' => $request['storage_type_id'],
                'product_id' => $order->product_id,
                'amount' => $order->amount,
                'product_case' => $request['storage_product_case']
            ]);
        }
        $order->factory_income()->delete();
        $order->order_payments()->delete();
        $order->delete();

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Muvaffaqiyatli o\'chirildi.');
    }

    public function orderDeleteSewed($id)
    {
        Order_payment::where('order_id', $id)->delete();
        Order::findOrFail($id)->delete();

        return $this->respondOk('Muvaffaqiyatli o\'chirildi.');
    }
}
