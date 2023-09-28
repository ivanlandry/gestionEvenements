<?php
require_once(realpath(dirname(__FILE__)."/../modeles/UserModel.php"));
require_once (realpath(dirname(__FILE__)."/../Util.php"));
class UserController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function register($_username,$_email,$_password){

        $username = Util::trojan($_username);
        $email = Util::trojan($_email);
        $password = Util::trojan($_password);

        $this->userModel->create($username,$email,$password);

        $_SESSION["add_user"] = "utilisateur créé";
        header("Location:user.php");
    }

    public function getUsers(){
        return $this->userModel->selectAll();
    }

}