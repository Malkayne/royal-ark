<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard — Royal Ark College Admin')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
  <link rel="icon" href="{{ asset('landing/img/ras-logo.jpg') }}" type="image/jpeg">
  @stack('styles')
</head>
<body>
    <!-- ══════════════════════════════════════════════════════
     GLOBAL NOTICE BAR
══════════════════════════════════════════════════════════ -->
<div class="notice-bar warning" id="globalNoticeBar">
  <i class="fas fa-megaphone"></i>
  <span class="notice-bar-text">
    <strong>Reminder:</strong> Third-term resumption content needs to be updated on the website before January 1, 2026.
  </span>
  <a href="content/hero.html" class="notice-bar-action">Update Now</a>
  <button class="notice-bar-close" aria-label="Dismiss"><i class="fas fa-times"></i></button>
</div>

<!-- ══════════════════════════════════════════════════════
     SHELL
══════════════════════════════════════════════════════════ -->
<div class="admin-shell" id="adminShell">

  <!-- ══ SIDEBAR ══ -->
  <aside class="admin-sidebar" id="adminSidebar">

    <!-- Logo -->
    <a href="dashboard.html" class="sidebar-header">
      <div class="sidebar-crest">RA</div>
      <div class="sidebar-brand-text">
        <span class="sidebar-brand-name">Royal Ark College</span>
        <span class="sidebar-brand-role">Admin Panel</span>
      </div>
    </a>

    <!-- Nav -->
    <nav class="sidebar-nav">

      <!-- Overview -->
      <div class="sidebar-section">Overview</div>
      <a href="dashboard.html" class="nav-item active">
        <span class="nav-item-icon"><i class="fas fa-chart-pie"></i></span>
        <span class="nav-item-text">Dashboard</span>
        <span class="nav-tooltip">Dashboard</span>
      </a>

      <!-- School Management -->
      <div class="sidebar-section">School Management</div>
      <a href="admissions/index.html" class="nav-item">
        <span class="nav-item-icon"><i class="fas fa-folder-open"></i></span>
        <span class="nav-item-text">Admissions</span>
        <span class="nav-badge">14</span>
        <span class="nav-tooltip">Admissions</span>
      </a>
      <a href="enquiries/index.html" class="nav-item">
        <span class="nav-item-icon"><i class="fas fa-comments"></i></span>
        <span class="nav-item-text">Enquiries</span>
        <span class="nav-badge">5</span>
        <span class="nav-tooltip">Enquiries</span>
      </a>

      <!-- Content Management -->
      <div class="sidebar-section">Content Management</div>

      <!-- Website Content subnav -->
      <div class="nav-parent">
        <div class="nav-parent-trigger" data-subnav="websiteContent">
          <span class="nav-item-icon"><i class="fas fa-globe"></i></span>
          <span class="nav-item-text">Website Content</span>
          <i class="fas fa-chevron-down nav-chevron"></i>
          <span class="nav-tooltip">Website Content</span>
        </div>
        <div class="nav-subnav" id="websiteContent">
          <a href="content/hero.html"          class="nav-sub-item"><span>Hero Section</span></a>
          <a href="content/about-snippet.html" class="nav-sub-item"><span>About Snippet</span></a>
          <a href="content/programs.html"      class="nav-sub-item"><span>Programs / Levels</span></a>
          <a href="content/why-choose-us.html" class="nav-sub-item"><span>Why Choose Us</span></a>
          <a href="content/gallery.html"       class="nav-sub-item"><span>Gallery</span></a>
          <a href="content/testimonials.html"  class="nav-sub-item"><span>Testimonials</span></a>
          <a href="content/stats.html"         class="nav-sub-item"><span>Stats Bar</span></a>
          <a href="content/footer.html"        class="nav-sub-item"><span>Footer Info</span></a>
        </div>
      </div>

      <!-- Events subnav -->
      <div class="nav-parent">
        <div class="nav-parent-trigger" data-subnav="eventsNav">
          <span class="nav-item-icon"><i class="fas fa-calendar-days"></i></span>
          <span class="nav-item-text">Events</span>
          <i class="fas fa-chevron-down nav-chevron"></i>
          <span class="nav-tooltip">Events</span>
        </div>
        <div class="nav-subnav" id="eventsNav">
          <a href="events/index.html"  class="nav-sub-item"><span>All Events</span></a>
          <a href="events/editor.html" class="nav-sub-item"><span>New Event</span></a>
        </div>
      </div>

      <!-- Blog subnav -->
      <div class="nav-parent">
        <div class="nav-parent-trigger" data-subnav="blogNav">
          <span class="nav-item-icon"><i class="fas fa-newspaper"></i></span>
          <span class="nav-item-text">Blog / News</span>
          <i class="fas fa-chevron-down nav-chevron"></i>
          <span class="nav-tooltip">Blog / News</span>
        </div>
        <div class="nav-subnav" id="blogNav">
          <a href="blog/index.html"       class="nav-sub-item"><span>All Posts</span></a>
          <a href="blog/editor.html"      class="nav-sub-item"><span>New Post</span></a>
          <a href="blog/categories.html"  class="nav-sub-item"><span>Categories</span></a>
        </div>
      </div>

      <a href="content/gallery.html" class="nav-item">
        <span class="nav-item-icon"><i class="fas fa-images"></i></span>
        <span class="nav-item-text">Media Library</span>
        <span class="nav-tooltip">Media Library</span>
      </a>

      <!-- Settings -->
      <div class="sidebar-section">Settings</div>
      <a href="settings/general.html" class="nav-item">
        <span class="nav-item-icon"><i class="fas fa-gear"></i></span>
        <span class="nav-item-text">School Settings</span>
        <span class="nav-tooltip">School Settings</span>
      </a>
      <a href="settings/accounts.html" class="nav-item">
        <span class="nav-item-icon"><i class="fas fa-users-gear"></i></span>
        <span class="nav-item-text">Admin Accounts</span>
        <span class="nav-tooltip">Admin Accounts</span>
      </a>
      <a href="settings/admissions.html" class="nav-item">
        <span class="nav-item-icon"><i class="fas fa-shield-halved"></i></span>
        <span class="nav-item-text">Security</span>
        <span class="nav-tooltip">Security</span>
      </a>

    </nav>

    <!-- Sidebar user -->
    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="sidebar-user-avatar">MA</div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name">Mrs. M. Adeyemi</div>
          <div class="sidebar-user-role">Super Administrator</div>
        </div>
        <a href="auth/login.html" class="sidebar-logout" title="Logout">
          <i class="fas fa-right-from-bracket"></i>
        </a>
      </div>
    </div>
  </aside>

  <!-- Overlay for mobile -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- ══ MAIN ══ -->
  <div class="admin-main" id="adminMain">

    <!-- TOPBAR -->
    <header class="admin-topbar">
      <button class="topbar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Breadcrumb -->
      <nav class="topbar-breadcrumb" aria-label="Breadcrumb">
        <span class="bc-sep"><i class="fas fa-house" style="font-size:0.65rem;"></i></span>
        <span class="bc-sep" style="color:var(--canvas-border-dark);">›</span>
        <span class="bc-current">Dashboard</span>
      </nav>

      <div class="topbar-right">

        <!-- Notifications -->
        <div class="dropdown-wrapper" style="position:relative;">
          <button class="topbar-icon-btn" data-notif-trigger aria-label="Notifications">
            <i class="fas fa-bell"></i>
            <span class="topbar-badge has-count" style="background:var(--amber);font-size:0.55rem;font-weight:800;color:#fff;min-width:16px;height:16px;display:flex;align-items:center;justify-content:center;border-radius:var(--r-pill);position:absolute;top:4px;right:4px;padding:0 3px;">7</span>
          </button>

          <!-- Notification dropdown -->
          <div class="notif-dropdown">
            <div class="notif-header">
              <span class="notif-header-title">Notifications</span>
              <span class="notif-mark-all">Mark all read</span>
            </div>
            <div class="notif-list">
              <div class="notif-item unread">
                <div class="notif-icon amber"><i class="fas fa-folder-open"></i></div>
                <div class="notif-body">
                  <div class="notif-text">New admission — <strong>Chidi Emmanuel Obi</strong> (JSS1)</div>
                  <div class="notif-time">Just now</div>
                </div>
              </div>
              <div class="notif-item unread">
                <div class="notif-icon amber"><i class="fas fa-comments"></i></div>
                <div class="notif-body">
                  <div class="notif-text">New enquiry from <strong>Mrs. Fatima Bello</strong></div>
                  <div class="notif-time">4 minutes ago</div>
                </div>
              </div>
              <div class="notif-item unread">
                <div class="notif-icon green"><i class="fas fa-check-circle"></i></div>
                <div class="notif-body">
                  <div class="notif-text">Application <strong>RAC-2025-0040</strong> approved</div>
                  <div class="notif-time">1 hour ago</div>
                </div>
              </div>
              <div class="notif-item">
                <div class="notif-icon royal"><i class="fas fa-newspaper"></i></div>
                <div class="notif-body">
                  <div class="notif-text">Blog post <em>"Q3 Bulk Purchase"</em> published</div>
                  <div class="notif-time">2 hours ago</div>
                </div>
              </div>
              <div class="notif-item">
                <div class="notif-icon blue"><i class="fas fa-calendar-days"></i></div>
                <div class="notif-body">
                  <div class="notif-text">Event <em>"Prize Giving Day"</em> is in 14 days</div>
                  <div class="notif-time">Yesterday</div>
                </div>
              </div>
            </div>
            <div class="notif-footer">
              <a href="notifications.html" class="notif-view-all">View All Notifications <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></a>
            </div>
          </div>
        </div>

        <div class="topbar-divider"></div>

        <!-- User -->
        <div class="dropdown-wrapper" style="position:relative;">
          <div class="topbar-user" data-user-trigger>
            <div class="topbar-avatar">MA</div>
            <div class="topbar-user-info">
              <span class="topbar-user-name">Mrs. Adeyemi</span>
              <span class="topbar-user-role">Super Admin</span>
            </div>
            <i class="fas fa-chevron-down topbar-user-chevron" style="margin-left:6px;"></i>
          </div>

          <!-- User dropdown -->
          <div class="user-dropdown">
            <div class="user-dropdown-header">
              <div class="user-dropdown-name">Mrs. M. Adeyemi</div>
              <div class="user-dropdown-email">m.adeyemi@royalark.edu.ng</div>
            </div>
            <a href="settings/accounts.html" class="dropdown-item">
              <i class="fas fa-user-circle"></i> My Profile
            </a>
            <a href="settings/general.html" class="dropdown-item">
              <i class="fas fa-gear"></i> Settings
            </a>
            <a href="settings/accounts.html" class="dropdown-item">
              <i class="fas fa-lock"></i> Change Password
            </a>
            <a href="auth/login.html" class="dropdown-item danger">
              <i class="fas fa-right-from-bracket"></i> Sign Out
            </a>
          </div>
        </div>

      </div>
    </header>

    <!-- PAGE CONTENT -->
    @yield('content')
    <!-- /admin-content -->

  </div><!-- /admin-main -->
