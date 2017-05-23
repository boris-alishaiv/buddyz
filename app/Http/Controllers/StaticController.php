<?php

namespace App\Http\Controllers;

use App\StaticModel;
use Illuminate\Http\Request;

class StaticController extends Controller
{
    public function getAllStatic()
    {
        return response()->json(StaticModel::all(), 200);
    }

    public function addStatic(Request $request)
    {
        if (StaticModel::where('name', $request['name'])->first()){
            return response()->json('Static name already exist',405);
        }

        $static = new StaticModel();
        $static->name = $request['name'];
        $static->content = $request['content'];
        $static->save();

        return response()->json('successful operation',200);
    }

    public function getStatic($staticId)
    {
        if ($static = StaticModel::find($staticId)) {
            return response()->json($static,200);
        }

        return response()->json('Invalid Static id',404);
    }

    public function updateStatic($staticId, Request $request)
    {
        if (! $static = StaticModel::find($staticId)) {
            return response()->json('Static not found',404);
        }

        if (isset($request['name']))  $static->name = $request['name'];
        if (isset($request['content'])) $static->content = $request['content'];
        $static->save();

        return response()->json('successful operation',202);
    }

    public function deleteStatic($staticId)
    {
        if (! $static = StaticModel::find($staticId)) {
            return response()->json('Static not found',404);
        }

        $static->delete();
        return response()->json('successful operation',202);
    }
}
