<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function getAllCategory()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function addCategory(Request $request)
    {
        if (!isset($request['name']) || !isset($request['description'])){
            return response()->json('missing parameters',400);
        }

        if (Category::where('name', $request['name'])->first()){
            return response()->json('Category name already exist',405);
        }

        $category = new Category();
        $category->name = $request['name'];
        $category->description = $request['description'];
        $category->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $category
        ],200);
    }

    public function getCategory($categoryId)
    {
        if ($category = Category::find($categoryId)) {
            return response()->json($category,200);
        }

        return response()->json('Category not found\',404');
    }

    public function updateCategory($categoryId, Request $request)
    {
        if (! $category = Category::find($categoryId)) {
            return response()->json('Category not found',404);
        }

        if (isset($request['name']))  $category->name = $request['name'];
        if (isset($request['description'])) $category->description = $request['description'];
        $category->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $category
        ],200);
    }

    public function deleteCategory($categoryId)
    {
        if (! $category = Category::find($categoryId)) {
            return response()->json('Category not found',404);
        }

        $category->delete();
        return response()->json('successful operation',202);
    }

}
