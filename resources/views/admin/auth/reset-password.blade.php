@extends('layouts.admin.auth')

@section('title', 'Reset Password - Royal Ark College Admin')

@section('content')
<!-- Brand Panel -->
<div class="auth-brand-panel">
    <div class="brand-header">
        <div class="brand-logo">RA</div>
        <div class="brand-text">
            <h1>Royal Ark College</h1>
            <p>Admin Panel</p>
        </div>
    </div>

    <div class="brand-content">
        <h2>Royal Ark College</h2>
        <p class="motto">Royalty in Excellence</p>
        <div class="divider"></div>
        
        <div class="feature-pills">
            <div class="feature-pill">
                <i class="fas fa-lock"></i>
                Secure Admin Portal
            </div>
            <div class="feature-pill">
                <i class="fas fa-chart-pie"></i>
                Real-time Dashboard
            </div>
            <div class="feature-pill">
                <i class="fas fa-bolt"></i>
                Instant Updates
            </div>
        </div>
    </div>

    <div class="brand-footer">
        Authorised access only. All activity is logged.
    </div>
</div>

<!-- Form Panel -->
<div class="auth-form-panel">
    <div class="auth-form-container">
        <!-- Mobile Logo -->
        <div class="mobile-logo">
            <div class="brand-logo">RA</div>
            <h1>Royal Ark College</h1>
        </div>

        <div class="auth-form-card">
            <a href="{{ route('admin.login') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Login
            </a>

            <div class="auth-form-header">
                <h2>Set New Password</h2>
                <p>Choose a strong password for your account.</p>
            </div>

            <form method="POST" action="{{ route('admin.reset-password.post') }}" data-auth-submit>
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label">Email Address<span class="req">*</span></label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-envelope input-icon"></i>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control @error('email') is-error @enderror"
                            value="{{ old('email', request()->email) }}"
                            placeholder="Enter your email"
                            required
                        >
                    </div>
                    @error('email')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label">New Password<span class="req">*</span></label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            name="password" 
                            id="reset-password"
                            class="form-control @error('password') is-error @enderror"
                            placeholder="Enter new password"
                            data-password-strength
                            required
                        >
                        <button 
                            type="button" 
                            class="input-icon-right" 
                            data-toggle-password="#reset-password"
                        >
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    
                    <!-- Password Strength -->
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-segment"></div>
                            <div class="strength-segment"></div>
                            <div class="strength-segment"></div>
                            <div class="strength-segment"></div>
                        </div>
                        <div class="strength-text"></div>
                    </div>
                    
                    @error('password')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="form-label">Confirm Password<span class="req">*</span></label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="reset-password-confirm"
                            class="form-control"
                            placeholder="Confirm new password"
                            required
                        >
                        <button 
                            type="button" 
                            class="input-icon-right" 
                            data-toggle-password="#reset-password-confirm"
                        >
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Password Rules -->
                <div class="password-rules">
                    <div class="password-rule invalid">
                        <i class="fas fa-circle"></i>
                        <span>At least 8 characters</span>
                    </div>
                    <div class="password-rule invalid">
                        <i class="fas fa-circle"></i>
                        <span>Contains uppercase letter</span>
                    </div>
                    <div class="password-rule invalid">
                        <i class="fas fa-circle"></i>
                        <span>Contains a number</span>
                    </div>
                    <div class="password-rule invalid">
                        <i class="fas fa-circle"></i>
                        <span>Contains a symbol</span>
                    </div>
                </div>

                <!-- Submit -->
                <div style="margin-top: 24px;">
                    <button type="submit" class="btn btn-primary" data-submit-button>
                        <span class="btn-spinner" aria-hidden="true"></span>
                        <span class="btn-label">Update Password</span>
                        <span class="btn-loading-label">Updating password...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
