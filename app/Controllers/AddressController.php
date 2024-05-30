<?php

namespace App\Controllers;

use App\Utils\RenderView;
use App\Services\AddressService;
use Src\Request;
use Src\Response;

class AddressController extends RenderView
{
    private $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * @param Response $response
     * @return Response 
     */
    public function list(Response $response)
    {
        $addressService = $this->addressService->list();
        
        if (isset($addressService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $addressService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $addressService
        ], 201);
    }

    /**
     * @param Response $response
     * @param int $id
     * @return Response 
     */
    public function get(Response $response, $id)
    {
        $addressService = $this->addressService->get($id);

        if (isset($addressService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $addressService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'message' => $addressService
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
                'message' => 'Unable to create address'
            ], 400); 
        }
       
        $addressService = $this->addressService->store($body);

        if (isset($addressService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $addressService['error']
            ], 400);
        }

        $response::json([
            'error'   => false,
            'success' => true,
            'data'    => $addressService
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

        $addressService = $this->addressService->update($body, $id);

        if (isset($addressService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $addressService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'message' => $addressService
        ], 200);
    }

    /**
     * @param Response $response
     * @param int $id
     * @return Response 
     */
    public function delete(Response $response, $id)
    {
        $addressService = $this->addressService->delete($id);

        if (isset($addressService['error'])) {

            return $response::json([
                'error'   => true,
                'success' => false,
                'message' => $addressService['error']
            ], 400);
        }

        return $response::json([
            'error'   => false,
            'success' => true,
            'message' => $addressService
        ], 200);
    }
}
