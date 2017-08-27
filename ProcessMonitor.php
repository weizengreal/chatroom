<?php
/**
 * Created by PhpStorm.
 * User: weizeng
 * Date: 2017/8/23
 * Time: 下午11:51
 * Des：总体管理各个进程，主要做如下几件事情
 * 1、监控
 */
require_once 'Message.php';
require_once 'RedisHelp.php';


class ProcessMonitor {

    private $options ;
    private $message ;

    // 构造函数
    public function __construct($options) {
        $this->options = $options;
        $this->message = new Message('127.0.0.1','9501',$options['websocket'],$options['redis']);
    }

    // start 函数
    public function start() {
        $this->message->start();
    }

    /*
     * 进程管理函数
     * 1、开启一个单独的进程用于管理用户状态
     * */
    public function processManager() {

    }

}


