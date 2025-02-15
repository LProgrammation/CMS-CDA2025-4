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
     * @param $email_user
     * @return false|array
     */
    public function getUserByEmail($email_user): false|array
    {

        $pdo = BDD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email=:email");
        $stmt->bindParam(":email",$email_user);
        $stmt->execute();
        $res = $stmt->fetchall(PDO::FETCH_ASSOC);
        if ($res) {
            return $res;

        }
        return false;
    }

    /**
     * @param $id_user
     * @return false|array
     */
    public function getUserById($id_user): false|array
    {

        $pdo = BDD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM User WHERE id=:id");
        $stmt->bindParam(":id_user",$id_user);
        $stmt->execute();
        $res = $stmt->fetchall(PDO::FETCH_ASSOC);
        if ($res) {
            return $res;

        }
        return false;
    }

    /**
     * @param string $id_user
     * @param string $firstname_user
     * @param string $name_user
     * @param string $email_user
     * @param string $password_user
     * @param string $role_user
     * @return void
     */
    public function registerUser(string $id_user, string $firstname_user, string $name_user, string $email_user, string $password_user, string $role_user): void
    {
        try {

            $pdo = BDD::getInstance();
            $stmt = $pdo->prepare("INSERT INTO User VALUES (:id_user, :name, :firstname, :email, :password, :role)");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":firstname", $firstname_user);
            $stmt->bindParam(":name_user", $name_user);
            $stmt->bindParam(":email_user", $email_user);
            $stmt->bindParam(":password_user", $password_user);
            $stmt->bindParam(":role_user", $role_user);
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo "error : ", $e->getMessage();
        }
    }
}