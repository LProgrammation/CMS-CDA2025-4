<?php 

namespace Src\Controller ;

class logoutController{
    public function index($routeMap, $uri){

        if(isset($_POST['submit_logout'])){
            $_SESSION = array();
            session_destroy();
            header('Location: /');
        }
        if(isset($_POST['submit_back'])){
            header('Location: /');
        }
       
        require_once "../src/view/".$routeMap[$uri]['name'].".php";

    }

}