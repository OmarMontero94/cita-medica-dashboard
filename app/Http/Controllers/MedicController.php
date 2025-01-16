<?php

namespace App\Http\Controllers;
use App\Http\Requests\MedicPostPutRequest;
use App\Models\Medic;

use Http;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class MedicController extends Controller
{
    public function index(){
        $medics = [];

        return response()->json([
            'data'=>$medics
        ],Response::HTTP_OK);
    }

    public function indexById($medicID){
        $medic = Medic::
        where('user_id,', $medicID)
        ->with(['location,specialty,user'])
        ->first();

        return response()->json([
            'data'=>$medic
        ],  Response::HTTP_OK);
    }

    public function create($medicID, MedicPostPutRequest $request){
        $createMedicData = $request->input();

        $user = User::create([
            'name' => $createMedicData['name'],
            'email' => $createMedicData['email'],
            'password' => Hash::make($createMedicData['password']),
        ]);

        $medic = Medic::create([
            'user_id'=>$user->id,
            'phone'=>$createMedicData['phone'],
            'location_id'=>$createMedicData['location_id'],
            'specialty_id'=>$createMedicData['specialty_id']
        ])
    }

    public function update(MedicPostPutRequest $request){
    }

    public function delete(int $medicID){
    }
    
}
