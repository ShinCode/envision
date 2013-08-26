<?php namespace Shincode\Envision\Support;

abstract class Singleton {


    /*
    | By default, all methods in this class have an underscore at the end.
    | This way the methods can be called like they were static.
    |
    | Example:
    |
    | class Foo {
    |   public function bar_() {
    |       // This method can be called as static without underscore.
    |   }
    | }
    |
    |
    | Now this works:
    | Foo::bar();
    */
    
    const METHODSYMBOL = '_';

    /*
    | Keep a singleton instance
    */
    final public static function getInstance() {
        static $instances = array();

        $calledClass = get_called_class();

        if (!isset($instances[$calledClass])) {
            $instances[$calledClass] = new $calledClass();
        }

        return $instances[$calledClass];
    }

    /*
    | Handle dynamic, static calls.
     */
    public static function __callStatic($method, $args) {

        $instance = static::getInstance();
        $method .= self::METHODSYMBOL;

        switch (count($args)) {
            case 0:
                return $instance->$method();

            case 1:
                return $instance->$method($args[0]);

            case 2:
                return $instance->$method($args[0], $args[1]);

            case 3:
                return $instance->$method($args[0], $args[1], $args[2]);

            case 4:
                return $instance->$method($args[0], $args[1], $args[2], $args[3]);

            default:
                return call_user_func_array(array($instance, $method), $args);
        }

    }

}