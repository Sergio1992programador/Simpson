<?php

require_once('../config/dataBase.php');

class User
{
    private static $table = "usuarios";  // ***

    public static function all()
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM " . self::$table);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM " . self::$table . " WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $conn = Database::getConnection();
        // Verificar si el usuario ya existe
        $stmt = $conn->prepare("SELECT * FROM " . self::$table . " WHERE nombre_usuario = ?");
        $stmt->execute([$data['nombre_usuario']]);
        if ($stmt->fetch()) {
            return false; // Usuario ya existe
        }

        // Hashear la contraseña
        $password_hash = password_hash($data['password_hash'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO " . self::$table . " (nombre, apellidos, email, telefono, nombre_usuario, password_hash) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$data['nombre'], $data['apellidos'], $data['email'], $data['telefono'], $data['nombre_usuario'], $password_hash]);
    }

    public static function update($id, $data)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE " . self::$table . " SET nombre = ?, apellidos = ?, email = ?, telefono = ?, nombreUsuario = ?, password = ? WHERE id = ?");
        return $stmt->execute([$data['nombre'], $data['apellidos'], $data['email'], $data['telefono'], $data['nombre_usuario'], $data['password_hash'], $id]);
    }

    public static function delete($id)
    {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM " . self::$table . " WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function authenticate($nombre, $password)
    {
        $conn = Database::getConnection();
        // Preparar la consulta para buscar el usuario por nombre de usuario
        $stmt = $conn->prepare("SELECT * FROM " . self::$table . " WHERE nombre_usuario = ?");
        $stmt->execute([$nombre]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró el usuario y si la contraseña coincide
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }

        return false;
    }
}