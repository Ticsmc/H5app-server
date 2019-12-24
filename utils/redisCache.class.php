<?php
/**
 * 缓存类
 */

class RedisCache extends Singleton
{
    protected static $_instance = null;
    protected $m_redis = null;

    protected function init(){
        $this->m_redis = new redis();
        $this->m_redis->connect("127.0.0.1","6379");
    }

    public function getRedisI()
    {
        return $this->m_redis;
    }
}

