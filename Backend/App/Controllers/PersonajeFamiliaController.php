<?php
// El controlador es el que contiene la lógica real de los endpoints (CRUD, validaciones…).
namespace App\Controllers;
require_once __DIR__ . '/../models/PersonajeFamilia.php';

class PersonajeFamiliaController
{

    public function index()
    {
        echo json_encode(PersonajeFamilia::all());
    }

    public function show($id)
    {
        $personajeFamilia = PersonajeFamilia::find($id);
        if (!$personajeFamilia) {
            http_response_code(404);
            echo json_encode(['mensaje' => 'Personaje no encontrado']);
        } else {
            echo json_encode($personajeFamilia);
        }
    }

    public function store($data)
    {
        if (!isset($data['personaje_id']) || !isset($data['familia_id'])) {
            http_response_code(400);
            echo json_encode(['mensaje' => 'Datos incompletos']);
            return;
        }
        $personajeFamilia = PersonajeFamilia::create($data);
        http_response_code(201);
        echo json_encode($personajeFamilia);
    }

    public function update($id, $data)
    {
        $personajeFamilia = PersonajeFamilia::update($id, $data);
        if (!$personajeFamilia) {
            http_response_code(404);
            echo json_encode(['mensaje' => 'Personaje no encontrado']);
        } else {
            echo json_encode($personajeFamilia);
        }
    }

    public function delete($id)
    {
        $result = PersonajeFamilia::delete($id);
        if ($result) {
            echo json_encode(['mensaje' => 'Personaje eliminado']);
        } else {
            http_response_code(404);
            echo json_encode(['mensaje' => 'Personaje no encontrado']);
        }
    }

}
