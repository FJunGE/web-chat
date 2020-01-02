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
        $this->middleware('auth:api')->only('logout'); // 仅针对 logout
    }

    public function register(Request $request) {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3'],
            'email' =>  ['required', 'email'],
            'password' => ['required'],
        ])->validate();

        $user = User::create([
            'name'  =>  $request->input('name'),
            'email'  =>  $request->input('email'),
            'password'  =>  Hash::make($request->input('password')),
            'api_token' => Str::random(60),
        ]);

        return $user;
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' =>  'required|string',
            'password'  =>  'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        if ($user && Hash::check($request->input('password'), $user->password)){
            // 每次登录成功重新替换token值
            $user->api_token = Str::random(60);
            $user->save();

            return response()->json(['user' => $user, 'success'=>true]);
        }

        return response()->json(['user' => $user, 'success'=>false]);
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
    public function test()
    {
        return 1231231;
    }
}