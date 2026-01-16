<?php
require __DIR__ . "/../core/Database.php";

class Coach
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getDisponibilites(int $id_user): array
    {
        $sql = "SELECT id, date_dispo, start_time, end_time
                FROM coach_disponibilites
                WHERE id_user = :id_user
                ORDER BY date_dispo ASC, start_time ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":id_user" => $id_user]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }

    public function addDisponibilite(int $id_user, string $date, string $start, string $end): bool
    {
        $sql = "INSERT INTO coach_disponibilites (id_user, date_dispo, start_time, end_time)
                VALUES (:id_user, :date_dispo, :start_time, :end_time)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":id_user" => $id_user,
            ":date_dispo" => $date,
            ":start_time" => $start,
            ":end_time" => $end
        ]);
    }

    public function deleteDisponibilite(int $id, int $id_user): bool
    {
        $sql = "DELETE FROM coach_disponibilites
                WHERE id = :id AND id_user = :id_user";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":id_user" => $id_user
        ]);
    }
}
