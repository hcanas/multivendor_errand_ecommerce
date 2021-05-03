<?php

namespace App\Http\Requests;

use App\Rules\HasUserValidation;

class SendVerificationCodeRequest extends BaseRequest
{
    use HasUserValidation;

    public function rules()
    {
        $rules = $this->getUserRules(['email']);

        switch ($this->segment(count($this->segments()))) {
            case 'email':
                $rules['email'][] = 'unique:users';
                break;
            case 'password':
                $rules['email'][] = 'exists:users';
        }

        return $rules;
    }
}
