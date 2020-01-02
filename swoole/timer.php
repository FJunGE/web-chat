<?php
/**
 * Created by PhpStorm.
 * User: crazy
 * Date: 2019/12/24
 * Time: 12:00
 * name: 定时器
 */

// 定时器 指定每一秒要处理的任务
/*\Swoole\Timer::tick(1000, function (){
    echo date('H:i:s',time())."\n";
});*/

// 指定时间处理任务 clear清除缓存
$count = 0;
\Swoole\Timer::tick(1000, function ($timerId, $count){
    global $count;
    $count++;
    echo "第{$count}秒的结果\n";
    if ($count == 3){
        \Swoole\Timer::clear($timerId);
    }
}, $count);