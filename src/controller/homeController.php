<?php
namespace Src\Controller;

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






