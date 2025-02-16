<?php
namespace Src\Model ;
use PDO;
use PDOException;
class LogsModel{
    /**
     * @return array
     */
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

    /**
     * @param $id_log
     * @return array
     */
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

    /**
     * @param $user_id
     * @return array
     */
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

    /**
     * @param $id_log
     * @param $user_id
     * @param $action_log
     * @return false|\PDOStatement
     */
    public function setLogs($id_log, $user_id, $action_log)
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