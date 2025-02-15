<?php

class UserModel
{
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

    public function getUserByEmail($email): false|array
    {

        $pdo = BDD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM User WHERE email_user=:email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $res = $stmt->fetchall(PDO::FETCH_ASSOC);
        if ($res) {
            return $res;

        }
        return false;
    }

    public function getUserById($id): false|array
    {

        $pdo = BDD::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM User WHERE id_user=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $res = $stmt->fetchall(PDO::FETCH_ASSOC);
        if ($res) {
            return $res;

        }
        return false;
    }

    public function registerUsers(string $firstname, string $lastname, string $email, string $password, string $role="user")
    {
        try {
            require_once __DIR__ . '/../module/uuid.php';
            $pdo = BDD::getInstance();
            $stmt = $pdo->prepare("INSERT INTO User (`id_user`, `role_user`, `password_user`, `email_user`, `name_user`, `firstname_user`) VALUES (:id, :role, :password, :email, :lastname, :firstname)");
            $id = guidv4();
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":role", $role);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return null;
        }
    }

    public function updateUser(string $id, string $firstname, string $lastname, string $email, string $role)
    {
        try {
            $pdo = BDD::getInstance();
            $stmt = $pdo->prepare("UPDATE user SET role_user=:role, email_user=:email, name_user=:lastname, firstname_user=:firstname WHERE id_user = :id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":lastname", $lastname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":role", $role);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return null;
        }
    }

    public function deleteUser(string $id)
    {
        try {
            $pdo = BDD::getInstance();
            $stmt = $pdo->prepare("DELETE FROM user WHERE id_user = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return null;
        }
    }
}