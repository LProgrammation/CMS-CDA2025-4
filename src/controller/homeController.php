<?php
<<<<<<< HEAD

/**
 * Summary of homeController
 */
class homeController
{
    private BDD $BDD;
=======
/**
 * Summary of homeController
 */
class homeController{
    public function index($routeMap, $uri){

        require_once "../src/view/".$routeMap[$uri]['name'].".php";
>>>>>>> f65d12a2e56fc59264fb03b85893d428558b102a

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






