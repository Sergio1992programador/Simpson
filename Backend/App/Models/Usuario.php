<?php
namespace App\Models;
use App\Core\Database;
use PDO;
class Usuario
{

    public static function all()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO usuarios (nombre, apellidos, email, telefono, nombre_usuario, password_hash) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$data['nombre'], $data['apellidos'], $data['email'], $data['telefono'], $data['nombre_usuario'], $data['password_hash']]);
        return self::find($db->lastInsertId());
    }

    public static function update($id, $data)
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, email = ?, telefono = ?, nombre_usuario = ?, password_hash = ?  WHERE id = ?");
        $stmt->execute([$data['nombre'], $data['apellidos'], $data['email'], $data['telefono'], $data['nombre_usuario'], $data['password_hash'], $id]);
        return self::find($id);
    }

    public static function delete($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

}


