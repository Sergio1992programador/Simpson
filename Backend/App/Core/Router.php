<?php
namespace App\Core;

class Router
{
    public static function route($method, $uri, $data)
    {
        $segments = explode('/', $uri);
        $resource = $segments[0] ?? null;
        $id = $segments[1] ?? null;

        // Login directo
        if ($resource === 'login' && $method === 'POST') {
            $auth = new \App\Controllers\AuthController();
            $auth->login($data);
            return;
        }

        $routes = [
            'usuarios' => [
                'controller' => \App\Controllers\UsuarioController::class,
                'public' => ['POST']
            ],
            'personajes' => [
                'controller' => \App\Controllers\PersonajeController::class,
                'public' => ['GET'],
                'params' => ['f']
            ],
            'familias' => [
                'controller' => \App\Controllers\FamiliaController::class,
                'public' => ['GET', 'POST']
            ]
        ];

        if (isset($routes[$resource])) {
            $routeConfig = $routes[$resource];
            $controllerClass = $routeConfig['controller'];
            $controller = new $controllerClass();

            $publicMethods = $routeConfig['public'] ?? [];
            if (!in_array($method, $publicMethods)) {
                AuthMiddleware::verificarToken();
            }

            switch ($method) {
                case 'GET':
                    $queryParams = $_GET;
                    $filteredParams = [];

                    // Extraer parámetros definidos en la ruta
                    if (!empty($routeConfig['params'])) {
                        foreach ($routeConfig['params'] as $paramName) {
                            if (isset($queryParams[$paramName])) {
                                $filteredParams[$paramName] = $queryParams[$paramName];
                            }
                        }
                    }

                    // Si hay parámetros válidos, pásalos al controlador
                    if (!empty($filteredParams)) {
                        $controller->index($filteredParams);
                    } else {
                        $id ? $controller->show($id) : $controller->index();
                    }
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
