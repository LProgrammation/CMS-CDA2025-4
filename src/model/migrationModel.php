<?php

Class migrationModel {
    /**
     * @return array
     */
    public function getMigrations(): array
    {
        $pdo = BDD::getInstance() ;
        $stmt = $pdo->prepare("SELECT * FROM Migrations");
        return $stmt->fetchAll();

    }

    /**
     * @return mixed
     */
    public function getLastMigration()
    {
        $pdo = BDD::getInstance() ;
        $stmt = $pdo->query("SELECT * FROM Migrations ORDER BY id DESC LIMIT 1");
        return $stmt->fetchColumn();

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
     * @param $id
     * @return void
     */
    public function deleteMigrationsById($id): void
    {
        try{

            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("DELETE FROM migrations WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $res = $stmt->fetchall(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }

    }
}