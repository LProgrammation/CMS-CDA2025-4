<?php
namespace Src\Model ;
use PDO;
use PDOException;
Class migrationModel {
    /**
     * @return array
     */
    public function getMigrations(): array
    {
        $pdo = BDD::getInstance() ;
        $stmt = $pdo->query("SELECT * FROM Migrations");
        return $stmt->fetchAll();

    }

    /**
     * @return array
     */
    public function getLastMigration(): array
    {
        $pdo = BDD::getInstance() ;
        $stmt = $pdo->query("SELECT * FROM Migrations ORDER BY id DESC LIMIT 1");
        return $stmt->fetchAll();

    }

    /**
     * @return array
     */
    public function getPrevMigration(): array
    {
        $pdo = BDD::getInstance() ;
        $stmt = $pdo->query("SELECT * FROM Migrations ORDER BY id DESC LIMIT 1 OFFSET 1");
        return $stmt->fetchAll();

    }

    /**
     * @param $name
     * @param $date
     * @return void
     */
    public function insertMigrationInLog($name, $date): void
    {
        $pdo = BDD::getInstance() ;
        $stmt = $pdo->prepare("INSERT INTO migrations(name, date) VALUES(:name, :date)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $res = $stmt->fetchall(PDO::FETCH_ASSOC);

    }

    /**
     * @param $name
     * @return void
     */
    public function deleteMigrationsByName($name): void
    {
        try{

            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("DELETE FROM migrations WHERE name = :name");
            $stmt->bindParam(":name", $name);
            $stmt->execute();
            $res = $stmt->fetchall(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }

    }
}