<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    //shop Page
    public function shopPage(){
        $categories = Category::get();
        $products = Product::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('user.Page.shop', compact('categories', 'products', 'cart', 'orders'));
    }

    //contact Page
    public function contactUs(){
        return view('user.Contact.Contact');
    }

    //contact Submit
    public function contactSubmit(Request $req){

        $data = [
            'user_id' => Auth::user()->id,
            'name' => $req->username,
            'email' => $req->email,
            'message' => $req->message
        ];

        Contact::create($data);

        return redirect()->route('user#contactUsPage')->with(['successMsg' => 'Successfully Sent your message!']);
    }

    //change Password Page
    public function changePasswordPage(){
        return view('user.Account.changePass');
    }

    //change Password Btn
    public function changePasswordBtn(Request $req){
        $this->PassValidate($req);
        $userID = Auth::user()->id;
        $user = User::where('id', $userID)->first();
        $userPassword = $user->password;

        if(Hash::check($req->currentPassword, $userPassword)){
            $newPass = Hash::make($req->currentPassword);
            User::where('id', $userID)->update([
                'password' => $newPass
            ]);

            return back()->with(['SuccessMsg' => 'Successfully changed the password! Do you want to stay logged in?']);

        }
        else{
            return back()->with(['PassChangeError' => 'Incorrect Password.']);
        }

    }

    //account Details
    public function accountDetailsPage(){
        return view('user.Account.accDetails');
    }

    //account Details Btn
    public function editDetailsPage(){
        return view('user.Account.editDetails');
    }

    //edit Confirm Btn
    public function editConfirm(Request $req){

            $this->updateValidation($req);
            $data = $this->getData($req);

            if($req->hasFile('image')){

                if(Auth::user()->image){
                    Storage::delete('public/'.Auth::user()->image);
                }

                //store uploaded image
                $uploadImage = $req->file('image');
                $uploadImageName = uniqid().'_'.$uploadImage->getClientOriginalName();
                $uploadImage->storeAs('public',$uploadImageName);
                $data['image'] = $uploadImageName;
            }
            User::where('id', Auth::user()->id)->update($data);
            return redirect()->route('user#accDetailsPage')->with(['UpdateSuccess' => "Successfully Updated Your Account!"]);

    }

    //filter
    public function filter($id){
        $categories = Category::get();
        $products = Product::where('category_id',$id)->get();
        $selectedCategory = Category::find($id)->name;
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('user.Page.shop', compact('categories', 'selectedCategory', 'products', 'cart', 'orders'));
    }

    //product Detail
    public function productDetail($id){
        $pizza = Product::where('id', $id)->first();
        $products = Product::get();
        return view('user.Page.detail', compact('pizza', 'products'));
    }

    // cart List
    public function cartList(){

        $orders = Cart::select('carts.*', 'products.name as product_name', 'products.price as product_price', 'products.image as product_image')

        ->Leftjoin('products','products.id','carts.product_id')
        ->where('carts.user_id', Auth::user()->id)->get();

        // dd($orders->toArray());

        $totalPrice = 0;
        foreach($orders as $order){
            $totalPrice += $order->product_price * $order->qty;
        }

        // dd($orders->toArray());
        return view('user.Cart.cart', compact('orders', 'totalPrice'));
    }

    // orders
    public function orderList(){
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(6);
        return view('user.Cart.order', compact('orders'));
    }

    //view count
    public function viewCount(Request $req){

        $product = Product::where('id', $req->productID)->first();
        $viewCount = [
            'view_count' => $product->view_count + 1
        ];
        Product::where('id', $req->productID)->update($viewCount);

    }


    //Update Validation
    private function updateValidation($req){

        Validator::make($req->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
            'address' => 'required',
        ])->validate();

    }

    //update Get Data
    private function getData($req){
        return [
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'gender' => $req->gender,
            'address' => $req->address,
        ];
    }

    //Password Validation
    private function PassValidate($req){

        $validationRules = [
            'currentPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmNewPassword' => 'required|min:6|same:newPassword'
        ];

        Validator::make($req->all(), $validationRules)->validate();
    }
}
