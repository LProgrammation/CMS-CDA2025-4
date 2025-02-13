<?php 
/**
 * Summary of errorController
 */
class errorController{
    private object $BDD;
    public function index($routeMap, $uri){
        $this->BDD->tryConnection();
        require_once "../src/view/".$routeMap[$uri]['name'].".php";
        
    }

    public function setBDD($BDD){
        $this->BDD = $BDD;
    }
}