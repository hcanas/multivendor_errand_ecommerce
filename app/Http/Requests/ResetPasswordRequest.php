<?php

namespace App\Http\Requests;

use App\Rules\HasUserValidation;

class ResetPasswordRequest extends BaseRequest
{
    use HasUserValidation;

    public function rules()
    {
        $rules = $this->getUserRules(['email', 'code', 'password', 'confirm_password']);
        $rules['email'][] = 'exists:users';

        return $rules;
    }
}
