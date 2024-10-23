<?php

namespace controllers;

use models\User;

class UserController
{
    public function index()
    {
        $user = new User();
        var_dump ($user->getAllUsers());
    }
}