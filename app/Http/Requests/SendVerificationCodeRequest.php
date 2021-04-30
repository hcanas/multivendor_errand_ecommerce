<?php

namespace App\Http\Requests;

use App\Rules\HasUserValidation;

class SendVerificationCodeRequest extends BaseRequest
{
    use HasUserValidation;

    public function rules()
    {
        return $this->getUserRules(['email']) + ['unique:users'];
    }
}
