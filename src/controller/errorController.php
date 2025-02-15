<?php
/**
 * Summary of errorController
 */
namespace Src\Controller;
class errorController{

    /**
     * @param $routeMap
     * @param $uri
     * @return void
     */
    public function index($routeMap, $uri): void
    {

        require_once "../src/view/".$routeMap[$uri]['name'].".php";

    }
}