<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {

    }

    protected function guard()
    {
        return Auth::guard();
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

            // 注册玩自动登录
            Auth::login($user);

        }else{
            return view('auth.register');
        }

    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')){
            $request->validate([
                'username' =>  'required',
                'password'  =>  'required',
            ]);

            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                // 更新用户状态
                User::query()->where('id', Auth::id())->update(['status' => User::USER_STATUS_ONLINE, 'api_token' => Str::random(60)]);
                return redirect()->route('chat.index');
            }else{
                session()->flush('falid', '操作失败');
            }
        }else{
            return view('auth.login');
        }
    }

    public function logout(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        $user->api_token = null;
        $user->status = User::USER_STATUS_OFFLINE;
        $user->save();
        Auth::logout();
        session()->flush('success', '切换账号成功');
        return redirect('/');
    }
}
