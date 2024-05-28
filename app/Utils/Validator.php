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
            case 'phone':
                return [
                    'user_id' => v::intVal()->positive()
                        ->setName('User ID')
                        ->setTemplate('{{name}} deve ser um número inteiro positivo.'),
                    'number' => v::digit()->length(10, 15)
                        ->setName('Número de Telefone')
                        ->setTemplate('{{name}} deve ter entre 10 e 15 caracteres e conter apenas dígitos.')
                ];
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
            default:
        }
    }
}
