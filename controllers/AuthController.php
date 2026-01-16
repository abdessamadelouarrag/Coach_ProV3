<?php
require __DIR__ . "/../model/Auth.php";

class AuthController
{
    public function login()
    {
        ob_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "Email and password are required";
                header("Location: /login");
                ob_end_flush();
                exit;
            }

            $auth = new Auth();
            $user = $auth->checkInfos($email, $password);

            if (!$user) {
                $_SESSION['error'] = "Email or password incorrect";
                header("Location: /login");
                ob_end_flush();
                exit;
            }

            $_SESSION['user'] = [
                'id' => (int)$user['id'],
                'role' => $user['role'],
                'full_name' => $user['full_name'],
                'email' => $user['email'],
            ];
            $_SESSION['logged_in'] = true;

            ob_end_clean();

            if ($user['role'] === 'coach') {
                header("Location: /coach");
                exit;
            } elseif ($user['role'] === 'sportif') {
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

    public function signup()
    {
        ob_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $role = strtolower(trim($_POST['role'] ?? ''));

            $exp_coach = $_POST['coach_exp'] ?? '';
            $bio_coach = $_POST['coach_bio'] ?? '';
            $domain = $_POST['sport'] ?? '';

            if (empty($name) || empty($email) || empty($password) || empty($role)) {
                $_SESSION['error'] = "All fields are required";
                header("Location: /signup");
                ob_end_flush();
                exit;
            }

            $auth = new Auth();

            $bio_to_save = ($role === 'coach') ? trim((string)$bio_coach) : null;
            $exp_to_save = ($role === 'coach') ? (is_numeric($exp_coach) ? (int)$exp_coach : 0) : null;

            $result = $auth->insertInfos($email, $name, $password, $role, $bio_to_save, $exp_to_save, $domain);

            if ($result) {
                $_SESSION['success'] = "Account created successfully!";
                ob_end_clean();
                header("Location: /login");
                exit;
            } else {
                $msg = "Error creating account";
                if (!empty($_SESSION['error_db'])) {
                    $msg .= " : " . $_SESSION['error_db'];
                    unset($_SESSION['error_db']);
                }
                $_SESSION['error'] = $msg;

                header("Location: /signup");
                ob_end_flush();
                exit;
            }
        }

        ob_end_clean();
        require __DIR__ . "/../view/Auth/signup.php";
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login");
        exit;
    }
}
