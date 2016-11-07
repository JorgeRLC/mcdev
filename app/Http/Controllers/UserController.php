<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        $response = User::all();
        return response()->json($response);
    }

    public function store(Request $data)
    {
        $validator = $this->validator($data->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $data, $validator
            );
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type' => $data['type'],
            'data' => $data['data']
        ]);

        return response('save', 200);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    }

    public function show($id)
    {
        $response = User::find($id);
        return response()->json($response);
    }

    public function login(Request $data){
        
        $user = User::where('email', $data['email'])->first();
        
        if($user) {
            $email = $data['email'];
            $password = $data['password'];
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $token = "Gh60Jjda9k4L3mY0";
                $user->token = $token;
                $user->save();
                
                $response = [
                    'token' => $token
                ];
                return response()->json($response);
            } else {
                return response('incorrect password', 404);
            }
        } else {
            return response('incorrect user', 403);
        }
    }
    
    public function logout(Request $data){
        $user = User::where('email', $data['email'])->first();
        
        if($user) {
            $token = "";
            $user->token = $token;
            $user->save();
            return response('logout', 200);
        } else {
            return response('incorrect user', 403);
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
