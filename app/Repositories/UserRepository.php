<?php

namespace App\Repositories;

use App\Database\Connection;
use PDO;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    private $connection;

    public function __construct()
    {
        // $this->connection = Connection::getConnection();
    }

    public function store(array $data)
    {
        print_r($data);
        $user = new User();
        // foreach ($validatedData as $key => $value) {
        //     $user->$key = $value;
        // }

        // if (!$user->save()) {
        //     return ['error' => 'Desculpe, não foi possível criar sua conta.'];
        // }

        // return $validatedData;
        die();
        // $sql = "INSERT INTO users (cpf, name, email, password, user_type_id, is_enabled) VALUES (:cpf, :name, :email, :password, :user_type_id, :is_enabled)";
        // $stmt = $this->connection->prepare($sql);
        //return $stmt->execute($data);
    }

    public function users()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(array $data, $id)
    {
        $data['id'] = $id;
        $sql = "UPDATE users SET cpf = :cpf, name = :name, email = :email, password = :password, user_type_id = :user_type_id, is_enabled = :is_enabled WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    public function destroy($id)
    {
        $sql = "UPDATE users SET is_enabled = 0 WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function getDataUser($cpf)
    {
        $sql = "SELECT id, cpf, name, email FROM users WHERE cpf = :cpf";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['cpf' => $cpf]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
