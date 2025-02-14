<?php

Class migration2 {
    /**
     * @param PDO $pdo
     * @return void
     */
    public function up(PDO $pdo) {
        try {
            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS Logs (id varchar(48) primary key auto_increment, id_user varchar(48) , date datetime, action varchar(512))");
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
            $stmt = $pdo->prepare("DROP TABLE IF EXISTS Logs");
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}