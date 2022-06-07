<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationApiController extends Controller
{
    public function index()
    {
        return response()->json(Location::all(),200,["content-type"=>"application/json"],JSON_UNESCAPED_UNICODE);
    }
}
