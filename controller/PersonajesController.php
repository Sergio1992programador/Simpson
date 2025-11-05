<?php

require_once('../models/Personaje.php');

class PersonajesController
{


    public static function index()
    {
        return Personaje::all();
    }

    public static function create($data)
    {
        return Personaje::create($data);
    }

    public static function edit($id, $data)
    {
        return Personaje::update($id, $data);
    }

    public static function delete($id)
    {
        return Personaje::delete($id);
    }

    public function show($id)
    {
        return Personaje::find($id);
    }
}
