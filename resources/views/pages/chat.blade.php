@extends('layouts.app')
@section('content')

     <div class="row">
        <div class="col-md-3">
            @include('lists.userList', ['users'=>$users])
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <ul class="list-unstyled" id="msg">
                    <li class="media">
                        <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1577944718482&di=e037adfbbf38f808b4784db8f539a44e&imgtype=jpg&src=http%3A%2F%2F5b0988e595225.cdn.sohucs.com%2Fimages%2F20190524%2F625e7a778d8041df82629db1c630c9e2.jpeg" width="50" height="50" class="align-self-start mr-3" alt="...">
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">Web-Chat 作者</h6>
                            <p>test</p>
                        </div>
                    </li>
                    <li class="media my-4">
                        <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1577944718482&di=e037adfbbf38f808b4784db8f539a44e&imgtype=jpg&src=http%3A%2F%2F5b0988e595225.cdn.sohucs.com%2Fimages%2F20190524%2F625e7a778d8041df82629db1c630c9e2.jpeg" width="50" height="50" class="align-self-start mr-3" alt="...">
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">Web-Chat 作者</h6>
                            <p>菜鸡</p>
                        </div>
                    </li>
                    <li class="media my-4 text-right">
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">产品经理</h6>
                            <p>你好我好才是真的好</p>
                        </div>
                        <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1577944718482&di=e037adfbbf38f808b4784db8f539a44e&imgtype=jpg&src=http%3A%2F%2F5b0988e595225.cdn.sohucs.com%2Fimages%2F20190524%2F625e7a778d8041df82629db1c630c9e2.jpeg" width="50" height="50" class="align-self-start ml-3" alt="...">
                    </li>
                </ul>


                <form action="">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><small>我是 <b>{{ Auth::user()->name }}</b> :</small></label>
                        <textarea class="form-control" id="chatMessageTextarea" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">发送</button>
                    <a href="{{ route('logout') }}" class="btn btn-danger">切换用户</a>
                </form>
            </div>
        </div>
     </div>
@endsection
@section('js')
    <script>
        var socket;
        var ping;
        socket = new WebSocket("ws://{{ env('LARAVELS_LISTEN_IP') }}:9501");
        function sendMessage(socket, data){
            socket.send(data);
            console.log('当前状态'+socket.readyState);
        }

        socket.onopen = function () {
            console.log('客户端连接中');
            ping = setInterval(function () {
                sendMessage(socket,'{"type":"ping"}');
                console.log("ping...");
            },1000 * 10)
        }

        var html = '';
        var msg = document.getElementById('msg');
        socket.onmessage = function (res) {

        }

        socket.onclose = function () {
            console.log("已和服务端断开连接");
            clearInterval(ping);
        }
    </script>
@endsection