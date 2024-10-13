<?php

require_once 'library/routes.php'; // Load the routes file that contains the RouteDispatcher class and controller definitions.

/*
|--------------------------------------------------------------------------
| Create Route Dispatcher Instance
|--------------------------------------------------------------------------
|
| Here we instantiate the RouteDispatcher class. This class is responsible
| for managing and dispatching routes based on the request URI.
|
*/

$router = new RouteDispatcher(); // Instantiate the RouteDispatcher class.

/*
|--------------------------------------------------------------------------
| Define Application Routes
|--------------------------------------------------------------------------
|
| The addRoute method is used to define the routes for the application. 
| For each route, we specify the URI, the corresponding controller, 
| and the method that should be called.
|
*/

// Authentication Routes
$router->addRoute('/', 'AuthController', 'showLogin'); // Show login page
$router->addRoute('/login', 'AuthController', 'login'); // Handle login action

$router->addRoute('/logout', 'AuthController', 'logout'); // Logout action

$router->addRoute('/create-account', 'AccountController', 'showCreateAccount'); // Show create account form
$router->addRoute('/create-account/submit', 'AccountController', 'createAccount'); // Handle create account submission
// Dashboard Routes
$router->addRoute('/dashboard', 'DashboardController', 'index'); // Show dashboard with account balance and options

// Statement Routes
$router->addRoute('/statement', 'StatementController', 'index'); // View account statement

// Transfer Routes
$router->addRoute('/transaction', 'TransferController', 'create'); // Show transfer form
$router->addRoute('/transaction-complete', 'TransferController', 'complete'); // Confirm transfer

// Error Handling
$router->addRoute('/404', 'ErrorController', 'notFound'); // Custom 404 page

/*
|--------------------------------------------------------------------------
| Capture Request URI
|--------------------------------------------------------------------------
|
| The request URI is captured using the $_SERVER['REQUEST_URI'] variable. 
| This represents the part of the URL after the domain name. Since the 
| application is running within a subdirectory, we must remove the base 
| path from the request URI to match it with our defined routes.
|
*/

$request_uri = $_SERVER['REQUEST_URI']; // Get the current request URI (e.g., '/bank.vitorgabrieldev.io/saldo').
$base_path = '/bank.vitorgabrieldev.io'; // Define the base path (subdirectory where the app is located).
define('BASE_PATH', $base_path);

/*
|--------------------------------------------------------------------------
| Remove Base Path from Request URI
|--------------------------------------------------------------------------
|
| Since the application is hosted in a subdirectory, we need to remove 
| the base path from the request URI to properly identify the route.
| The str_replace function is used to strip the base path from the URI.
|
*/

$route = str_replace($base_path, '', $request_uri); // Remove the base path from the request URI to get the actual route.
$route = parse_url($route, PHP_URL_PATH); // Parse the route to get the path part of the URL (ignoring query parameters, etc.).

/*
|--------------------------------------------------------------------------
| Dispatch the Route
|--------------------------------------------------------------------------
|
| After defining the routes and capturing the request, the dispatchRoute 
| method of the RouteDispatcher is called. This method checks if the 
| route exists and, if so, executes the corresponding controller method.
|
*/

$router->dispatchRoute($route); // Dispatch the route and execute the corresponding controller method.
