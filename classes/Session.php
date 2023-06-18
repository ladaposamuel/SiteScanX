<?php

class Session
{
    public static function init()
    {
        session_start();
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function checkAdminSession()
    {
        self::init();
        if (!self::get("adminLogin")) {
            self::destroy();
            header("Location: " . getBaseUrl() . "/index.php");
        } else {
            return self::get("adminInfo");
        }
    }


    public static function destroy()
    {
        session_destroy();
        session_unset();
    }
}

?>
