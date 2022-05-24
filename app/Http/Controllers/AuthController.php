<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        return response([
            "user" => $user
        ], 200);
    }
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'groupe_id' => 'required',
            'num_inscription' => 'required',
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'num_inscription' => $fields['num_inscription'],
            'groupe_id' => $fields['groupe_id'],
            'password' => Hash::make($fields['password']),
        ]);
        $token = $user->createToken('token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }
    public function logout(Request $request){
        Auth::user()->tokens()->delete();
        return response([
            "message" => "logged out."
        ], 200);
    }
    public function login(Request $request){
        $fields = $request->validate([
            'num_inscription' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('num_inscription', $fields['num_inscription'])->first();
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                "message" => "bad credentials."
            ], 401);
        }
        $token = $user->createToken('token')->plainTextToken;

        $response = [
            'token' => $token
        ];
        return response($response, 201);
    } 
}
