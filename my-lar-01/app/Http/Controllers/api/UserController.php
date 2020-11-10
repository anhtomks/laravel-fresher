<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public $successStatus = 200;

    /**
     * Login
     */
    public function login() {
        if(Auth::attempt(
            [
                'email' => request('email'),
                'password' => request('password')
            ])) {
                $user = Auth::user();
                $success['token'] = $user->createToken('MyApp')->accessToken;

                return response()->json(['success'=>$success], $this->successStatus);
        }else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    /**
     * Register
     */
    public function register(Request $req) {
        $validator = Validator::make($req->all(),
        [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=>'required',
            'c_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $req->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * details
     */

     public function details() {
        $user = Auth::user();

        return response()->json(['success'=>$user], $this->successStatus);
     }
}
