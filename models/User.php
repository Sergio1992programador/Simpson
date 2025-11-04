<?php

require_once('../config/dataBase.php');

class User
{
    private $conn;
    private $table = "usuarios";  // ***

    public $id;
    public $nombre;
    public $apellidos;
    public $email;
    public $telefono;
    public $nombreUsuario;
    public $password;



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

    public static function register($pdo, $nombre, $apellidos, $email, $telefono, $usuarioNuevo, $password)
    {
        // Verificar si el usuario ya existe
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");
        $stmt->execute([$usuarioNuevo]);
        if ($stmt->fetch()) {
            return false; // Usuario ya existe
        }

        // Hashear la contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar nuevo usuario
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellidos, email, telefono, nombre_usuario, password_hash) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $apellidos, $email, $telefono, $usuarioNuevo, $password_hash]);
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table . " (nombre, apellidos, email, telefono, nombre_usuario, password_hash) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$data['nombre'], $data['apellidos'], $data['email'], $data['telefono'], $data['nombre_usuario'], $data['password_hash']]);
    }

    public function update($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE " . $this->table . " SET nombre = ?, apellidos = ?, email = ?, telefono = ?, nombreUsuario = ?, password = ?, = ? WHERE id = ?");
        return $stmt->execute([$data['nombre'], $data['apellidos'], $data['email'], $data['telefono'], $data['nombre_usuario'], $data['password_hash'], $id]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table . " WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function authenticate($nombre, $password)
    {
        // Preparar la consulta para buscar el usuario por nombre de usuario
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE nombre_usuario = ?");
        $stmt->execute([$nombre]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró el usuario y si la contraseña coincide
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }

        return false;
    }
}