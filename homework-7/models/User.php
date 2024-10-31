<?php

namespace models;

class User
{
    public function getAllUsers()
    {
        return [
            [
                "id" => 1,
                "name" => "Alice",
                "email" => "a.test@gmail.com"
            ],
            [
                "id" => 2,
                "name" => "Bob",
                "email" => "b.test@gmail.com"
            ],
            [
                "id" => 3,
                "name" => "Charlie",
                "email" => "c.test@gmail.com"
            ]
        ];
    }
}