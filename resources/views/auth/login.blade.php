@extends('index')
@section('form')

    <form action="{{ route('auth.login') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <input placeholder="账号" type="text" name="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <input placeholder="密码" type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-success">登录</button>
        <a href="{{ route('register.index') }}">去注册</a>
    </form>

@endsection