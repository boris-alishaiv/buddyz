<?php

namespace App\Http\Controllers;

use App\Vouch;
use Illuminate\Http\Request;

class VouchController extends Controller
{

    public function getAllVouches()
    {
        // TODO: admin only
        return response()->json(Vouch::all(), 200);
    }

    public function getVouchesByUser($userId)
    {

    }

    public function addVouchByUser($userId, Request $request)
    {
        if (!isset($request['otherUserId '])){
            return response()->json('input error',404);
        }

        $vouch = new Vouch();
        $vouch->user_id_get = $request['otherUserId'];
        $vouch->user_id_post = $userId;
        $vouch->save();

        return response()->json('successful operation',202);
    }

    public function deleteVouch($userId, Request $request)
    {
        if (! $vouch = Vouch::where('user_id_get', $request['otherUserId'])->where('user_id_post', $userId)->first()) {
            return response()->json('Static not found',404);
        }

    }

    public function getAllVouches2($userId)
    {

    }

}
