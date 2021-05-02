<?php

namespace App\Rules;

trait HasUserValidation
{
    private function getUserRules(array $fields = [])
    {
        $rules = [
            'name' => ['required', 'person_name', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'code' => ['required', 'active_code:email', 'size:8'],
            'password' => ['required', 'custom_password', 'min:8', 'max:255'],
            'confirm_password' => ['same:password'],
        ];

        return empty($fields)
            ? $rules
            : array_intersect_key($rules, array_flip($fields));
    }
}
