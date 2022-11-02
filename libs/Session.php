<?php

namespace libs;


class Session extends DefaultLib
{

    protected static $instance;

    protected function __construct()
    {
        session_start();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key, $defaultValue = null)
    {
        return $_SESSION[$key] ?? $defaultValue;
    }

    public function remove($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

}