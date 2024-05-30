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
                        ->setName('Name')
                        ->setTemplate('{{name}} must be between 3 and 50 characters'),
                    'email' => v::email()
                        ->setName('E-mail')
                        ->setTemplate('{{name}} must be a valid email address'),
                    'password' => v::stringType()->length(5, null)
                        ->setName('Password')
                        ->setTemplate('{{name}} must be at least 5 characters long')
                        // ->regex('/[A-Z]/', '{{name}} must contain at least one upper case letter.')
                        // ->regex('/[a-z]/', '{{name}} must contain at least one lowercase letter')
                        ->regex('/[0-9]/', '{{name}} must contain at least one number'),
                        // ->regex('/[\W]/', '{{name}} must contain at least one special character'),
                    'password_confirmation' => v::equals($data['password'] ?? null)
                        ->setName('Password Confirmation')
                        ->setTemplate('Password confirmation must match the password')
                ];

            case 'phone':
                return [
                    'contact_id' => v::intVal()->positive()
                        ->setName('Contact ID')
                        ->setTemplate('{{name}} must be a positive integer.'),
                    'number' => v::digit()->length(10, 15)
                        ->setName('Phone number')
                        ->setTemplate('{{name}} must be between 10 and 15 characters and contain only digits')
                ];

            case 'address':
                return [
                    'contact_id' => v::intVal()->positive()
                        ->setName('Contact ID')
                        ->setTemplate('{{name}} must be a positive integer'),
                    'number' => v::digit()->length(1, 5)
                        ->setName('Number')
                        ->setTemplate('{{name}} must be between 1 and 5 characters long and contain only digits'),
                    'public_place' => v::stringType()->length(3, 50)
                        ->setName('Public place')
                        ->setTemplate('{{name}} must be between 3 and 50 characters'),
                    'neighborhood' => v::stringType()->length(3, 50)
                        ->setName('Neighborhood')
                        ->setTemplate('{{name}} must be between 3 and 50 characters'),
                    'city' => v::stringType()->length(3, 50)
                        ->setName('City')
                        ->setTemplate('{{name}} must be between 3 and 50 characters'),
                    'state' => v::stringType()->length(1, 10)
                        ->setName('State')
                        ->setTemplate('{{name}} must be between 1 and 10 characters')
                ];

            case 'contact':
                return [
                    'user_id' => v::intVal()->positive()
                        ->setName('User ID')
                        ->setTemplate('{{name}} must be a positive integer'),
                    'name' => v::stringType()->length(3, 50)
                        ->setName('Name')
                        ->setTemplate('{{name}} must be between 3 and 50 characters'),
                    'email' => v::email()
                        ->setName('E-mail')
                        ->setTemplate('{{name}} must be a valid email address')
                ];

            default:
        }
    }
}
