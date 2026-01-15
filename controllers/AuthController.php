<?php 

class AuthController{

    public function login(){
        require __DIR__ . "/../view/Auth/login.php";
    }

    public function signup(){
        require __DIR__ . "/../view/Auth/signup.php";
    }
}

?>