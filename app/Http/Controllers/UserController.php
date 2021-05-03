<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function store(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();

            VerificationCode::query()
                ->where('email', $request->validated()['email'])
                ->where('code', $request->validated()['code'])
                ->update(['status' => 'used']);

            $user = User::create($request->validated());

            DB::commit();

            return new UserResource($user);
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e);
            return response()->json('Unable to create user. Please try again later.');
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
