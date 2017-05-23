<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function getAllAreas()
    {
        return response()->json(Area::all(), 200);
    }

    public function createArea(Request $request)
    {
        if (Area::where('locations', $request['locations'])->first()){
            return response()->json('Area location already exist',405);
        }

        $area = new Area();
        $area->user_id = $request['userId'];
        $area->locations = $request['locations'];
        $area->save();

        return response()->json('successful operation',200);
    }

    public function getArea($areaId)
    {
        if ($area = Area::find($areaId)) {
            return response()->json($area,200);
        }

        return response()->json('Invalid Area id',404);
    }

    public function updateArea($areaId, Request $request)
    {
        if (! $area = Area::find($areaId)) {
            return response()->json('Area not found',404);
        }

        if (isset($request['userId']))  $area->user_id = $request['userId'];
        if (isset($request['locations'])) $area->description = $request['locations'];
        $area->save();

        return response()->json('successful operation',202);
    }

    public function deleteArea($areaId)
    {
        if (! $area = Area::find($areaId)) {
            return response()->json('Area not found',404);
        }

        $area->delete();
        return response()->json('successful operation',202);
    }

}
