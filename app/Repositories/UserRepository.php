<?php

namespace App\Repositories;

use App\Database\Connection;
use PDO;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    private $connection;
    private $model;

    public function __construct()
    {
        $this->model = new User;
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
            if (!$user = $this->model->with('contacts')->find($id)) {

                return ['error' => 'Sorry, the user could not be found.'];
            }

            return $user;
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
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            if ($e->errorInfo[0] === '23000') return ['error' => 'Sorry, This email is already registered.'];
            if ($e->errorInfo[0] === '23505') return ['error' => 'Sorry, user already exists.'];

            return ['error' => $e->getMessage()];
        }
    }

    public function update(array $data, $id)
    {
        try {
            if (!$user = $this->model->find($id)) {

                return ['error'=> 'Sorry, Unable to find user'];
            }

            if (isset($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            } else {
                unset($data['password']);
            }

            if (!$user->update($data)) {

                return ['error'=> 'Sorry, Unable to edit user.'];
            }

            return $user->refresh();
        }
        catch (Exception $e) {
            if (isset($e->errorInfo[0])) {
                if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
                if ($e->errorInfo[0] === '23000') return ['error' => 'Sorry, This email is already registered.'];
                if ($e->errorInfo[0] === '23505') return ['error' => 'Sorry, user already exists.'];
            }

            return ['error' => $e->getMessage()];
        }
    }

    public function delete($id)
    {
        try {
            if (!$user = $this->model->find($id)) {
                return ['error' => 'Sorry, the user could not be found.'];
            }

            if (!$user->delete()) {
                return ['error'=> 'Sorry, unable to delete user.'];
            }

            return "User deleted successfully!";
        } 
        catch (Exception $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            return ['error' => $e->getMessage()];
        }
    }
}
?>
