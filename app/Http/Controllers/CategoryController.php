<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use PHPUnit\Util\Xml\SuccessfulSchemaDetectionResult;

class CategoryController extends Controller
{
   public function viewCategory(Request $request)
   {
      $categories = Category::with('childrens')->whereNull('parent_id')->get();
      return view('admin.category.viewCategory', ['categories' => $categories]);
   }


   public function getcategory(Request $request)
   {
      $categories = Category::with('childrens')->whereNull('parent_id')->get();
      return response()->json($categories);
   }

   public function addNewCategory(Request $request)
   {
      // dd($request);
      $category = new Category();
      if ($request->parent_id == 0) {
         $category->parent_id = NULL;
      } else {
         $category->parent_id = $request->parent_id;
      }
      $category->name = $request->name;
      $category->save();
      return redirect()->back();
   }


   public function editCategory($id)
   {
      $category = Category::where('id', $id)->first();
      return view('admin.category.editCategory', compact('category'));
   }


   public function updateCategory(Request $request)
   {
      $category = Category::where('id', $request->id)->first();
      $category->name = $request->name;
      $category->save();
      return redirect()->back();
   }

   public function deleteCategory(Request $request)
   {
      $category = Category::where('id', $request->id)->first();
      if ($category) {
         $category->delete();
         return response()->json([
            'success' => true
         ]);
      } else {
         return response()->json([
            'success' => false
         ]);
      }
   }
}
