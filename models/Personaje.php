<?php

require_once('../config/dataBase.php');

class Personaje
{
    private $conn;
    private $table = "personajes";  // ***

    public $id;
    public $nombre;
    public $enlace;
    public $imagen;
    public $titulo;
    public $descripcion;


    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function all()
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table . " (nombre, enlace, imagen, titulo, descripcion) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$data['nombre'], $data['enlace'], $data['imagen'], $data['titulo'], $data['descripcion']]);
    }

    public function update($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE " . $this->table . " SET nombre = ?, enlace = ?, imagen = ?, titulo = ?, descripcion = ?, WHERE id = ?");
        return $stmt->execute([$data['nombre'], $data['enlace'], $data['imagen'], $data['titulo'], $data['descripcion'], $id]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table . " WHERE id = ?");
        return $stmt->execute([$id]);
    }
}