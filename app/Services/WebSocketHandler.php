<?php
namespace app\Services;

use App\Events\MessageReceived;
use App\Models\OfflineMessage;
use App\Models\User;
use Hhxsv5\LaravelS\Swoole\WebSocketHandlerInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Swoole\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

class WebSocketHandler implements WebSocketHandlerInterface {

    private $swoole;
    public function __construct()
    {
        $this->swoole = app('swoole');
    }

    // 传送信息，发给对应用户
    public function sendMessage(Server $server, $userID, $data, $user_status = User::USER_STATUS_ONLINE)
    {
        $fd = $this->swoole->wsTable->get('uid:'.$userID);
        if ($fd == false) {
            // 没有获取到客户端资源，并且判断用户是否已经上线
            if ($user_status == User::USER_STATUS_OFFLINE) {
                // 用户下线后将信息存入下线表中
                OfflineMessage::create([
                    'user_id' => $userID,
                    'message' => $data,
                    'status'  => 'unSend',
                ]);
            }
        }
        $server->push($fd['value'], json_encode($data));
    }

    //
    public function onOpen(Server $server, Request $request)
    {
        // TODO: Implement onOpen() method.
        Log::info("WebSocket 连接建立".$request->fd);

        $user = Auth::user();
        $userID = $user ? $user->id : null; // null代表未登录

        // userID 与 fd 互绑
        $this->swoole->wsTable->set('uid:'.$userID, ['value' => $request->fd]); // userID 和 fd互绑
        $this->swoole->wsTable->set('fd:'.$request->fd, ['value' => $userID]); // fd 和 userID互绑

        // 更新用户状态
        User::query()->where('id', $userID)->update(['status' => User::USER_STATUS_ONLINE]);

    }

    // 收到客户端发来的数据，触发
    public function onMessage(Server $server, Frame $frame)
    {
        // TODO: Implement onMessage() method.
        // frame->fd 客户端id frame->data 客服端发来的数据
        Log::info("从{$frame->fd} 收到一条消息: {$frame->data}");

        $info = json_decode($frame->data);
        $server->push($frame->fd, "nihao ");


        switch ($info->type)
        {
            case "ping":
                break;

            case "chatMessage":
                if ($info->data->to->type = 'friend') {
                    // 好友聊天
                }else{
                    // 群聊聊天
                }

        }

        /*if (empty($message->token) && !($user = User::query()->where('api_token', $message->token)->first())){
            Log::warning("这个用户离线了: {$message->name} 不能参与聊天");
            $server->push($frame->fd, "这个用户离线了，聊个几把天");
        }else{
            // 数据要入库，因为这里入库需要消耗IO 所以用到异步事件操作
            $event = new MessageReceived($message, $user->id);
            Event::fire($event); // 触发事件
            unset($message->token);

            // 遍历当前有多少客户端与当前服务端进行链接
            foreach ($server->connections as $fd) {
                // 判断链接是否有效
                if (!$server->isEstablished($fd)) {
                    // 不可用的链接 忽略
                    continue;
                }

                // 向所有客户端广播事件
                $server->push($fd, json_encode($frame->data));
            }
        }*/

    }

    public function onClose(Server $server, $fd, $reactorId)
    {
        // TODO: Implement onClose() method.
        Log::info('WebSocket 连接关闭');
    }

}