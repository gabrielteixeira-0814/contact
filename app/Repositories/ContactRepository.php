<?php

namespace App\Repositories;

use App\Database\Connection;
use PDO;
use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    private $connection;
    private $model;

    public function __construct()
    {
        $this->model = new Contact;
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
            if (!$contact = $this->model->find($id)) {

                return ['error' => 'Sorry, the contact could not be found.'];
            }

            return $contact;
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
            if (!$contact = $this->model->find($id)) {

                return ['error'=> 'Sorry, Unable to find contact'];
            }

            if (!$contact->update($data)) {

                return ['error'=> 'Sorry, Unable to edit contact.'];
            }

            return $contact->refresh();
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
            if (!$contact = $this->model->find($id)) {
                return ['error' => 'Sorry, the contact could not be found.'];
            }

            if (!$contact->delete()) {
                return ['error'=> 'Sorry, unable to delete contact.'];
            }

            return "Contact deleted successfully!";
        } 
        catch (Exception $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            return ['error' => $e->getMessage()];
        }
    }
}
?>
