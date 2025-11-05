<?php

require_once('../config/dataBase.php');

class Personaje
{
    private static $table = "personajes";  // ***

    public static function all()
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM " . self::$table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM " . self::$table . " WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO " . self::$table . " (nombre, enlace, imagen, titulo, descripcion) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$data['nombre'], $data['enlace'], $data['imagen'], $data['titulo'], $data['descripcion']]);
    }

    public static function update($id, $data)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE " . self::$table . " SET nombre = ?, enlace = ?, imagen = ?, titulo = ?, descripcion = ?, WHERE id = ?");
        return $stmt->execute([$data['nombre'], $data['enlace'], $data['imagen'], $data['titulo'], $data['descripcion'], $id]);
    }

    public static function delete($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM " . self::$table . " WHERE id = ?");
        return $stmt->execute([$id]);
    }
}