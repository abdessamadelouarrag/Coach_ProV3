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

        // Get all coaches with their profiles
        $coachModel = new Coach();
        $all = $coachModel->allCoach();

        // Pass data to view
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
        $coachInfo = $coachModel->getCoachById($coachId);
        
        if (!$coachInfo) {
            $_SESSION['flash_error'] = "Coach introuvable";
            header("Location: /sportif");
            exit;
        }

        $dispos = $coachModel->getDisponibilites($coachId);

        require __DIR__ . "/../view/Sportif/detailsCoach.php";
    }

    public function done(){
        require __DIR__ . "/../view/Sportif/doneReserve.php";
    }
}