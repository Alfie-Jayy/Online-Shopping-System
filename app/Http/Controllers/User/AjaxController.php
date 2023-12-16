<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //Sorting Products by Categories
    public function SortProducts(Request $req){
        // logger($req->all());

        if($req->status == 'asc'){
            $products = Product::orderBy('created_at', 'asc')->get();
        }
        else{
            $products = Product::orderBy('created_at', 'desc')->get();
        }
        return response()->json($products, 200);
    }

    //Single Adding to Cart
    public function singleAddCart(Request $req){

        $data = [
            'user_id' => $req->userId,
            'product_id' => $req->productId,
            'qty' => 1
        ];

        Cart::create($data);

        $response = [
            'status' => 'success',
            'message' => 'Successfully added to Cart',
        ];

        return response()->json($response, 200);

    }

    //adding to Cart
    public function addCart(Request $req){

        $data = $this->getOrderData($req);
        Cart::create($data);

        $response = [
            'status' => 'success',
            'message' => 'Successfully added to Cart',
        ];

        return response()->json($response, 200);
    }

    //order Btn
    public function order(Request $req){

        $total = 0;

        foreach($req->all() as $item){

            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' =>$item['product_id'],
                'qty' => $item['qty'],
                'total'=> $item['total'],
                'order_code' => $item['order_code']
            ]);

            $total += $data['total'];

        }


        Cart::where('user_id', Auth::user()->id)->delete();

        Order::create([
            'user_id' =>Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 3000
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order completed'
        ], 200);


    }

    //removing single cart
    public function removeSingleCart(Request $req){

        // logger($req->all());
        Cart::where('id', $req->cartID)->delete();

        return response()->json([
            'status' => 'true',
            'message' => 'successfully removed'
        ], 200);

    }

    // clearing cart
    public function clearCart(){
        Cart::where('user_id', Auth::user()->id)->delete();
        return response()->json([
            'status' => 'true',
            'message' => 'successfully cleared'
        ], 200);

    }

    //private get Data
    private function getOrderData($req){

        return [
            'user_id' => $req->userId,
            'product_id' => $req->pizzaId,
            'qty' => $req->count
        ];
    }
}
