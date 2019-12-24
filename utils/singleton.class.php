<?php
/**
 * 单例类
 */

class SingletonV1
{
    private static $_instance = null;
    //私有构造函数，防止外界实例化对象
    private function __construct() {
    }
    //私有克隆函数，防止外办克隆对象
    private function __clone() {
    }
    //静态方法，单例统一访问入口
    static public function getInstance() {
        if (is_null ( self::$_instance ) || isset ( self::$_instance )) {
            self::$_instance = new self ();
        }
        return self::$_instance;
    }
}
class SingletonV2
{
    protected static $_instance = null;
    private function __construct()
    {
    }
    private function __clone()
    {
        //disallow clone
    }
    public static function getInstance()
    {
        if (static::$_instance === null) {
            static::$_instance = new static;
        }
        return static::$_instance;
    }

}

abstract class Singleton{
    final protected function __construct(){
        $this->init();
    }

    final protected function __clone(){}
    protected function init(){}
    //abstract protected function init();

    public static function getInstance(){
        if(static::$_instance === null){
            static::$_instance = new static();
        }
        return static::$_instance;
    }
}

class Base extends Singleton
{
    #protected static $_instance = null;
}

class A extends Base
{
    protected static $_instance = null;
}

class  B extends Base
{
    protected static $_instance = null;
}

//$c = A::getInstance();
//$d = B::getInstance();
//var_dump($c === $d);

