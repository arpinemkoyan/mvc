<?php

namespace libs;


abstract class DefaultLib
{


    protected static $_instance;

    abstract protected function __construct();

    public static function getInstance()
    {
        if (!static::$_instance) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

}