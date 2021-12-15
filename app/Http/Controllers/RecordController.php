<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
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
    public function show(){
        $records = DB::table('records')
            ->select('*')
            ->getArray();
        return response(["message" => $records], 200); 
    }
}
