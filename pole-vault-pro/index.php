<?php
require('model/database.php');
require('model/jumps_db.php');
require('model/session_db.php');

// Start session if needed
session_start();

// Handle routing
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_jumps';
    }
}

// Route to appropriate view
switch ($action) {
    case 'list_jumps':
        include('view/jump_list.html');
        break;
    case 'list_sessions':
        include('view/sessions.html');
        break;
    default:
        include('view/sessions.html');
        break;
}