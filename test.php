<?php
require __DIR__ . "/../model/Auth.php";

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $auth = new Auth();
            $user = $auth->checkInfos($email, $password);

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
                    header("Location: /coach/dashboard");
                    break;

                case 'sportif':
                    header("Location: /sportif/dashboard");
                    break;

                default:
                    header("Location: /");
                    break;
            }
            exit;
        }

        require __DIR__ . "/../view/Auth/login.php";
    }

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'sportif';

            $auth = new Auth();
            $auth->insertInfos($name, $email, $password, $role);

            header("Location: /login");
            exit;
        }

        require __DIR__ . "/../view/Auth/signup.php";
    }
}




require __DIR__ . "/../core/Database.php";

class Auth
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function insertInfos(string $fullname, string $email, string $password, string $role): bool
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (email, full_name, password, role)
                VALUES (:email, :fullname, :password, :role)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":email" => $email,
            ":fullname" => $fullname,
            ":password" => $password_hash,
            ":role" => $role
        ]);
    }

    public function checkInfos(string $email, string $password): array|bool
    {
        $sql = "SELECT id, email, full_name, password, role FROM users WHERE email = :email LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":email" => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) return false;

        if (!password_verify($password, $user['password'])) return false;

        return $user;
    }
}
