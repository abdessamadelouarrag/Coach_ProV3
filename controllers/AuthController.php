<?php 
require __DIR__ . "/../model/Auth.php";

class AuthController{

    public function login(){

        if($_SERVER['REQUEST_METHOD'] === 'PSOT'){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $checkUser = new Auth();

            $checkUser->checkInfos($email, $password);
        }
        require __DIR__ . "/../view/Auth/login.php";
    }

    public function signup(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];


            $newUser = new Auth();
            $newUser->insertInfos($name, $email, $password, $role);

            header("Location: /login");
            exit;
        }
        require __DIR__ . "/../view/Auth/signup.php";
    }
}

?>