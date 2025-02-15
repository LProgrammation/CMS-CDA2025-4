<?php
//  Insert migration script here
require_once __DIR__ . '/../vendor/autoload.php';
require_once('../src/model/BDD.php');
require_once('../src/model/migrationModel.php');
require_once('./migrationFunction.php');
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

(isset($migrationModel->getLastMigration()[0]['name'])) ? $lastMigration = $migrationModel->getLastMigration()[0]['name'] : $lastMigration = null;

$migrationsLocalList =  array_diff(scandir('./migrations/'), array('.', '..'));
$date = date("Y-m-d H:i:s");
$migrationFunction = New migrationFunction() ;
$migrationFunction->lastMigration = $lastMigration;
$migrationFunction->date = $date;
$migrationFunction->migrationsLocalList = $migrationsLocalList;
$migrationFunction->migrationModel = $migrationModel;
switch ($arguments['mode']) {

    case 'locallist' :
        echo "Voici la liste des migrations disponible :  \n";
        foreach($migrationsLocalList as $migration){
            echo " - ", pathinfo($migration, PATHINFO_FILENAME),"\n";
        };
        break;

    case 'history':
        $i = 1 ;
        foreach ($migrationsLogs as $log) {
            echo "$i : ". $log['name']  . "\n";
            $i++ ;
        };
        break;

    case 'next':
        $migrationFunction->next();
        break;

    case 'prev':
        $migrationFunction->prev();

        break;

    case 'migrate':
        $migrationFunction->migrate();
        break;

    case 'reset':
        $migrationFunction->reset();
        break;

    default:
        echo "Error: please enter valide migration mode (next, prev, migrate, reset, history or locallist)";
        break;
}


