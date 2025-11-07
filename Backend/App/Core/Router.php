<?php
namespace App\Core;

class Router
{

    public static function route($method, $uri, $data)
    {

        $segments = explode('/', $uri);

        $resource = $segments[0] ?? null;
        $id = $segments[1] ?? null;

        // Primero comprobamos si es login
        if ($segments[0] == 'login' && $method == 'POST') {
            $auth = new \App\Controllers\AuthController();
            $auth->login($data);
            return;
        }

        if ($segments[0] != 'usuarios' || $method != 'POST') {
            // AuthMiddleware::verificarToken();
        }


        $routes = [
            'usuarios' => \App\Controllers\UsuarioController::class,
            'personajes' => \App\Controllers\PersonajeController::class,
            'familia' => \App\Controllers\FamiliaController::class
        ];


        $data = json_decode(file_get_contents("php://input"), true);


        if (isset($routes[$resource])) {
            $controlerClass = $routes[$resource];
            $controller = new $controlerClass();
            switch ($method) {
                case 'GET':
                    $id ? $controller->show($id) : $controller->index();
                    break;
                case 'POST':
                    $controller->store($data);
                    break;
                case 'PUT':
                    $controller->update($id, $data);
                    break;
                case 'DELETE':
                    $controller->destroy($id);
                    break;
                default:
                    http_response_code(405);
                    echo json_encode(['error' => 'Método no permitido']);
            }

        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Ruta no encontrada']);

        }
    }
}




