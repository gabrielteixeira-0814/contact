<?php 

namespace App\Core;

use App\Http\Request;
use App\Http\Response;

class Core 
{
    public static function dispatch(array $routes, array $dependencies)
    {
        $url = '/';

        isset($_GET['url']) && $url .= $_GET['url'];

        $url !== '/' && $url = rtrim($url, '/');

        $prefixController = 'App\\Controllers\\';

        $routeFound = false;

        foreach ($routes as $route) {
            $pattern = '#^'. preg_replace('/{id}/', '([\w-]+)', $route['path']) .'$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $routeFound = true;

                if ($route['method'] !== Request::method()) {
                    Response::json([
                        'error'   => true,
                        'success' => false,
                        'message' => 'Sorry, method not allowed.'
                    ], 405);
                    return;
                }

                [$controller, $action] = explode('@', $route['action']);

                $controller = $prefixController . $controller;
                
                // Verifique se a classe do controlador existe
                if (!class_exists($controller)) {
                    Response::json([
                        'error'   => true,
                        'success' => false,
                        'message' => 'Controller not found.'
                    ], 404);
                    return;
                }

                // Obtém a dependência correta para o controlador
                $controllerInstance = new $controller($dependencies[$controller]);

                // Verifique se o método existe no controlador
                if (!method_exists($controllerInstance, $action)) {
                    Response::json([
                        'error'   => true,
                        'success' => false,
                        'message' => 'Action not found.'
                    ], 404);
                    return;
                }

                // Lida com os diferentes métodos HTTP e seus parâmetros
                if (Request::method() === 'PUT' || Request::method() === 'POST') {
                    $controllerInstance->$action(new Request, new Response, ...$matches);
                }
                else if (Request::method() === 'GET' || Request::method() === 'DELETE') {
                    $controllerInstance->$action(new Response, ...$matches);
                }
                else {
                    // Método HTTP não suportado
                    Response::json([
                        'error'   => true,
                        'success' => false,
                        'message' => 'HTTP method not supported.'
                    ], 405);
                }

                return; // Saia do loop após encontrar e despachar a rota
            }
        }

        // Se nenhuma rota foi encontrada, use o controlador NotFound
        if (!$routeFound) {
            $controller = $prefixController . 'NotFoundController';
            $controllerInstance = new $controller();
            $controllerInstance->index(new Request, new Response);
        }
    }
}
