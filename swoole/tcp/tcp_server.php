<?php
namespace swoole;

// 监听本地9501端口
$server = new Server("192.168.10.110", 9501);

// 建立连接时的输出语句
$server->on('connect', function ($serv, $fd) {
    echo "Client:Connect\n";
});

// 接收到客户端消息返回的内容，原样输出
$server->on('receive', function ($serv, $fd, $form_id, $data) {
    // $fd 客户端的文件描述
    $serv->send($fd, "收到消息: ".$data);
    $serv->close($fd);
});

// 连接关闭时输出的语句
$server->on('close', function ($serv, $fd) {
    echo "Client:close";
});

// 启动TCP服务器
$server->start();