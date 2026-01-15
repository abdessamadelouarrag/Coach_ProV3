<?php 

class HomeController{
    public function index(){
        $filePath = __DIR__ . "/../view/home/home.php";
        if (!file_exists($filePath)) {
            die("File not found: " . $filePath);
        }
        require $filePath;
    }
}
?>