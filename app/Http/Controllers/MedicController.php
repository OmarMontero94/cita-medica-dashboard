<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddMedicServiceRequest;
use App\Http\Requests\MedicPostRequest;
use App\Http\Requests\MedicPutRequest;
use App\Http\Resources\MedicCSVResource;
use App\Http\Resources\MedicResource;
use App\Http\Resources\MedicServiceResource;
use App\Models\Medic;

use App\Models\MedicService;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class MedicController extends Controller
{
    public function index(){
        $medics = Medic::query()
            ->with(['user','location', 'specialty'])
            ->get();

        return response()->json([
            'data'=>MedicResource::collection($medics)
        ],Response::HTTP_OK);
    }

    public function indexById($medicID){
        $medic = Medic::query()
        ->findById($medicID)
        ->with(['location,specialty,user'])
        ->first();

        return response()->json([
            'data'=>new MedicResource($medic)
        ],  Response::HTTP_OK);
    }

    public function indexBySpecialty($specialtyID){
        $medics = Medic::query()
        ->findBySpecialtyId($specialtyID)
        ->with(['location,specialty,user'])
        ->first();

        return response()->json([
            'data'=> MedicResource::collection($medics)
        ],  Response::HTTP_OK);
    }
    public function indexByUserId($userID){
        $medic = Medic::query()
        ->findByUserId($userID)
        ->with(['location,specialty,user'])
        ->first();

        return response()->json([
            'data'=>new MedicResource($medic)
        ],  Response::HTTP_OK);
    }

    public function create(MedicPostRequest $request){
        $data = $request->input();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $medic = Medic::create([
            'user_id'=>$user->id,
            'phone'=>$data['phone'],
            'location_id'=>$data['location_id'],
            'specialty_id'=>$data['specialty_id']
        ]);

        $medic = Medic::query()
            ->findById($medic->id)
            ->with('user','location','specialty')
            ->first();
        
        return response()->json([
            'data'=> new MedicResource($medic),
            'message' => "Medic added successfully."
        ],Response::HTTP_OK);
    }

    public function addService(AddMedicServiceRequest $request){
        $data = $request->input();

        $medicService = MedicService::create([
            'medic_id' => $data['medic_id'],
            'service_id' => $data['service_id'],
            'price' => $data['price']
        ]);

        return response()->json([
            'data'=> new MedicServiceResource($medicService),
            'message' => "Medic service added successfully."
        ],Response::HTTP_OK);

    }

    public function indexMedicServiceByMedicId($medicID){
        $medicServices = MedicService::query()
        ->findBymedicId($medicID)
        ->with(['service', 'medic'])
        ->get();

        return response()->json([
            'data'=>MedicServiceResource::collection($medicServices)
        ],  Response::HTTP_OK);
    }

    public function update(MedicPutRequest $request, $medicID){
        $data = $request->input();

        $medic = Medic::query()
            ->findById($medicID)
            ->first();
        
        $medic->phone = $data['phone'];
        $medic->location_id = $data['location_id'];
        $medic->specialty_id = $data['specialty_id'];
        $medic->save();
        
        $user = User::query()
        ->findById($medic->user_id)
        ->first();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = isset($data['password']) ? Hash::make($data['password']) : $user->password;
        $user->save();

        return response()->json([
            'data'=>new MedicResource($medic)
        ],  Response::HTTP_OK);

    }

    public function getMedicsCSV(){
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=galleries.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
        ];


        $list = Medic::query()
        ->with(['user', 'location', 'specialty'])
        ->get();

        $list = MedicCSVResource::collection($list);
        
        $list = json_decode($list->toJson());

        # add headers for each column in the CSV download
        array_unshift($list, array_keys((array) $list[0]));

        $callback = function() use ($list) 
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, (array) $row);
            }
            fclose($FH);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function delete( $medicID ){
        MedicService::query()
            ->findByMedicId($medicID)
            ->delete();

        $medic = Medic::query()
            ->with('user')
            ->findById($medicID)
            ->first();

        User::query()
            ->findById($medic->user->id)
            ->delete();

        $medic->delete();

        return response()->json([
            'data'=>[]
        ],  Response::HTTP_OK);

    }

   
    
}
