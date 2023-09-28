<?php
session_start();

require_once(realpath(dirname(__FILE__) . "/../Util.php"));
require_once(realpath(dirname(__FILE__) . "/../modeles/UserModel.php"));

class AuthController
{
    private static $user;

    private static function initUser()
    {
        return self::$user = new UserModel();
    }

    public static function logout(){

        if (isset( $_SESSION["connexion"])){

            if ($_SESSION["connexion"]==true){
                unset($_SESSION["connexion"]);
                session_destroy();
            }
        }
        header("Location:login.php");
    }
    public static function login($_username, $_password)
    {

        $username = Util::trojan($_username);
        $password = Util::trojan($_password);

        $_user = AuthController::initUser()->selectWhereUserNameAndPassword($username, md5($password));

        if ($_user == 0){
            return false;
        }
        else {
            $_SESSION["connexion"] = true;
            header("Location:dashboard.php");
            return true;
        }
    }

    public static function isLogin()
    {
        if (isset($_SESSION["connexion"])) {
            if ($_SESSION["connexion"] == true) {
                return true;
            } else
                header("Location:login.php");
        } else {
            header("Location:login.php");
        }
    }
}