</div><!-- /admin-shell -->

<!-- ══════════════════════════════════════════════════════
     MODALS
══════════════════════════════════════════════════════════ -->

<!-- Confirm Modal -->
<div class="modal-backdrop" id="confirmModal">
  <div class="modal modal-sm">
    <div class="modal-header">
      <div>
        <div class="modal-title confirm-title">Confirm Action</div>
      </div>
      <button class="modal-close" data-modal-close="confirmModal"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body">
      <p class="confirm-message" style="font-family:var(--font-data);font-size:var(--t-base);color:var(--text-mid);line-height:1.65;"></p>
      <p class="confirm-subtitle" style="font-family:var(--font-data);font-size:var(--t-xs);color:var(--text-muted);margin-top:6px;"></p>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline btn-md" data-modal-close="confirmModal">Cancel</button>
      <button class="btn btn-danger btn-md" id="confirmOkBtn">Confirm</button>
    </div>
  </div>
</div>

<!-- Approve Application Modal -->
<div class="modal-backdrop" id="approveModal">
  <div class="modal modal-sm">
    <div class="modal-header">
      <div>
        <div class="modal-title" style="color:var(--s-open);"><i class="fas fa-check-circle" style="margin-right:6px;"></i> Approve Application</div>
        <div class="modal-subtitle" data-applicant-name></div>
      </div>
      <button class="modal-close" data-modal-close="approveModal"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body">
      <div class="alert alert-success" style="margin-bottom:14px;">
        <i class="fas fa-info-circle"></i>
        <div class="alert-body">An approval email will be sent to the parent automatically upon confirmation.</div>
      </div>
      <div class="form-group">
        <label class="form-label">Optional note to include in email</label>
        <textarea class="form-control" rows="3" placeholder="e.g. Please bring the required documents on resumption day…"></textarea>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline btn-md" data-modal-close="approveModal">Cancel</button>
      <button class="btn btn-success btn-md" data-approve-confirm>
        <i class="fas fa-check"></i> Confirm Approval
      </button>
    </div>
  </div>
