<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendVerificationCodeRequest;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\DB;

class VerificationCodeController extends Controller
{
    public function store(SendVerificationCodeRequest $request)
    {
        try {
            DB::beginTransaction();

            $code = [
                'code' => bin2hex(random_bytes(4)),
                'email' => $request->validated()['email'],
                'expires_at' => now()->addMinutes(15),
                'status' => 'unused',
            ];

            VerificationCode::create($code);

            DB::commit();

            return response()->json('Verification code has been sent to your email and will expire after 15 minutes.');
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e);
            return response()->json('Unable to send verification code. Please try again later.', 500);
        }
    }
}
