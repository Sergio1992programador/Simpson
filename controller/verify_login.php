<?php
// Inicia la sesión para poder usar variables de sesión
session_start();

// Incluye el encabezado de la página
require_once('../views/components/header.php');

// Incluye la conexión a la base de datos
require_once('../config/dataBase.php');

// Incluye la clase que gestiona el login de usuarios
require_once "UserController.php";

// Recoge los datos del formulario (usuario y contraseña)
$id = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

$database = new Database();
// Conecta a la base de datos 'simpson_db'
$pdo = $database->getConnection();

// Intenta autenticar al usuario con los datos ingresados
$userController = new UserController();
$user = $userController->getVerifiedUser($id, $password);

if ($user) {
    // Si la autenticación es correcta, guarda datos del usuario en la sesión
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nombre'] = $user['usuarioNuevo'];

    // Redirige al panel principal (dashboard)
    header("Location: dashboard.php");
    exit; // Finaliza el script
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Los Simpson</title>

    <!-- Metadatos -->
    <meta name="keywords" content="Lá mejor página">
    <meta name="author" content="Sergio Vallejo">

    <!-- CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../views/resources/css/bootstrap.css">
    <link rel="stylesheet" href="../views/resources/css/formulario.css">

    <!-- PWA Manifest -->
    <link rel="manifest" href="manifest.json">

    <!-- JS -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.js" defer></script>
</head>

<body style="
        background-image: url('../img/lossimpsonss.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        height: 100vh;
    ">
    <?php echo render(); ?>

    <main class="centrado">
        <form style="display: flex; flex-direction: column; align-items: center;">
            <label style="
                    background-color: rgb(255, 237, 78);
                    font-size: 30px;
                    padding: 30px;
                    margin: 0;
                    text-align: center;
                    border-radius: 10px;
                    display: inline-block;
                ">
                Usuario o contraseña incorrectos
            </label>
            <button>
                <a id="enlace" href="login.php" style="text-decoration: none; color: inherit;">Volver</a>
            </button>
        </form>
    </main>

    <footer>
        <strong>&copy; Todos los derechos reservados Sergio 2025</strong>
    </footer>
</body>

</html>