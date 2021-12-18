<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
    public function create(Request $request){

        $record = new Record;
        $record->title = $request->title;
        $record->category = $request->category;
        $record->palace = $request->place;
        $record->status = $request->status;
        $record->user_id = $request->user_id;
        $record->save();

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
