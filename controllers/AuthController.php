<?php 
require __DIR__ . "/../model/Auth.php";

class AuthController{

    public function login(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $checkUser = new Auth();

            $user = $checkUser->checkInfos($email, $password);

            if (!$user) {
                $_SESSION['error'] = "Email or password incorrect";
                header("Location: /login");
                exit;
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['full_name'] = $user['full_name'];

            switch ($user['role']) {
                case 'coach':
                    header("Location: /coach");
                    break;

                case 'sportif':
                    header("Location: /sportif");
                    break;

                default:
                    header("Location: /");
                    break;
            }
            exit;
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