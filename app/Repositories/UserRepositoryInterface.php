<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function store(array $data);
    public function users();
    public function get($id);
    public function update(array $data, $id);
    public function destroy($id);
    public function getDataUser($cpf);
}
?>
