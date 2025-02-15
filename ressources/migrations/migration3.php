<?php
namespace ressources\migrations;
use Src\Model\BDD ;
use PDO ;
use PDOException;
Class migration3 {
    /**
     * @param PDO $pdo
     * @return bool
     */
    public function up(PDO $pdo): bool
    {
        try {
            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS Site (id varchar(36) primary key, id_user varchar(36))");
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
    public function down(PDO $pdo): bool
    {
        try {
            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("DROP TABLE IF EXISTS Site");
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false ;
        }
    }
}