<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function store(ResetPasswordRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::query()
                ->where('email', $request->validated()['email'])
                ->first();

            $user->fill(['password' => $request->validated()['password']])
                ->save();

            DB::commit();

            return response()->json('Password has been changed.');
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e);
            return response()->json('Unable to change password. Please try again later.', 500);
        }
    }
}
