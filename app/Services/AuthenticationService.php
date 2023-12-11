<?php

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthenticationService
{
    /**
     * Check if user exists and matches the hash
     *
     * @param string $email
     * @param string $password
     * @return string
     * @throws ValidationException
     */
    public function login(array $data): string
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken('API Token')->plainTextToken;
    }
}
