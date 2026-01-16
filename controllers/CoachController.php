<?php
require_once __DIR__ . "/../model/Coach.php";

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
        $id_user = (int)$_SESSION['user']['id'];

        // Get dispos for dashboard
        $dispos = $coachModel->getDisponibilites($id_user);

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

    public function publicProfile()
    {
        // Coach ID from URL query parameter
        $coachId = (int)($_GET['id'] ?? 0);

        if ($coachId <= 0) {
            http_response_code(404);
            echo "Coach not found";
            exit;
        }

        $coachModel = new Coach();

        $coach = $coachModel->getCoachById($coachId);  // Changed from $coachInfo

        if (!$coach) {
            http_response_code(404);
            echo "Coach not found";
            exit;
        }

        $profile = $coachModel->getCoachProfile($coachId);  // Added this line
        $dispos = $coachModel->getDisponibilites($coachId);

        require __DIR__ . "/../view/Sportif/detailsCoach.php";
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