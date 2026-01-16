<?php

class Disponibilite
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getByCoach(int $coachId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM coach_disponibilites
            WHERE id_user = :id_user
            ORDER BY date_dispo ASC, start_time ASC
        ");
        $stmt->execute(['id_user' => $coachId]);
        return $stmt->fetchAll();
    }

    public function create(
        int $coachId,
        string $date,
        string $start,
        string $end
    ): bool {
        $stmt = $this->pdo->prepare("
            INSERT INTO coach_disponibilites
            (id_user, date_dispo, start_time, end_time)
            VALUES (:id_user, :date_dispo, :start_time, :end_time)
        ");

        return $stmt->execute([
            'id_user' => $coachId,
            'date_dispo' => $date,
            'start_time' => $start,
            'end_time' => $end,
        ]);
    }

    public function delete(int $id, int $coachId): bool
    {
        $stmt = $this->pdo->prepare("
            DELETE FROM coach_disponibilites
            WHERE id = :id AND id_user = :id_user
        ");

        return $stmt->execute([
            'id' => $id,
            'id_user' => $coachId,
        ]);
    }
}
