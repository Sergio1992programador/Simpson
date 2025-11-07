<?php
// El controlador es el que contiene la lógica real de los endpoints (CRUD, validaciones…).
namespace App\Controllers;
use App\Models\Personaje;

class PersonajeController
{

    public function index()
    {
        echo json_encode(Personaje::all());
    }

    public function show($id)
    {
        $personaje = Personaje::find($id);
        if (!$personaje) {
            http_response_code(404);
            echo json_encode(['mensaje' => 'Personaje no encontrado']);
        } else {
            echo json_encode($personaje);
        }
    }

    public function store($data)
    {
        if (!isset($data['nombre']) || !isset($data['enlace']) || !isset($data['imagen']) || !isset($data['titulo']) || !isset($data['descripcion'])) {
            http_response_code(400);
            echo json_encode(['mensaje' => 'Datos incompletos']);
            return;
        }
        $personaje = Personaje::create($data);
        http_response_code(201);
        echo json_encode($personaje);
    }

    public function update($id, $data)
    {
        $personaje = Personaje::update($id, $data);
        if (!$personaje) {
            http_response_code(404);
            echo json_encode(['mensaje' => 'Personaje no encontrado']);
        } else {
            echo json_encode($personaje);
        }
    }

    public function delete($id)
    {
        $result = Personaje::delete($id);
        if ($result) {
            echo json_encode(['mensaje' => 'Personaje eliminado']);
        } else {
            http_response_code(404);
            echo json_encode(['mensaje' => 'Personaje no encontrado']);
        }
    }

}
