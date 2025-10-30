<?php

require_once('../models/Personaje.php');

class PersonajesController
{
    private $personajes;

    public function __construct()
    {
        $this->personajes = new Personaje();
    }

    public function index()
    {
        return $this->personajes->all();
    }

    public function create($data)
    {
        return $this->personajes->create($data);
    }

    public function edit($id, $data)
    {
        return $this->personajes->update($id, $data);
    }

    public function delete($id)
    {
        return $this->personajes->delete($id);
    }

    public function show($id)
    {
        return $this->personajes->find($id);
    }
}
