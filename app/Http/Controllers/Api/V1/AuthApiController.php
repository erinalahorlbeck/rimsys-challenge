<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends ApiController
{
    /**
     * Login via the api
     *
     * @return JsonResponse
     */
    public function login()
    {
        return response()->json('Login method.');
    }

    /**
     * Register a new user via the api
     *
     * @return JsonResponse
     */
    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token for ' . $user->username)
                ->plainTextToken
        ], 'User successfully registered');
    }

    /**
     * Logout via the api
     *
     * @return JsonResponse
     */
    public function logout()
    {
        return response()->json('Logout method.');
    }
}
