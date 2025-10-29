<?php
// Función para conectar a la base de datos
function connect($database, $user = "root", $password = "", $server = "localhost")
{
    try {
        // Crea una conexión PDO con los datos proporcionados
        $pdo = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $user, $password);

        // Configura PDO para lanzar excepciones si hay errores
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Devuelve el objeto de conexión
        return $pdo;
    } catch (PDOException $e) {
        // Si falla la conexión, muestra el mensaje de error y detiene el script
        die("Error DB: " . $e->getMessage());
    }
}

// Función para cerrar la conexión (asigna null)
function disconnect($con)
{
    $con = null;
}


