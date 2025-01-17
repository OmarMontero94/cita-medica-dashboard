<?php

namespace App\Http\Controllers;
use App\Http\Requests\SpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Models\Medic;

use App\Models\Specialty;
use App\Models\User;
use Http;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SpecialtyController extends Controller
{
    public function index(){
        $specialties = Specialty::query()
            ->orderByTitleAsc()
            ->get();

        return response()->json([
            'data'=> SpecialtyResource::collection($specialties),
            'message' => "List of specialties."
        ],Response::HTTP_OK);
    }

    public function indexById($specialtyID){
        $specialty = Specialty::query()
            ->findById($specialtyID)
            ->first();

        if(isset($specialty)){
            return response()->json([
                'data'=>new SpecialtyResource($specialty),
                'message' => "Specialty found successfuly"
            ],  Response::HTTP_OK);
        }
        
        return response()->json([
            'data'=> [],
            'message' => "Specialty not found."
        ],Response::HTTP_NOT_FOUND);
    }

    public function store(SpecialtyRequest $request){
        $data = $request->input();

        $specialty = Specialty::create([
            'title' => $data['title'],
        ]);
        
        return response()->json([
            'data'=> new SpecialtyResource($specialty),
            'message' => "Specialty added successfully."
        ],Response::HTTP_OK);
    }

    public function update(SpecialtyRequest $request, $specialtyID){
        $data = $request->all();

        $specialty = Specialty::query()
            ->findById($specialtyID)
            ->first();

        if(isset($specialty)){
            $specialty->title = $data['title'];
            $specialty->save();

            return response()->json([
                'data'=> new SpecialtyResource($specialty),
                'message' => "Specialty updated successfully."
            ],Response::HTTP_OK);
        }
        return response()->json([
            'data'=> [],
            'message' => "Specialty not found."
        ],Response::HTTP_NOT_FOUND);

    }

    public function delete($specialtyID){
        $specialty = Specialty::query()
        ->findById($specialtyID)
        ->first();

        if(isset($specialty)){
            $specialty->delete();

            return response()->json([
                'data'=> [],
                'message' => "Specialty deleted successfully."
            ],Response::HTTP_OK);
        }
        return response()->json([
            'data'=> [],
            'message' => "Specialty not found."
        ],Response::HTTP_NOT_FOUND);
    }
}    