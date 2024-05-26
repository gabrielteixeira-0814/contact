<?php 

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\UserService;

class UserController
{
    public function get(Response $response, $id)
    {
        $userService = UserService::get($id);

        if (isset($userService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $userService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'message' => $userService
        ], 200);
        return;
    }

    public function store(Request $request, Response $response)
    {
        if (!$body = $request::body()) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => 'Unable to create user'
            ], 400); 
        }
       
        $userService = UserService::create($body);

        if (isset($userService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $userService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $userService
        ], 201);
    }

    public function update(Request $request, Response $response, $id)
    {
        if (!$body = $request::body()) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => 'Unable to create update'
            ], 400); 
        }

        $userService = UserService::update($body, $id);

        if (isset($userService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $userService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'message' => $userService
        ], 200);
        return;
    }

    public function delete(Response $response, $id)
    {
        $userService = UserService::delete($id);

        if (isset($userService['error'])) {
            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $userService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'message' => $userService
        ], 200);
        return;
    }
}