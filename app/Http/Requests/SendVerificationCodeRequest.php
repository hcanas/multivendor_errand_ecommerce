<?php

namespace App\Http\Requests;

use App\Rules\HasUserValidation;

class SendVerificationCodeRequest extends BaseRequest
{
    use HasUserValidation;

    public function rules()
    {
        $rules = $this->getUserRules(['email']);
        $rules['email'][] = 'unique:users';

        return $rules;
    }
}
