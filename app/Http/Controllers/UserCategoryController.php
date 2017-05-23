<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\UserCategory;
use Illuminate\Http\Request;

class UserCategoryController extends Controller
{
    public function getUserCategories($userId)
    {
        $result = [];
        $userCategories = UserCategory::where('user_id', $userId)->get()->toArray();
        foreach ($userCategories as $userCategory) {
            $userCategory['category'] = Category::find($userCategory['category_id'])->toArray();
            array_push($result, $userCategory);
        }

        return response()->json($result, 200);
    }

    public function addUserCategories(Request $request, $userId)
    {
        $this->validate($request, [
            'categoryId' => 'required',
            'type' => 'required'
        ]);

        $user = User::find($userId);
        if ($request['type'] == 'skill' && $user->type != 'buddy' && $user->type != 'admin') {
            return response()->json('Invalid permission',408);
        }

        $userCategory = new UserCategory();
        $userCategory->user_id = $userId;
        $userCategory->category_id = $request['categoryId'];
        $userCategory->type = $request['type'];;
        $userCategory->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $userCategory
        ],200);
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
        if (! $userCategory = UserCategory::find($userCategoryId)) {
            return response()->json('UserCategory not found',404);
        }

        if (isset($request['categoryId']))  $userCategory->category_id = $request['categoryId'];
        if (isset($request['type'])) $userCategory->type = $request['type'];
        $userCategory->save();

        return response()->json(
            [
                'message'=> 'successful operation',
                'data' => $userCategory
            ],200);
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
