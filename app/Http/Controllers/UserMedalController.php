<?php

namespace App\Http\Controllers;

use App\User;
use App\UserMedal;
use Illuminate\Http\Request;

class UserMedalController extends Controller
{
    public function getAllBuddyMedal($userId)
    {
        $userMedals = UserMedal::where("user_id", $userId)->get();
        return response()->json($userMedals, 200);
    }

    public function createBuddyMedal($userId, Request $request)
    {
        $this->validate($request, [
            'medalId' => 'required'
        ]);

        if (UserMedal::where('user_id', $userId)->where('medal_id', $request['medalId'])->first()) {
            return response()->json('User medal already exist',404);
        }

        $userMedal = new UserMedal();
        $userMedal->user_id = $userId;
        $userMedal->medal_id = $request['medalId'];
        $userMedal->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $userMedal
        ],200);
    }

    public function getBuddyMedal($userId, $medalId)
    {
        if (! $userMedals = UserMedal::where("user_id", $userId)->where('medal_id', $medalId)->first()) {
            return response()->json('User medal not exist',404);
        }

        return response()->json($userMedals, 200);
    }

    public function deleteBuddyMedal($userId, $medalId)
    {
        if (! $userMedals = UserMedal::where("user_id", $userId)->where('medal_id', $medalId)->first()) {
            return response()->json('User medal not exist',404);
        }

        $userMedals->delete();
        return response()->json('successful operation',202);
    }

}
