<?php
use \Src\Model\LogsModel;
class LogsController
{
    public function index($routeMap, $uri): void
    {

        $logs_model = new LogsModel;
        $tab_logs=$logs_model->getLogs();
        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }
}