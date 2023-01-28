<?php

namespace helpers;

abstract class Session
{

    // Start the Session
    public static function start()
    {
        session_start();
    }

    // Set values to the Session
    public static function setValues($key, $value)
    {
            $_SESSION[$key] = $value;
    }

    //Return Session Values
    public static function getValues($key)
    {
            return $_SESSION[$key];
    }

    // Check Session Values
    public static function isSet($key)
    {
        if (isset($_SESSION[$key])) {
            return true;
        } else {
            return false;
        }
    }

    //Check whether Session is set
    public static function isLoggedIn()
    {
        if (self::isSet('user_id')) {
            return true;
        } else {
            return false;
        }
    }


    // Unset Session Values
    public static function unset($key)
    {
            unset($_SESSION[$key]);

    }

    //Destroy session
    public static function destroy()
    {
        session_destroy();
    }

    //Get the User Type
    public static function getUserRole(){
        return $_SESSION['user_role'];
    }
}