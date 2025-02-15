<?php
namespace Src\Controller ;
namespace Src\Controller ;
use \Src\Model\LogsModel;
use \Src\Module\Access;
class LogsController
{
    public function index($routeMap, $uri): void
    {
        $accessModule = new Access();
        $accessModule->isGranted();
        $logs_model = new LogsModel;
        $tab_logs=$logs_model->getLogs();
        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }
}