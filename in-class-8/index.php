<?php

require_once 'C:\Users\hjpro\OneDrive\Desktop\GitRepo\CISC3300-Homework\in-class-8\models\User.php';
require_once 'C:\Users\hjpro\OneDrive\Desktop\GitRepo\CISC3300-Homework\in-class-8\controllers\UserController.php';

use models\User;
use controllers\UserController;

$controller = new UserController();
$controller->index();