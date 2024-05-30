<?php 

namespace App\Services;

require "bootstrap.php";

use App\Repositories\ContactRepositoryInterface;
use App\Utils\Validator;
use Exception;

class ContactService
{
    private $repo;

    public function __construct(ContactRepositoryInterface $repo)
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
            $rules = Validator::rules($data, 'contact');
            $validatedData = Validator::validate($data, $rules);

            return $this->repo->store($validatedData);
        }
        catch (Exception $e) {

            if (isset($e->errorInfo[0])) {
                if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            }

            $errorInfo = json_decode($e->getMessage(), true);

            if (isset($errorInfo['name'])) {
                $error = $errorInfo['name']['name'];
                return ['error' => $error];
            }

            if (isset($errorInfo['email'])) {
                $error = $errorInfo['email']['email'];
                return ['error' => $error];
            }

            return ['error' => $e->getMessage()];
        }
    }

    public function update(array $data, $id)
    {
        try {
            $rules = Validator::rules($data);
            $rules = Validator::rules($data, 'contact');
            $validatedData = Validator::validate($data, $rules);

            return $this->repo->update($validatedData, $id);
        }
        catch (Exception $e) {

            return ['error' => $e->getMessage()];
        }
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
