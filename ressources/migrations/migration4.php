<?php
Class migration4 {
    /**
     * @param PDO $pdo
     * @return mixed
     */
    public function up(PDO $pdo)
    {
        try {
            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS Page (id varchar(36) primary key,  id_site varchar(36), title varchar(50), type enum('header', 'footer', 'main'), content text, is_default_page boolean)");
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
     */
    public function down(PDO $pdo)
    {
        try {
            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("DROP TABLE IF EXISTS Page");
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false ;
        }
    }
}