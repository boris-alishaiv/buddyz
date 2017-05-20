<?php

namespace App\Http\Controllers;

use App\Medal;
use Illuminate\Http\Request;

class MedalController extends Controller
{
    public function getAllMedals()
    {
        // TODO: admin only
        return response()->json(Medal::all(), 200);
    }

    public function addMedal(Request $request)
    {
        // TODO: admin only

        if (Medal::where('name', $request['name'])->first()){
            return response()->json('Medal name already exist',405);
        }

        $medal = new Medal();
        $medal->name = $request['name'];
        $medal->description = $request['description'];
        $medal->save();

        return response()->json('successful operation',200);
    }

    public function getMedal($medalId)
    {
        // TODO: admin only

        if ($medal = Medal::find($medalId)) {
            return response()->json($medal,200);
        }

        return response()->json('Invalid Medal id',404);
    }

    public function updateMedal($medalId, Request $request)
    {
        // TODO: admin only

        if (! $medal = Medal::find($medalId)) {
            return response()->json('Medal not found',404);
        }

        if (isset($request['name']))  $medal->name = $request['name'];
        if (isset($request['description'])) $medal->description = $request['description'];
        $medal->save();

        return response()->json('successful operation',202);

    }

    public function deleteMedal($medalId)
    {
        // TODO: admin only

        if (! $medal = Medal::find($medalId)) {
            return response()->json('Medal not found',404);
        }

        $medal->delete();
        return response()->json('successful operation',202);
    }

}
