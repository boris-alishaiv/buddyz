<?php

namespace App\Http\Controllers;

use App\Vouch;
use Illuminate\Http\Request;
use JWTAuth;

class VouchController extends Controller
{

    public function getAllVouches()
    {
        if (JWTAuth::parseToken()->toUser()->type != "admin") {
            return response()->json(['error' => 'Permission denied'], 400);
        }

        return response()->json(Vouch::all(), 200);
    }

    public function createVouch(Request $request, $userId)
    {
        $this->validate($request, [
            'otherUserId' => 'required',
            'status' => 'required'
        ]);

        $vouch = new Vouch();
        $vouch->user_id_get = $request['otherUserId'];
        $vouch->user_id_post = $userId;
        $vouch->status = $request['status'];
        $vouch->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $vouch
        ],200);
    }

    public function deleteVouch($userId, Request $request)
    {
        $this->validate($request, [
            'otherUserId' => 'required'
        ]);


        if (! $vouch = Vouch::where('user_id_get', $request['otherUserId'])->where('user_id_post', $userId)->first()) {
            return response()->json('Vouch not found',404);
        }

        $vouch->status = "deleted";
        $vouch->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $vouch
        ],200);
    }


    public function testFunc($userId, $vouchId)
    {
        return response()->json('Implementation missing',400);
    }


   public function changeVouchStatus($vouchId, $userId)
    {
        if (! $vouch = Vouch::where('id', $vouchId)->where('user_id_get', $userId)->first()) {
            return response()->json('Vouch not found',404);
        }

        $vouch->status = "oneSide";
        $vouch->save;

        return response()->json([
            'message' => "successful operation",
            'data'    => $vouch
        ],200);
    }

}
