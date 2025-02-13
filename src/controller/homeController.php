<?php


/**
 * Summary of homeController
 */
class homeController
{

    public function index($routeMap, $uri): void
    {

        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }

}






