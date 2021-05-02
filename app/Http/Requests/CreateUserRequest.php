<?php

namespace App\Http\Requests;

use App\Rules\HasUserValidation;

class CreateUserRequest extends BaseRequest
{
    use HasUserValidation;

    public function rules()
    {
        $rules = $this->getUserRules();
        $rules['email'][] = 'unique:users';

        return $rules;
    }
}
