<?php
/**
 * Created by PhpStorm.
 * User: weizeng
 * Date: 2017/8/24
 * Time: 上午12:49
 * Des：Redis 助手类
 */

class RedisHelp extends \Redis {

    private $comHashMap;

    public function __construct($option)
    {
        if(!extension_loaded('redis')) {
            echo 'extension not support: redis!';
            exit;
        }
        $this->connect($option['host'],$option['port']);
        $this->comHashMap = $option['comHashMap'];
    }

    /*
     * 向一个hash集合中添加一个数据对象
     * */
    public function hashSet($key,$str) {
        return $this->hSet($this->comHashMap,$key,$str);
    }

    /*
     * 获取某个值
     * */
    public function hashGet($key) {
        return $this->hGet($this->comHashMap,$key);
    }

    /*
     * 向某一个hashMap中批量添加数据
     * */
    public function hashMSet($hashTable,$array) {
        return $this->hMset($hashTable,$array);
    }

    /*
     * 取得某个hashTable中所有数据
     * */
    public function hashMGet($hashTable,$fields = array()) {
        return count($fields) == 0 ? $this->hGetAll($hashTable) : $this->hMGet($hashTable,$fields) ;
    }

    /*
     * 检测某个hash表是否存在
     * 存在时返回true
     * */
    public function isHashTableExist($hashTable) {
        return $this->hLen($hashTable) > 0;
    }

}


