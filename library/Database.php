<?php

class Database
{
    private $host = '185.173.111.184';
    private $db_name = 'u858577505_bank';
    private $username = 'u858577505_bank';
    private $password = '@#Hostinger023@_';
    private $connection;

    public function getConnection()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->connection->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
