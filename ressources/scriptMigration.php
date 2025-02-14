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

(isset($migrationModel->getLastMigration()[0]['name'])) ? $lastMigration = $migrationModel->getLastMigration()[0]['name'] : $lastMigration = null;

$migrationsLocalList =  array_diff(scandir('./migrations/'), array('.', '..'));
$date = date("Y-m-d H:i:s");
switch ($arguments['mode']) {

    case 'localList' :
        var_dump(scandir("./migrations/"));
        break;

    case 'history':
        $i = 1 ;
        foreach ($migrationsLogs as $log) {
            echo "$i : ". $log['name']  . "\n";
            $i++ ;
    };
        break;

    case 'next':
        echo "La dernière migrations effectuer est la suivante : ". $lastMigration ."\n";
        echo "Voici la liste des migrations disponible : \n" ;
        foreach($migrationsLocalList as $migration){
            echo "- " . $migration . "\n";

        }


        $pattern = '/^migration(\d+)$/';
        (!$lastMigration) ? $currentMigrationNumber = 0 : $currentMigrationNumber = (int)substr($lastMigration, 9); // Extract number from currentMigration
        foreach ($migrationsLocalList as $migration) {

            $migrationClass = pathinfo($migration, PATHINFO_FILENAME);

            if (preg_match($pattern, $migrationClass, $matches)) {
                $num = (int)$matches[1];
                if ($num > $currentMigrationNumber) {
                    require_once ('./migrations/' . $matches[0] . '.php');
                    echo "La migration suivante vas être exécuter : $matches[0]\n";
                    $migrationExecution = New $matches[0]();

                    $exec = $migrationExecution->up(BDD::getInstance());
                    if (!$exec) {
                        echo "error";
                        return false;
                    }


                    $migrationModel->insertMigrationInLog($migrationClass, $date);

                    echo $migrationClass, " effectuer avec succès" ;
                    return true;

                }
            }
        }

        echo "Aucune migration suivant la ", $lastMigration ;


        // Insert next action code
        break;

    case 'prev':
        if (!$lastMigration){
            echo "Aucune migration n'a été effectuer pour le moment" ;
            break ;
        }
        require_once ('./migrations/' . $lastMigration. '.php');
        $migrationExecution = New $lastMigration();
        $exec = $migrationExecution->down(BDD::getInstance());
        if(!$exec){
            echo "error";
            return false;
        }
        $migrationModel->deleteMigrationsByName($lastMigration);

        break;

    case 'migrate':
        $pattern = '/^migration(\d+)$/';
        (!$lastMigration) ? $currentMigrationNumber = 0 : $currentMigrationNumber = (int)substr($lastMigration, 9);
        $migrationToExecute= [];
        // Foreach to check migration up for migrate
        foreach ($migrationsLocalList as $migration) {

            $migrationClass = pathinfo($migration, PATHINFO_FILENAME);

            if (preg_match($pattern, $migrationClass, $matches)) {
                $num = (int)$matches[1];
                if ($num > $currentMigrationNumber) {
                    $migrationToExecute[] = $migrationClass ;

                }
            }
        }
        if(empty($migrationToExecute)){
            echo "La base de données est à jour, migration inutile" ;


        }
        foreach($migrationToExecute as $migration){
            require_once ('./migrations/' . $migration.'.php');
            $migrationClass = pathinfo($migration, PATHINFO_FILENAME);
            $migrationExecution = New $migrationClass();
            $exec = $migrationExecution->up(BDD::getInstance());
            if(!$exec){
                echo "error";
                return false;
            }
            $migrationModel->insertMigrationInLog($migrationClass, $date);

        }
        break;

    case 'reset':
        if(!$lastMigration){
            echo "La base de données est vide, rien à reset" ;
            break;
        }
        $pattern = '/^migration(\d+)$/';
        $currentMigrationNumber = (int)substr($migrationModel->getLastMigration()[0]['name'], 9); // Extract number from currentMigration
        $migrationToExecute= [];
        // Foreach to check migration down for reset
        foreach ($migrationsLocalList as $migration) {

            $migrationClass = pathinfo($migration, PATHINFO_FILENAME);

            if (preg_match($pattern, $migrationClass, $matches)) {
                $num = (int)$matches[1];
                if ($num <= $currentMigrationNumber) {
                    $migrationToExecute[] = $migrationClass ;

                }
            }
        }
        // Revert migration list to start by last migration (Exemple : 1, 2, 3 -> 3, 2, 1.)
        rsort($migrationToExecute);
        foreach($migrationToExecute as $migration){
            require_once ('./migrations/' . $migration.'.php');
            $migrationClass = pathinfo($migration, PATHINFO_FILENAME);
            $migrationExecution = New $migrationClass();
            $exec = $migrationExecution->down(BDD::getInstance());
            if(!$exec){
                echo "error";
                return false;
            }
            $migrationModel->deleteMigrationsByName($migrationClass);
        }
        break;

    default:
        echo "Error: please enter valide migration mode (next, prev, migrate or reset)";
        break;
}


