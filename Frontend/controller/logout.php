<?php
// Inicia la sesión para poder manipularla
session_start();

// Elimina todas las variables de sesión
session_unset();

// Destruye la sesión completamente
session_destroy();

// Redirige al login tras cerrar sesión
header("Location:../views/login.php");
exit;