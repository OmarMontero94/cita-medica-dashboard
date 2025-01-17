<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;

use Illuminate\Http\Response;


class ServiceController extends Controller
{
    public function index(){
        $services = Service::query()
            ->with('specialty')
            ->orderByTitleAsc()
            ->get();

        return response()->json([
            'data'=> ServiceResource::collection($services),
            'message' => "List of services."
        ],Response::HTTP_OK);
    }

    public function indexBySpecialtyId($specialtyID){
        $services = Service::query()
            ->with('specialty')
            ->findBySpecialtyId($specialtyID)
            ->orderByTitleAsc()
            ->get();

        return response()->json([
            'data'=> ServiceResource::collection($services),
            'message' => "List of services by specialty."
        ],Response::HTTP_OK);
    }

    public function indexById($serviceID){
        $service = Service::query()
            ->with('specialty')
            ->findById($serviceID)
            ->first();

        if(isset($service)){
            return response()->json([
                'data'=>new ServiceResource($service),
                'message' => "Service found successfuly"
            ],  Response::HTTP_OK);
        }
        
        return response()->json([
            'data'=> [],
            'message' => "Service not found."
        ],Response::HTTP_NOT_FOUND);
    }

    public function store(ServiceRequest $request){
        $data = $request->input();

        $service = Service::create([
            'title' => $data['title'],
            'specialty_id' => $data['specialty_id'],
        ]);

        $service = Service::query()
            ->with('specialty')
            ->findById($service->id)
            ->first();
        
        return response()->json([
            'data'=> new ServiceResource($service),
            'message' => "Service added successfully."
        ],Response::HTTP_OK);
    }

    public function update(ServiceRequest $request, $serviceID){
        $data = $request->all();

        $service = Service::query()
            ->findById($serviceID)
            ->first();

        if(isset($service)){
            $service->title = $data['title'];
            $service->save();

            return response()->json([
                'data'=> new ServiceResource($service),
                'message' => "Service updated successfully."
            ],Response::HTTP_OK);
        }
        return response()->json([
            'data'=> [],
            'message' => "Service not found."
        ],Response::HTTP_NOT_FOUND);

    }

    public function delete($serviceID){
        $service = Service::query()
        ->findById($serviceID)
        ->first();

        if(isset($service)){
            $service->delete();

            return response()->json([
                'data'=> [],
                'message' => "Service deleted successfully."
            ],Response::HTTP_OK);
        }
        return response()->json([
            'data'=> [],
            'message' => "Service not found."
        ],Response::HTTP_NOT_FOUND);
    }
}    