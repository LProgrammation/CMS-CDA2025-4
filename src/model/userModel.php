<?php
Class UserModel{


    public function getUsers(): false|array
    {
        $pdo = BDD::getInstance() ;
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
        $stmt = $pdo->prepare("SELECT * FROM User WHERE email=:email");
        $stmt->bindParam(":email",$email);
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
        $stmt = $pdo->prepare("SELECT * FROM User WHERE id=:id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $res = $stmt->fetchall(PDO::FETCH_ASSOC);
        if ($res) {
            return $res;

        }
        return false;
    }

    public function registerUsers(string $id, string $firstname, string $lastname, string $email, string $password, string $role): void
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