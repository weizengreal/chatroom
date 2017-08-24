<?php
/**
 * Created by PhpStorm.
 * User: weizeng
 * Date: 2017/8/24
 * Time: 上午12:36
 * Des：服务端入口程序
 */

$argv = $_SERVER['argv'];

if(PHP_SAPI == 'cli') {
    echo 'run chatroom socket!';
    require_once './ProcessMonitor.php';
    $options = include './config.php';
    $processMonitor = new ProcessMonitor($options);
    $processMonitor->start();
}




