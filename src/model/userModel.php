<?php
namespace Src\Model ;
use PDO;
use PDOException;
Class UserModel{

    /**
     * @return false|array
     */
    public function getUsers(): false|array
    {
        $pdo = BDD::getInstance() ;
        $stmt = $pdo->prepare("SELECT * FROM user");
        $stmt->execute();
        $res = $stmt->fetchall(PDO::FETCH_ASSOC);
        if ($res) {
            return $res;

        }
        return false;
    }

    /**
     * @param $email
     * @return false|array
     */
    public function getUserByEmail($email): false|array
    {

        $pdo = BDD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email=:email");
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        $res = $stmt->fetchall(PDO::FETCH_ASSOC);
        if ($res) {
            return $res;

        }
        return false;
    }

    /**
     * @param $id
     * @return false|array
     */
    public function getUserById($id): false|array
    {

        $pdo = BDD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM User WHERE id=:id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $res = $stmt->fetchall(PDO::FETCH_ASSOC);
        if ($res) {
            return $res;

        }
        return false;
    }

    /**
     * @param string $id
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $password
     * @param string $role
     * @return void
     */
    public function registerUser(string $id, string $firstname, string $lastname, string $email, string $password, string $role): void
    {
        try {

            $pdo = BDD::getInstance();
            $stmt = $pdo->prepare("INSERT INTO User VALUES (:id, :lastname, :firstname, :email, :password, :role)");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":role", $role);
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo "error : ", $e->getMessage();
        }
    }
}