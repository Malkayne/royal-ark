@extends('layouts.admin.app')

@section('title', 'Admission Details - Royal Ark College Admin')

@section('content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <a href="{{ route('admin.admissions.index') }}" class="btn btn-outline btn-sm" style="margin-bottom: 12px; display: inline-flex; align-items: center; gap: 6px;">
                <i class="fas fa-arrow-left"></i> Back to Applications
            </a>
            <h1>Application: RAC-2025-0048</h1>
            <p>Submitted: January 10, 2026 — 10:34 AM</p>
        </div>
    </div>

    <div class="grid-2-1">
        <!-- Left: Details -->
        <div>
            <!-- Tabs -->
            <div class="admin-tabs">
                <button class="admin-tab active">Student Info</button>
                <button class="admin-tab">Parent Info</button>
                <button class="admin-tab">Documents</button>
                <button class="admin-tab">Notes</button>
            </div>

            <!-- Tab Content: Student Info -->
            <div class="admin-tab-panel active" style="display: block;">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Student Information</div>
                    </div>
                    <div class="card-body">
                        <div class="kv-list">
                            <div class="kv-row">
                                <div class="kv-key">Full Name</div>
                                <div class="kv-val">Chidi Emmanuel Obi</div>
                            </div>
                            <div class="kv-row">
                                <div class="kv-key">Date of Birth</div>
                                <div class="kv-val">March 15, 2016 (9 years)</div>
                            </div>
                            <div class="kv-row">
                                <div class="kv-key">Gender</div>
                                <div class="kv-val">Male</div>
                            </div>
                            <div class="kv-row">
                                <div class="kv-key">Nationality</div>
                                <div class="kv-val">Nigerian</div>
                            </div>
                            <div class="kv-row">
                                <div class="kv-key">Class Applying For</div>
                                <div class="kv-val"><span class="badge badge-royal">JSS 1</span></div>
                            </div>
                            <div class="kv-row">
                                <div class="kv-key">Previous School</div>
                                <div class="kv-val">Graceville Nursery & Primary School</div>
                            </div>
                            <div class="kv-row">
                                <div class="kv-key">Address</div>
                                <div class="kv-val">12, Admiralty Way, Lekki Phase 1, Lagos</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Action Panel -->
        <div>
            <div class="card" style="position: sticky; top: 80px;">
                <div class="card-header">
                    <div class="card-title">Current Status</div>
                </div>
                <div class="card-body">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                        <span class="badge badge-pending badge-dot" style="font-size: var(--t-sm); padding: 8px 14px;">Pending Review</span>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px;">
                        <button class="btn btn-success btn-md">
                            <i class="fas fa-check"></i> Approve Application
                        </button>
                        <button class="btn btn-outline btn-md">
                            <i class="fas fa-eye"></i> Mark in Review
                        </button>
                        <button class="btn btn-danger btn-md">
                            <i class="fas fa-times"></i> Reject Application
                        </button>
                    </div>

                    <div class="divider"></div>

                    <button class="btn btn-outline btn-md w-full" style="width: 100%;">
                        <i class="fas fa-envelope"></i> Send Email to Parent
                    </button>

                    <div class="divider"></div>

                    <div class="kv-list" style="margin-top: 12px;">
                        <div class="kv-row">
                            <div class="kv-key">Application ID</div>
                            <div class="kv-val mono">RAC-2025-0048 <span class="copy-text" style="cursor: pointer; color: var(--amber); margin-left: 8px;"><i class="fas fa-copy"></i></span></div>
                        </div>
                        <div class="kv-row">
                            <div class="kv-key">Submitted</div>
                            <div class="kv-val mono">Jan 10, 2026 — 10:34 AM</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection