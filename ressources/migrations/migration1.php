<?php
namespace ressources\migrations;
use Src\Model\BDD ;
use PDO ;
use PDOException;
Class migration1 {
    public function up(PDO $pdo) {
        try {
            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS User(id_user varchar(36) primary key, firstname_user varchar(48), name_user varchar(48), email_user varchar(255), password_user varchar(255), role_user enum('user', 'admin'))");
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false ;
        }

    }


    public function down(PDO $pdo) {
        try {
            $pdo = BDD::getInstance() ;
            $stmt = $pdo->prepare("DROP TABLE IF EXISTS User");
            $stmt->execute();
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false ;
        }
    }
}