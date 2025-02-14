<?php
class LogsController
{
    public function index($routeMap, $uri)
    {
        require_once "../src/model/" . $routeMap[$uri]['name'] . "Model.php";
        $logs_model=new LogsModel();
        $tab_logs=$logs_model->getLogs();
        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }
}