<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
    public function create(Request $request){
        $record = Record::create([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'palace'=>$request->input('palace')
        ]);

        return response(["message" => "Successfully created record!"], 200);
    }
     public function myRecords(){
        $records = DB::table('records')
            ->select('*')
            ->where('user_id', '=', Auth::user()->id)
            ->get()->toArray();
        return response(["message" => $records], 200); 
    }
    public function allRecords(){
        $records = DB::table('records')
            ->select('*')
            ->get()->toArray();
        return response(["message" => $records], 200); 
    }

}
