<?php
//  Insert migration script here
require_once __DIR__ . '/../vendor/autoload.php';
require_once('../src/model/BDD.php');
require_once('../src/model/migrationModel.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
$migrationModel = new MigrationModel();
$options = [
    "mode:",
    "number:",
];

$arguments = getopt("", $options);


if(!isset($arguments["mode"])){
    echo "L'argument mode est obligatoire (--mode)" ;
    die();
}
$migrationsLogs = $migrationModel->getMigrations();
$lastMigration = $migrationModel
switch ($arguments['mode']) {

    case 'localList' :
        var_dump(scandir("./migrations/"));
        break;
    case 'history': 
        var_dump($migrationsLogs);
        break;
    case 'next':
        $datetime = new \DateTime();
        $migrationModel->insertMigrationInLog('migration1', $datetime->format('Y-m-d H:i:s'));
        // Insert next action code
        break;
    case 'prev':
        // Insert previous action code
        break;
    case 'migrate':
        // Insert full migration action code
        break;
    case 'reset':
        // Insert reset migration action code
        break;
    default:
        // Insert default action code
        echo "Error: please enter valide migration mode (next, prev, migrate or reset";
        break;
}
