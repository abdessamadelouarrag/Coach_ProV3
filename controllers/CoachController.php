<?php 

class CoachController {
    
    public function coach(){

        if(!isset($_SESSION['logged_in']) || !isset($_SESSION['user_id'])){
            header("Location: /login");
            exit;
        }
        
        if($_SESSION['role'] !== 'coach'){
            $_SESSION['error'] = "Access denied. Coach only area.";
            header("Location: /login");
            exit;
        }
        
        require __DIR__ . "/../view/Coach/dashboardCoach.php";
    }
}
?>