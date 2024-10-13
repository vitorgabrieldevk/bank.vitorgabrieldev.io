<?php

class User
{
    private $connection;
    private $table_name = 'users';

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function create($agency, $account, $password)
    {
        $query = "INSERT INTO " . $this->table_name . " (agency, account, password) VALUES (:agency, :account, :password)";
        
        $stmt = $this->connection->prepare($query);
        
        $stmt->bindParam(':agency', $agency);
        $stmt->bindParam(':account', $account);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT)); // Hashing the password for security
        
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function authenticate($agency, $account, $password)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE agency = :agency AND account = :account LIMIT 1";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':agency', $agency);
        $stmt->bindParam(':account', $account);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                return $user; // Return user data if authenticated
            }
        }

        return false; // Invalid credentials
    }
}
