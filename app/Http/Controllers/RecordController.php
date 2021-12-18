<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;



class RecordController extends Controller
{
    public function create(Request $request){

        $record = new Record;
        $record->title = $request->title;
        $record->category = $request->category;
        $record->place = $request->place;
        $record->status = $request->status;
        $record->user_id = Auth::user()->id;
        $record->save();

        return response(["message" => "Successfully created record!"], 200);
    }
    public function show($id){
        try{
            $record = Record::findOrFail($id);
            return response(["data" => $record], 200);
        }
        catch(ModelNotFoundException $e){
            return response(["message" => "Record does not exist " . $id], 404);
        } 
    }
    public function edit(Request $request, $id){
        try{
            $record = Record::findOrFail($id)
                ->update($request->all());
            return response(["message" => "Successfully updated! " . $id], 200);
        }
        catch(ModelNotFoundException $e){
            return response(["message" => "Record does not exist " . $id], 404);
        } 
    }

    public function delete($id){
        try{
            $record = Record::findOrFail($id);
            $record->delete();
            return response(["message" => "Successfully deleted! " . $id], 200); 
        }
        catch(ModelNotFoundException $e){
            return response(["message" => "Record does not exist " . $id], 404);
        }  
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
            ->where('user_id', '<>', Auth::user()->id)
            ->get()->toArray();
        return response(["message" => $records], 200); 
    }

}
