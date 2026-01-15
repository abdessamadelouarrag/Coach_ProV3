<?php 
class SportifController {
    
    public function sportif(){
        
        if(!isset($_SESSION['logged_in']) || !isset($_SESSION['user_id'])){
            header("Location: /login");
            exit;
        }
        
        if($_SESSION['role'] !== 'sportif'){
            $_SESSION['error'] = "Access denied. Sportif only area.";
            header("Location: /login");
            exit;
        }
        
        require __DIR__ . "/../view/Sportif/pageSportif.php";
    }

    public function details(){
        require __DIR__ . "/../view/Sportif/detailsCoach.php";
    }
}
?>