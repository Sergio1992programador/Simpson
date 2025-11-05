<?php

require_once('../models/User.php');

class UserController
{


    public static function index()
    {
        return User::all();
    }

    public static function create($data)
    {
        return User::create($data);
    }

    public static function edit($id, $data)
    {
        return User::update($id, $data);
    }

    public static function delete($id)
    {
        return User::delete($id);
    }

    public static function getVerifiedUser($id, $password)
    {
        return User::authenticate($id, $password);
    }
}
