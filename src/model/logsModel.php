<?php
class LogsModel{
    public function getLogs()
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                *
            FROM
                cms_logs";
        $pdoStatement=$pdo->query($requete);
        $tab_logs=$pdoStatement->fetchAll();
        return $tab_logs;
    }
    public function getLogsById($id_logs)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                *
            FROM
                cms_logs
            WHERE
                id_logs=".$id_logs;
        $pdoStatement=$pdo->query($requete);
        $tab_logs=$pdoStatement->fetchAll();
        return $tab_logs;
    }
    public function getLogsByUserId($user_id)
    {
        $pdo=BDD::getInstance();
        $requete="
            SELECT
                *
            FROM
                cms_logs
            WHERE
                id_user=".$user_id;
        $pdoStatement=$pdo->query($requete);
        $tab_logs=$pdoStatement->fetchAll();
        return $tab_logs;
    }
    public function setLogs($user_id, $action)
    {
        $pdo=BDD::getInstance();
        $requete="
        INSERT INTO
            cms_logs
            (
                id_user,
                date_logs,
                action_logs
            )
        VALUES
            (
                ".$user_id.",
                NOW(),
                '".$action."'
            )
        ";
        $pdoStatement=$pdo->query($requete);
        return $pdoStatement;
    }
}