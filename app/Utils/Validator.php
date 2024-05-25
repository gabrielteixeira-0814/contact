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

    public static function rules(array $data): array
    {
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
                ->setTemplate('A confirmação de senha deve corresponder à senha.'),
            // 'date_of_birth' => v::date()
            //     ->setName('Data de Nascimento')
            //     ->setTemplate('{{name}} deve ser uma data válida.'),
            // 'age' => v::intVal()->positive()->between(1, 120)
            //     ->setName('Idade')
            //     ->setTemplate('{{name}} deve ser um número inteiro entre 1 e 120.')
        ];
    }
}
