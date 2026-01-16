<?php
require_once __DIR__ . "/../core/Database.php";

class Auth
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function insertInfos($email, $fullname, $password, $role, $bio_coach = null, $exp_coach = null, $domain = null)
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO users (email, full_name, password, role)
                    VALUES (:email, :fullname, :password, :role)
                    RETURNING id";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ":email" => $email,
                ":fullname" => $fullname,
                ":password" => $password_hash,
                ":role" => $role
            ]);

            $user_id = (int)$stmt->fetchColumn();

            if ($role === "coach") {
                $sqlCoach = "INSERT INTO coach_profiles (bio, exp, domain, id_user)
                VALUES (:bio, :exp, :domain, :id_user)";
                $stmtCoach = $this->pdo->prepare($sqlCoach);

                $stmtCoach->execute([
                    ":bio" => $bio_coach ?? "",
                    ":exp" => ($exp_coach !== null && $exp_coach !== '') ? (string)$exp_coach : null,
                    ":domain" => $domain !== null && $domain !== '' ? (string)$domain : null,
                    ":id_user" => $user_id,
                ]);
            }

            $this->pdo->commit();
            return $user_id;
        } catch (PDOException $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            $_SESSION['error_db'] = $e->getMessage();
            return false;
        }
    }

    public function checkInfos($email, $password)
    {
        $sql = "SELECT id, email, full_name, password, role
                FROM users
                WHERE email = :email
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":email" => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) return false;
        if (!password_verify($password, $user['password'])) return false;

        return $user;
    }
}
