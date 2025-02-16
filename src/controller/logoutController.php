<?php 

namespace Src\Controller ;
Use Src\Module\Access;

class logoutController{
    public function index($routeMap, $uri){
        $accessModule = new Access();
        if(!$accessModule->isGranted()){
            header("location: /error?code=404");
            exit();
        }
        if(isset($_POST['submit_logout'])){
            $_SESSION = array();
            session_destroy();
            header('Location: /');
            exit();
        }
        if(isset($_POST['submit_back'])){
            header('Location: /');
            exit();
        }
       
        require_once "../src/view/".$routeMap[$uri]['name'].".php";

    }

}