@extends('layouts.admin.app')

@section('title', 'Hero Section - Royal Ark College Admin')

@section('content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h1>Hero Section Editor</h1>
            <p>Content / Hero Section</p>
        </div>
        <div class="page-header-actions">
            <a href="{{ route('home') }}" target="_blank" class="btn btn-outline btn-sm">
                <i class="fas fa-external-link-alt"></i> Preview on Website
            </a>
        </div>
    </div>

    <!-- Editor Card -->
    <div class="card">
        <div class="card-body">
            <div class="form-section">
                <div class="form-section-title">Hero Content</div>

                <div class="form-group">
                    <label class="form-label">Hero Badge Text</label>
                    <input type="text" class="form-control" value="Est. 2005 · Accredited Institution">
                </div>

                <div class="form-group">
                    <label class="form-label">Main Heading Line 1 <span class="req">*</span></label>
                    <input type="text" class="form-control" value="Nurturing Royalty,">
                </div>

                <div class="form-group">
                    <label class="form-label">Main Heading Line 2 <span class="req">*</span></label>
                    <input type="text" class="form-control" value="Inspiring Excellence">
                </div>

                <div class="form-group">
                    <label class="form-label">Italic Word Selector</label>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <label class="form-check">
                            <input type="radio" name="italic-line" checked>
                            <span class="form-check-label">Line 1</span>
                        </label>
                        <label class="form-check">
                            <input type="radio" name="italic-line">
                            <span class="form-check-label">Line 2</span>
                        </label>
                        <label class="form-check">
                            <input type="radio" name="italic-line">
                            <span class="form-check-label">Both</span>
                        </label>
                        <label class="form-check">
                            <input type="radio" name="italic-line">
                            <span class="form-check-label">None</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Subtitle / Tagline <span class="req">*</span></label>
                    <textarea class="form-control" rows="2">Royal Ark College equips students with the knowledge, skills, and character needed to excel in a rapidly changing world.</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Primary CTA Button</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="Apply Now">
                            <input type="text" class="form-control" value="/apply">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Secondary CTA Button</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="Explore Programs">
                            <input type="text" class="form-control" value="/programs">
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="form-group">
                    <label class="form-label">Background Style</label>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <label class="form-check">
                            <input type="radio" name="bg-style" checked>
                            <span class="form-check-label">Gradient (default)</span>
                        </label>
                        <label class="form-check">
                            <input type="radio" name="bg-style">
                            <span class="form-check-label">Image + Overlay</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Upload Hero Background Image</label>
                    <div style="border: 2px dashed var(--canvas-border-dark); border-radius: var(--r-md); padding: 30px; text-align: center;">
                        <i class="fas fa-cloud-upload-alt" style="font-size: 2.5rem; color: var(--text-muted); margin-bottom: 12px;"></i>
                        <p style="font-family: var(--font-data); color: var(--text-muted); margin-bottom: 8px;">Drop image here or click to browse</p>
                        <p style="font-family: var(--font-mono); font-size: 0.7rem; color: var(--text-muted);">PNG, JPG up to 5MB</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Overlay Opacity</label>
                    <input type="range" style="width: 100%;" min="0" max="100" value="60">
                    <div style="font-family: var(--font-mono); font-size: 0.7rem; color: var(--text-muted); text-align: center; margin-top: 4px;">60%</div>
                </div>

                <div class="divider"></div>

                <div style="display: flex; gap: 10px;">
                    <button class="btn btn-primary btn-md">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <button class="btn btn-outline btn-md">
                        <i class="fas fa-eye"></i> Preview Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection