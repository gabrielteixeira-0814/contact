<?php 

namespace App\Services;

require "bootstrap.php";

use App\Models\Funcionario;
use App\Repositories\UserRepositoryInterface;
use App\Utils\Validator;
use Exception;

class UserService
{
    private $repo;

    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function list()
    {
        return $this->repo->list();
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function store(array $data)
    {
        try {
            $rules = Validator::rules($data);
            $validatedData = Validator::validate($data, $rules);
            unset($validatedData['password_confirmation']);
            $validatedData['password'] = password_hash($validatedData['password'], PASSWORD_DEFAULT);

            return $this->repo->store($validatedData);
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
            $rules = Validator::rules($data);
            $validatedData = Validator::validate($data, $rules);
            unset($validatedData['password_confirmation']);

            return $this->repo->update($validatedData, $id);
        }
        catch (Exception $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            if ($e->errorInfo[0] === '23000') return ['error' => 'Sorry, This email is already registered.'];
            if ($e->errorInfo[0] === '23505') return ['error' => 'Sorry, user already exists.'];

            return ['error' => $e->getMessage()];
        }
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
