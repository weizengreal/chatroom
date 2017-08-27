<?php
/**
 * Created by PhpStorm.
 * User: weizeng
 * Date: 2017/8/23
 * Time: 下午11:50
 * Desc：用户发送消息的处理
 */

class Message extends \swoole_websocket_server {
    private $redisHelper;

    // 初始化一个 websocket 应用
    public function __construct($host, $port,array $option, $redisOpt, $mode = 3, $tcp_or_udp = 1)
    {
        parent::__construct($host, $port, $mode, $tcp_or_udp);
        $this->set($option);
        $this->redisHelper = new RedisHelp($redisOpt);


        $this->on('open',function (swoole_websocket_server $server, $request) {
            echo "server: handshake success with fd{$request->fd},we do not do anything:\n";
//            var_dump($request);
        });

        $this->on('message',function (swoole_websocket_server $server, $frame) {
            $this->message($frame);
        });

        $this->on('close', function ($ser, $fd) {
            echo "client {$fd} closed,follow will dump var request:\n";
//            var_dump($fd);
        });

        $this->on('task',function ($serv, $task_id, $src_worker_id, $data) {
            echo 'task';
        });

        $this->on('finish',function ($serv, $task_id, $data) {
            echo $data;
        });

    }

    /*
     * 消息处理函数，用于处理各个消息，根据消息的发送类型 sendType ，主要如下所示：
     * 1:表示用户初始化一个消息类型
     * 2:表示
     *
     * @param object    $frame    结构如下
     * class Swoole\WebSocket\Frame#14 (4) {
          public $fd =>
          int(2)
          public $finish =>
          bool(true)
          public $opcode =>
          int(1)
          public $data =>
          string(24) "{"auth":"","sendType":1}"
        }
     *
     * */
    public function message($frame) {
        $msgData = json_decode($frame->data,true);
        switch ($msgData['sendType']) {
            case 1: {
//                print_r($msgData);
                if(empty($msgData['auth'])) {
                    $key = $this->newKey($frame->fd);
                }
                else {
                    $key = $msgData['auth'];
                }
//                if($this->redisHelper->isHashTableExist($key)) {
//
//                }时间戳
                unset($msgData['auth']);
                $this->redisHelper->hashMSet($key,$msgData);
                break;
            }
        }


    }

    /*
     * 为任意一个用户生成唯一的用户标志
     * */
    public function newKey($fid) {
        return time().$fid;
    }





}



