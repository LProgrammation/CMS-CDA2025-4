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

    private static ?BDD $instance = null;
    private PDO $pdo;
    private string $dsn;
    private mixed $username;

    private mixed $password;

    /**
     * Summary of __construct
     * @throws \Exception
     */

    private function __construct()
    {
        try {
            $this->dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8mb4';
            $this->username = $_ENV['DB_USER'];
            $this->password = $_ENV['DB_PASS'];

            $this->pdo = new PDO($this->dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // throw new Exception('Erreur de connexion : ' . $e->getMessage());
            header('Location:error?code=401');
            exit();
        }


    }

    /**
     * @return BDD|null
     */
    public static function getInstance(): ?PDO
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }

    /**
     * @return void
     */
    public function __clone(){}

    /**
     * @return void
     */
    public function __wakeup(){}

}