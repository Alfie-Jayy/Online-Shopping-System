<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CategoryController;

class ProductController extends Controller
{
    public function listPage(){

        $products = Product::select('products.*','categories.name as category_name')

        ->when(request('search'), function($query){
            $query->orWhere('products.name','like','%'.request('search').'%')
            ->orWhere('categories.name','like','%'.request('search').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')->paginate(3);
        return view('admin.Product.pizzaList', compact('products'));
    }

    public function addPage(){
        $products = Category::select('id', 'name')->get();
        return view('admin.Product.createPizza', compact('products'));
    }

    //product Create Btn
    public function createBtn(Request $req){
        $this->productValidation($req, "create");
        $data = $this->getData($req);

        if($req->hasFile('pizzaImage')){
            $imageName = uniqid().'_'.$req->file('pizzaImage')->getClientOriginalName();
            $req->file('pizzaImage')->storeAs('public',$imageName);
            $data['image'] = $imageName;
        }

        Product::create($data);
        return redirect()->route('product#listPage')->with(['createSuccess' => "$req->pizzaName is Successfully created!"]);

    }

    // Product Delete
    public function delete($id){
        Product::where('id', $id)->delete();
        return redirect()->route('product#listPage')->with(['deleteSuccess' => "A category is successfully deleted!"]);
    }

    //product ViewPage
    public function viewPage($id){
        $product = Product::select('products.*','categories.name as category_name')
        ->join('categories','products.category_id','categories.id')
        ->where('products.id', $id)->first();
        // dd($product->toArray());
        return view('admin.Product.view', compact('product'));
    }

    //product Edit Page
    public function editPage($id){
        $product = Product::where('id', $id)->first();
        $categories = Category::select('id','name')->get();
        return view('admin.Product.edit',compact('product', 'categories'));
    }

    //product confirm Btn
    public function confirmBtn(Request $req){
        $this->productValidation($req,"update");
        $categories = $this->getData($req);

        //image
        if($req->hasFile('pizzaImage')){

            //delete
            $currentImage = Product::where('id', $req->productID)->first();
            $currentImageName = $currentImage->image;
            Storage::delete('public/'.$currentImageName);

            //update
            $uploadImage = $req->pizzaImage;
            $uploadImageName = uniqid().'_'.$uploadImage->getClientOriginalName();
            $uploadImage->storeAs('public',$uploadImageName);
            $categories['image'] = $uploadImageName;

        }


        Product::where('id', $req->productID)->update($categories);
        return redirect()->route('product#listPage')->with(['updateSuccess'=>'A category is successfully updated!']);
    }

    // Product Validation
    private function productValidation($req, $action){

        $validationRules = [
            'pizzaName' => 'required|unique:products,name,'.$req->productID,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required',
            'pizzaWaitingTime' => 'required',
            'pizzaPrice' => 'required'
        ];

        if($action == 'create'){
            $validationRules['pizzaImage'] = 'required|mimes:jpg,jpeg,png,webp';
        }
        else{
            $validationRules['pizzaImage'] = 'mimes:jpg,jpeg,png,webp';
        }

        Validator::make( $req->all(), $validationRules)->validate();
    }

    //product getData
    private function getData($req){
        return [
            'name'=> $req->pizzaName,
            'category_id' => $req->pizzaCategory,
            'description' => $req->pizzaDescription,
            'waiting_time' => $req->pizzaWaitingTime,
            'price' => $req->pizzaPrice,
        ];
    }
}
