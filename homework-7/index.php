<?php

require_once 'C:\Users\hjpro\OneDrive\Desktop\GitRepo\CISC3300-Homework\homework-7\models\User.php';
require_once 'C:\Users\hjpro\OneDrive\Desktop\GitRepo\CISC3300-Homework\homework-7\controllers\UserController.php';
use models\User;
use controllers\UserController;

// Parse the URL path and request method
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Create an instance of UserController
$controller = new UserController();

// Handle different routes
if ($requestMethod === 'GET' && $requestUri === '/users') {
    $controller->getJSON(); // Serve JSON data
} else {
    $controller->getHTML(); // Serve HTML page
}