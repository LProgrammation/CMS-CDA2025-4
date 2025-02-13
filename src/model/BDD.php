<?php
/*
? MariaDB / Mysql helper : 
? https://mariadb.com/resources/blog/developer-quickstart-php-data-objects-and-mariadb/

*/

/**
 * class use to connect the php to the database
 */
class BDD
{

    private static $instance = null;
    private $pdo;
    private $dsn;
    private $username;
    private $password;

    /**
     * Summary of __construct
     * @throws \Exception
     */
    public function __construct()
    {
        try {
            $this->dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8mb4';
            $this->username = $_ENV['DB_USER'];
            $this->password = $_ENV['DB_PASS'];

            $this->pdo = new PDO($this->dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Erreur de connexion : ' . $e->getMessage());
        }
    }

    /**
     * Summary of getInstance
     * @return mixed
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }

    public function __clone()
    {
    }

    public function __wakeup()
    {
    }

}

