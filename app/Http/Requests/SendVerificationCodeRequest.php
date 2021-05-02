<?php

namespace App\Http\Requests;

use App\Rules\HasUserValidation;

class SendVerificationCodeRequest extends BaseRequest
{
    use HasUserValidation;

    public function rules()
    {
        $rules = $this->getUserRules(['email']);

        if ($this->segment(count($this->segments())) === 'email') {
            $rules['email'][] = 'unique:users';
        }

        return $rules;
    }
}
