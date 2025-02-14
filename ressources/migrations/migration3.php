<?php
Class migration3 {
    /**
     * @param PDO $pdo
     * @return void
     */
    public function up(PDO $pdo): void
    {
        try {
            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS Sites (id varchar(36) primary key, id_user varchar(36))");
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
    public function down(PDO $pdo): void
    {
        try {
            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("DROP TABLE IF EXISTS Sites");
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}