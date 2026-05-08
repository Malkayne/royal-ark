<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    @php
        $siteName = 'Royal Ark Schools';
        $defaultDesc = 'Royal Ark Schools - Nurturing Royalty, Inspiring Excellence. A leading private school in Lagos offering Creche, Nursery, Primary, Junior and Senior Secondary education.';
        $currentUrl = request()->url();
        $ogImage = asset('landing/img/ras-logo.jpg');
    @endphp

    <title>@yield('title', 'Royal Ark Schools — Nurturing Royalty, Inspiring Excellence')</title>
    <meta name="description" content="@yield('meta_description', $defaultDesc)">
    <meta name="keywords" content="@yield('meta_keywords', 'Royal Ark Schools, private school Lagos, secondary school, primary school, nursery school, creche, education excellence, WAEC prep')">
    <meta name="author" content="Royal Ark Schools">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $currentUrl }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:title" content="@yield('title', $siteName)">
    <meta property="og:description" content="@yield('meta_description', $defaultDesc)">
    <meta property="og:image" content="@yield('og_image', $ogImage)">
    <meta property="og:site_name" content="{{ $siteName }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $currentUrl }}">
    <meta name="twitter:title" content="@yield('title', $siteName)">
    <meta name="twitter:description" content="@yield('meta_description', $defaultDesc)">
    <meta name="twitter:image" content="@yield('og_image', $ogImage)">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('landing/img/ras-logo.jpg') }}" type="image/jpeg">

    {{-- Assets --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('landing/css/main.css') }}">
    @stack('styles')
