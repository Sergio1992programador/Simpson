<?php
// Incluye el archivo de conexión a la base de datos
require_once(__DIR__ . "/db.php");

// Indica que la respuesta será en formato JSON
header("Content-Type: application/json");

// Conecta a la base de datos 'simpson_db'
$pdo = connect("simpson_db");

// Obtiene el parámetro 'f' de la URL (ID de familia), si existe
$familiaId = isset($_GET['f']) ? intval($_GET['f']) : null;

try {
    if ($familiaId !== null) {
        // Si se especifica una familia, consulta personajes de esa familia
        $stmt = $pdo->prepare("
            SELECT p.* 
            FROM personajes p
            INNER JOIN personajes_familias pf ON p.id = pf.personaje_id
            WHERE pf.familia_id = :familiaId
        ");
        $stmt->execute(['familiaId' => $familiaId]);
    } else {
        // Si no se especifica familia, consulta todos los personajes
        $stmt = $pdo->query("SELECT * FROM personajes");
    }

    // Obtiene todos los resultados y los convierte a JSON
    $personaje = $stmt->fetchAll();
    echo json_encode($personaje);
} catch (PDOException $e) {
    // Si hay error en la consulta, devuelve código 500 y mensaje
    http_response_code(500);
    echo json_encode(["error" => "Error al consultar la base de datos: " . $e->getMessage()]);
}
?>