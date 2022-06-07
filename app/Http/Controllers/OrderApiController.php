<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

// use Mockery\Matcher\Contains;

class OrderApiController extends Controller
{
    public function calculate(Request $request)
    {
        $request->validate([
            "locationId" => ["required","exists:locations,id"],
            "volume" => ["required","numeric"],
            "temperature"=>["numeric","required"],
        ]);

        $temperature = intval($request->temperature);
        $volume = intval($request->volume);
        $locationId = intval($request->locationId);

        $containers = $this->getAcceptableContainers($temperature,$locationId);

        $blockNumbers = $this->getBlockNumbers($volume);

        $dayPrice = $this->calculatePrice($blockNumbers);

        if($this->isContainable($containers, $blockNumbers))
        {
            return response()->json([
                "available" => true,
                "daily price" => $dayPrice
            ], 200, ["content-type"=>"application/json"]);
        }
        else{
            return response()->json([
                "available" => false,
            ],417,["content-type"=>"application/json"]);
        }
    }

    private function getAcceptableContainers(int $temperature, int $locationId)
    {
        $containers = Container::where("id",$locationId)
                                    ->whereBetween("temperature",[$temperature-2,$temperature+2])
                                    ->get();

        return $containers;
    }

    private function getBlockNumbers(int $volume, int $blockType = 1)
    {
        $block = Block::all()->find($blockType);
        $blockVolume = $block->length * $block->width * $block->height;
        $number = intval(ceil($volume / $blockVolume));

        return $number;
    }

    private function isContainable($containers, int $blockNumbers)
    {
        $blocks = 0;
        foreach ($containers as $container) {
            $blocks = $blocks + intval($container->BlockNum)-intval($container->RentedBlockNum);
        }

        return ($blocks >= $blockNumbers);
    }

    private function calculatePrice(int $blockNumber, int $blockType=1)
    {
        $block = Block::all()->find($blockType);

        $blockPrice = intval($block->price);

        $price = $blockNumber * $blockPrice;

        return $price;

    }

    public function create(Request $request)
    {
        // return response()->json($request,200,["content-type"=>"application/json"],JSON_UNESCAPED_UNICODE);
        $request->validate([
            "locationId" => ["required","exists:locations,id"],
            "volume" => ["required","numeric"],
            "temperature"=>["numeric","required"],
        ]);

        $temperature = intval($request->temperature);
        $volume = intval($request->volume);
        $locationId = intval($request->locationId);

        $containers = $this->getAcceptableContainers($temperature,$locationId);

        $blockNumbers = $this->getBlockNumbers($volume);

        $dayPrice = $this->calculatePrice($blockNumbers);

        if($this->isContainable($containers, $blockNumbers))
        {
            return response()->json([
                "message"=>"Booked, ".$blockNumbers." blocks, daily price is ".$dayPrice
            ], 201, ["content-type"=>"application/json"]);
        }
        else{
            return response()->json([
                "message" => "Volume not fillable",
            ],417,["content-type"=>"application/json"]);
        }

    }
}
