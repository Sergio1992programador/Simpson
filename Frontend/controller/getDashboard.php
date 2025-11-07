<?php
// Verifica si la petición es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtiene el valor enviado por POST con la clave 'dato' (o cadena vacía si no existe)
    $dato = $_POST['dato'] ?? '';

    // Si el usuario está autenticado (existe 'user_id' en la sesión), muestra el dato
    // Si no, muestra 'sinverificado.php'
    echo isset($_SESSION['user_id']) ? $dato : 'sinverificado.php';
}
?>