<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Royal Ark College')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
    <link rel="icon" href="{{ asset('landing/img/ras-logo.jpg') }}" type="image/jpeg">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            font-family: 'DM Sans', sans-serif;
        }

        .auth-brand-panel {
            width: 40%;
            background: linear-gradient(160deg, #180A30 0%, #3D1A6E 100%);
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .auth-brand-panel::before {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #F4C240 0%, #C85A00 100%);
        }

        .auth-brand-panel::after {
            content: '';
            position: absolute;
            right: -100px;
            bottom: -100px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(244, 194, 64, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .brand-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #C85A00 0%, #F4C240 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: #180A30;
            box-shadow: 0 8px 24px rgba(200, 90, 0, 0.3);
        }

        .brand-text h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .brand-text p {
            font-family: 'Outfit', sans-serif;
            font-size: 12px;
            font-weight: 600;
            color: #F4C240;
            text-transform: uppercase;
            letter-spacing: 0.14em;
        }

        .brand-content {
            position: relative;
            z-index: 1;
        }

        .brand-content h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 48px;
            font-weight: 600;
            color: #ffffff;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .brand-content .motto {
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #F4C240;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 32px;
        }

        .divider {
            width: 48px;
            height: 3px;
            background: linear-gradient(90deg, #F4C240 0%, #C85A00 100%);
            margin-bottom: 32px;
            border-radius: 2px;
        }

        .feature-pills {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .feature-pill {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: rgba(255, 255, 255, 0.85);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 500;
        }

        .feature-pill i {
            color: #F4C240;
            font-size: 18px;
        }

        .brand-footer {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        .auth-form-panel {
            width: 60%;
            background: #FAF8FC;
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .auth-form-container {
            width: 100%;
            max-width: 420px;
        }

        .mobile-logo {
            display: none;
            margin-bottom: 32px;
        }

        .auth-form-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 24px rgba(61, 26, 110, 0.08);
        }

        .auth-form-header {
            margin-bottom: 32px;
        }

        .auth-form-header h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: #1A0D2E;
            margin-bottom: 8px;
        }

        .auth-form-header p {
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            color: #8B7FA0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-family: 'Outfit', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #2D1F40;
            margin-bottom: 8px;
        }

        .form-label .req {
            color: #B52B2B;
            margin-left: 2px;
        }

        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap .form-control {
            padding-left: 44px;
            padding-right: 44px;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #8B7FA0;
            font-size: 16px;
            pointer-events: none;
        }

        .input-icon-right {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #8B7FA0;
            font-size: 16px;
            cursor: pointer;
            transition: color 0.2s;
        }

        .input-icon-right:hover {
            color: #3D1A6E;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            background: #ffffff;
            border: 1.5px solid #D0C4EC;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            color: #2D1F40;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: #C85A00;
            box-shadow: 0 0 0 4px rgba(200, 90, 0, 0.1);
        }

        .form-control::placeholder {
            color: #B0A8C0;
        }

        .form-control.is-error {
            border-color: #B52B2B;
        }

        .form-control.is-error:focus {
            box-shadow: 0 0 0 4px rgba(181, 43, 43, 0.1);
        }

        .form-error {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            color: #B52B2B;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-check input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #C85A00;
            cursor: pointer;
        }

        .form-check-label {
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: #5A4F6B;
            cursor: pointer;
        }

        .forgot-link {
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #3D1A6E;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #C85A00;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-primary {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, #C85A00 0%, #F4C240 100%);
            color: #ffffff;
            font-size: 16px;
            box-shadow: 0 4px 12px rgba(200, 90, 0, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(200, 90, 0, 0.35);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.45);
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        .btn.is-loading .btn-spinner {
            display: inline-block;
        }

        .btn.is-loading .btn-label {
            display: none;
        }

        .btn-loading-label {
            display: none;
        }

        .btn.is-loading .btn-loading-label {
            display: inline;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .btn-outline {
            width: 100%;
            padding: 12px 24px;
            background: transparent;
            border: 1.5px solid #D0C4EC;
            color: #5A4F6B;
            font-size: 15px;
        }

        .btn-outline:hover {
            background: #F2EFF9;
            border-color: #3D1A6E;
            color: #3D1A6E;
        }

        .btn-icon {
            padding: 0;
            width: 36px;
            height: 36px;
        }

        .auth-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #E8E0F5;
        }

        .auth-divider span {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: #8B7FA0;
        }

        .auth-footer-text {
            text-align: center;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: #5A4F6B;
            margin-top: 24px;
        }

        .auth-footer-text a {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            color: #3D1A6E;
            text-decoration: none;
            transition: color 0.2s;
        }

        .auth-footer-text a:hover {
            color: #C85A00;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-success {
            background: #D4F5E4;
            color: #1A7A4A;
        }

        .alert-warning {
            background: #FDEFD6;
            color: #B56B00;
        }

        .alert i {
            font-size: 18px;
            margin-top: 1px;
        }

        .alert-body {
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
        }

        /* Role Selector */
        .role-selector {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
        }

        .role-pill {
            flex: 1;
            padding: 12px 16px;
            background: #F2EFF9;
            border: 2px solid transparent;
            border-radius: 10px;
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #5A4F6B;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s;
        }

        .role-pill:hover {
            background: #EDE4F9;
        }

        .role-pill.active {
            background: rgba(200, 90, 0, 0.1);
            border-color: #C85A00;
            color: #C85A00;
        }

        .role-pill i {
            margin-right: 6px;
        }

        /* Password Strength */
        .password-strength {
            margin-top: 10px;
        }

        .strength-bar {
            display: flex;
            gap: 6px;
            margin-bottom: 8px;
        }

        .strength-segment {
            flex: 1;
            height: 4px;
            background: #E8E0F5;
            border-radius: 2px;
            transition: background 0.2s;
        }

        .strength-segment.weak { background: #B52B2B; }
        .strength-segment.fair { background: #B56B00; }
        .strength-segment.good { background: #1A5C99; }
        .strength-segment.strong { background: #1A7A4A; }

        .strength-text {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            color: #8B7FA0;
        }

        .password-rules {
            margin-top: 16px;
            padding: 16px;
            background: #F7F3FD;
            border-radius: 10px;
        }

        .password-rule {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: #5A4F6B;
            margin-bottom: 8px;
        }

        .password-rule:last-child { margin-bottom: 0; }

        .password-rule i {
            font-size: 14px;
        }

        .password-rule.valid { color: #1A7A4A; }
        .password-rule.invalid { color: #5A4F6B; }

        /* Back Link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #5A4F6B;
            text-decoration: none;
            margin-bottom: 24px;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #3D1A6E;
        }

        /* Success State */
        .success-state {
            text-align: center;
            padding: 24px 0;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: #D4F5E4;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }

        .success-icon i {
            font-size: 40px;
            color: #1A7A4A;
        }

        .success-state h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #1A0D2E;
            margin-bottom: 8px;
        }

        .success-state p {
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            color: #5A4F6B;
            margin-bottom: 24px;
        }

        .countdown {
            font-family: 'JetBrains Mono', monospace;
            font-size: 14px;
            color: #8B7FA0;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .auth-brand-panel {
                display: none;
            }

            .auth-form-panel {
                width: 100%;
                padding: 32px 20px;
            }

            .mobile-logo {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
            }

            .mobile-logo .brand-logo {
                width: 48px;
                height: 48px;
                font-size: 20px;
            }

            .mobile-logo h1 {
                font-family: 'Outfit', sans-serif;
                font-size: 20px;
                font-weight: 700;
                color: #1A0D2E;
            }

            .auth-form-card {
                padding: 32px 24px;
            }
        }

        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&display=swap');
    </style>
</head>
<body>
    <!-- ══════════════════════════════════════════════════════
         SESSION TOASTS
    ═══════════════════════════════════════════════════════ -->
    @php
        $sessionToasts = collect([
            ['message' => session('success'), 'type' => 'success'],
            ['message' => session('error'), 'type' => 'danger'],
            ['message' => session('warning'), 'type' => 'warning'],
            ['message' => session('info'), 'type' => 'info'],
            ['message' => (session()->has('success') || session()->has('error') || session()->has('warning') || session()->has('info')) ? null : session('status'), 'type' => 'info'],
        ])->filter(fn ($toast) => filled($toast['message']))->values();
    @endphp

    @if($sessionToasts->isNotEmpty())
    <script>
        window.sessionToasts = @json($sessionToasts);
        document.addEventListener('DOMContentLoaded', function() {
            window.sessionToasts.forEach(function(toast) {
                showToast(toast.message, toast.type);
            });
        });
    </script>
    @endif

    <div class="auth-wrapper">
        @yield('content')
    </div>

    <style>
        /* Toast styles */
        .toast-stack {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-width: 380px;
            pointer-events: none;
        }
        .toast {
            background: var(--ink, #1A0D2E);
            color: #ffffff;
            padding: 13px 16px;
            border-radius: var(--r-lg, 12px);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            box-shadow: var(--sh-lg, 0 12px 32px rgba(26, 13, 46, 0.22));
            pointer-events: auto;
            transform: translateX(20px);
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border-left: 4px solid #C85A00;
            position: relative;
            overflow: hidden;
            line-height: 1.5;
            min-width: 300px;
        }
        .toast.show { transform: translateX(0); opacity: 1; }
        .toast.success { border-left-color: #1A7A4A; }
        .toast.warning { border-left-color: #F4C240; }
        .toast.danger { border-left-color: #ff6b6b; }
        .toast.info { border-left-color: #64b5f6; }
        .toast i { font-size: 0.9rem; flex-shrink: 0; margin-top: 1px; }
        .toast-text { flex: 1; min-width: 0; }
        .toast-msg { display: block; }
        .toast-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.5);
            cursor: pointer;
            font-size: 0.75rem;
            flex-shrink: 0;
            margin-left: 4px;
            padding: 0;
        }
        .toast-close:hover { color: #ffffff; }
        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
            background: rgba(255,255,255,0.3);
            animation: toast-progress linear forwards;
        }
        @keyframes toast-progress { from { width: 100%; } to { width: 0%; } }
    </style>
    <script>
        // Toast System for Auth pages
        const Toast = {
            container: null,
            MAX: 4,
            DURATION: { success: 4000, info: 4000, warning: 6000, danger: 6000 },
            ICONS: {
                success: 'fas fa-check-circle',
                warning: 'fas fa-exclamation-triangle',
                danger: 'fas fa-times-circle',
                info: 'fas fa-info-circle'
            },
            init() {
                this.container = document.querySelector('.toast-stack');
                if (!this.container) {
                    this.container = document.createElement('div');
                    this.container.className = 'toast-stack';
                    document.body.appendChild(this.container);
                }
            },
            show(message, type = 'success') {
                this.init();
                const duration = this.DURATION[type] || 4000;
                const existing = this.container.querySelectorAll('.toast');
                if (existing.length >= this.MAX) {
                    existing[0].remove();
                }

                const toast = document.createElement('div');
                toast.className = `toast ${type}`;
                toast.innerHTML = `
                    <i class="${this.ICONS[type] || 'fas fa-bell'}"></i>
                    <div class="toast-text">
                        <span class="toast-msg">${message}</span>
                    </div>
                    <button class="toast-close" aria-label="Dismiss">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="toast-progress"></div>
                `;
                
                this.container.appendChild(toast);
                requestAnimationFrame(() => requestAnimationFrame(() => toast.classList.add('show')));
                
                // Close button
                toast.querySelector('.toast-close').addEventListener('click', () => {
                    this.dismiss(toast);
                });
                
                // Progress bar animation
                const progress = toast.querySelector('.toast-progress');
                progress.style.animationDuration = `${duration}ms`;
                
                // Auto dismiss
                const timer = setTimeout(() => {
                    this.dismiss(toast);
                }, duration);
                
                // Pause on hover
                toast.addEventListener('mouseenter', () => {
                    clearTimeout(timer);
                    progress.style.animationPlayState = 'paused';
                });
                toast.addEventListener('mouseleave', () => {
                    progress.style.animationPlayState = 'running';
                    const remainingTime = parseFloat(getComputedStyle(progress).animationDuration) * 1000 * (1 - parseFloat(getComputedStyle(progress).width) / parseFloat(getComputedStyle(toast).width));
                    setTimeout(() => {
                        this.dismiss(toast);
                    }, remainingTime);
                });
            },
            dismiss(toast) {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.remove();
                }, 320);
            }
        };
        
        function showToast(message, type) {
            Toast.show(message, type);
        }

        // Password toggle
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('[data-toggle-password]');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = document.querySelector(this.getAttribute('data-toggle-password'));
                    const icon = this.querySelector('i');
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // Role selector
            const rolePills = document.querySelectorAll('.role-pill');
            rolePills.forEach(pill => {
                pill.addEventListener('click', function() {
                    rolePills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Password strength indicator
            const passwordInput = document.querySelector('[data-password-strength]');
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    updatePasswordStrength(this.value);
                });
            }

            document.querySelectorAll('form[data-auth-submit]').forEach(form => {
                form.addEventListener('submit', function() {
                    const button = form.querySelector('[data-submit-button]');
                    if (!button) return;

                    button.disabled = true;
                    button.classList.add('is-loading');
                    button.setAttribute('aria-busy', 'true');
                });
            });
        });

        function updatePasswordStrength(password) {
            const segments = document.querySelectorAll('.strength-segment');
            const strengthText = document.querySelector('.strength-text');
            const rules = document.querySelectorAll('.password-rule');
            
            let score = 0;
            const checks = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                number: /[0-9]/.test(password),
                symbol: /[^A-Za-z0-9]/.test(password)
            };

            // Update rules display
            rules.forEach((rule, index) => {
                const keys = ['length', 'uppercase', 'number', 'symbol'];
                const isValid = checks[keys[index]];
                
                rule.classList.remove('valid', 'invalid');
                rule.classList.add(isValid ? 'valid' : 'invalid');
                
                const icon = rule.querySelector('i');
                icon.classList.remove('fa-check-circle', 'fa-circle');
                icon.classList.add(isValid ? 'fa-check-circle' : 'fa-circle');
            });

            // Calculate score
            score = Object.values(checks).filter(Boolean).length;

            // Update segments
            segments.forEach((segment, index) => {
                segment.classList.remove('weak', 'fair', 'good', 'strong');
                if (index < score) {
                    if (score <= 1) segment.classList.add('weak');
                    else if (score === 2) segment.classList.add('fair');
                    else if (score === 3) segment.classList.add('good');
                    else segment.classList.add('strong');
                }
            });

            // Update text
            if (score === 0) strengthText.textContent = '';
            else if (score === 1) strengthText.textContent = 'Weak password';
            else if (score === 2) strengthText.textContent = 'Fair password';
            else if (score === 3) strengthText.textContent = 'Good password';
            else strengthText.textContent = 'Strong password';
        }
    </script>
</body>
</html>
