<?php

namespace App\Http\Controllers\Auth;

use App\Events\GenericUserActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

            event(new GenericUserActivity('Updated password.', $user->id));

            DB::commit();

            return response()->json('Password has been changed.');
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e);
            return response()->json('Unable to change password. Please try again later.', 500);
        }
    }
}
