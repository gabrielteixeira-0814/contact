<?php

namespace App\Repositories;

use App\Models\Address;
use Exception;

class AddressRepository implements AddressRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new Address;
    }

    public function list()
    {
        try {
            return $this->model->with('contacts')->get();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function get($id)
    {
        try {
            if (!$address = $this->model->find($id)) {
                return ['error' => 'Sorry, the address could not be found.'];
            }
            return $address;
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function store(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update(array $data, $id)
    {
        try {
            if (!$address = $this->model->find($id)) {
                return ['error'=> 'Sorry, Unable to find address'];
            }

            if (!$address->update($data)) {
                return ['error'=> 'Sorry, Unable to edit address.'];
            }

            return $address->refresh();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete($id)
    {
        try {
            if (!$address = $this->model->find($id)) {
                return ['error' => 'Sorry, the address could not be found.'];
            }

            if (!$address->delete()) {
                return ['error'=> 'Sorry, unable to delete address.'];
            }

            return "Address deleted successfully!";
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function checkAddress($contact_id)
    {
        return $this->model->where('contact_id', '=', $contact_id)->count() > 0;
    }

    private function handleException(Exception $e)
    {
        if (isset($e->errorInfo[0]) && $e->errorInfo[0] === '08006') {
            return ['error' => 'Sorry, we could not connect to the database.'];
        }

        return ['error' => $e->getMessage()];
    }
}
