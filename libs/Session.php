<?php

namespace libs;

use libs\DefaultLib;

require_once 'libs/DefaultLib.php';

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
        return $_SESSION[$key];
    }

    public function remove($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

}