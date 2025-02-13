<?php

/**
 * Summary of homeController
 */
class homeController
{
    private BDD $BDD;

    public function index($routeMap, $uri): void
    {

        $this->BDD->tryConnection();
        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }

    /**
     * Method to setBDD from index
     * @param mixed $BDD
     * @return void
     */
    public function setBDD(mixed $BDD): void
    {
        $this->BDD = $BDD;
    }

}






