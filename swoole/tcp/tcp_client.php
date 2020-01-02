<?php
namespace swoole;


// swoole 4 通过协程来实现异步通信
go(function (){
    $client = new Coroutine\Client(SWOOLE_SOCK_TCP);

    // 尝试是否与 TCP 服务端建立了连接 端口与服务端配置的一致 超时时间是0.5s
    if ($client->connect('192.168.10.110', 9501, 0.5)) {

        // 建立连接后发送内容
        $client->send("快说 你是猪\n");

        // 打印服务端传过来的消息
        echo $client->recv();

        // 关闭连接
        $client->close();
    } else {
        echo "connect failed";// 连接失败
    }
});