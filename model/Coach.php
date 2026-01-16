<?php
require_once __DIR__ . '/../config/Database.php';

class Coach
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getDisponibilites(int $id_user): array
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM coach_disponibilites
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

        $check = $this->pdo->prepare("
            SELECT COUNT(*) FROM coach_disponibilites WHERE id_user = :id_user AND date_dispo = :date_dispo
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

        $stmt = $this->pdo->prepare("
            INSERT INTO coach_disponibilites
            (id_user, date_dispo, start_time, end_time)
            VALUES (:id_user, :date, :start, :end)
        ");

        return $stmt->execute([
            ':id_user' => $id_user,
            ':date' => $date,
            ':start' => $start,
            ':end' => $end,
        ]);
    }

    public function deleteDisponibilite(int $id, int $id_user): bool
    {
        $stmt = $this->pdo->prepare("
            DELETE FROM coach_disponibilites
            WHERE id = :id AND id_user = :id_user
        ");
        return $stmt->execute([
            'id' => $id,
            'id_user' => $id_user,
        ]);
    }

    public function getCoachById(int $id): array|false
    {
        $stmt = $this->pdo->prepare("SELECT id, full_name, email, role FROM users WHERE id = :id AND role = 'coach'");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
