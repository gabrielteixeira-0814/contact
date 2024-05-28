<?php

namespace App\Utils;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
    public static function validate(array $data, array $rules)
    {
        $errors = [];

        foreach ($rules as $field => $rule) {
            try {
                $rule->setName($field)->assert($data[$field] ?? null);
            } catch (NestedValidationException $e) {
                $errors[$field] = $e->getMessages();
            }
        }

        if (!empty($errors)) {
            throw new \Exception(json_encode($errors));
        }

        return $data;
    }

    public static function rules(array $data, string $context = 'user'): array
    {
        switch ($context) {
            case 'user':
                return [
                    'name' => v::stringType()->length(3, 50)
                        ->setName('Nome')
                        ->setTemplate('{{name}} deve ter entre 3 e 50 caracteres.'),
                    'email' => v::email()
                        ->setName('E-mail')
                        ->setTemplate('{{name}} deve ser um endereço de e-mail válido.'),
                    'password' => v::stringType()->length(8, null)
                        ->setName('Senha')
                        ->setTemplate('{{name}} deve ter pelo menos 8 caracteres.')
                        ->regex('/[A-Z]/', '{{name}} deve conter pelo menos uma letra maiúscula.')
                        ->regex('/[a-z]/', '{{name}} deve conter pelo menos uma letra minúscula.')
                        ->regex('/[0-9]/', '{{name}} deve conter pelo menos um número.')
                        ->regex('/[\W]/', '{{name}} deve conter pelo menos um caractere especial.'),
                    'password_confirmation' => v::equals($data['password'] ?? null)
                        ->setName('Confirmação de Senha')
                        ->setTemplate('A confirmação de senha deve corresponder à senha.')
                ];

            case 'phone':
                return [
                    'user_id' => v::intVal()->positive()
                        ->setName('User ID')
                        ->setTemplate('{{name}} deve ser um número inteiro positivo.'),
                    'number' => v::digit()->length(10, 15)
                        ->setName('Número de Telefone')
                        ->setTemplate('{{name}} deve ter entre 10 e 15 caracteres e conter apenas dígitos.')
                ];

            case 'address':
                return [
                    'user_id' => v::intVal()->positive()
                        ->setName('User ID')
                        ->setTemplate('{{name}} deve ser um número inteiro positivo.'),
                    'number' => v::digit()->length(1, 5)
                        ->setName('Número')
                        ->setTemplate('{{name}} deve ter entre 1 e 5 caracteres e conter apenas dígitos.'),
                    'public_place' => v::stringType()->length(3, 50)
                        ->setName('Rua ou Avenida')
                        ->setTemplate('{{name}} deve ter entre 3 e 50 caracteres.'),
                    'neighborhood' => v::stringType()->length(3, 50)
                        ->setName('Bairro')
                        ->setTemplate('{{name}} deve ter entre 3 e 50 caracteres.'),
                    'city' => v::stringType()->length(3, 50)
                        ->setName('Cidade')
                        ->setTemplate('{{name}} deve ter entre 3 e 50 caracteres.'),
                    'state' => v::stringType()->length(1, 10)
                        ->setName('Estado')
                        ->setTemplate('{{name}} deve ter entre 1 e 10 caracteres.')
                ];

            case 'contact':
                return [
                    'user_id' => v::intVal()->positive()
                        ->setName('User ID')
                        ->setTemplate('{{name}} deve ser um número inteiro positivo.'),
                    'address_id' => v::intVal()->positive()
                        ->setName('Address ID')
                        ->setTemplate('{{name}} deve ser um número inteiro positivo.'),
                    'phone_id' => v::intVal()->positive()
                        ->setName('Phone ID')
                        ->setTemplate('{{name}} deve ser um número inteiro positivo.'),
                    'name' => v::stringType()->length(3, 50)
                        ->setName('Nome')
                        ->setTemplate('{{name}} deve ter entre 3 e 50 caracteres.'),
                    'email' => v::email()
                        ->setName('E-mail')
                        ->setTemplate('{{name}} deve ser um endereço de e-mail válido.')
                ];

            default:
        }
    }
}
