<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {

    }

    public function register(Request $request)
    {
        if ($request->isMethod('POST')){
            $request->validate([
                'name' => 'required|unique:users',
                'username' => 'required',
                'password' => 'required'
            ]);
            $user = User::create([
                'name'  =>  $request->input('name'),
                'username'  =>  $request->input('username'),
                'password'  =>  password_hash($request->input('password'),PASSWORD_DEFAULT),
                'api_token' => Str::random(60),
            ]);
            return $user;

        }else{
            return view('auth.register');
        }

    }

    public function login(Request $request)
    {

        $request->validate([
            'username' =>  'required|string',
            'password'  =>  'required',
        ]);

        $user = User::where('username', $request->input('username'))->first();
        if ($user && Hash::check($request->input('password'), $user->password)){
            // 每次登录成功重新替换token值
            $user->api_token = Str::random(60);
            $user->save();

            return response()->json(['user' => $user, 'success'=>true]);
        }

        return view('index');
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('auth:api')->user();//获取通过auth:api验证用户的
        User::find($user->id);
        $user->apt_token = null;
        $user->save();
        Auth::logout(); //
        return response()->json(['success'=>true]);
    }
}
