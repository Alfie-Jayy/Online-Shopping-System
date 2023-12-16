<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //order List
    public function orderList(){
        $orders = Order::select('orders.*', 'users.name as user_name')
        ->leftJoin('users', 'users.id', 'orders.user_id')
        ->orderBy('created_at', 'desc')
        ->get();

        // dd($orders->toArray());
        return view('admin.Order.list', compact('orders'));
    }

    // order status
    public function orderStatus(Request $req){

        $orders = Order::select('orders.*', 'users.name as user_name')
        ->leftJoin('users', 'users.id', 'orders.user_id')
        ->orderBy('created_at', 'desc');

        if($req->orderStatus == null){
            $orders = $orders->get();
        }
        else{
            $orders = $orders->where('orders.status',$req->orderStatus)
                                ->get();
        }

        // dd($orders->status);

        return view('admin.Order.list', compact('orders'));

    }

    //change Order Status
    public function changeOrderStatus(Request $req){

        logger($req->all());

        Order::where('id', $req->orderId)->update(['status' => $req->orderStatus]);

        return response()->json([
            'status' => 'true',
            'message' => 'successfully changed'
        ], 200);
    }

    //order Detail
    public function orderDetail($orderCode){

        $order = Order::where('order_code', $orderCode)->first();
        // dd($order->toArray());

        $details = OrderList::select('order_lists.*', 'products.name  as product_name','products.price as product_price' ,'products.image as product_image', 'users.name as customer_name')
        ->where('order_code', $orderCode)
        ->leftJoin('products', 'products.id', 'order_lists.product_id')
        ->leftJoin('users', 'users.id', 'order_lists.user_id')
        ->get();

        // dd($details->toArray());


        return view('admin.Order.orderDetail', compact('details','order'));
    }
}
