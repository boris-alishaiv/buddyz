<?php

namespace App\Http\Controllers;

use App\User;
use App\UserCategory;
use Illuminate\Http\Request;

class UserCategoryController extends Controller
{
    public function getUserCategories()
    {
        return response()->json(UserCategory::all(), 200);
    }

    public function addUserCategories(Request $request)
    {
        if (! $user = User::find($request['userId'])) {
            return response()->json('userId not exist',405);
        }

        if ($request['type'] == 'skill' && $user->type != 'buddy') {
            return response()->json('skill must be added to buddy user',405);
        }

        if (UserCategory::where('user_id', $request['userId'])->where('category_id', ['categoryId'])->first()) {
            $userCategory = new UserCategory();
            $userCategory->user_id = $user->id;
            $userCategory->category_id = $request['categoryId'];
            $userCategory->type = 'skill';

        }

        $request['userId'];
        $request['categoryId'];
        $request['type'];

        if (StaticModel::where('name', $request['name'])->first()){
            return response()->json('Static name already exist',405);
        }

        $static = new StaticModel();
        $static->name = $request['name'];
        $static->content = $request['content'];
        $static->save();

        return response()->json('successful operation',200);
    }

    public function getUserCategory($userCategoryId)
    {
        if ($userCategory = UserCategory::find($userCategoryId)) {
            return response()->json($userCategory,200);
        }

        return response()->json('Invalid UserCategory id',404);
    }

    public function updateUserCategory($userCategoryId, Request $request)
    {


    }

    public function deleteUserCategory($userCategoryId)
    {
        if (! $userCategory = UserCategory::find($userCategoryId)) {
            return response()->json('UserCategory not found',404);
        }

        $userCategory->delete();
        return response()->json('successful operation',202);

    }

}
