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

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table . " (nombre, apellidos, email, telefono, nombreUsuario, password) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$data['nombre'], $data['apellidos'], $data['email'], $data['telefono'], $data['nombreUsuario'], $data['password']]);
    }

    public function update($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE " . $this->table . " SET nombre = ?, apellidos = ?, email = ?, telefono = ?, nombreUsuario = ?, password = ?, = ? WHERE id = ?");
        return $stmt->execute([$data['nombre'], $data['apellidos'], $data['email'], $data['telefono'], $data['nombreUsuario'], $data['password'], $id]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table . " WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function authenticate($nombre, $password)
    {
        echo "{$nombre}" . "{$password}";
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE nombre_usuario = ?");
        $stmt->execute([$nombre]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "{$user['id']}";
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return false;
    }
}