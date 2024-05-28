<?php

namespace App\Repositories;

use App\Database\Connection;
use PDO;
use App\Models\Phone;

class PhoneRepository implements PhoneRepositoryInterface
{
    private $connection;
    private $model;

    public function __construct()
    {
        $this->model = new Phone;
        // $this->connection = Connection::getConnection();
    }

    public function list()
    {
        try {

            return $this->model->all();
        }
        catch (Exception $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];

            return ['error' => $e->getMessage()];
        }
    }

    public function get($id)
    {
        try {
            if (!$phone = $this->model->find($id)) {

                return ['error' => 'Sorry, the phone could not be found.'];
            }

            return $phone;
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
            if (!$phone = $this->model->find($id)) {

                return ['error'=> 'Sorry, Unable to find phone'];
            }

            if (!$phone->update($data)) {

                return ['error'=> 'Sorry, Unable to edit phone.'];
            }

            return $phone->refresh();
        }
        catch (Exception $e) {
            if (isset($e->errorInfo[0])) {
                if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
                if ($e->errorInfo[0] === '23000') return ['error' => 'Sorry, This email is already registered.'];
                if ($e->errorInfo[0] === '23505') return ['error' => 'Sorry, phone already exists.'];
            }

            return ['error' => $e->getMessage()];
        }
    }

    public function delete($id)
    {
        try {
            if (!$phone = $this->model->find($id)) {
                return ['error' => 'Sorry, the phone could not be found.'];
            }

            if (!$phone->delete()) {
                return ['error'=> 'Sorry, unable to delete phone.'];
            }

            return "Phone deleted successfully!";
        } 
        catch (Exception $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            if ($e->errorInfo[0] === '23505') return ['error' => 'Sorry, phone already exists.'];
            return ['error' => $e->getMessage()];
        }
    }
}
?>
