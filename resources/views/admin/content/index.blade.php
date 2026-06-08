@extends('layouts.admin.app')

@section('title', 'Content Manager - Royal Ark College Admin')

@section('content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h1>Website Content Manager</h1>
            <p>Changes here update the public website immediately</p>
        </div>
    </div>

    <!-- Content Hub Grid -->
    <div class="content-hub-grid">
        <!-- Hero Section -->
        <a href="{{ route('admin.content.hero') }}" class="content-hub-card">
            <div class="content-hub-card-icon">
                <i class="fas fa-home"></i>
            </div>
            <div class="content-hub-card-title">Hero Section</div>
            <div class="content-hub-card-meta">
                <div style="display: flex; align-items: center; gap: 6px; color: var(--s-open);">
                    <span class="live-dot green"></span>
                    Live & up to date
                </div>
                <div style="font-family: var(--font-mono); font-size: 0.65rem; color: var(--text-muted); margin-top: 4px;">Last edited: 2 days ago</div>
            </div>
            <div class="content-hub-card-footer">
                <span class="content-hub-card-cta">Edit <i class="fas fa-arrow-right"></i></span>
            </div>
        </a>

        <!-- About Snippet -->
        <a href="{{ route('admin.content.about') }}" class="content-hub-card">
            <div class="content-hub-card-icon">
                <i class="fas fa-info"></i>
            </div>
            <div class="content-hub-card-title">About Snippet</div>
            <div class="content-hub-card-meta">
                <div style="display: flex; align-items: center; gap: 6px; color: var(--s-open);">
                    <span class="live-dot green"></span>
                    Live & up to date
                </div>
                <div style="font-family: var(--font-mono); font-size: 0.65rem; color: var(--text-muted); margin-top: 4px;">Last edited: 1 week ago</div>
            </div>
            <div class="content-hub-card-footer">
                <span class="content-hub-card-cta">Edit <i class="fas fa-arrow-right"></i></span>
            </div>
        </a>

        <!-- Programs / Levels -->
        <a href="{{ route('admin.content.programs') }}" class="content-hub-card">
            <div class="content-hub-card-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="content-hub-card-title">Programs / Levels</div>
            <div class="content-hub-card-meta">
                <div style="display: flex; align-items: center; gap: 6px; color: var(--s-open);">
                    <span class="live-dot green"></span>
                    Live & up to date
                </div>
                <div style="font-family: var(--font-mono); font-size: 0.65rem; color: var(--text-muted); margin-top: 4px;">Last edited: 3 days ago</div>
            </div>
            <div class="content-hub-card-footer">
                <span class="content-hub-card-cta">Edit <i class="fas fa-arrow-right"></i></span>
            </div>
        </a>

        <!-- Why Choose Us -->
        <a href="{{ route('admin.content.why-choose-us') }}" class="content-hub-card">
            <div class="content-hub-card-icon">
                <i class="fas fa-crown"></i>
            </div>
            <div class="content-hub-card-title">Why Choose Us</div>
            <div class="content-hub-card-meta">
                <div style="display: flex; align-items: center; gap: 6px; color: var(--s-open);">
                    <span class="live-dot green"></span>
                    Live & up to date
                </div>
                <div style="font-family: var(--font-mono); font-size: 0.65rem; color: var(--text-muted); margin-top: 4px;">Last edited: 5 days ago</div>
            </div>
            <div class="content-hub-card-footer">
                <span class="content-hub-card-cta">Edit <i class="fas fa-arrow-right"></i></span>
            </div>
        </a>

        <!-- Gallery -->
        <a href="{{ route('admin.content.gallery') }}" class="content-hub-card">
            <div class="content-hub-card-icon">
                <i class="fas fa-images"></i>
            </div>
            <div class="content-hub-card-title">Gallery</div>
            <div class="content-hub-card-meta">
                <div style="display: flex; align-items: center; gap: 6px; color: var(--s-open);">
                    <span class="live-dot green"></span>
                    34 items
                </div>
                <div style="font-family: var(--font-mono); font-size: 0.65rem; color: var(--text-muted); margin-top: 4px;">Last edited: 4 days ago</div>
            </div>
            <div class="content-hub-card-footer">
                <span class="content-hub-card-cta">Manage <i class="fas fa-arrow-right"></i></span>
            </div>
        </a>

        <!-- Testimonials -->
        <a href="{{ route('admin.content.testimonials') }}" class="content-hub-card">
            <div class="content-hub-card-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="content-hub-card-title">Testimonials</div>
            <div class="content-hub-card-meta">
                <div style="display: flex; align-items: center; gap: 6px; color: var(--s-open);">
                    <span class="live-dot green"></span>
                    Live & up to date
                </div>
                <div style="font-family: var(--font-mono); font-size: 0.65rem; color: var(--text-muted); margin-top: 4px;">Last edited: 1 week ago</div>
            </div>
            <div class="content-hub-card-footer">
                <span class="content-hub-card-cta">Edit <i class="fas fa-arrow-right"></i></span>
            </div>
        </a>

        <!-- Stats Bar -->
        <a href="{{ route('admin.content.stats') }}" class="content-hub-card">
            <div class="content-hub-card-icon">
                <i class="fas fa-chart-bar"></i>
            </div>
            <div class="content-hub-card-title">Stats Bar</div>
            <div class="content-hub-card-meta">
                <div style="display: flex; align-items: center; gap: 6px; color: var(--s-open);">
                    <span class="live-dot green"></span>
                    Live & up to date
                </div>
                <div style="font-family: var(--font-mono); font-size: 0.65rem; color: var(--text-muted); margin-top: 4px;">Last edited: 1 week ago</div>
            </div>
            <div class="content-hub-card-footer">
                <span class="content-hub-card-cta">Edit <i class="fas fa-arrow-right"></i></span>
            </div>
        </a>

        <!-- Footer Info -->
        <a href="{{ route('admin.content.footer') }}" class="content-hub-card">
            <div class="content-hub-card-icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="content-hub-card-title">Footer Info</div>
            <div class="content-hub-card-meta">
                <div style="display: flex; align-items: center; gap: 6px; color: var(--s-open);">
                    <span class="live-dot green"></span>
                    Live & up to date
                </div>
                <div style="font-family: var(--font-mono); font-size: 0.65rem; color: var(--text-muted); margin-top: 4px;">Last edited: 2 weeks ago</div>
            </div>
            <div class="content-hub-card-footer">
                <span class="content-hub-card-cta">Edit <i class="fas fa-arrow-right"></i></span>
            </div>
        </a>
    </div>
</div>
@endsection