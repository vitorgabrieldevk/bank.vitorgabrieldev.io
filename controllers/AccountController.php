<?php

class AccountController
{
    public function showCreateAccount()
    {
        render('CreateAccount.php'); // Render the create account view
    }

    public function createAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $agency = $_POST['agency'];
            $account = $_POST['account'];
            $password = $_POST['password'];

            // Here you should validate the input and save to the database
            if ($this->saveAccount($agency, $account, $password)) {
                // Redirect to the login page or show success message
                header('Location: /login');
                exit();
            } else {
                // Handle error: account creation failed
                echo "Failed to create account!";
            }
        }
    }

    private function saveAccount($agency, $account, $password)
    {
        // Implement the logic to save the account in the database
        $db = new Database(); // Initialize the Database class
        $conn = $db->getConnection();

        // Prepare and execute the SQL query to insert the new account
        $stmt = $conn->prepare("INSERT INTO users (agency, account_number, password) VALUES (?, ?, ?)");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security

        return $stmt->execute([$agency, $account, $hashedPassword]);
    }
}
