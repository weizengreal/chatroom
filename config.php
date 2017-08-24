<?php
/**
 * Created by PhpStorm.
 * User: weizeng
 * Date: 2017/8/23
 * Time: 下午11:56
 * 项目配置文件
 */

return [
    'websocket' => [
        'daemonize'       => 0,
        'worker_num'      => 2, //worker process num
        'task_worker_num' => 2
    ],
    'redis' => [],
    ''
];