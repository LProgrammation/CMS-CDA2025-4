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
    public function setLogs($id_log, $user_id, $date_log, $action_log)
    {
        $pdo=BDD::getInstance();
        $requete='
        INSERT INTO
            log
            (
                id_log,
                id_user,
                date_log,
                action_log
            )
        VALUES
            (
                "'.$id_log.'",
                "'.$user_id.'",
                NOW(),
                "'.$action_log.'"
            )
        ';
        return $pdo->query($requete);
    }
}