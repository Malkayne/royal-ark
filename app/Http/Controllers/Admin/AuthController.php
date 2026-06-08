<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\ForgotPasswordRequest;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    /**
     * Show login form
     */
    public function showLogin(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Handle login request
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        if ($this->authService->login($email, $password, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Login successful! Welcome back to the admin panel.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->with('error', 'Login failed. Please check your email and password.')->onlyInput('email');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request): RedirectResponse
    {
        $this->authService->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Show forgot password form
     */
    public function showForgotPassword(): View
    {
        return view('admin.auth.forgot-password');
    }

    /**
     * Send password reset link
     */
    public function sendResetLink(ForgotPasswordRequest $request): RedirectResponse
    {
        $email = $request->input('email');
        $status = $this->authService->sendResetLink($email);

        return $status === Password::RESET_LINK_SENT
            ? back()->with([
                'status' => __($status),
                'success' => 'Password reset link sent. Please check your email.',
                'email' => $email,
            ])
            : back()
                ->withErrors(['email' => __($status)])
                ->with('error', __($status));
    }

    /**
     * Show reset password form
     */
    public function showResetPassword(string $token): View
    {
        return view('admin.auth.reset-password', ['token' => $token]);
    }

    /**
     * Reset password
     */
    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $token = $request->input('token');
        
        $status = $this->authService->resetPassword($email, $password, $token);

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('admin.login')->with('success', 'Password updated successfully. Please log in.')
            : back()
                ->withErrors(['email' => [__($status)]])
                ->with('error', __($status));
    }
}
