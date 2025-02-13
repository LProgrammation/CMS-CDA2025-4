<?php
/**
 * Summary of errorController
 */
class errorController{
    private object $BDD;
    public function index($routeMap, $uri){
<<<<<<< HEAD
        $this->BDD->tryConnection();
=======

>>>>>>> f65d12a2e56fc59264fb03b85893d428558b102a
        require_once "../src/view/".$routeMap[$uri]['name'].".php";

    }

    public function setBDD($BDD){
        $this->BDD = $BDD;
    }
}