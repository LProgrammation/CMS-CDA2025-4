<?php
namespace Src\Controller;
/**
 * Summary of homeController
 */
class homeController{
    public function index($routeMap, $uri){
        require_once "../src/view/".$routeMap[$uri]['name'].".php";
    }

}