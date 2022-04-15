<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

    public function index(){
        $users = User::all();
        return $this->successResponse($users);
    }

    public function getOne($user_id){
        $user = User::findOrFail($user_id);
        return $this->successResponse($user);
    }

    public function store(Request $request){    
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);
        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    public function update(Request $request, $user_id){
        $user = User::findOrFail($user_id);

        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|unique:users,email,'.$user_id,
            'password' => 'required|min:8|confirmed'
        ];

        $this->validate($request, $rules);

        $user->fill($request->all());

        if($request->has('password')){
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return $this->successResponse($user, Response::HTTP_OK);
    }

    public function delete(Request $request,$user_id){
        $user = User::findOrFail($user_id);
        $user->delete();
        return $this->successResponse($user);
    }

    public function trashed(){
        $users = User::onlyTrashed()->get();
        if(!$users) return $this->errorResponse('User Not Found',Response::HTTP_NOT_FOUND);

        return $this->successResponse($users);
    }
}
