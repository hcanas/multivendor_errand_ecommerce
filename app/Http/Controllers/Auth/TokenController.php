<?php

namespace App\Http\Controllers\Auth;

use App\Events\GenericUserActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAuthTokenRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function store(CreateAuthTokenRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::query()
                ->where('email', $request->validated()['email'])
                ->where('status', 'active')
                ->first();

            if ($user === null OR Hash::check($request->validated()['password'], $user->password) === false) {
                return response()->json('Incorrect username or password.', 401);
            }

            $token = $user->createToken($user->email)->plainTextToken;
            event(new GenericUserActivity('Logged in.', $user->id));

            DB::commit();

            return response()->json($token);
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e);
            return response()->json('Unable to verify credentials. Please try again later.', 500);
        }
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
