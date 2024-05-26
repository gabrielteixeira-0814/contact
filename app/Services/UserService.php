<?php 

namespace App\Services;

require "bootstrap.php";

// use App\Http\JWT;
use App\Utils\Validator;
use Exception;
// use PDOException;
use App\Models\User;
use App\Models\Funcionario;


class UserService
{
    public static function get($id)
    {
        try {
            if (!$user = User::find($id)) {
                return ['error' => 'Sorry, the user could not be found.'];
            }

            return $user;
        }
        catch (Exception $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            if ($e->errorInfo[0] === '23505') return ['error' => 'Sorry, user already exists.'];
            return ['error' => $e->getMessage()];
        }
    }

    public static function create(array $data)
    {
        try {
            $rules = Validator::rules($data);

            $validatedData = Validator::validate($data, $rules);

            unset($validatedData['password_confirmation']);

            $user = new User();
            $validatedData['password'] = password_hash($validatedData['password'], PASSWORD_DEFAULT);

            foreach ($validatedData as $key => $value) {
                $user->$key = $value;
            }

            if (!$user->save()) {
                return ['error' => 'Desculpe, não foi possível criar sua conta.'];
            }

            return $validatedData;

        }
        catch (Exception $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            if ($e->errorInfo[0] === '23000') return ['error' => 'Sorry, This email is already registered.'];
            if ($e->errorInfo[0] === '23505') return ['error' => 'Sorry, user already exists.'];
            return ['error' => $e->getMessage()];
        }
    }

    public static function update(array $data, $id)
    {
        try {
            if (!$user = User::find($id)) {
                return ['error' => 'Sorry, the user could not be found'];
            }

            $rules = Validator::rules($data);

            $validatedData = Validator::validate($data, $rules);

            unset($validatedData['password_confirmation']);

            foreach ($validatedData as $key => $value) {
                if ($key == 'password') {
                    $value = password_hash($value, PASSWORD_DEFAULT);
                }
                $user->$key = $value;
            }

            if (!$user->save()) {
                return ['error'=> 'Sorry, we could not update your account.'];
            }

            return "User updated successfully!";
        }
        catch (Exception $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            if ($e->errorInfo[0] === '23000') return ['error' => 'Sorry, This email is already registered.'];
            if ($e->errorInfo[0] === '23505') return ['error' => 'Sorry, user already exists.'];
            return ['error' => $e->getMessage()];
        }
    }

    public static function delete($id)
    {
        try {
            if (!$user = User::find($id)) {
                return ['error' => 'Sorry, the user could not be found.'];
            }

            if (!$user->delete()) {
                return ['error'=> 'Sorry, we could not delete your account.'];
            }

            return "User deleted successfully!";
        } 
        catch (Exception $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            if ($e->errorInfo[0] === '23505') return ['error' => 'Sorry, user already exists.'];
            return ['error' => $e->getMessage()];
        }
    }
}