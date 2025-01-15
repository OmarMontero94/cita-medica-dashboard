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

    public function indexById(medicID){
        $medic = Medic::first(Auth::user()->id);

        return response()->json([
            'data'=>$medic
        ],Response::HTTP_OK);
    }

    public function create(){

    }

    public function update(MedicPostPutRequest){

    }

    public function delete(medicID){
        
    }
    

}
