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


class ProcessMonitor {

    private $options ;
    private $message ;

    // 构造函数
    public function __construct($options) {
        $this->options = $options;
        $this->message = new Message('10.4.10.105','9501',$options['websocket']);

    }

    // start 函数
    public function start() {
        $this->message->start();
    }

}