</head>
<body>

    {{-- Admission Alert Bar --}}
    <!-- <div class="admit-bar">
        <div class="container admit-bar-inner">
            <span class="pulse-dot"></span>
            <span><strong>Admissions Open</strong> for 2025/2026 Academic Session</span>
            <a href="{{ route('admissions') }}">Apply Now &rarr;</a>
        </div>
        <button class="admit-bar-close" aria-label="Close alert">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div> -->

    @if(!View::hasSection('hide-navbar'))
    {{-- Navbar --}}
    <nav class="navbar @yield('navbar-class', 'solid')">
        <div class="container navbar-inner">
            <a href="{{ route('home') }}" class="navbar-logo">
                <img src="{{ asset('landing/img/ras-logo.jpg') }}" class="logo-crest" alt="Royal Ark Schools Logo">
                <div class="logo-text">
                    <span class="logo-name">Royal Ark Schools</span>
                    <span class="logo-motto">Royalty in Excellence</span>
                </div>
            </a>

            <div class="navbar-nav">
                <a href="{{ route('home') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('academics') }}" class="nav-link {{ request()->is('academics') ? 'active' : '' }}">Academics</a>
                <a href="{{ route('admissions') }}" class="nav-link {{ request()->is('admissions') ? 'active' : '' }}">Admissions</a>

                <div class="nav-dropdown">
                    <span class="nav-link nav-dropdown-toggle">
                        Community <i class="fa-solid fa-chevron-down chevron"></i>
                    </span>
                    <div class="nav-dropdown-menu">
                        <!-- <a href="{{ route('news') }}" class="nav-dropdown-item">
                            <span class="dd-icon"><i class="fa-regular fa-newspaper"></i></span>
                            <div>
                                <div class="dd-label">News</div>
                                <div class="dd-desc">Latest updates &amp; events</div>
                            </div>
                        </a> -->
                        <a href="{{ route('gallery') }}" class="nav-dropdown-item">
                            <span class="dd-icon"><i class="fa-regular fa-images"></i></span>
                            <div>
                                <div class="dd-label">Gallery</div>
                                <div class="dd-desc">Photos &amp; videos</div>
                            </div>
                        </a>
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
            </div>

            <div class="navbar-actions">
                <a href="{{ route('apply') }}" class="btn btn-primary btn-sm">Apply Now</a>
                <!-- <a href="{{ url('/login') }}" class="nav-staff-link">Staff Login</a> -->
                <button class="navbar-hamburger" aria-label="Open menu" aria-expanded="false">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </div>
    </nav>

    {{-- Mobile Drawer --}}
    <div class="drawer-overlay"></div>
    <div class="mobile-drawer">
        <div class="mobile-drawer-header">
            <a href="{{ route('home') }}" class="navbar-logo">
                <img src="{{ asset('landing/img/ras-logo.jpg') }}" class="logo-crest" alt="Royal Ark Schools Logo">
                <div class="logo-text">
                    <span class="logo-name">Royal Ark Schools</span>
                    <span class="logo-motto">Royalty in Excellence</span>
                </div>
            </a>
            <button class="mobile-drawer-close" aria-label="Close menu">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <nav class="mobile-drawer-nav">
            <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->is('/') ? 'active' : '' }}">
                <span class="link-icon"><i class="fa-solid fa-house"></i></span> Home
            </a>
            <a href="{{ route('about') }}" class="mobile-nav-link {{ request()->is('about') ? 'active' : '' }}">
                <span class="link-icon"><i class="fa-solid fa-circle-info"></i></span> About
            </a>
            <a href="{{ route('academics') }}" class="mobile-nav-link {{ request()->is('academics') ? 'active' : '' }}">
                <span class="link-icon"><i class="fa-solid fa-graduation-cap"></i></span> Academics
            </a>
            <a href="{{ route('admissions') }}" class="mobile-nav-link {{ request()->is('admissions') ? 'active' : '' }}">
                <span class="link-icon"><i class="fa-solid fa-clipboard-list"></i></span> Admissions
            </a>
            <a href="{{ route('gallery') }}" class="mobile-nav-link {{ request()->is('gallery') ? 'active' : '' }}">
                <span class="link-icon"><i class="fa-solid fa-images"></i></span> Gallery
            </a>
            <a href="{{ route('contact') }}" class="mobile-nav-link {{ request()->is('contact') ? 'active' : '' }}">
                <span class="link-icon"><i class="fa-solid fa-envelope"></i></span> Contact
            </a>
        </nav>
        <div class="mobile-drawer-footer">
            <a href="{{ route('apply') }}" class="btn btn-primary btn-md w-full">Apply Now</a>
            <!-- <a href="{{ url('/login') }}" class="nav-staff-link" style="color:rgba(255,255,255,0.45);text-align:center;display:block;">Staff Login</a> -->
        </div>
    </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="site-footer">
        <div class="container footer-top">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ route('home') }}" class="footer-logo navbar-logo" style="margin-bottom:16px;">
                        <img src="{{ asset('landing/img/ras-logo.jpg') }}" class="logo-crest" alt="Royal Ark Schools Logo">
                        <div class="logo-text">
                            <span class="logo-name">Royal Ark Schools</span>
                            <span class="logo-motto">Royalty in Excellence</span>
                        </div>
                    </a>
                    <p style="margin-bottom: 1rem;">Equipping every student with the character, knowledge, and ambition to lead since 2005.</p>
                    <div class="footer-contact-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>21, Were Avenue, Mopol Bus Stop, Egan Road, Iyana Iyesi Ota, Ogun State</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fa-solid fa-phone"></i>
                        <span><a href="tel:09021062859">0902 106 2859</a>, <a href="tel:08134324765">0813 432 4765</a></span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fa-solid fa-envelope"></i>
                        <span><a href="mailto:info@ras.com">info@ras.com</a></span>
                    </div>
                    <div class="footer-social">
                        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" aria-label="X / Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <div class="footer-links">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('about') }}">About</a>
                        <a href="{{ route('academics') }}">Academics</a>
                        <a href="{{ route('admissions') }}">Admissions</a>
                        <a href="{{ route('contact') }}">Contact</a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Community</h4>
                    <div class="footer-links">
                        <!-- <a href="{{ route('news') }}">News</a> -->
                        <a href="{{ route('gallery') }}">Gallery</a>
                        <a href="{{ route('apply') }}">Apply Now</a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Academics</h4>
                    <div class="footer-links">
                        <a href="{{ url('/academics#programs') }}">Programs</a>
                        <a href="{{ url('/academics#curriculum') }}">Curriculum</a>
                        <a href="{{ url('/academics#calendar') }}">Academic Calendar</a>
                        <a href="{{ url('/admissions#fees') }}">School Fees</a>
                    </div>
                </div>

                <!-- <div class="footer-col footer-newsletter">
                    <h4>Newsletter</h4>
                    <p>Stay updated with the latest news, events, and announcements from Royal Ark Schools.</p>
                    <form class="newsletter-input-group" onsubmit="event.preventDefault();alert('Thanks for subscribing!');">
                        <input type="email" class="newsletter-input" placeholder="Your email" required>
                        <button type="submit" class="newsletter-btn">Subscribe</button>
                    </form>
                </div> -->
            </div>
        </div>
        <div class="container footer-bottom">
            <span style="text-align:center;">&copy; {{ date('Y') }} <a href="https://ras.com" target="_blank" style="color: var(--amber);">Royal Ark Schools</a>. Developed by <a href="https://intellicsolutions.org" target="_blank" style="color: var(--amber);">Intellic Solutions</a>. All rights reserved.</span>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Use</a>
            </div>
        </div>
    </footer>

    {{-- Scroll to top --}}
    <button class="scroll-top-btn" aria-label="Scroll to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    {{-- Toast stack --}}
    <div class="toast-stack"></div>

    {{-- Scripts --}}
    <script src="{{ asset('landing/js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>
