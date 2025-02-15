<?php

Class migrationFunction{
    public string|null $lastMigration;
    public array $migrationsLocalList;

    public migrationModel $migrationModel ;
    public string $date ;



    public function migrate(){
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
            require_once ('./migrations/' . $migration.'.php');
            $migrationClass = pathinfo($migration, PATHINFO_FILENAME);
            $migrationExecution = New $migrationClass();
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

    public function reset(){
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
            require_once ('./migrations/' . $migration.'.php');
            $migrationClass = pathinfo($migration, PATHINFO_FILENAME);
            $migrationExecution = New $migrationClass();
            $exec = $migrationExecution->down(BDD::getInstance());
            if(!$exec){
                echo "error";
                return false;
            }
            $this->migrationModel->deleteMigrationsByName($migrationClass);
        }
        return true ;
    }
    public function next(){
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
                    require_once ('./migrations/' . $matches[0] . '.php');
                    echo "This update will be executed : $matches[0]\n";
                    $migrationExecution = New $matches[0]();

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
    public function prev(){
        if (!$this->lastMigration){
            echo "The migrations history is empty, please make a migration(s) before use previous mode" ;
            return false ;
        }
        require_once ('./migrations/' . $this->lastMigration. '.php');
        $migrationExecution = New $this->lastMigration();
        $exec = $migrationExecution->down(BDD::getInstance());
        if(!$exec){
            echo "error";
            return false;
        }
        $this->migrationModel->deleteMigrationsByName($this->lastMigration);
    }


}