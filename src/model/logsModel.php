<?php
namespace Src\Model ;
use PDO;
use PDOException;
class LogsModel{

    public function getLogs()
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                *
            FROM
               log";
        $pdoStatement=$pdo->query($requete);
        return $pdoStatement->fetchAll();
    }
    public function getLogById($id_log)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                *
            FROM
                log
            WHERE
                id_log=".$id_log;
        $pdoStatement=$pdo->query($requete);
        return $pdoStatement->fetchAll();
    }
    public function getLogsByUserId($user_id)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                *
            FROM
                log
            WHERE
                id_user=".$user_id;
        $pdoStatement=$pdo->query($requete);
        return $pdoStatement->fetchAll();
    }
    public function setLogs($user_id, $action_log)
    {
        $pdo=BDD::getInstance();
        $requete="
        INSERT INTO
            log
            (
                id_user,
                date_loo,
                action_log
            )
        VALUES
            (
                ".$user_id.",
                NOW(),
                '".$action_log."'
            )
        ";
        return $pdo->query($requete);
    }
}