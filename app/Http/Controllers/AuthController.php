<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use AuthenticationService;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    /**
     * @param AuthenticationService $userService The user service instance.
     */
    public function __construct(private AuthenticationService $authenticationService) {}

    /**
     * Handle user login.
     *
     * @param LoginRequest $request The login request.
     * @return JsonResponse The JSON response.
     * @throws ValidationException If validation fails.
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $token = $this->authenticationService->login($validated);

        return response()->json(['token' => $token]);
    }

    /**
     * Handle user logout.
     *
     * @param Request $request The HTTP request.
     * @return JsonResponse The JSON response.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
