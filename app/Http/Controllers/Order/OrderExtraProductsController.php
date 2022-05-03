<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Factory_product;
use App\Models\Order_extra_product;
use App\Models\Product;
use App\Models\Storage;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class OrderExtraProductsController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        $date = explode(',', request('date'));

        if (!$date) {
            $date = '';
        }

        return Order_extra_product::whereRelation('product.product_category', 'parent_id', '=', \request('parent_id'))
            ->with('order:id,factory_id,color_code', 'order.factory:id,name', 'product:id,name,code,product_category_id', 'product.product_category:id,name')
            ->select(['id', 'product_id', 'amount', 'created_at', 'order_id'])
            ->where(function ($query) use ($date) {
                if (!empty($date[0]) && !empty($date[1])) {
                    $query->whereDate('created_at', '>=', $date[0])->whereDate('created_at', '<=', $date[1]);
                } else if (!empty($date[0])) {
                    $query->whereDate('created_at', $date[0]);
                }
            })
            ->paginate(10);
    }

    public function getExtraProduct(Request $request)
    {
        $this->validate(request(), [
            'order_id' => 'required',
            'order_extra_products.*.product_id' => 'required',
            'order_extra_products.*.amount' => 'required',
            'order_extra_products.*.product_case' => 'required',
        ],
            [
                'order_id.required' => 'Iltimos,fabrikani kiriting !',
                'order_extra_products.*.product_id.required' => 'Mahsulotni id sini kiriting! ',
                'order_extra_products.*.amount.required' => 'Mahsulotni miqdorini kiriting! ',
                'order_extra_products.*.product_case.required' => 'Skladni turini kiriting! ',
            ]
        );

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

        foreach ($request['order_extra_products'] as $item) {
            $orderExtra = new Order_extra_product();
            $orderExtra->product_id = $item['product_id'];
            $orderExtra->amount = $item['amount'];
            $orderExtra->order_id = $request['order_id'];
            $orderExtra->save();
        }

        Storage::where('amount', 0)->delete();
        Factory_product::where('amount', 0)->delete();

        return $this->respondOk('Qo\'shimcha olindi.');
    }
}
