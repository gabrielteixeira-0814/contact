<?php 

namespace App\Http;

class Request
{
    public static function method()
    {
        return $_SERVER["REQUEST_METHOD"];
    }

    public static function body()
    {
        $json = json_decode(file_get_contents('php://input'), true) ?? [];

        $method = self::method();
        $data = [];

        switch ($method) {
            case 'GET':
                $data = $_GET;
                break;
            case 'POST':
            case 'PUT':
            case 'DELETE':
                $data = $json;
                break;
            default:
                $data = [];
        }

        return $data;
    }

    // public static function authorization()
    // {
    //     $authorization = self::getHeaders();

    //     if (!isset($authorization['Authorization'])) {
    //         return ['error' => 'Sorry, no authorization header provided'];
    //     }

    //     $authorizationPartials = explode(' ', $authorization['Authorization']);

    //     if (count($authorizationPartials) != 2) {
    //         return ['error' => 'Please, provide a valid authorization header.'];
    //     }

    //     return $authorizationPartials[1] ?? '';
    // }

    // private static function getHeaders()
    // {
    //     if (function_exists('getallheaders')) {
    //         return getallheaders();
    //     }
        
    //     $headers = [];
    //     foreach ($_SERVER as $name => $value) {
    //         if (substr($name, 0, 5) == 'HTTP_') {
    //             $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
    //         }
    //     }
    //     return $headers;
    // }
}
