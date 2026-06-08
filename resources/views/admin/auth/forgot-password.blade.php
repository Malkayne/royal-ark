@extends('layouts.admin.auth')

@section('title', 'Forgot Password - Royal Ark College Admin')

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
                <!-- Success State -->
                <div class="success-state">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Reset link sent!</h3>
                    <p>Check your inbox at <strong>{{ session('email') }}</strong></p>
                    <p class="countdown">You can resend the link in <span id="countdown">60</span> seconds</p>
                    
                    <div style="margin-top: 24px;">
                        <a href="{{ route('admin.login') }}" class="btn btn-outline">
                            <i class="fas fa-arrow-left"></i> Back to Login
                        </a>
                    </div>
                </div>
            @else
                <a href="{{ route('admin.login') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Back to Login
                </a>

                <div class="auth-form-header">
                    <h2>Reset Password</h2>
                    <p>Enter your email and we'll send a reset link.</p>
                </div>

                <form method="POST" action="{{ route('admin.forgot-password.post') }}" data-auth-submit>
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

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary" data-submit-button>
                        <span class="btn-spinner" aria-hidden="true"></span>
                        <span class="btn-label">Send Reset Link</span>
                        <span class="btn-loading-label">Sending link...</span>
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>

@if(session('status'))
<script>
    // Countdown timer
    let seconds = 60;
    const countdownEl = document.getElementById('countdown');
    
    const interval = setInterval(() => {
        seconds--;
        countdownEl.textContent = seconds;
        
        if (seconds <= 0) {
            clearInterval(interval);
            countdownEl.textContent = '0';
        }
    }, 1000);
</script>
@endif
@endsection
