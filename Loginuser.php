<?php

// Incluye el archivo de conexión a la base de datos
require_once "db.php";

// Clase para manejar el registro y autenticación de usuarios
class Loginuser
{
    // Método para registrar un nuevo usuario
    public static function register($pdo, $nombre, $apellidos, $email, $telefono, $usuarioNuevo, $password_hash)
    {
        // Encripta la contraseña antes de guardarla
        $hash = password_hash($password_hash, PASSWORD_DEFAULT);

        // Prepara la consulta para insertar el nuevo usuario
        $stmt = $pdo->prepare("INSERT INTO loginuser(nombre, apellidos, email, telefono, usuarioNuevo, password_hash) VALUES (?, ?, ?, ?, ?, ?)");

        // Ejecuta la consulta con los datos del usuario
        return $stmt->execute([$nombre, $apellidos, $email, $telefono, $usuarioNuevo, $hash]);
    }

    // Método para autenticar al usuario
    public static function authenticate($pdo, $nombre, $password)
    {
        // Busca el usuario por su nombre de usuario
        $stmt = $pdo->prepare("SELECT * FROM loginuser WHERE usuarioNuevo = ?");
        $stmt->execute([$nombre]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica si la contraseña coincide con la almacenada
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user; // Autenticación exitosa
        }

        return false; // Fallo en la autenticación
    }
}
?>