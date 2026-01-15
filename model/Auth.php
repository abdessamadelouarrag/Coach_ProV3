<?php
require __DIR__ . "/User.php";
require __DIR__ . "/../core/Database.php";

class Auth{

    private PDO $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function insertInfos($email, $fullname, $password, $role){

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

    public function checkInfos($email, $password){
        $sql = "SELECT id, email, full_name, password, role FROM users WHERE email = :email LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            ":email" => $email,
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$user){
            return false;
        }
        
        if(!password_verify($password, $user['password'])){
            return false;
        }

        return $user;
    }
}
?>