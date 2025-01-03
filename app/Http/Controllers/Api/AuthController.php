<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Models\User;
use App\Permissions\V1\Abilities;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    //
    use ApiResponse;

    public function login(LoginUserRequest $request) {
        $request->validated($request->all());

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Invalid credentials', status: 422);
        }

        $user = User::firstWhere('email', $request->email);

        return $this->ok(
            'Authentication successful',
            [
                'token' => $user->createToken(
                    'API token for ' . $user->email,
                    Abilities::getAbilities($user),
                    now()->addMonth())->plainTextToken,
            ]
        );
    }

    public function logout(Request $request) {
        if (!$request->bearerToken()) {
            $this->error('Invalid token', 401);
        }

        if(method_exists(auth()->user()->currentAccessToken(), 'delete')) {
            auth()->user()->currentAccessToken()->delete();
        }

        auth()->guard('web')->logout();

        return $this->ok('');
    }

    public function register(LoginUserRequest $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return AuthController::class::login($request);
    }
}
