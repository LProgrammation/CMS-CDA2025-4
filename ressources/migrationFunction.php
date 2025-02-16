<?php
namespace ressources ;
use \Src\Model\BDD ;
Class migrationFunction{
    /**
     * @var string|null
     */
    public string|null $lastMigration;
    /**
     * @var array
     */
    public array $migrationsLocalList;
    /**
     * @var \Src\Model\migrationModel
     */
    public \Src\Model\migrationModel $migrationModel ;
    /**
     * @var string
     */
    public string $date ;


    /**
     * @return bool
     */
    public function migrate():bool{
        $pattern = '/^migration(\d+)$/';
        (!$this->lastMigration) ? $currentMigrationNumber = 0 : $currentMigrationNumber = (int)substr($this->lastMigration, 9);
        $migrationToExecute= [];
        // Foreach to check migration up for migrate
        foreach ($this->migrationsLocalList as $migration) {

            $migrationClass = pathinfo($migration, PATHINFO_FILENAME);

            if (preg_match($pattern, $migrationClass, $matches)) {
                $num = (int)$matches[1];
                if ($num > $currentMigrationNumber) {
                    $migrationToExecute[] = $migrationClass ;

                }
            }
        }
        if(empty($migrationToExecute)){
            echo "Database already updated." ;
            return false;

        }
        foreach($migrationToExecute as $migration){
            require_once (__DIR__ . '/migrations/' . $migration.'.php');
            $migrationClass = pathinfo($migration, PATHINFO_FILENAME);
            $migrationExecution = "\\ressources\\migrations\\" . $migrationClass;
            $migrationExecution = New $migrationExecution();
            $exec = $migrationExecution->up(BDD::getInstance());
            if(!$exec){
                echo 'error' ;
                return false;
            }
            $this->migrationModel->insertMigrationInLog($migrationClass, $this->date);

        }
        echo "All migration executed successfully (see history mode)" ;
        return true ;
    }

    /**
     * @return bool
     */
    public function reset():bool{
        if(!$this->lastMigration){
            echo "Empty database, reset not necessary" ;
            return false ;
        }
        $pattern = '/^migration(\d+)$/';
        $currentMigrationNumber = (int)substr($this->migrationModel->getLastMigration()[0]['name'], 9); // Extract number from currentMigration
        $migrationToExecute= [];
        // Foreach to check migration down for reset
        foreach ($this->migrationsLocalList as $migration) {

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
            require_once (__DIR__ . '/migrations/' . $migration.'.php');
            $migrationClass = pathinfo($migration, PATHINFO_FILENAME);
            $migrationExecution = "\\ressources\\migrations\\" . $migrationClass;
            $migrationExecution = New $migrationExecution();
            $exec = $migrationExecution->down(BDD::getInstance());
            if(!$exec){
                echo "error";
                return false;
            }
            $this->migrationModel->deleteMigrationsByName($migrationClass);
        }
        return true ;
    }

    /**
     * @return bool
     */
    public function next(): bool
    {
        echo "Next update : ". $this->lastMigration ."\n";
        echo "All migration available : \n" ;
        foreach($this->migrationsLocalList as $migration){
            echo "- " . $migration . "\n";

        }


        $pattern = '/^migration(\d+)$/';
        (!$this->lastMigration) ? $currentMigrationNumber = 0 : $currentMigrationNumber = (int)substr($this->lastMigration, 9); // Extract number from currentMigration
        foreach ($this->migrationsLocalList as $migration) {

            $migrationClass = pathinfo($migration, PATHINFO_FILENAME);

            if (preg_match($pattern, $migrationClass, $matches)) {
                $num = (int)$matches[1];
                if ($num > $currentMigrationNumber) {
                    require_once (__DIR__ . '/migrations/' . $matches[0] . '.php');
                    echo "This update will be executed : $matches[0]\n";
                    $migrationExecution = "\\ressources\\migrations\\" . $matches[0];
                    $migrationExecution = New $migrationExecution();
                    $exec = $migrationExecution->up(BDD::getInstance());
                    if (!$exec) {
                        echo "error";
                        return false;
                    }


                    $this->migrationModel->insertMigrationInLog($migrationClass, $this->date);

                    echo $migrationClass, "Migration executed successfully" ;
                    return true;

                }
            }
        }

        echo "Empty migrations list after this migration : ", $this->lastMigration ;
        return false ;
    }

    /**
     * @return false|void
     */
    public function prev(){
        if (!$this->lastMigration){
            echo "The migrations history is empty, please make a migration(s) before use previous mode" ;
            return false ;
        }
        require_once (__DIR__.'/migrations/' . $this->lastMigration. '.php');

        $migrationExecution = "\\ressources\\migrations\\" . $this->lastMigration;
        $migrationExecution = New $migrationExecution();
        $exec = $migrationExecution->down(BDD::getInstance());
        if(!$exec){
            echo "error";
            return false;
        }
        $this->migrationModel->deleteMigrationsByName($this->lastMigration);
    }


}