<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request){
        $validate=Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'email'=>'required|email',
            'password'=>'required|confirmed|string'
        ]);
        if($validate->fails()){
            return response()->json([
                'error'=>$validate->errors()
            ],300);
        }
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
        ]);
        return response()->json([
            'stutas'=>'success',
            'data'=>$user
        ],200);
    }
    public function login(Request $request){
        $validate=validator::make($request->all(),[
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);
        if($validate->fails()){
            return response()->json([
                'error'=>$validate->errors()
            ],404);
        }
        $user=User::where('email',$request->email)->first();
        if($user){
            $password_verfiy=Hash::check($request->password,$user->password);
            if($password_verfiy){
                $access_token=bin2hex(random_bytes(32));
                $user->access_token=$access_token;
                $user->save();
                return response()->json([
                    'stutas'=>'success',
                    'msg'=>'you are login ',
                    'access_token'=>$access_token
                ],200);

            }else {
                return response()->json([
                    'stutas'=>'false',
                    'msg'=>'password is not corrct'

                ],301);

            }
        }
        return response()->json([
            'stutas'=>'false',
            'msg'=>'error in login',

        ],404);
    }
}
