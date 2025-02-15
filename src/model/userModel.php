<?php
namespace Src\Model ;
use Src\Module\Uuid ;
use PDO;
use PDOException;
Class UserModel{

    /**
     * @return false|array
     */
    public function getUsers(): false|array
    {
        $pdo = BDD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM User");
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
        $stmt = $pdo->prepare("SELECT * FROM User WHERE email_user=:email_user");
        $stmt->bindParam(":email_user", $email_user);
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
        $stmt = $pdo->prepare("SELECT * FROM User WHERE id_user=:id_user");
        $stmt->bindParam(":id_user", $id_user);
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
     * @return int|null
     */
    public function registerUsers(string $id_user, string $firstname_user, string $name_user, string $email_user, string $password_user, string $role_user = 'user')
    {
        try {
            $pdo = BDD::getInstance();
            $stmt = $pdo->prepare("INSERT INTO User (`id_user`, `role_user`, `password_user`, `email_user`, `nom_user`, `prenom_user`) VALUES (:id_user, :role_user, :password_user, :email_user, :name_user, :firstname_user)");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":firstname_user", $firstname_user);
            $stmt->bindParam(":name_user", $name_user);
            $stmt->bindParam(":email_user", $email_user);
            $stmt->bindParam(":password_user", $password_user);
            $stmt->bindParam(":role_user", $role_user);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "error : ", $e->getMessage();
            return null;
        }
    }
}