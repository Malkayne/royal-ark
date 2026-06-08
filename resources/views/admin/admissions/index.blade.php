@extends('layouts.admin.app')

@section('title', 'Admissions - Royal Ark College Admin')

@section('content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h1>Admission Applications</h1>
            <p>2025/2026 Academic Session — 48 total applications</p>
        </div>
        <div class="page-header-actions">
            <button class="btn btn-outline btn-sm">
                <i class="fas fa-download"></i> Export CSV
            </button>
            <button class="btn btn-outline btn-sm">
                <i class="fas fa-filter"></i> Filter
            </button>
            <button class="btn btn-outline btn-sm">
                <i class="fas fa-list"></i> Bulk Actions
            </button>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar" style="background: var(--white); padding: 14px 18px; border: 1px solid var(--canvas-border); border-radius: var(--r-lg); margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
        <div class="search-box" style="flex: 1; min-width: 220px;">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search by name, email, ID…">
        </div>
        <select class="form-control" style="width: auto;">
            <option>All Classes</option>
            <option>Creche</option>
            <option>Nursery</option>
            <option>Primary</option>
            <option>JSS</option>
            <option>SSS</option>
        </select>
        <select class="form-control" style="width: auto;">
            <option>All Statuses</option>
            <option>Pending</option>
            <option>In Review</option>
            <option>Approved</option>
            <option>Rejected</option>
        </select>
        <select class="form-control" style="width: auto;">
            <option>Date Range</option>
            <option>Today</option>
            <option>This Week</option>
            <option>This Month</option>
        </select>
        <button class="btn btn-ghost btn-sm">
            <i class="fas fa-times"></i> Clear
        </button>
    </div>

    <!-- Bulk Bar (hidden by default) -->
    <div class="bulk-bar" style="background: linear-gradient(135deg, var(--royal-pale), var(--canvas-bg)); padding: 12px 18px; border: 1px solid var(--canvas-border-dark); border-radius: var(--r-md); margin-bottom: 20px; display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
        <span class="bulk-count" style="font-family: var(--font-ui); font-weight: 700; color: var(--royal);">3 applications selected</span>
        <button class="btn btn-success btn-sm">
            <i class="fas fa-check"></i> Approve Selected
        </button>
        <button class="btn btn-warning btn-sm">
            <i class="fas fa-eye"></i> Mark in Review
        </button>
        <button class="btn btn-danger btn-sm">
            <i class="fas fa-times"></i> Reject Selected
        </button>
        <button class="btn btn-ghost btn-sm ml-auto">
            Clear Selection
        </button>
    </div>

    <!-- Table -->
    <div class="datatable-card">
        <div class="datatable-header">
            <div class="datatable-title-group">
                <div class="datatable-title">Recent Applications</div>
                <div class="datatable-subtitle">Showing 1-15 of 48 applications</div>
            </div>
        </div>
        <div class="table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 40px;">
                            <input type="checkbox" class="row-check" id="checkAll">
                        </th>
                        <th>Applicant</th>
                        <th>Class</th>
                        <th>Parent</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label=""><input type="checkbox" class="row-check"></td>
                        <td data-label="Applicant">
                            <div class="user-cell">
                                <div class="user-avatar" style="background: linear-gradient(135deg, var(--royal), var(--amber)); color: white;">CO</div>
                                <div>
                                    <div class="td-primary">Chidi Emmanuel Obi</div>
                                    <div class="td-sub mono">RAC-2025-0048</div>
                                </div>
                            </div>
                        </td>
                        <td data-label="Class"><span class="badge badge-royal">JSS 1</span></td>
                        <td data-label="Parent"><span class="td-mono">Mr. Obi E.</span></td>
                        <td data-label="Date"><span class="td-mono">Jan 10, 2026</span></td>
                        <td data-label="Status"><span class="badge badge-pending badge-dot">Pending</span></td>
                        <td data-label="Actions">
                            <div class="row-actions">
                                <a href="{{ route('admin.admissions.detail', ['id' => 1]) }}" class="btn btn-outline btn-xs">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <div class="action-menu">
                                    <button class="action-menu-btn" aria-label="More actions">
                                        <i class="fas fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="action-menu-dropdown">
                                        <a href="{{ route('admin.admissions.detail', ['id' => 1]) }}" class="action-menu-item">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                        <div class="action-menu-item" style="color: var(--s-open);">
                                            <i class="fas fa-check-circle"></i> Approve
                                        </div>
                                        <div class="action-menu-item" style="color: var(--s-review);">
                                            <i class="fas fa-eye"></i> Mark in Review
                                        </div>
                                        <div class="action-menu-item" style="color: var(--s-rejected);">
                                            <i class="fas fa-times-circle"></i> Reject
                                        </div>
                                        <div class="action-menu-divider"></div>
                                        <div class="action-menu-item danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td data-label=""><input type="checkbox" class="row-check"></td>
                        <td data-label="Applicant">
                            <div class="user-cell">
                                <div class="user-avatar" style="background: linear-gradient(135deg, var(--amber), var(--royal)); color: white;">AU</div>
                                <div>
                                    <div class="td-primary">Amaka Chisom Uche</div>
                                    <div class="td-sub mono">RAC-2025-0047</div>
                                </div>
                            </div>
                        </td>
                        <td data-label="Class"><span class="badge badge-royal">Primary 4</span></td>
                        <td data-label="Parent"><span class="td-mono">Mrs. Uche N.</span></td>
                        <td data-label="Date"><span class="td-mono">Jan 10, 2026</span></td>
                        <td data-label="Status"><span class="badge badge-pending badge-dot">Pending</span></td>
                        <td data-label="Actions">
                            <div class="row-actions">
                                <a href="{{ route('admin.admissions.detail', ['id' => 2]) }}" class="btn btn-outline btn-xs">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <div class="action-menu">
                                    <button class="action-menu-btn" aria-label="More actions">
                                        <i class="fas fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="action-menu-dropdown">
                                        <a href="{{ route('admin.admissions.detail', ['id' => 2]) }}" class="action-menu-item">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                        <div class="action-menu-item" style="color: var(--s-open);">
                                            <i class="fas fa-check-circle"></i> Approve
                                        </div>
                                        <div class="action-menu-item" style="color: var(--s-review);">
                                            <i class="fas fa-eye"></i> Mark in Review
                                        </div>
                                        <div class="action-menu-item" style="color: var(--s-rejected);">
                                            <i class="fas fa-times-circle"></i> Reject
                                        </div>
                                        <div class="action-menu-divider"></div>
                                        <div class="action-menu-item danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td data-label=""><input type="checkbox" class="row-check"></td>
                        <td data-label="Applicant">
                            <div class="user-cell">
                                <div class="user-avatar" style="background: linear-gradient(135deg, var(--royal-pale), var(--amber-pale)); color: var(--royal);">TA</div>
                                <div>
                                    <div class="td-primary">Tunde Adebayo Akin</div>
                                    <div class="td-sub mono">RAC-2025-0046</div>
                                </div>
                            </div>
                        </td>
                        <td data-label="Class"><span class="badge badge-royal">SSS 1</span></td>
                        <td data-label="Parent"><span class="td-mono">Mr. Akin T.</span></td>
                        <td data-label="Date"><span class="td-mono">Jan 09, 2026</span></td>
                        <td data-label="Status"><span class="badge badge-review badge-dot">In Review</span></td>
                        <td data-label="Actions">
                            <div class="row-actions">
                                <a href="{{ route('admin.admissions.detail', ['id' => 3]) }}" class="btn btn-outline btn-xs">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <div class="action-menu">
                                    <button class="action-menu-btn" aria-label="More actions">
                                        <i class="fas fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="action-menu-dropdown">
                                        <a href="{{ route('admin.admissions.detail', ['id' => 3]) }}" class="action-menu-item">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                        <div class="action-menu-item" style="color: var(--s-open);">
                                            <i class="fas fa-check-circle"></i> Approve
                                        </div>
                                        <div class="action-menu-item" style="color: var(--s-rejected);">
                                            <i class="fas fa-times-circle"></i> Reject
                                        </div>
                                        <div class="action-menu-divider"></div>
                                        <div class="action-menu-item danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="pagination">
                <button class="page-btn" disabled><i class="fas fa-chevron-left"></i></button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <span class="page-sep">...</span>
                <button class="page-btn">8</button>
                <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
            </div>
            <span class="page-info">Showing 1-15 of 48</span>
        </div>
    </div>
</div>
@endsection