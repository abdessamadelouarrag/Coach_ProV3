<?php
require_once __DIR__ . "/../config/Database.php";

class Reservation
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function createReservation($id_sportif, $id_disponibilite)
    {
        $stmt = $this->db->prepare("
            SELECT d.id, d.id_user as id_coach, d.date_dispo, d.start_time, d.end_time
            FROM coach_disponibilites d
            LEFT JOIN reservations r ON r.id_disponibilite = d.id
            WHERE d.id = :id_dispo AND r.id IS NULL
        ");
        $stmt->execute([':id_dispo' => $id_disponibilite]);
        $dispo = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dispo) {
            return false;
        }

        $stmt = $this->db->prepare("
            SELECT r.id 
            FROM reservations r
            JOIN coach_disponibilites d ON d.id = r.id_disponibilite
            WHERE r.id_sportif = :id_sportif 
            AND d.id_user = :id_coach
            AND d.date_dispo = :date_dispo
            AND d.start_time = :start_time
        ");
        $stmt->execute([
            ':id_sportif' => $id_sportif,
            ':id_coach' => $dispo['id_coach'],
            ':date_dispo' => $dispo['date_dispo'],
            ':start_time' => $dispo['start_time']
        ]);

        if ($stmt->fetch()) {
            return false;
        }

        $stmt = $this->db->prepare("
            INSERT INTO reservations (id_sportif, id_disponibilite, status, created_at)
            VALUES (:id_sportif, :id_disponibilite, 'pending', NOW())
        ");

        return $stmt->execute([
            ':id_sportif' => $id_sportif,
            ':id_disponibilite' => $id_disponibilite
        ]);
    }

    public function getReservationsBySportif($id_sportif)
    {
        $stmt = $this->db->prepare("
            SELECT 
                r.id,
                r.status,
                r.created_at,
                d.date_dispo,
                d.start_time,
                d.end_time,
                d.id as id_disponibilite,
                u.full_name as coach_name,
                u.email as coach_email,
                u.id as coach_id,
                cp.domain,
                cp.exp
            FROM reservations r
            JOIN coach_disponibilites d ON d.id = r.id_disponibilite
            JOIN users u ON u.id = d.id_user
            LEFT JOIN coach_profiles cp ON cp.id_user = u.id
            WHERE r.id_sportif = :id_sportif
            ORDER BY d.date_dispo DESC, d.start_time DESC
        ");
        $stmt->execute([':id_sportif' => $id_sportif]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReservationsByCoach($id_coach)
    {
        $stmt = $this->db->prepare("
            SELECT 
                r.id,
                r.status,
                r.created_at,
                d.date_dispo,
                d.start_time,
                d.end_time,
                u.full_name as sportif_name,
                u.email as sportif_email,
                u.id as sportif_id
            FROM reservations r
            JOIN coach_disponibilites d ON d.id = r.id_disponibilite
            JOIN users u ON u.id = r.id_sportif
            WHERE d.id_user = :id_coach
            ORDER BY d.date_dispo DESC, d.start_time DESC
        ");
        $stmt->execute([':id_coach' => $id_coach]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cancelReservation($id, $id_user)
    {
        $stmt = $this->db->prepare("
            UPDATE reservations r
            SET status = 'cancelled'
            FROM coach_disponibilites d
            WHERE r.id_disponibilite = d.id
            AND r.id = :id 
            AND (r.id_sportif = :id_user OR d.id_user = :id_user)
        ");
        return $stmt->execute([
            ':id' => $id,
            ':id_user' => $id_user
        ]);
    }

    public function acceptReservation($id, $id_coach)
    {
        $stmt = $this->db->prepare("
            UPDATE reservations r
            SET status = 'confirmed'
            FROM coach_disponibilites d
            WHERE r.id_disponibilite = d.id
            AND r.id = :id 
            AND d.id_user = :id_coach
            AND r.status = 'pending'
        ");
        return $stmt->execute([
            ':id' => $id,
            ':id_coach' => $id_coach
        ]);
    }

    public function refuseReservation($id, $id_coach)
    {
        $stmt = $this->db->prepare("
            UPDATE reservations r
            SET status = 'refused'
            FROM coach_disponibilites d
            WHERE r.id_disponibilite = d.id
            AND r.id = :id 
            AND d.id_user = :id_coach
            AND r.status = 'pending'
        ");
        return $stmt->execute([
            ':id' => $id,
            ':id_coach' => $id_coach
        ]);
    }
}