<?php

namespace App\Repositories;

use App\Database\Connection;
use PDO;
use App\Models\Address;

class AddressRepository implements AddressRepositoryInterface
{
    private $connection;
    private $model;

    public function __construct()
    {
        $this->model = new Address;
    }

    public function list()
    {
        try {

            return $this->model->with('contacts')->get();
        }
        catch (Exception $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];

            return ['error' => $e->getMessage()];
        }
    }

    public function get($id)
    {
        try {
            if (!$address = $this->model->find($id)) {

                return ['error' => 'Sorry, the address could not be found.'];
            }

            return $address;
        }
        catch (Exception $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];

            return ['error' => $e->getMessage()];
        }
    }

    public function store(array $data)
    {
        try {

            return $this->model->create($data);
        }
        catch (Exception $e) {

            return ['error' => $e->getMessage()];
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
        }
        catch (Exception $e) {
            if (isset($e->errorInfo[0])) {
                if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            }

            return ['error' => $e->getMessage()];
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
        } 
        catch (Exception $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            return ['error' => $e->getMessage()];
        }
    }

    public function checkAddress($contact_id)
    {
        $address = $this->model->where('contact_id', '=', $contact_id)->count();
        if ($address > 0) {
            return true;
        }

        return false;
    }
}
?>
