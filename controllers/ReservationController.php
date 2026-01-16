<?php
require_once __DIR__ . "/../model/Reservation.php";
require_once __DIR__ . "/../model/Coach.php";

class ReservationController
{
    private function requireSportif()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }

        if (($_SESSION['user']['role'] ?? '') !== 'sportif') {
            http_response_code(403);
            echo "Forbidden - Sportifs only";
            exit;
        }
    }
    
    public function reserve()
    {
        $this->requireSportif();

        $id_dispo = (int)($_GET['id'] ?? 0);

        if ($id_dispo <= 0) {
            $_SESSION['flash_error'] = "Disponibilité invalide.";
            header("Location: /error");
            exit;
        }

        $id_sportif = (int)$_SESSION['user']['id'];

        $reservationModel = new Reservation();
        $success = $reservationModel->createReservation($id_sportif, $id_dispo);

        if ($success) {
            $_SESSION['flash_success'] = "Réservation confirmée avec succès!";
            $coachModel = new Coach();
            $stmt = Database::getInstance()->getConnection()->prepare("
                SELECT id_coach FROM disponibilites WHERE id = :id
            ");
            $stmt->execute([':id' => $id_dispo]);
            $dispo = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($dispo) {
                $coach = $coachModel->getCoachById($dispo['id_coach']);
                $profile = $coachModel->getCoachProfile($dispo['id_coach']);
                require __DIR__ . "/../view/Sportif/doneReserve.php";
            } else {
                header("Location: /reservations");
            }
        } else {
            $_SESSION['flash_error'] = "Erreur: Ce créneau est déjà réservé ou n'existe plus.";
            header("Location: /error");
        }
        exit;
    }

 
    public function myReservations()
    {
        $this->requireSportif();

        $id_sportif = (int)$_SESSION['user']['id'];
        $reservationModel = new Reservation();
        $reservations = $reservationModel->getReservationsBySportif($id_sportif);

        require __DIR__ . "/../view/Sportif/myReservations.php";
    }

    public function cancel()
    {
        $this->requireSportif();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /reservations");
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            header("Location: /reservations");
            exit;
        }

        $id_user = (int)$_SESSION['user']['id'];
        $reservationModel = new Reservation();
        $success = $reservationModel->cancelReservation($id, $id_user);

        if ($success) {
            $_SESSION['flash_success'] = "Réservation annulée.";
        } else {
            $_SESSION['flash_error'] = "Erreur lors de l'annulation.";
        }

        header("Location: /reservations");
        exit;
    }

    public function store()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: ?url=auth/login");
            exit;
        }

        $coachId = (int)($_GET['coach_id'] ?? 0);
        $dispoId = (int)($_GET['dispo_id'] ?? 0);

        if ($coachId <= 0 || $dispoId <= 0) {
            die("coach_id or dispo_id missing");
        }

        $reservation = new Reservation();
        $reservation->createReservation($_SESSION['user_id'], $coachId, $dispoId);

        header("Location: ?url=reservation/done");
        exit;
    }

    public function done()
    {
        require __DIR__ . "/../view/Sportif/doneReserve.php";
    }
}