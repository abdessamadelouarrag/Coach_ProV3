<?php
require __DIR__ . "/../model/Coach.php";

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
            header("Location: /coach/disponibilite");
            exit;
        }

        $id_user = (int)$_SESSION['user']['id'];

        $date  = $_POST['date_dispo'] ?? '';
        $start = $_POST['start_time'] ?? '';
        $end   = $_POST['end_time'] ?? '';

        if ($date === '' || $start === '' || $end === '' || $end <= $start) {
            $_SESSION['flash_error'] = "دخل تاريخ ووقت صحيحين (end خاصو يكون أكبر من start).";
            header("Location: /coach/disponibilite");
            exit;
        }

        $coachModel = new Coach();
        $ok = $coachModel->addDisponibilite($id_user, $date, $start, $end);

        if (!$ok) {
            $_SESSION['flash_error'] = "Erreur: disponibilité ربما كاينة من قبل.";
        } else {
            $_SESSION['flash_success'] = "Disponibilité تزادت بنجاح.";
        }

        header("Location: /coach/disponibilite");
        exit;
    }

    public function deleteDisponibilite()
    {
        $this->requireCoach();

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id <= 0) {
            header("Location: /coach/disponibilite");
            exit;
        }

        $id_user = (int)$_SESSION['user']['id'];

        $coachModel = new Coach();
        $coachModel->deleteDisponibilite($id, $id_user);

        header("Location: /coach/disponibilite");
        exit;
    }
}
