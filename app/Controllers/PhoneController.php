<?php

namespace App\Controllers;

use App\Utils\RenderView;
use App\Services\PhoneService;
use Src\Request;
use Src\Response;

class PhoneController extends RenderView
{
    private $phoneService;

    public function __construct(PhoneService $phoneService)
    {
        $this->phoneService = $phoneService;
    }

    /**
     * @param Response $response
     * @return Response 
     */
    public function list(Response $response)
    {
        $phoneService = $this->phoneService->list();
        
        if (isset($phoneService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $phoneService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $phoneService
        ], 201);
    }

    /**
     * @param Response $response
     * @param int $id
     * @return Response 
     */
    public function get(Response $response, $id)
    {
        $phoneService = $this->phoneService->get($id);

        if (isset($phoneService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $phoneService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'message' => $phoneService
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
                'message' => 'Unable to create phone'
            ], 400); 
        }
       
        $phoneService = $this->phoneService->store($body);

        if (isset($phoneService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $phoneService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $phoneService
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

        $phoneService = $this->phoneService->update($body, $id);

        if (isset($phoneService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $phoneService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'message' => $phoneService
        ], 200);
    }

    /**
     * @param Response $response
     * @param int $id
     * @return Response 
     */
    public function delete(Response $response, $id)
    {
        $phoneService = $this->phoneService->delete($id);

        if (isset($phoneService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $phoneService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'message' => $phoneService
        ], 200);
    }
}
