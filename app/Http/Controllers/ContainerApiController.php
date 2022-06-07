<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Container;
use Illuminate\Cache\Lock;

class ContainerApiController extends Controller
{
    public function index($locationId)
    {   
        return response()->json(Container::where("LocationId","=",$locationId)->get(["id","BlockNum","RentedBlockNum","temperature"]),200,["content-type"=>"application/json"],JSON_UNESCAPED_UNICODE);
    }
}
