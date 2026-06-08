@extends('layouts.admin.auth')

@section('title', 'Login - Royal Ark College Admin')

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
            @if(session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-info-circle"></i>
                    <div class="alert-body">{{ session('status') }}</div>
                </div>
            @endif

            <div class="auth-form-header">
                <h2>Welcome Back</h2>
                <p>Sign in to the Royal Ark admin panel.</p>
            </div>

            <!-- Role Selector -->
            <div class="role-selector">
                <div class="role-pill active" data-role="admin">
                    <i class="fas fa-user-shield"></i> Admin
                </div>
                <div class="role-pill" data-role="staff">
                    <i class="fas fa-user-tie"></i> Staff
                </div>
                <div class="role-pill" data-role="bursar">
                    <i class="fas fa-calculator"></i> Bursar
                </div>
            </div>

            <form method="POST" action="{{ route('admin.login.post') }}" data-auth-submit>
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label">Email Address<span class="req">*</span></label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-envelope input-icon"></i>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control @error('email') is-error @enderror"
                            value="{{ old('email') }}"
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
                    <label class="form-label">Password<span class="req">*</span></label>
                    <div class="input-icon-wrap">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            name="password" 
                            id="login-password"
                            class="form-control @error('password') is-error @enderror"
                            placeholder="Enter your password"
                            required
                        >
                        <button 
                            type="button" 
                            class="input-icon-right" 
                            data-toggle-password="#login-password"
                        >
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Remember & Forgot -->
                <div class="form-row">
                    <div class="form-check">
                        <input type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <a href="{{ route('admin.forgot-password') }}" class="forgot-link">Forgot Password?</a>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary" data-submit-button>
                    <span class="btn-spinner" aria-hidden="true"></span>
                    <span class="btn-label">Sign In</span>
                    <span class="btn-loading-label">Signing in...</span>
                </button>
            </form>

            <div class="auth-divider">
                <span>or</span>
            </div>

            <p class="auth-footer-text">
                Having trouble? Contact your system administrator at<br>
                <a href="mailto:support@royalark.edu.ng">support@royalark.edu.ng</a>
            </p>
        </div>
    </div>
</div>
@endsection
