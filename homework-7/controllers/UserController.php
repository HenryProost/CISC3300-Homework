<?php

namespace controllers;

use models\User;


class UserController
{
    public function getHTML()
    {
        include 'views/users.html';
    }

    public function getJSON()
    {
        $users = new User();
        header('Content-Type: application/json');
        echo json_encode($users->getAllUsers());
    }

}