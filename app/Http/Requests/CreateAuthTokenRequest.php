<?php

namespace App\Http\Requests;

use App\Rules\HasUserValidation;

class CreateAuthTokenRequest extends BaseRequest
{
    use HasUserValidation;

    public function rules()
    {
        return $this->getUserRules(['email', 'password']);
    }
}
