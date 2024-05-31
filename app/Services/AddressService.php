<?php 

namespace App\Services;

use App\Repositories\AddressRepositoryInterface;
use App\Repositories\ContactRepositoryInterface;
use App\Utils\Validator;
use Exception;

class AddressService
{
    private $repo;
    private $contactRepo;

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
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update(array $data, $id)
    {
        try {
            $rules = Validator::rules($data, 'address');
            $validatedData = Validator::validate($data, $rules);

            return $this->repo->update($validatedData, $id);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    private function handleException(Exception $e)
    {
        if (isset($e->errorInfo[0])) {
            if ($e->errorInfo[0] === '08006') {
                return ['error' => 'Sorry, we could not connect to the database'];
            }
            if ($e->errorInfo[0] === '23000') {
                return ['error' => 'Sorry, no contact has been linked to this address'];
            }
        }

        $errorInfo = json_decode($e->getMessage(), true);

        $errorMessages = [
            'contact_id' => 'contact_id',
            'number' => 'number',
            'public_place' => 'public_place',
            'neighborhood' => 'neighborhood',
            'city' => 'city',
            'state' => 'state'
        ];

        foreach ($errorMessages as $key => $value) {
            if (isset($errorInfo[$key])) {
                return ['error' => $errorInfo[$key][$value]];
            }
        }

        return ['error' => $e->getMessage()];
    }
}
