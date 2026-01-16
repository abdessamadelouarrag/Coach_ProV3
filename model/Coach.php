<?php
// require_once __DIR__ . '/../config/Database.php';

class Coach
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getDisponibilites(?int $id_user = null): array
    {
        if ($id_user === null) {
            $stmt = $this->pdo->prepare("
            SELECT * FROM coach_disponibilites
            ORDER BY date_dispo ASC, start_time ASC
        ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $stmt = $this->pdo->prepare("
        SELECT * FROM coach_disponibilites
        WHERE id_user = :id_user
        ORDER BY date_dispo ASC, start_time ASC
    ");
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addDisponibilite(
        int $id_user,
        string $date,
        string $start,
        string $end
    ): bool {
        try {
            // Check overlap
            $check = $this->pdo->prepare("
                SELECT COUNT(*) FROM coach_disponibilites 
                WHERE id_user = :id_user 
                  AND date_dispo = :date_dispo
                  AND (:start < end_time AND :end > start_time)
            ");

            $check->execute([
                ':id_user' => $id_user,
                ':date_dispo' => $date,
                ':start' => $start,
                ':end' => $end,
            ]);

            if ((int)$check->fetchColumn() > 0) {
                return false; // overlap
            }

            // Insert new disponibilite
            $stmt = $this->pdo->prepare("
                INSERT INTO coach_disponibilites
                (id_user, date_dispo, start_time, end_time)
                VALUES (:id_user, :date, :start, :end)
            ");

            $result = $stmt->execute([
                ':id_user' => $id_user,
                ':date' => $date,
                ':start' => $start,
                ':end' => $end,
            ]);

            return $result;
        } catch (PDOException $e) {
            error_log("Error adding disponibilite: " . $e->getMessage());
            $_SESSION['flash_error'] = "Erreur DB: " . $e->getMessage();
            return false;
        }
    }

    public function deleteDisponibilite(int $id, int $id_user): bool
    {
        try {
            $stmt = $this->pdo->prepare("
                DELETE FROM coach_disponibilites
                WHERE id = :id AND id_user = :id_user
            ");
            return $stmt->execute([
                'id' => $id,
                'id_user' => $id_user,
            ]);
        } catch (PDOException $e) {
            error_log("Error deleting disponibilite: " . $e->getMessage());
            return false;
        }
    }

    public function getCoachById(int $id): array|false
    {
        try {
            $stmt = $this->pdo->prepare("
                SELECT u.id, u.full_name, u.email, u.role, cp.bio, cp.exp, cp.domain
                FROM users u
                LEFT JOIN coach_profiles cp ON cp.id_user = u.id
                WHERE u.id = :id AND u.role = 'coach'
            ");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting coach by id: " . $e->getMessage());
            return false;
        }
    }

    public function allCoach(): array
    {
        try {
            $sql = "SELECT u.id AS coach_id, u.full_name, u.email, 
                        cp.bio, cp.domain, cp.exp 
                    FROM users u
                    JOIN coach_profiles cp ON cp.id_user = u.id 
                    WHERE u.role = 'coach'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting all coaches: " . $e->getMessage());
            return [];
        }
    }

    public function getCoachProfile(int $coachId): array|false
    {
        $stmt = $this->pdo->prepare("
        SELECT bio, exp, domain
        FROM coach_profiles
        WHERE id_user = :id_user
        LIMIT 1
    ");
        $stmt->execute(['id_user' => $coachId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
