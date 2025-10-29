<?php
// Indicamos que la respuesta será en formato JSON
header("Content-Type: application/json");

// Datos de conexión a la base de datos
$host = 'localhost';
$db = 'simpson_db';
$user = 'root';
$pass = '';

// Cadena de conexión (DSN) y opciones de PDO
$dsn = "mysql:host=$host;dbname=$db;";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Mostrar errores como excepciones
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Obtener resultados como arrays asociativos
];

// Intentamos conectar a la base de datos
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Si falla la conexión, devolvemos error 500 y mensaje
    http_response_code(500);
    echo json_encode(["error" => "Error de conexión: " . $e->getMessage()]);
    exit;
}

// Leemos el cuerpo de la petición (JSON)
$input = file_get_contents("php://input");
$data = json_decode($input, true); // Lo convertimos en array

// Preparamos las consultas SQL
$checkStmt = $pdo->prepare("SELECT COUNT(*) FROM personajes WHERE id = ?");
$insertStmt = $pdo->prepare("INSERT INTO personajes (id, nombre, enlace, imagen, titulo, descripcion) VALUES (?, ?, ?, ?, ?, ?)");

// Contadores para saber cuántos se insertan o se omiten
$insertados = 0;
$omitidos = 0;

// Recorremos cada personaje recibido
foreach ($data as $personaje) {
    // Verificamos si ya existe el personaje por su ID
    $checkStmt->execute([$personaje['id']]);
    $existe = $checkStmt->fetchColumn();

    if ($existe > 0) {
        // Si existe, lo omitimos
        $omitidos++;
        continue;
    }

    // Si no existe, lo insertamos en la base de datos
    $insertStmt->execute([
        $personaje['id'],
        $personaje['nombre'],
        $personaje['enlace'],
        $personaje['imagen'],
        $personaje['titulo'],
        $personaje['descripcion']
    ]);

    $insertados++;
}

// Devolvemos un resumen del proceso en formato JSON
echo json_encode([
    "mensaje" => "Proceso completado.",
    "insertados" => $insertados,
    "omitidos" => $omitidos
]);
?>