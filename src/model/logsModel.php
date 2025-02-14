<?php
class LogsModel{
    public function getLogs(): mixed
    {
        try {

            $pdo=BDD::getInstance();
            $requete="SELECT * FROM cms_logs";
            $pdoStatement=$pdo->query($requete);
            return $pdoStatement->fetchAll();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }
    public function getLogsById($id): mixed
    {
        // Insert sql request to get logs by id
        return true;
    }
    public function getLogsByUserId($user_id): mixed
    {
        // Insert sql request to get logs by id
        return true;
    }
    public function setLogs($logs): mixed
    {
        // Insert sql request to set logs
        return true;
    }
}