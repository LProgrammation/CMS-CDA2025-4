<?php

class authModel
{
    public function getUserByEmail($email_user)
    {
        $pdo = BDD::getInstance();
        $sql = "SELECT * FROM Utilisateur WHERE email_user = :email_user LIMIT 1";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':email_user', $email_user);
        $statement->execute();
        $result = $statement->fetchAll();
        if (count($result) == 0) return null;
        return $result[0];
    }



    //public function createUser($password_user, $email_user, $nom_user, $prenom_user)
    //{
    //    $pdo = BDD::getInstance();
    //    $sql = "INSERT INTO Utilisateur (id_user, role_user, password_user, email_user, nom_user, prenom_user) VALUES (:id_user, :role, :password_user, :email_user, :nom_user, :prenom_user)";
    //    $statement = $pdo->prepare($sql);
    //    $id_user = guidv4();
    //    $statement->execute();
    //    return $statement->rowCount();
    //}
}