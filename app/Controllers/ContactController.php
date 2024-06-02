<?php

namespace App\Controllers;

use App\Utils\RenderView;
use App\Services\ContactService;
use Src\Request;
use Src\Response;

class ContactController extends RenderView
{
    private $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * @param Response $response
     * @return Response 
     */
    public function list(Response $response)
    {
        $contactService = $this->contactService->list();
        
        if (isset($contactService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $contactService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $contactService
        ], 201);
    }

    /**
     * @param Response $response
     * @param int $id
     * @return Response 
     */
    public function get(Response $response, $id)
    {
        $contactService = $this->contactService->get($id);

        if (isset($contactService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $contactService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'message' => $contactService
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
                'message' => 'Unable to create contact'
            ], 400); 
        }
       
        $contactService = $this->contactService->store($body);

        if (isset($contactService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $contactService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $contactService
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
                'message' => 'Unable to update'
            ], 400); 
        }

        $contactService = $this->contactService->update($body, $id);

        if (isset($contactService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $contactService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'message' => $contactService
        ], 200);
    }

    /**
     * @param Response $response
     * @param int $id
     * @return Response 
     */
    public function delete(Response $response, $id)
    {
        $contactService = $this->contactService->delete($id);

        if (isset($contactService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $contactService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'message' => $contactService
        ], 200);
    }
}
