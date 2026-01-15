<?php 
require __DIR__ . "/../model/Auth.php";

class AuthController{

    public function login(){
        
        ob_start();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if(empty($email) || empty($password)){
                $_SESSION['error'] = "Email and password are required";
                header("Location: /login");
                ob_end_flush();
                exit;
            }

            $checkUser = new Auth();
            $user = $checkUser->checkInfos($email, $password);

            if (!$user) {
                $_SESSION['error'] = "Email or password incorrect";
                header("Location: /login");
                ob_end_flush();
                exit;
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['logged_in'] = true;

            var_dump($_SESSION);

            ob_end_clean();

            if($user['role'] === 'coach'){
                header("Location: /coach");
                exit;
            } elseif($user['role'] === 'sportif'){
                header("Location: /sportif");
                exit;
            } else {
                header("Location: /");
                exit;
            }
        }
        
        ob_end_clean();
        require __DIR__ . "/../view/Auth/login.php";
    }

    public function signup(){
        
        ob_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? '';

            if(empty($name) || empty($email) || empty($password) || empty($role)){
                $_SESSION['error'] = "All fields are required";
                header("Location: /signup");
                ob_end_flush();
                exit;
            }

            $newUser = new Auth();
            $result = $newUser->insertInfos($email, $name, $password, $role);

            if($result){
                $_SESSION['success'] = "Account created successfully!";
                ob_end_clean();
                header("Location: /login");
                exit;
            } else {
                $_SESSION['error'] = "Error creating account";
                header("Location: /signup");
                ob_end_flush();
                exit;
            }
        }
        
        ob_end_clean();
        require __DIR__ . "/../view/Auth/signup.php";
    }
}
?> 