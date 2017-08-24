<?php
/**
 * Created by PhpStorm.
 * User: weizeng
 * Date: 2017/8/23
 * Time: 下午11:50
 * Desc：用户发送消息的处理
 */

class Message extends \swoole_websocket_server {

    // 初始化一个 websocket 应用
    public function __construct($host, $port,array $option, $mode = 3, $tcp_or_udp = 1)
    {
        parent::__construct($host, $port, $mode, $tcp_or_udp);

        $this->set($option);


        $this->on('open',function (swoole_websocket_server $server, $request) {
            echo "server: handshake success with fd{$request->fd},follow will dump var request:\n";
            var_dump($request);
        });

        $this->on('message',function (swoole_websocket_server $server, $frame) {
            $this->message($server,$frame);
        });

        $this->on('close', function ($ser, $fd) {
            echo "client {$fd} closed,follow will dump var request:\n";
            var_dump($fd);
        });

        $this->on('task',function ($serv, $task_id, $src_worker_id, $data) {
            echo 'task';
        });

        $this->on('finish',function ($serv, $task_id, $data) {
            echo $data;
        });

    }

    // Hook function
    public function message(swoole_websocket_server $server, $frame) {
        echo 'do some function hook!';
    }





}



