<?php
session_start(); // Inicia la sesión

require_once "../models/User.php";
require_once(__DIR__ . "/components/header.php");
require_once "../config/dataBase.php";
require_once "../controller/UserController.php";
$v = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'nombre' => $_POST['nombre'],
        'apellidos' => $_POST['apellidos'],
        'email' => $_POST['email'],
        'telefono' => $_POST['numero'],
        'nombre_usuario' => $_POST['usuario_nuevo'],
        'password_hash' => $_POST['password_hash']
    ];

    if (UserController::create($data)) {
        $user = UserController::getVerifiedUser($data['nombre'], $data['password_hash']);
        // Guardar datos en la sesión
        $_SESSION['nombre'] = $user['usuario_nuevo'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['usuario'] = [
            'nombre' => $data['nombre'],
            'apellidos' => $data['apellidos'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'usuario' => $data['nombre_usuario']
        ];


        header('Location: ../dashboard.php');
        exit;
    } else {
        header('Location: ../controller/verify_login2.php');
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="resources/css/bootstrap.css">
    <link rel="stylesheet" href="resources/css/formulario.css">
    <script type="text/javascript" src="../bootstrap/js/bootstrap.bundle.js" defer></script>
    <meta name="keywords" content="Lá mejor página">
    <meta name="author" content="Sergio Vallejo">
    <title>Personajes</title>
</head>

<body>
    <?= render(); ?>
    <main>
        <section>
            <div class="container-fluid">
                <div id="character-container"
                    class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 m-4 justify-content-lg-center">
                    <form action="#" method="post" id="registroForm">
                        <fieldset>
                            <legend>Datos de usuario</legend>

                            <label for="nombre">Nombre:</label>
                            <br>
                            <input type="text" name="nombre" id="nombre" placeholder="Ponga su nombre" maxlength="25"
                                required>
                            <br>
                            <label for="apellidos">Apellidos:</label>
                            <br>
                            <input type="text" name="apellidos" id="apellidos" placeholder="Ponga sus apellidos"
                                maxlength="30" required>
                            <br>
                            <label for="email">Email:</label>
                            <br>
                            <input type="email" name="email" id="email" placeholder="Ponga su email" required>
                            <br>
                            <label for="numero">Teléfono:</label>
                            <br>
                            <input type="number" name="numero" id="numero" placeholder="Ponga su teléfono" required>
                            <br>
                            <label for="usuarioNuevo" name="usuario_nuevo" id="usuarioNuevo">Usuario nuevo:</label>
                            <br>
                            <input type="text" name="usuario_nuevo" id="usuarioNuevo" placeholder="Nombre del Usuario"
                                required>
                            <br>
                            <label for="password" name="password_hash" id="password">Contraseña:</label>
                            <br>
                            <input type="password" name="password_hash" id="password" placeholder="Ponga su contraseña"
                                required>
                            <br>
                            <br>
                            <div class="centrado">
                                <button type="submit">Registrarse</button>
                                <button type="reset">Limpiar</button>
                                <br>
                                <br>
                            </div>
                            <div class="centrado">
                                <button type="button" onclick="window.location.href='login.php'">Volver</button>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>
        </section>
        <article>

        </article>
        <aside>

        </aside>
    </main>
    <footer>
        <strong>&copy; Todos los derechos reservados Sergio 2025</strong>
    </footer>
    <script>
        // Registrar Service Worker
        // if ('serviceWorker' in navigator) {
        //     navigator.serviceWorker.register("/lossimpson/index.html")
        //         .then(reg => console.log('Service Worker registrado:', reg))
        //         .catch(err => console.error('Error registrando Service Worker:', err));
        // }
    </script>
</body>

</html>