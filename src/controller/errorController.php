<?php
/**
 * Summary of errorController
 */
class errorController{
    public function index($routeMap, $uri){

        require_once "../src/view/".$routeMap[$uri]['name'].".php";

    }

}