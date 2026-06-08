<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthService extends BaseService
{
    /**
     * Attempt to login a user
     */
    public function login(string $email, string $password, bool $remember = false): bool
    {
        $credentials = [
            'email' => $email,
            'password' => $password
        ];
        
        $this->log('Login attempt', ['email' => $email]);
        
        $success = Auth::attempt($credentials, $remember);
        
        if ($success) {
            $this->log('Login successful', ['email' => $email]);
        }
        
        return $success;
    }

    /**
     * Logout the current user
     */
    public function logout(): void
    {
        $user = Auth::user();
        if ($user) {
            $this->log('User logged out', ['email' => $user->email]);
        }
        Auth::logout();
    }

    /**
     * Send password reset link
     */
    public function sendResetLink(string $email): string
    {
        $this->log('Password reset link requested', ['email' => $email]);
        return Password::sendResetLink(['email' => $email]);
    }

    /**
     * Reset user password
     */
    public function resetPassword(string $email, string $password, string $token): string
    {
        $this->log('Password reset attempt', ['email' => $email]);
        
        return Password::reset(
            [
                'email' => $email,
                'password' => $password,
                'token' => $token
            ],
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
                
                $this->log('Password reset successful', ['email' => $user->email]);
            }
        );
    }
}
