<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends ApiController
{
    /**
     * Login via the api
     *
     * @return JsonResponse
     */
    public function login(ApiLoginRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only(['email', 'password'])))
            return $this->error('', 'Invalid login', 401);

        $user = User::where('email', $request->input('email'))
            ->get()->first();

        return $this->success([
            'user'  => $user,
            'token' => $user->createToken('Api Token for ' . $user->username)->plainTextToken,
        ]);
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
