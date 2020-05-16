<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    public function respondWithToken($token) 
    {
        
        return  response()->json([
            'access_token' => $token,
            'type_token'   => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }


    public function register (Request $request)
    {
        // validate data 
        $validateData = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required'

        ]);

        if(!$validateData->fails()) {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
    
            $token = auth()->login($user);
            return $this->respondWithToken($user);
        }
        return response()->json(['error' => $validateData->errors()]);

    }


    public function login(Request $request) 
    {
        $validateData = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
         
        if(!$validateData->fails()) {

            $credentials = $request->only(['email', 'password']);

            if(!$token = auth()->attempt($credentials)) {
    
                return response()->json(['error' => 'Acces non authorisé'], 401);
            }
    
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => $validateData->errors()]);
       
    }

}
