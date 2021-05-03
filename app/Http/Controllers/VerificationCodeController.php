<?php

namespace App\Http\Controllers;

use App\Events\CreatedVerificationCode;
use App\Http\Requests\SendVerificationCodeRequest;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\DB;

class VerificationCodeController extends Controller
{
    public function store(SendVerificationCodeRequest $request)
    {
        try {
            DB::beginTransaction();

            $verification_code = VerificationCode::create($request->validated());
            event(new CreatedVerificationCode($verification_code));

            DB::commit();

            return response()->json('Verification code has been sent to your email and will expire after 15 minutes.');
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e);
            return response()->json('Unable to send verification code. Please try again later.', 500);
        }
    }
}
