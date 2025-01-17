<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;

use Illuminate\Http\Response;


class LocationController extends Controller
{
    public function index(){
        $locations = Location::query()
            ->orderByTitleAsc()
            ->get();

        return response()->json([
            'data'=> LocationResource::collection($locations),
            'message' => "List of locations."
        ],Response::HTTP_OK);
    }

    public function indexById($locationID){
        $location = Location::query()
            ->findById($locationID)
            ->first();

        if(isset($location)){
            return response()->json([
                'data'=>new LocationResource($location),
                'message' => "Location found successfuly"
            ],  Response::HTTP_OK);
        }
        
        return response()->json([
            'data'=> [],
            'message' => "Location not found."
        ],Response::HTTP_NOT_FOUND);
    }

    public function store(LocationRequest $request){
        $data = $request->input();

        $location = Location::create([
            'title' => $data['title'],
        ]);
        
        return response()->json([
            'data'=> new LocationResource($location),
            'message' => "Location added successfully."
        ],Response::HTTP_OK);
    }

    public function update(LocationRequest $request, $locationID){
        $data = $request->all();

        $location = Location::query()
            ->findById($locationID)
            ->first();

        if(isset($location)){
            $location->title = $data['title'];
            $location->save();

            return response()->json([
                'data'=> new LocationResource($location),
                'message' => "Location updated successfully."
            ],Response::HTTP_OK);
        }
        return response()->json([
            'data'=> [],
            'message' => "Location not found."
        ],Response::HTTP_NOT_FOUND);

    }

    public function delete($locationID){
        $location = Location::query()
        ->findById($locationID)
        ->first();

        if(isset($location)){
            $location->delete();

            return response()->json([
                'data'=> [],
                'message' => "Location deleted successfully."
            ],Response::HTTP_OK);
        }
        return response()->json([
            'data'=> [],
            'message' => "Location not found."
        ],Response::HTTP_NOT_FOUND);
    }
}    