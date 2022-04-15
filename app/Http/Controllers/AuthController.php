<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request){    
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        return $this->successResponse(['user'=>$user, 'access_token' => $token], Response::HTTP_CREATED);
    }

    public function login (Request $request) {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];

        $this->validate($request, $rules);
        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return $this->successResponse($response, Response::HTTP_OK);
            } else {
                $response = ["message" => "Password mismatch"];
                return $this->successResponse($response, Response::HTTP_BAD_REQUEST);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return $this->successResponse($response, Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return $this->successResponse($response, Response::HTTP_OK);
    }
}
