<?php

namespace ressources\migrations;
use Src\Model\BDD ;
use PDO ;
use PDOException;
Class migration2 {
    /**
     * @param PDO $pdo
     * @return bool
     */
    public function up(PDO $pdo): bool {
        try {
            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS Log (id varchar(48) primary key, id_user varchar(48) , date datetime, action varchar(512))");
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false ;
        }
    }

    /**
     * @param PDO $pdo
     * @return bool
     */
    public function down(PDO $pdo): bool {
        try {
            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("DROP TABLE IF EXISTS Log");
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false ;
        }
    }
}