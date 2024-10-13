<?php

// Import the necessary controllers.
require_once 'controllers/AuthController.php';
require_once 'controllers/AccountController.php';

// Import the necessary UTILS
include __DIR__ . '/../library/_helpers.php';
include __DIR__ . '/../library/Database.php';
include __DIR__ . '/../models/User.php';

class RouteDispatcher
{
    // Array to store registered routes.
    private $routes = [];

    /*
    |--------------------------------------------------------------------------
    | Method to Define a Route
    |--------------------------------------------------------------------------
    |
    | This method registers a new route in the system.
    |
    | @param  string  $uri        The URI for the route (e.g., '/saldo').
    | @param  string  $controller The name of the controller class.
    | @param  string  $method     The method in the controller to be called.
    |
    */
    public function addRoute($uri, $controller, $method)
    {
        $this->routes[$uri] = ['controller' => $controller, 'method' => $method]; // Store the route.
    }

    /*
    |--------------------------------------------------------------------------
    | Method to Dispatch the Route
    |--------------------------------------------------------------------------
    |
    | This method dispatches the route based on the provided URI.
    |
    | @param  string  $uri  The URI of the current request (e.g., '/saldo').
    |
    */
    public function dispatchRoute($uri)
    {
        if ($this->routeExists($uri)) {
            $route = $this->routes[$uri]; // Retrieve the corresponding route.
            $this->handleRequest($route); // Call the method to handle the request.
        } else {
            $this->sendErrorResponse("Route not found!", 404); // Error response for route not found.
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Method to Check if the Route Exists
    |--------------------------------------------------------------------------
    |
    | This method checks if the requested URI is registered.
    |
    | @param  string  $uri  The URI of the current request.
    | @return bool          Returns true if the route exists, false otherwise.
    |
    */
    private function routeExists($uri)
    {
        return array_key_exists($uri, $this->routes); // Returns whether the route exists.
    }

    /*
    |--------------------------------------------------------------------------
    | Method to Handle the Request
    |--------------------------------------------------------------------------
    |
    | This method instantiates the controller and calls the appropriate method.
    |
    | @param  array  $route  The array containing the corresponding route.
    |
    */
    private function handleRequest($route)
    {
        if ($this->controllerExists($route['controller'])) {
            $controller = new $route['controller'](); // Create an instance of the controller.
            if ($this->methodExists($controller, $route['method'])) {
                $controller->{$route['method']}(); // Call the method on the controller.
            } else {
                $this->sendErrorResponse("Method not found!", 404); // Error response for method not found.
            }
        } else {
            $this->sendErrorResponse("Controller not found!", 404); // Error response for controller not found.
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Method to Check if the Controller Exists
    |--------------------------------------------------------------------------
    |
    | This method checks if the controller class is defined.
    |
    | @param  string  $controller  The name of the controller class.
    | @return bool                Returns true if the controller exists, false otherwise.
    |
    */
    private function controllerExists($controller)
    {
        return class_exists($controller); // Checks if the controller class exists.
    }

    /*
    |--------------------------------------------------------------------------
    | Method to Check if the Method Exists
    |--------------------------------------------------------------------------
    |
    | This method checks if the specified method exists in the controller instance.
    |
    | @param  object  $controller  The instance of the controller.
    | @param  string  $method      The name of the method to check.
    | @return bool                Returns true if the method exists, false otherwise.
    |
    */
    private function methodExists($controller, $method)
    {
        return method_exists($controller, $method); // Checks if the method exists in the controller instance.
    }

    /*
    |--------------------------------------------------------------------------
    | Method to Send Error Response
    |--------------------------------------------------------------------------
    |
    | This method sends an error response to the client.
    |
    | @param  string  $message   The error message to be sent.
    | @param  int     $code      The HTTP status code to be set.
    |
    */
    private function sendErrorResponse($message, $code)
    {
        http_response_code($code); // Set the HTTP status code.
        echo $message; // Display the error message.
    }
}
