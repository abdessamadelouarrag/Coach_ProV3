<?php
require_once __DIR__ . "/../model/Coach.php";

class SportifController
{
    private function requireSportif()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }

        if (($_SESSION['user']['role'] ?? '') !== 'sportif') {
            http_response_code(403);
            echo "Forbidden";
            exit;
        }
    }

    public function sportif()
    {
        $this->requireSportif();

        $coachModel = new Coach();
        $all = $coachModel->allCoach();

        require __DIR__ . "/../view/Sportif/pageSportif.php";
    }

    public function details()
    {
        $this->requireSportif();

        $coachId = (int)($_GET['id'] ?? 0);

        if ($coachId <= 0) {
            header("Location: /sportif");
            exit;
        }

        $coachModel = new Coach();
        $coach = $coachModel->getCoachById($coachId);
        
        if (!$coach) {
            $_SESSION['flash_error'] = "Coach introuvable";
            header("Location: /sportif");
            exit;
        }

        $profile = $coachModel->getCoachProfile($coachId);
        $dispos = $coachModel->getDisponibilites($coachId);

        require __DIR__ . "/../view/Sportif/detailsCoach.php";
    }
}