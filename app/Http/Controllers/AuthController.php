<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function user(){
        return "Authenticated user!";
    }

    public function register(Request $request){
        $user = User::create([
            'email' => $request -> input('email'),
            'name' => $request -> input('name'),
            'phone_number' => $request -> input('phone_number'),
            'password' => Hash::make($request -> input('password'))
        ]);

        return response(["message" => "Successfully regitered!"], 200);
    }

    public function login(Request $request){
        
        $user = User::where('email', $request->email)->first();
        if($user){
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        }

        return response(["message" => "Invalid login!"], 401);
    }

    public function check(){
        $men = User::all();
        return response(["message" => $men], 200);
    }
    public function show(){
        $records = DB::table('records')
            ->select('*')
            ->get()->toArray();

        return response(["message" => $records], 200); 
    }
}