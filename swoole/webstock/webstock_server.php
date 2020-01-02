<?php
namespace swoole;

// swoole 异步非阻塞网络引擎 实现websocket协议
$server = new \swoole_websocket_server("192.168.10.110", 9501);

$server->on("open", function (\swoole_websocket_server $server, $request){
    echo "server: handshake success with fd{$request->fd} \n";
});

$server->on("message", function(\swoole_websocket_server $server, $frame) {
    echo "receive message: {$frame->data} \n";
    $server->push($frame->fd, "客服已经收到你的消息：{$frame->data}");
});

$server->on("close", function ($serverm, $fd) {
    echo "client {$fd} close\n";
});

$server->start();