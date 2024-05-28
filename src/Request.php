<?php

namespace Src;

class Request
{
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function uri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?');
        return rtrim($uri, '/');
    }

    public static function body()
    {
        $input = file_get_contents('php://input');
        return json_decode($input, true) ?? [];
    }
}
