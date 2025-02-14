<?php
/**
 * Summary of errorController
 */
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