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
            header("Location: /sportif");
            exit;
        }

        $id_sportif = (int)$_SESSION['user']['id'];

        $reservationModel = new Reservation();
        $success = $reservationModel->createReservation($id_sportif, $id_dispo);

        if ($success) {
            $_SESSION['flash_success'] = "Réservation effectuée avec succès! En attente de confirmation du coach.";
            header("Location: /reservations");
        } else {
            $_SESSION['flash_error'] = "Erreur: Ce créneau est déjà réservé ou n'existe plus.";
            header("Location: /sportif");
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
}