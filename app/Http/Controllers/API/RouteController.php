<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Random;

class RouteController extends Controller
{
    // get Categories
    public function getCategories(){

        $data = Category::orderBy('id','desc')->get();
        return response()->json($data, 200);
    }

    //get Category
    public function getCategory($id){

        $data = Category::where('id', $id)->first();

        if($data){
            return response()->json($data, 200);
        }
        return response()->json([
            'status' => false,
            'message' => "No category for your search"
        ], 500);

    }

    //create Categories
    public function createCategory(Request $req){

        $data = [
            'name' => $req->name,
            'crated_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);

        return response()->json($response, 200);
    }

    // update Category
    public function updateCategory(Request $req){

        $categoryId = $req->id;
        $data = Category::where('id', $categoryId)->first();

        if(isset($data)){

            $updateData =[
                'name' => $req->name,
                'updated_at' => Carbon::now()
            ];

            Category::where('id', $req->id)->update($updateData);
            $data = Category::where('id', $categoryId)->first();

            return response()->json([
                'status' => 'true',
                'message' => 'update Success...',
                'data' => $data
            ], 200);

        }

        return response()->json([
            'status' => false,
            'message' => 'No Category Here...'
        ], 500);

    }

    // delete Categories (Post)
    public function deleteCategory(Request $req){

        $data = Category::where('id', $req->id)->first();

        if($data){

            Category::where('id', $req->id)->delete();

            return response()->json( ['message' => 'delete Success', 'data' => $data] , 200);
        }

            return response()->json([
            'message' => 'Here is no Category...'], 500);

    }

    //delete Categories (GET)
    // public function deleteCategories($id){

    //     $data = Category::where('id', $id)->first();

    //     if(isset($data)){
    //         Category::where('id', $id)->delete();

    //         $response = [
    //             'status' => true,
    //             'message' => 'Delete Success',
    //             'data' => $data
    //         ];

    //         return response()->json($response, 200);
    //     }

    //     return response()->json([
    //         'message' => 'Here is no Category'
    //     ], 500);
    // }


}
