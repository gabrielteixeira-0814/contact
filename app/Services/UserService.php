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

            $rules = Validator::rules($data);

            $validatedData = Validator::validate($data, $rules);

            unset($validatedData['password_confirmation']);

            $user = new User();

            if (!$user->find($id)) {
                return ['error' => 'Desculpe, não foi possível encontrar o usuário.'];
            }

            foreach ($validatedData as $key => $value) {
                $user->$key = $value;
            }

            if (!$user->update($id)) {
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

    // public static function delete(mixed $authorization, int|string $id)
    // {
    //     // try {
    //     //     if (isset($authorization['error'])) {
    //     //         return ['unauthorized'=> $authorization['error']];
    //     //     }

    //     //     $userFromJWT = JWT::verify($authorization);

    //     //     if (!$userFromJWT) return ['unauthorized'=> "Please, login to access this resource."];

    //     //     $user = User::delete($id);

    //     //     if (!$user) return ['error'=> 'Sorry, we could not delete your account.'];

    //     //     return "User deleted successfully!";
    //     // } 
    //     // catch (PDOException $e) {
    //     //     if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
    //     //     return ['error' => $e->getMessage()];
    //     // }
    //     // catch (Exception $e) {
    //     //     return ['error' => $e->getMessage()];
    //     // }
    // }
}