<?php


class siteController{
    public function index($routeMap, $uri)
    {
        require_once "../src/model/BDD.php";
        require_once "../src/model/" . $routeMap[$uri]['name'] . "Model.php";
        $sites_model=new siteModel();
        $liste_sites=$sites_model->getSites();
        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }
   

}

?>