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

        $routes = [
            'usuarios' => [
                'controller' => \App\Controllers\UsuarioController::class,
                'public' => ['POST'] // solo POST es público (crear usuario)
            ],
            'personajes' => [
                'controller' => \App\Controllers\PersonajeController::class,
                'public' => ['GET'] // permite GET sin token
            ],
            'familia' => [
                'controller' => \App\Controllers\FamiliaController::class,
                'public' => ['GET'] // permite GET sin token
            ]
        ];


        if (isset($routes[$resource])) {
            $routeConfig = $routes[$resource];
            $controlerClass = $routeConfig['controller'];
            $controller = new $controlerClass();

            $publicMethods = $routeConfig['public'] ?? [];
            if (!in_array($method, $publicMethods)) {
                AuthMiddleware::verificarToken(); // solo si no es público
            }

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




