<?php

class AuthController
{
    /**
     * Show the login page.
     *
     * @return void
     */
    public function showLogin()
    {
        render('Login.php'); // Render the login view
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $agency = $_POST['agency'];
            $account = $_POST['account'];
            $password = $_POST['password'];

            $database = new Database();
            $db = $database->getConnection();
            $user = new User($db);

            if ($user->authenticate($agency, $account, $password)) {
                header('Location: /dashboard');
                exit();
            } else {
                echo "Invalid credentials!";
            }
        } else {
            header('Location: ./');
        };
    }

    private function authenticate($agency, $account, $password)
    {
        return false; 
    }

    private function validateInput($agency, $account, $password)
    {
        // Check if all fields are filled
        return !empty($agency) && !empty($account) && !empty($password);
    }

    private function showError($message)
    {
        // Display the error message (can be modified to redirect)
        echo "<div class='alert alert-danger'>$message</div>";
        $this->showLogin(); // Return to the login form
    }
}
