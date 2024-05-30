<?php

namespace Src;

use App\Services\UserService; 
use App\Repositories\UserRepository;

use App\Services\PhoneService; 
use App\Repositories\PhoneRepository;

use App\Services\AddressService; 
use App\Repositories\AddressRepository;

use App\Services\ContactService; 
use App\Repositories\ContactRepository;

class Router
{
    private static $routes = [];
    private static $prefix = '';

    public static function setPrefix($prefix)
    {
        self::$prefix = $prefix;
    }

    public static function get($path, $callback)
    {
        self::addRoute('GET', $path, $callback);
    }

    public static function post($path, $callback)
    {
        self::addRoute('POST', $path, $callback);
    }

    public static function put($path, $callback)
    {
        self::addRoute('PUT', $path, $callback);
    }

    public static function delete($path, $callback)
    {
        self::addRoute('DELETE', $path, $callback);
    }

    private static function addRoute($method, $path, $callback)
    {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback
        ];
    }

    public static function dispatch()
    {
        $requestMethod = Request::method();
        $requestUri = Request::uri();

        // Remove prefix if it exists
        if (self::$prefix && strpos($requestUri, self::$prefix) === 0) {
            $requestUri = substr($requestUri, strlen(self::$prefix));
        }

        // Debugging output
        error_log("Request Method: $requestMethod");
        error_log("Request URI: $requestUri");

        foreach (self::$routes as $route) {
            $pattern = '#^' . preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route['path']) . '$#';

            error_log("Checking Route: " . $route['method'] . ' ' . $route['path']);
            error_log("Pattern: $pattern");

            if ($route['method'] === $requestMethod && preg_match($pattern, $requestUri, $matches)) {
                array_shift($matches);

                error_log("Route matched. Executing callback.");

                if (is_callable($route['callback'])) {

                    if (Request::method() === 'PUT' || Request::method() === 'POST') {
                        call_user_func($route['callback'], new Request(), new Response(), ...$matches);
                    }
                    else if (Request::method() === 'GET' || Request::method() === 'DELETE') {
                        call_user_func($route['callback'], new Response(), ...$matches);
                    }

                } else {
                    list($controller, $action) = explode('@', $route['callback']);

                    switch ($controller) {

                        // WEB
                        case 'HomeController':
                            $controller = "App\\Controllers\\$controller";
                            $controllerInstance = new $controller();

                            if (Request::method() === 'PUT' || Request::method() === 'POST') {
                                $controllerInstance->$action(new Request, new Response, ...$matches);
                            } else if (Request::method() === 'GET' || Request::method() === 'DELETE') {
                                call_user_func_array([$controllerInstance, $action], [new Response(), ...$matches]);
                            }

                            break;

                        case 'UserController':
                            $controller = "App\\Controllers\\$controller";
                            $userService = new UserService(new UserRepository());
                            $controllerInstance = new $controller($userService);

                            if (Request::method() === 'PUT' || Request::method() === 'POST') {
                                $controllerInstance->$action(new Request, new Response, ...$matches);
                            } else if (Request::method() === 'GET' || Request::method() === 'DELETE') {
                                call_user_func_array([$controllerInstance, $action], [new Response(), ...$matches]);
                            }

                            break;

                        case 'ContactController':
                            $controller = "App\\Controllers\\$controller";
                            
                            $contactService = new ContactService(new ContactRepository());
                            $controllerInstance = new $controller($contactService);

                            if (Request::method() === 'PUT' || Request::method() === 'POST') {
                                $controllerInstance->$action(new Request, new Response, ...$matches);
                            } else if (Request::method() === 'GET' || Request::method() === 'DELETE') {
                                call_user_func_array([$controllerInstance, $action], [new Response(), ...$matches]);
                            }

                            break;

                        // API
                        case 'UserController':
                            $controller = "App\\Controllers\\Api\\$controller";
                            $userService = new UserService(new UserRepository());
                            $controllerInstance = new $controller($userService);

                            if (Request::method() === 'PUT' || Request::method() === 'POST') {
                                $controllerInstance->$action(new Request, new Response, ...$matches);
                            } else if (Request::method() === 'GET' || Request::method() === 'DELETE') {
                                call_user_func_array([$controllerInstance, $action], [new Response(), ...$matches]);
                            }

                            break;

                        case 'PhoneController':
                            $controller = "App\\Controllers\\Api\\$controller";
                            $phoneService = new PhoneService(new PhoneRepository());
                            $controllerInstance = new $controller($phoneService);

                            if (Request::method() === 'PUT' || Request::method() === 'POST') {
                                $controllerInstance->$action(new Request, new Response, ...$matches);
                            } else if (Request::method() === 'GET' || Request::method() === 'DELETE') {
                                call_user_func_array([$controllerInstance, $action], [new Response(), ...$matches]);
                            }

                            break;

                        case 'AddressController':
                            $controller = "App\\Controllers\\Api\\$controller";
                            $addressService = new AddressService(new AddressRepository(), new ContactRepository());
                            $controllerInstance = new $controller($addressService);

                            if (Request::method() === 'PUT' || Request::method() === 'POST') {
                                $controllerInstance->$action(new Request, new Response, ...$matches);
                            } else if (Request::method() === 'GET' || Request::method() === 'DELETE') {
                                call_user_func_array([$controllerInstance, $action], [new Response(), ...$matches]);
                            }

                            break;

                        case 'ContactController':
                            $controller = "App\\Controllers\\Api\\$controller";
                            $contactService = new ContactService(new ContactRepository());
                            $controllerInstance = new $controller($contactService);

                            if (Request::method() === 'PUT' || Request::method() === 'POST') {
                                $controllerInstance->$action(new Request, new Response, ...$matches);
                            } else if (Request::method() === 'GET' || Request::method() === 'DELETE') {
                                call_user_func_array([$controllerInstance, $action], [new Response(), ...$matches]);
                            }

                            break;
                        
                        default:
                            break;
                    }
                }
                return;
            }
        }

        // If no route was found, return a 404 error
        error_log("No route matched. Returning 404.");
        Response::json(['error' => 'Route not found'], 404);
    }
}
