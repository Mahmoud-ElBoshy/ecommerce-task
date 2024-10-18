<?php

namespace App\Http\Controllers\Api\Order;

use App\Events\OrderPlacement;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\StoreRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function store(StoreRequest $request)
    {
        try {
            $products = $request->products;
            $order = new Order();
            $order->user_id = auth()->user()->id;
            DB::beginTransaction();
            foreach ($products as $product) {
                $productInDB = Product::findOrFail($product['product_id']);
                if ($productInDB->quantity >= $product['quantity'])
                {
                    $order->total_price += $productInDB->price;
                    $order->quantity += $product['quantity'];
                    $productInDB->quantity -= $product['quantity'];
                }
                else{
                    return response()->json(['data'=>null,'message'=>'some products have not sufficient quantity']);
                }
                $productInDB->save();
            }
            $order->save();
            $order->products()->attach($products);



            DB::commit();
            event(new OrderPlacement($order));
            return response()->json(['data' => $order,'message' => 'Order Placed Successfully']);
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            return $exception;
            return response()->json(['data'=>null,'message'=>'something went wrong']);
        }
    }

    public function show(Request $request)
    {
        $order =  Order::with('products','user')->whereId($request->order)->first();
        abort_unless(Gate::allows('order-details',$order),403,'unauthorized');
        return response()->json(['data' => $order,'message' => 'Order Retrieved Successfully']);
    }
}
