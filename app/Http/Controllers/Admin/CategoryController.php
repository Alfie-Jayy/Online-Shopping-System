<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // list
    public function list(){
        $categories = Category::when(request('search'), function($query){
            $query->where('name','like','%'.request('search').'%');

        })
        ->orderBy('id', 'desc')->paginate(4);
        return view('admin.category.list', compact('categories'));
    }

    //createPage
    public function createPage(){
        return view('admin.category.create');
    }

    //Category createBtn
    public function createBtn(Request $req){
        $this->catagoryValidation($req);
        $newCategory = $this->getData($req);
        Category::create($newCategory);
        $newCategoryName = $newCategory['name'];
        return redirect()->route('category#list')->with(['createSuccess'=> "$newCategoryName is Successfully Added!"]);

    }

    //Category deleteBtn
    public function delete($id){
        Category::where('id', $id)->delete();
        return redirect()->route('category#list')->with(['deleteSuccess' => "A Category is Successfully Deleted!"]);
    }

    //Category edit Page
    public function editPage($id){
        $category = Category::where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    //Category update Btn
    public function updateBtn(Request $req, $id){
        $this->catagoryValidation($req);
        $updateCategory = $this->getData($req);
        $updateCategoryName = $updateCategory['name'];
        Category::where('id', $id)->update($updateCategory);
        return redirect()->route('category#list')->with(['updateSuccess' => "Successfully updated to $updateCategoryName!"]);
    }

    //Validation
    private function catagoryValidation($req){
        Validator::make($req->all(), [
            'categoryName' => 'required|unique:categories,name,'.$req->id
        ])->validate();
    }

    //getData
    private function getData($req){
        return [
            'name' => $req->categoryName
        ];
    }
}
