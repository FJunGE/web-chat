@extends('index')
@section('form')

    <form action="{{ route('register.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <input placeholder="名称" type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <input placeholder="账号" type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <input placeholder="密码" type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-success">注册</button>
    </form>

@endsection