<?php 

namespace App\Controllers;

use App\Services\UserService;
use App\Http\Request;
use App\Http\Response;

class UserController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Response $response
     * @return Response 
     */
    public function list(Response $response)
    {
        $userService = $this->userService->list();
        
        if (isset($userService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $userService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $userService
        ], 201);
    }

    /**
     * @param Response $response
     * @param int $id
     * @return Response 
     */
    public function get(Response $response, $id)
    {
        $userService = $this->userService->get($id);

        if (isset($userService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $userService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'message' => $userService
        ], 200);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response 
     */
    public function store(Request $request, Response $response)
    {
        if (!$body = $request::body()) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => 'Unable to create user'
            ], 400); 
        }
       
        $userService = $this->userService->store($body);

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

    /**
     * @param Request $request
     * @param Response $response
     * @param int $id
     * @return Response 
     */
    public function update(Request $request, Response $response, $id)
    {
        if (!$body = $request::body()) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => 'Unable to create update'
            ], 400); 
        }

        $userService = $this->userService->update($body, $id);

        if (isset($userService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $userService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'message' => $userService
        ], 200);
    }

    /**
     * @param Response $response
     * @param int $id
     * @return Response 
     */
    public function delete(Response $response, $id)
    {
        $userService = $this->userService->delete($id);

        if (isset($userService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $userService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'message' => $userService
        ], 200);
    }
}
