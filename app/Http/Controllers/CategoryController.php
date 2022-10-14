<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function viewCategory(Request $request){
        $categories = Category::with('childrens')->whereNull('parent_id')->get();
        return view('admin.category.viewCategory',['categories'=>$categories]);
     }   


     public function getcategory(Request $request){
      $categories = Category::with('childrens')->whereNull('parent_id')->get();
      return response()->json($categories);
     }

     public function addNewCategory(Request $request){
      // dd($request);
      $category = new Category();  
      if($request->parent_id==0){
          $category->parent_id =NULL;
       }else{
         $category->parent_id = $request->parent_id;
      }
       $category->name = $request->name;
       $category->save();
       return redirect()->back();
     }
}
