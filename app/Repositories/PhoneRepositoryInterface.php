<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface PhoneRepositoryInterface
{
    public function store(array $data);
    public function list();
    public function get($id);
    public function update(array $data, $id);
    public function delete($id);
}
?>