</div>

<!-- Reject Application Modal -->
<div class="modal-backdrop" id="rejectModal">
  <div class="modal modal-sm">
    <div class="modal-header danger-header">
      <div>
        <div class="modal-title"><i class="fas fa-times-circle" style="margin-right:6px;"></i> Reject Application</div>
        <div class="modal-subtitle" data-applicant-name></div>
      </div>
      <button class="modal-close" data-modal-close="rejectModal"><i class="fas fa-times"></i></button>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label class="form-label">Rejection Reason <span class="req">*</span></label>
        <select class="form-control" id="rejectReason">
          <option value="">Select a reason…</option>
          <option>Class is at full capacity</option>
          <option>Applicant is overage for class</option>
          <option>Incomplete documentation</option>
          <option>Academic record insufficient</option>
          <option>Other (specify below)</option>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label">Additional note to parent</label>
        <textarea class="form-control" rows="3" placeholder="Provide additional context or next steps…"></textarea>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline btn-md" data-modal-close="rejectModal">Cancel</button>
      <button class="btn btn-danger btn-md" data-reject-confirm>
        <i class="fas fa-times"></i> Confirm Rejection
      </button>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════════
     TOAST STACK & SCROLL TOP
══════════════════════════════════════════════════════════ -->
<div class="toast-stack"></div>
<button class="scroll-top-btn" id="scrollTopBtn" aria-label="Scroll to top">
  <i class="fas fa-chevron-up"></i>
</button>

<!-- ══════════════════════════════════════════════════════
     SCRIPTS
══════════════════════════════════════════════════════════ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script src="{{ asset('admin/js/admin.js') }}"></script>
@stack('scripts')
</body>
</html>
