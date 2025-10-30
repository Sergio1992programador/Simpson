<?php

require_once('../models/User.php');

class UserController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        return $this->user->all();
    }

    public function create($data)
    {
        return $this->user->create($data);
    }

    public function edit($id, $data)
    {
        return $this->user->update($id, $data);
    }

    public function delete($id)
    {
        return $this->user->delete($id);
    }

    public function getVerifiedUser($id, $password)
    {
        return $this->user->authenticate($id, $password);
    }
}
