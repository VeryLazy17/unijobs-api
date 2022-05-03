<?php

namespace App\Http\Controllers\Factory;

use App\Http\Controllers\Controller;
use App\Models\Factory_income;
use App\Models\Factory_product;
use App\Models\Storage;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class FactoryIncomesController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        if (!empty(request('factory_id'))) {
            return Factory_income::whereFactoryId(request('factory_id'))
                ->with('product:id,name,code')
//                ->search(request('search'))
                ->whereLike(['amount', '.product[name,code]', '.factory[name]'], request('search'))
                ->where(function ($query) use ($date) {
                    if (!empty($date[0]) && !empty($date[1])) {
                        $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                    } else if (!empty($date[0])) {
                        $query->whereDate('created_at', $date[0]);
                    }
                })
                ->orderByDesc('created_at')
                ->paginate(10);
        }

        return Factory_income::with('factory:id,name', 'product:id,code,name')
//            ->search(request('search'))
            ->whereLike(['amount', '.product[name,code]', '.factory[name]'], request('search'))
            ->whereRelation('factory.factory_category', 'type', '=', 'material')
            ->orWhereRelation('factory.factory_category', 'type', '=', 'collar')
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    public function getProcessThread(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Factory_income::whereRelation('product.product_category', 'type', '=', 'thread')
            ->with('product:id,code,name', 'factory:factory_category_id,name,id', 'factory.factory_category:id,name')
            ->where(function ($query) {
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
            ->select(['id', 'factory_id', 'product_id', 'amount'])
            ->orderByDesc('created_at')
            ->paginate(20);
    }

    public function getProcessMaterial(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {

        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Factory_income::whereRelation('product.product_category', 'type', '=', 'material')
            ->whereRelation('order', 'status', '=', 'in_process')
            ->search(request('search'))
            ->where(function ($query) {
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
            ->with('product', 'factory.factory_category')
            ->orderByDesc('created_at')
            ->paginate(20);
    }

    public function getProcessProduct(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {

        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Factory_income::whereRelation('product.product_category', 'parent_id', '=', request('status'))
            ->whereRelation('order', 'status', '=', 'in_process')
            ->search(request('search'))
            ->where(function ($query) {
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
            ->with('product:id,code,name,product_category_id', 'factory.factory_category:id,name', 'product.product_category:id,name', 'factory:id,factory_category_id,name')
            ->orderByDesc('created_at')
            ->paginate(20);
    }

    public function getSewingProcess()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Factory_income::whereRelation('factory.factory_category', 'type', '=', 'factory')
            ->whereRelation('order', 'status', '=', 'in_process')
            ->search(request('search'))
            ->where(function ($query) {
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
            ->with('order:id,price,total_price', 'factory:id,name', 'product:id,name,code',
                'order.order_extra_product.product.product_category:id,name,parent_id', 'order.order_extra_product.product:id,name,code,product_category_id',
                'order.order_extra_product:id,order_id,amount,product_id')
            ->select(['id', 'amount', 'factory_id', 'order_id', 'product_id', 'created_at'])
            ->orderByDesc('created_at')
            ->paginate(10);

    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate(request(), [
            'factory_id' => 'required',
            'product_id' => 'required',
            'amount' => 'max:12',
            'created_at' => 'required'
        ],
            [
                'factory_id.required' => 'Iltimos,fabrikani kiriting !',
                'product_id.required' => 'Iltimos,mahsulotni kiriting !',
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !',
                'created_at.required' => 'Iltimos,sanani tanlang !',
            ]
        );

        $storage = Storage::whereProductId($request['product_id'])
            ->whereStorageTypeId(1)->first();

        if (!$storage) {
            return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda tovar yo\'q!']);
        }
        if ($storage->amount < $request['amount']) {
            return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda tovar yo\'q!']);
        }
        $amountOfStorage = $storage->amount;
        $amountOfStorage -= $request['amount'];
        $storage->amount = $amountOfStorage;
        $storage->update();

        $factoryProduct = Factory_product::whereProductId($request['product_id'])
            ->whereFactoryId($request['factory_id'])
            ->whereProductCase('raw')->first();

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
                'product_case' => 'raw', //To Do check income mato yoqa (type)
                'created_at' => $request['created_at']
            ]);
        }

        Factory_income::create($request->only('factory_id', 'product_id', 'amount', 'order_id', 'created_at'));

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Mahsulot jo\'natildi.');
    }

    public function show(Factory_income $factory_income): Factory_income
    {
        return $factory_income;
    }

    public function update(Request $request, Factory_income $factory_income)
    {
        $this->validate(request(), [
            'amount' => 'max:12'
        ],
            [
                'amount.max' => 'Iltimos,miqdor 12 ta belgidan oshmasin !'
            ]
        );

        $factoryProduct = Factory_product::whereFactoryId($factory_income->factory_id)
            ->whereProductId($factory_income->product_id)->whereProductCase($request['factory_product_case'])->first();

        if (!$factoryProduct) {
            return response()->json(['success' => false, 'message' => $factory_income->factory->name . 'da bu tovar yo\'q!'], 409);
        }

        if ($factoryProduct->amount < $factory_income->amount) {
            return response()->json(['success' => false, 'message' => $factory_income->factory->name . 'da bu miqdorda tovar yo\'q!'], 409);
        }

        $storage = Storage::whereStorageTypeId($request['storage_type_id'])->whereProductId($factory_income->product_id)
            ->whereProductCase($request['storage_product_case'])->first();

        if ($storage) {
            $amountOfStorage = $storage->amount;
            $amountOfStorage += $factory_income->amount;
            if ($amountOfStorage < $request['amount']) {
                return response()->json(['success' => false, 'message' => 'Skladda bu miqdorda tovar yo\'q!'], 409);
            }
        } else {
            Storage::create([
                'storage_type_id' => $request['storage_type_id'],
                'product_id' => $factory_income->product_id,
                'amount' => $factory_income->amount,
                'product_case' => $request['storage_product_case']
            ]);
            $storage = Storage::whereStorageTypeId($request['storage_type_id'])->whereProductId($factory_income->product_id)
                ->whereProductCase($request['storage_product_case'])->first();

            $amountOfStorage = $storage->amount;
        }
        $amountOfStorage -= $request['amount'];
        $storage->amount = $amountOfStorage;
        $storage->update();

        //Factory storage update
        $amountOfFactoryProduct = $factoryProduct->amount;
        $amountOfFactoryProduct -= $factory_income->amount;
        $amountOfFactoryProduct += $request['amount'];
        $factoryProduct->amount = $amountOfFactoryProduct;
        $factoryProduct->update();

        $factory_income->update($request->only('amount'));

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Muvaffaqiyatli yangilandi.');
    }

    public function destroy(Request $request, Factory_income $factory_income)
    {
        $factoryProduct = Factory_product::whereFactoryId($factory_income->factory_id)
            ->whereProductId($factory_income->product_id)->whereProductCase($request['factory_product_case'])->first();

        if (!$factoryProduct) {
            return response()->json(['success' => false, 'message' => $factory_income->factory->name . 'da bu tovar yo\'q!'], 409);
        }

        if ($factoryProduct->amount < $factory_income->amount) {
            return response()->json(['success' => false, 'message' => $factory_income->factory->name . 'da bu miqdorda tovar yo\'q!'], 409);
        }

        $amountOfFactoryProduct = $factoryProduct->amount;
        $amountOfFactoryProduct -= $factory_income->amount;
        $factoryProduct->amount = $amountOfFactoryProduct;
        $factoryProduct->update();

        $storage = Storage::whereStorageTypeId($request['storage_type_id'])->whereProductId($factory_income->product_id)
            ->whereProductCase($request['storage_product_case'])->first();

        if ($storage) {
            $amountOfStorage = $storage->amount;
            $amountOfStorage += $factory_income->amount;
            $storage->amount = $amountOfStorage;
            $storage->update();
        } else {
            Storage::create([
                'storage_type_id' => $request['storage_type_id'],
                'product_id' => $factory_income->product_id,
                'amount' => $factory_income->amount,
                'product_case' => $request['storage_product_case']
            ]);
        }
        $factory_income->delete();

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Muvaffaqiyatli o\'chirildi.');
    }
}
