<?php
$dsn = 'mysql:host=localhost;dbname=jump_tracker';
$username = 'root';
//password

try 
{
    $db = new PDO($dsn, $username);
} catch (PDOException $e) {
    $error = "Batabase Error: ";
    $error .= $e->getMessage();
    include('view/error.php');
    exit();
}