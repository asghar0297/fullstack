<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];

            return response()->json($response, 400);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->token = $user->createToken('MyApp')->plainTextToken;

        $response = [
            'success' => true,
            'data' => $user,
            'message' => 'User register successfully'
        ];

        return response()->json($response, 200);
    }


    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user =Auth::user();
            $user->token = $user->createToken('MyApp')->plainTextToken;

            $response = [
                'success' => true,
                'data' => $user,
                'message' => 'User login successfully'
            ];

            return response()->json($response, 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password'
            ], 200);
        }
    }
}
