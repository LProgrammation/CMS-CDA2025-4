<?php

Class migration1 {
    /**
     * @param PDO $pdo
     * @return void
     */
    public function up(PDO $pdo) {
        try {
            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS users (id string primary key auto_increment, firstname varchar(48), lastname varchar(48), email varchar(255), password varchar(255), role enum('user', 'admin'))");
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param PDO $pdo
     * @return void
     */
    public function down(PDO $pdo) {
        try {
            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("DROP TABLE IF EXISTS users");
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}