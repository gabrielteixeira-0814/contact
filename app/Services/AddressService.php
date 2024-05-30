<?php 

namespace App\Services;

require "bootstrap.php";

use App\Repositories\AddressRepositoryInterface;
use App\Repositories\ContactRepositoryInterface;
use App\Utils\Validator;
use Exception;

class AddressService
{
    private $repo;

    public function __construct(AddressRepositoryInterface $repo, ContactRepositoryInterface $contactRepo)
    {
        $this->repo = $repo;
        $this->contactRepo = $contactRepo;
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
        if ($address = $this->repo->checkAddress((int)$data['contact_id'])) {
            return ['error' => ['There is already an address created for the contact']];
        }

        try {
            $rules = Validator::rules($data, 'address');
            $validatedData = Validator::validate($data, $rules);

            return $this->repo->store($validatedData);
        }
        catch (Exception $e) {

            if (isset($e->errorInfo[0])) {
                if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            }

            $errorInfo = json_decode($e->getMessage(), true);

            if (isset($errorInfo['contact_id'])) {
                $error = $errorInfo['contact_id']['contact_id'];
                return ['error' => $error];
            }

            if (isset($errorInfo['number'])) {
                $error = $errorInfo['number']['number'];
                return ['error' => $error];
            }

            if (isset($errorInfo['public_place'])) {
                $error = $errorInfo['public_place']['public_place'];
                return ['error' => $error];
            }

            if (isset($errorInfo['neighborhood'])) {
                $error = $errorInfo['neighborhood']['neighborhood'];
                return ['error' => $error];
            }

            if (isset($errorInfo['city'])) {
                $error = $errorInfo['city']['city'];
                return ['error' => $error];
            }

            if (isset($errorInfo['state'])) {
                $error = $errorInfo['state']['state'];
                return ['error' => $error];
            }

            return ['error' => $e->getMessage()];
        }
    }

    public function update(array $data, $id)
    {
        try {
            $rules = Validator::rules($data);
            $rules = Validator::rules($data, 'address');
            $validatedData = Validator::validate($data, $rules);

            return $this->repo->update($validatedData, $id);
        }
        catch (Exception $e) {

            if (isset($e->errorInfo[0])) {
                if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            }

            $errorInfo = json_decode($e->getMessage(), true);

            if (isset($errorInfo['contact_id'])) {
                $error = $errorInfo['contact_id']['contact_id'];
                return ['error' => $error];
            }

            if (isset($errorInfo['number'])) {
                $error = $errorInfo['number']['number'];
                return ['error' => $error];
            }

            if (isset($errorInfo['public_place'])) {
                $error = $errorInfo['public_place']['public_place'];
                return ['error' => $error];
            }

            if (isset($errorInfo['neighborhood'])) {
                $error = $errorInfo['neighborhood']['neighborhood'];
                return ['error' => $error];
            }

            if (isset($errorInfo['city'])) {
                $error = $errorInfo['city']['city'];
                return ['error' => $error];
            }

            if (isset($errorInfo['state'])) {
                $error = $errorInfo['state']['state'];
                return ['error' => $error];
            }

            return ['error' => $e->getMessage()];
        }
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
