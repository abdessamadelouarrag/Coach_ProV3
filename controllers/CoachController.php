<?php
require_once __DIR__ . "/../model/Coach.php";
require_once __DIR__ . "/../model/Reservation.php";

class CoachController
{
    private function requireCoach()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }

        if (($_SESSION['user']['role'] ?? '') !== 'coach') {
            http_response_code(403);
            echo "Forbidden";
            exit;
        }
    }

    public function coach()
    {
        $this->requireCoach();

        $coachModel = new Coach();
        $reservationModel = new Reservation();
        $id_user = (int)$_SESSION['user']['id'];

        $dispos = $coachModel->getDisponibilites($id_user);
        
        $reservations = $reservationModel->getReservationsByCoach($id_user);

        require __DIR__ . "/../view/Coach/dashboardCoach.php";
    }

    public function disponibilite()
    {
        $this->requireCoach();

        $coachModel = new Coach();
        $id_user = (int)$_SESSION['user']['id'];

        $dispos = $coachModel->getDisponibilites($id_user);

        require __DIR__ . "/../view/Coach/disponibilite.php";
    }

    public function addDisponibilite()
    {
        $this->requireCoach();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /coach");
            exit;
        }

        $id_user = (int)$_SESSION['user']['id'];

        $date  = $_POST['date_dispo'] ?? '';
        $start = $_POST['start_time'] ?? '';
        $end   = $_POST['end_time'] ?? '';

        if ($date === '' || $start === '' || $end === '' || $end <= $start) {
            $_SESSION['flash_error'] = "Date et heures invalides (fin doit être après début).";
            header("Location: /coach");
            exit;
        }

        $coachModel = new Coach();
        $ok = $coachModel->addDisponibilite($id_user, $date, $start, $end);

        if (!$ok) {
            $_SESSION['flash_error'] = "Erreur: disponibilité existe déjà ou chevauchement.";
        } else {
            $_SESSION['flash_success'] = "Disponibilité ajoutée avec succès!";
        }

        header("Location: /coach");
        exit;
    }

    public function deleteDisponibilite()
    {
        $this->requireCoach();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /coach");
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            header("Location: /coach");
            exit;
        }

        $id_user = (int)$_SESSION['user']['id'];

        $coachModel = new Coach();
        $coachModel->deleteDisponibilite($id, $id_user);

        $_SESSION['flash_success'] = "Disponibilité supprimée!";
        header("Location: /coach");
        exit;
    }

    public function acceptReservation()
    {
        $this->requireCoach();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /coach");
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            header("Location: /coach");
            exit;
        }

        $id_user = (int)$_SESSION['user']['id'];
        $reservationModel = new Reservation();
        $success = $reservationModel->acceptReservation($id, $id_user);

        if ($success) {
            $_SESSION['flash_success'] = "Réservation acceptée!";
        } else {
            $_SESSION['flash_error'] = "Erreur lors de l'acceptation.";
        }

        header("Location: /coach");
        exit;
    }

    public function refuseReservation()
    {
        $this->requireCoach();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /coach");
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            header("Location: /coach");
            exit;
        }

        $id_user = (int)$_SESSION['user']['id'];
        $reservationModel = new Reservation();
        $success = $reservationModel->refuseReservation($id, $id_user);

        if ($success) {
            $_SESSION['flash_success'] = "Réservation refusée!";
        } else {
            $_SESSION['flash_error'] = "Erreur lors du refus.";
        }

        header("Location: /coach");
        exit;
    }

    public function details()
    {
        $coachId = (int)($_GET['id'] ?? 0);
        if ($coachId <= 0) {
            http_response_code(404);
            die("Coach id missing");
        }

        $coachModel = new Coach();

        $coach = $coachModel->getCoachById($coachId);
        if (!$coach) {
            http_response_code(404);
            die("Coach not found");
        }

        $profile = $coachModel->getCoachProfile($coachId);
        $dispos  = $coachModel->getDisponibilites($coachId);

        require __DIR__ . '/../view/Sportif/detailsCoach.php';
    }
}