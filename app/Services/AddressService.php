<?php 

namespace App\Services;

require "bootstrap.php";

use App\Repositories\AddressRepositoryInterface;
use App\Utils\Validator;
use Exception;

class AddressService
{
    private $repo;

    public function __construct(AddressRepositoryInterface $repo)
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
            $rules = Validator::rules($data, 'address');
            $validatedData = Validator::validate($data, $rules);

            return $this->repo->store($validatedData);
        }
        catch (Exception $e) {

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

            return ['error' => $e->getMessage()];
        }
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
