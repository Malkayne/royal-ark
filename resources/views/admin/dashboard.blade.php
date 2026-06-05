@extends('layouts.admin.app')

@section('title', 'Dashboard')

@push('styles')
<style>
  /* ── Dashboard-specific styles ── */

  /* Greeting header */
  .dashboard-greeting {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 24px;
    flex-wrap: wrap;
  }
  .greeting-left h1 {
    font-family: var(--font-ui);
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--ink);
    margin-bottom: 4px;
  }
  .greeting-left p {
    font-family: var(--font-data);
    font-size: var(--t-sm);
    color: var(--text-muted);
  }
  .greeting-right {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
  }
  .date-chip {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 7px 14px;
    background: var(--white);
    border: 1px solid var(--canvas-border);
    border-radius: var(--r-pill);
    font-family: var(--font-mono);
    font-size: var(--t-xs);
    color: var(--text-mid);
    box-shadow: var(--sh-xs);
  }
  .date-chip i { color: var(--amber); }

  /* ── Charts row ── */
  .charts-row {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
  }
  .chart-card {
    background: var(--white);
    border: 1px solid var(--canvas-border);
    border-radius: var(--r-lg);
    box-shadow: var(--sh-xs);
    overflow: hidden;
  }
  .chart-card-header {
    padding: 16px 20px 0;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
  }
  .chart-card-title {
    font-family: var(--font-ui);
    font-size: var(--t-base);
    font-weight: 700;
    color: var(--ink);
  }
  .chart-card-sub {
    font-family: var(--font-data);
    font-size: var(--t-xs);
    color: var(--text-muted);
    margin-top: 2px;
  }
  .chart-card-body {
    padding: 16px 20px 20px;
    position: relative;
  }

  /* Chart legend */
  .chart-legend {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
    margin-top: 12px;
  }
  .legend-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-family: var(--font-ui);
    font-size: var(--t-xs);
    color: var(--text-mid);
  }
  .legend-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
  }

  /* Donut center text */
  .donut-center {
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -46%);
    text-align: center;
    pointer-events: none;
  }
  .donut-center-val {
    font-family: var(--font-ui);
    font-size: 1.6rem;
    font-weight: 800;
    color: var(--ink);
    line-height: 1;
  }
  .donut-center-lbl {
    font-family: var(--font-ui);
    font-size: 0.6rem;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-top: 3px;
  }

  /* ── Content grid ── */
  .content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
  }
  .content-grid-3 {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
  }

  /* ── Admission status big card ── */
  .admissions-card {
    background: var(--white);
    border: 1px solid var(--canvas-border);
    border-radius: var(--r-lg);
    box-shadow: var(--sh-xs);
    margin-bottom: 20px;
    overflow: hidden;
  }
  .admissions-card-header {
    background: linear-gradient(135deg, var(--royal-ink) 0%, #2a0e54 100%);
    padding: 20px 24px;
    display: flex;
    align-items: center;
    gap: 18px;
    flex-wrap: wrap;
    position: relative;
    overflow: hidden;
  }
  .admissions-card-header::before {
    content: '';
    position: absolute;
    right: -30px; top: -30px;
    width: 140px; height: 140px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
  }
  .admissions-card-header::after {
    content: '';
    position: absolute;
    right: 50px; bottom: -40px;
    width: 100px; height: 100px;
    border-radius: 50%;
    background: rgba(200,90,0,0.12);
  }
  .ac-icon {
    width: 48px; height: 48px;
    background: rgba(244,194,64,0.18);
    border: 1px solid rgba(244,194,64,0.3);
    border-radius: var(--r-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem;
    flex-shrink: 0;
    position: relative; z-index: 1;
  }
  .ac-info { flex: 1; min-width: 180px; position: relative; z-index: 1; }
  .ac-info h3 {
    font-family: var(--font-ui);
    font-size: var(--t-lg);
    font-weight: 700;
    color: var(--white);
    margin-bottom: 3px;
  }
  .ac-info p {
    font-family: var(--font-data);
    font-size: var(--t-xs);
    color: rgba(255,255,255,0.55);
  }
  .ac-toggle-wrap {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-shrink: 0;
    position: relative; z-index: 1;
  }
  .ac-status-text {
    font-family: var(--font-ui);
    font-size: var(--t-sm);
    font-weight: 700;
    letter-spacing: 0.05em;
  }
  .ac-status-text.open   { color: #4ade80; }
  .ac-status-text.closed { color: rgba(255,255,255,0.45); }
  .admissions-card-body {
    padding: 16px 24px 20px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0;
  }
  .admission-mini-stat {
    padding: 12px 16px;
    border-right: 1px solid var(--canvas-border);
  }
  .admission-mini-stat:last-child { border-right: none; }
  .ams-label {
    font-family: var(--font-ui);
    font-size: var(--t-xs);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: var(--text-muted);
    margin-bottom: 5px;
  }
  .ams-value {
    font-family: var(--font-ui);
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--ink);
    line-height: 1;
    margin-bottom: 3px;
  }
  .ams-sub {
    font-family: var(--font-data);
    font-size: var(--t-xs);
    color: var(--text-muted);
  }

  /* ── Recent applications datatable ── */
  .datatable-card {
    background: var(--white);
    border: 1px solid var(--canvas-border);
    border-radius: var(--r-lg);
    box-shadow: var(--sh-xs);
    overflow: hidden;
  }
  .datatable-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--canvas-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
  }
  .datatable-title-group {}
  .datatable-title {
    font-family: var(--font-ui);
    font-size: var(--t-base);
    font-weight: 700;
    color: var(--ink);
  }
  .datatable-sub {
    font-family: var(--font-data);
    font-size: var(--t-xs);
    color: var(--text-muted);
    margin-top: 2px;
  }
  .datatable-actions {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  /* ── Quick actions panel ── */
  .quick-panel {
    background: var(--white);
    border: 1px solid var(--canvas-border);
    border-radius: var(--r-lg);
    box-shadow: var(--sh-xs);
    overflow: hidden;
  }
  .quick-panel-header {
    padding: 14px 18px;
    border-bottom: 1px solid var(--canvas-border);
  }
  .quick-panel-title {
    font-family: var(--font-ui);
    font-size: var(--t-base);
    font-weight: 700;
    color: var(--ink);
  }
  .quick-actions-list {
    padding: 10px;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }
  .quick-action-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 12px;
    border-radius: var(--r-md);
    font-family: var(--font-ui);
    font-size: var(--t-sm);
    font-weight: 600;
    color: var(--text-dark);
    cursor: pointer;
    transition: background var(--dur-fast) var(--ease), color var(--dur-fast) var(--ease);
    text-decoration: none;
    border: none;
    background: transparent;
    width: 100%;
    text-align: left;
  }
  .quick-action-btn:hover {
    background: var(--canvas-bg);
    color: var(--royal);
  }
  .quick-action-btn:hover .qa-icon { background: var(--amber-pale); color: var(--amber-deep); }
  .qa-icon {
    width: 34px; height: 34px;
    border-radius: var(--r-sm);
    background: var(--royal-pale);
    color: var(--royal);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem;
    flex-shrink: 0;
    transition: background var(--dur-fast) var(--ease), color var(--dur-fast) var(--ease);
  }
  .qa-arrow {
    margin-left: auto;
    color: var(--text-muted);
    font-size: 0.7rem;
    transition: transform var(--dur-fast) var(--ease);
  }
  .quick-action-btn:hover .qa-arrow { transform: translateX(3px); color: var(--amber); }

  /* Site status panel */
  .site-status-list {
    display: flex;
    flex-direction: column;
    gap: 0;
  }
  .site-status-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 18px;
    border-bottom: 1px solid var(--canvas-border);
  }
  .site-status-item:last-child { border-bottom: none; }
  .ssi-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: var(--font-ui);
    font-size: var(--t-sm);
    font-weight: 500;
    color: var(--text-mid);
  }
  .ssi-label i { width: 14px; text-align: center; color: var(--text-muted); font-size: 0.8rem; }
  .ssi-val {
    font-family: var(--font-mono);
    font-size: var(--t-xs);
    color: var(--text-muted);
  }

  /* ── Activity feed ── */
  .activity-feed {
    display: flex;
    flex-direction: column;
    gap: 0;
  }
  .activity-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid var(--canvas-border);
    position: relative;
  }
  .activity-item:last-child { border-bottom: none; }
  .activity-item::before {
    content: '';
    position: absolute;
    left: 16px;
    top: 44px;
    bottom: -12px;
    width: 1px;
    background: var(--canvas-border);
  }
  .activity-item:last-child::before { display: none; }
  .activity-dot {
    width: 34px; height: 34px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.8rem;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
  }
  .activity-dot.royal  { background: var(--royal-pale); color: var(--royal); }
  .activity-dot.amber  { background: var(--amber-pale); color: var(--amber-deep); }
  .activity-dot.green  { background: var(--s-open-bg); color: var(--s-open); }
  .activity-dot.red    { background: var(--s-rejected-bg); color: var(--s-rejected); }
  .activity-dot.blue   { background: var(--s-review-bg); color: var(--s-review); }
  .activity-body { flex: 1; min-width: 0; }
  .activity-text {
    font-family: var(--font-data);
    font-size: var(--t-sm);
    color: var(--text-dark);
    line-height: 1.5;
  }
  .activity-text strong { font-weight: 600; color: var(--ink); }
  .activity-time {
    font-family: var(--font-mono);
    font-size: 0.65rem;
    color: var(--text-muted);
    margin-top: 3px;
  }

  /* ── Upcoming events mini ── */
  .event-mini {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid var(--canvas-border);
  }
  .event-mini:last-child { border-bottom: none; }
  .event-mini-date {
    width: 44px; height: 44px;
    border-radius: var(--r-md);
    background: linear-gradient(135deg, var(--amber-pale), rgba(244,194,64,0.15));
    border: 1px solid rgba(200,90,0,0.15);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .emd-day {
    font-family: var(--font-ui);
    font-size: 1rem;
    font-weight: 800;
    color: var(--amber-deep);
    line-height: 1;
  }
  .emd-month {
    font-family: var(--font-ui);
    font-size: 0.55rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--amber);
  }
  .event-mini-info { flex: 1; min-width: 0; }
  .emi-title {
    font-family: var(--font-ui);
    font-size: var(--t-sm);
    font-weight: 600;
    color: var(--ink);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .emi-meta {
    font-family: var(--font-data);
    font-size: var(--t-xs);
    color: var(--text-muted);
    margin-top: 2px;
  }

  /* ── Enquiries mini ── */
  .enquiry-mini {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 11px 0;
    border-bottom: 1px solid var(--canvas-border);
    cursor: pointer;
    transition: background var(--dur-fast) var(--ease);
  }
  .enquiry-mini:last-child { border-bottom: none; }
  .enquiry-mini:hover { margin: 0 -20px; padding: 11px 20px; background: var(--canvas-bg); }
  .em-avatar {
    width: 32px; height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--royal-pale), var(--amber-pale));
    display: flex; align-items: center; justify-content: center;
    font-family: var(--font-ui);
    font-size: 0.7rem;
    font-weight: 700;
    color: var(--royal);
    flex-shrink: 0;
  }
  .em-body { flex: 1; min-width: 0; }
  .em-name {
    font-family: var(--font-ui);
    font-size: var(--t-sm);
    font-weight: 600;
    color: var(--ink);
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .em-unread {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--amber);
    flex-shrink: 0;
  }
  .em-preview {
    font-family: var(--font-data);
    font-size: var(--t-xs);
    color: var(--text-muted);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-top: 1px;
  }
  .em-time {
    font-family: var(--font-mono);
    font-size: 0.62rem;
    color: var(--text-muted);
    flex-shrink: 0;
  }

  /* ── Blog posts mini ── */
  .post-mini {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 0;
    border-bottom: 1px solid var(--canvas-border);
  }
  .post-mini:last-child { border-bottom: none; }
  .post-mini-thumb {
    width: 40px; height: 40px;
    border-radius: var(--r-sm);
    background: var(--royal-pale);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
  }
  .post-mini-info { flex: 1; min-width: 0; }
  .pmi-title {
    font-family: var(--font-ui);
    font-size: var(--t-xs);
    font-weight: 600;
    color: var(--ink);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .pmi-meta {
    font-family: var(--font-data);
    font-size: 0.65rem;
    color: var(--text-muted);
    margin-top: 1px;
  }

  /* ── Responsive charts ── */
  @media (max-width: 1200px) {
    .charts-row        { grid-template-columns: 1fr; }
    .content-grid      { grid-template-columns: 1fr; }
    .content-grid-3    { grid-template-columns: 1fr 1fr; }
    .admissions-card-body { grid-template-columns: 1fr 1fr; }
    .admission-mini-stat:nth-child(2) { border-right: none; }
    .admission-mini-stat:nth-child(3) { border-top: 1px solid var(--canvas-border); }
  }
  @media (max-width: 768px) {
    .charts-row        { grid-template-columns: 1fr; }
    .content-grid      { grid-template-columns: 1fr; }
    .content-grid-3    { grid-template-columns: 1fr; }
    .admissions-card-body { grid-template-columns: 1fr 1fr; }
    .greeting-left h1  { font-size: 1.2rem; }
    .greeting-right    { display: none; }
  }
  @media (max-width: 480px) {
    .admissions-card-body { grid-template-columns: 1fr; }
    .admission-mini-stat  { border-right: none; border-bottom: 1px solid var(--canvas-border); }
  }
</style>
@endpush

@section('content')
<main class="admin-content">

  <!-- ── GREETING ── -->
  <div class="dashboard-greeting">
    <div class="greeting-left">
      <h1 id="greetingText">Good morning, Mrs. Adeyemi 👋</h1>
      <p>Here's what's happening at Royal Ark College today.</p>
    </div>
    <div class="greeting-right">
      <div class="date-chip">
        <i class="fas fa-calendar-day"></i>
        <span id="currentDate">Monday, 12 January 2026</span>
      </div>
      <a href="../index.html" target="_blank" class="btn btn-outline btn-sm">
        <i class="fas fa-arrow-up-right-from-square"></i> View School Site
      </a>
    </div>
  </div>

  <!-- ── STAT CARDS ── -->
  <div class="stats-grid" style="margin-bottom:20px;">
    <div class="stat-card">
      <div class="stat-icon amber"><i class="fas fa-folder-open"></i></div>
      <div class="stat-body">
        <div class="stat-label">Admissions</div>
        <div class="stat-value" data-count-to="48">48</div>
        <div class="stat-meta up"><i class="fas fa-arrow-up"></i> 14 pending review</div>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon blue"><i class="fas fa-comments"></i></div>
      <div class="stat-body">
        <div class="stat-label">Enquiries</div>
        <div class="stat-value" data-count-to="5">5</div>
        <div class="stat-meta down"><i class="fas fa-circle" style="font-size:0.45rem;"></i> 5 unread</div>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon green"><i class="fas fa-calendar-check"></i></div>
      <div class="stat-body">
        <div class="stat-label">Upcoming Events</div>
        <div class="stat-value" data-count-to="3">3</div>
        <div class="stat-meta neutral"><i class="fas fa-clock"></i> Next: Dec 14</div>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon royal"><i class="fas fa-newspaper"></i></div>
      <div class="stat-body">
        <div class="stat-label">Blog Posts</div>
        <div class="stat-value" data-count-to="17">17</div>
        <div class="stat-meta neutral"><i class="fas fa-file-pen"></i> 2 drafts</div>
      </div>
    </div>
  </div>

  <!-- ── ADMISSIONS STATUS CARD ── -->
  <div class="admissions-card">
    <div class="admissions-card-header">
      <div class="ac-icon"><i class="fas fa-graduation-cap"></i></div>
      <div class="ac-info">
        <h3>Admissions Portal — 2025/2026 Session</h3>
        <p>Toggle to open or close the public admission application form. This updates the website instantly.</p>
      </div>
      <div class="ac-toggle-wrap">
        <span class="ac-status-text open" data-admissions-status>OPEN</span>
        <label class="toggle toggle-lg">
          <input type="checkbox" checked data-admissions-toggle>
          <div class="toggle-track"></div>
        </label>
      </div>
      <div style="display:flex;gap:8px;flex-shrink:0;position:relative;z-index:1;">
        <a href="settings/admissions.html" class="btn btn-sm" style="background:rgba(255,255,255,0.1);border-color:rgba(255,255,255,0.2);color:#fff;border-radius:var(--r-sm);">
          <i class="fas fa-gear"></i> Settings
        </a>
        <a href="admissions/index.html" class="btn btn-sm" style="background:linear-gradient(135deg,var(--amber),var(--amber-mid));color:#fff;border:none;border-radius:var(--r-sm);">
          <i class="fas fa-arrow-right"></i> View All
        </a>
      </div>
    </div>
    <div class="admissions-card-body">
      <div class="admission-mini-stat">
        <div class="ams-label">Total Applications</div>
        <div class="ams-value">48</div>
        <div class="ams-sub">2025/2026 session</div>
      </div>
      <div class="admission-mini-stat">
        <div class="ams-label">Pending Review</div>
        <div class="ams-value" style="color:var(--s-pending);">14</div>
        <div class="ams-sub">Awaiting action</div>
      </div>
      <div class="admission-mini-stat">
        <div class="ams-label">Approved</div>
        <div class="ams-value" style="color:var(--s-open);">28</div>
        <div class="ams-sub">Confirmed students</div>
      </div>
      <div class="admission-mini-stat">
        <div class="ams-label">Window Closes</div>
        <div class="ams-value" style="font-size:1rem;">Nov 30</div>
        <div class="ams-sub">2025 · 48 days left</div>
      </div>
    </div>
  </div>

  <!-- ── CHARTS ROW ── -->
  <div class="charts-row">

    <!-- Applications Over Time — Line Chart -->
    <div class="chart-card">
      <div class="chart-card-header">
        <div>
          <div class="chart-card-title">Applications Over Time</div>
          <div class="chart-card-sub">Monthly admissions received — 2025/2026 session</div>
        </div>
        <div style="display:flex;gap:6px;">
          <button class="btn btn-ghost btn-xs chart-range-btn active" data-range="monthly">Monthly</button>
          <button class="btn btn-ghost btn-xs chart-range-btn" data-range="weekly">Weekly</button>
        </div>
      </div>
      <div class="chart-card-body">
        <canvas id="applicationsChart" height="200"></canvas>
        <div class="chart-legend" style="margin-top:14px;">
          <div class="legend-item"><div class="legend-dot" style="background:#5B2D9E;"></div>Applications Received</div>
          <div class="legend-item"><div class="legend-dot" style="background:#F4C240;"></div>Approved</div>
          <div class="legend-item"><div class="legend-dot" style="background:rgba(181,43,43,0.7);"></div>Rejected</div>
        </div>
      </div>
    </div>

    <!-- Donut — Status Breakdown -->
    <div class="chart-card">
      <div class="chart-card-header">
        <div>
          <div class="chart-card-title">Application Status</div>
          <div class="chart-card-sub">Current breakdown</div>
        </div>
      </div>
      <div class="chart-card-body" style="display:flex;flex-direction:column;align-items:center;">
        <div style="position:relative;width:200px;height:200px;margin:0 auto;">
          <canvas id="statusDonut" width="200" height="200"></canvas>
          <div class="donut-center">
            <div class="donut-center-val">48</div>
            <div class="donut-center-lbl">Total</div>
          </div>
        </div>
        <div class="chart-legend" style="margin-top:16px;justify-content:center;gap:12px;">
          <div class="legend-item"><div class="legend-dot" style="background:#F4C240;"></div>Pending (14)</div>
          <div class="legend-item"><div class="legend-dot" style="background:#5B2D9E;"></div>Approved (28)</div>
          <div class="legend-item"><div class="legend-dot" style="background:#B52B2B;"></div>Rejected (4)</div>
          <div class="legend-item"><div class="legend-dot" style="background:#1A5C99;"></div>Review (2)</div>
        </div>
      </div>
    </div>
  </div>

  <!-- ── MAIN CONTENT GRID ── -->
  <div class="content-grid" style="margin-bottom:20px;">

    <!-- Recent Applications Datatable -->
    <div class="datatable-card">
      <div class="datatable-header">
        <div class="datatable-title-group">
          <div class="datatable-title">Recent Applications</div>
          <div class="datatable-sub">Latest 10 submissions — showing newest first</div>
        </div>
        <div class="datatable-actions">
          <div class="search-box" style="max-width:200px;">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search…" data-search-table="recentAppsTable" id="appSearch">
          </div>
          <a href="admissions/index.html" class="btn btn-outline btn-sm">View All</a>
        </div>
      </div>

      <!-- Bulk bar -->
      <div class="bulk-bar" data-bulk-bar="recentAppsTable" style="margin:0 20px 0;border-radius:var(--r-sm);">
        <span class="bulk-count"></span>
        <button class="btn btn-success btn-xs" onclick="Toast.show('Selected applications approved','success')"><i class="fas fa-check"></i> Approve</button>
        <button class="btn btn-danger btn-xs" onclick="Toast.show('Selected applications rejected','warning')"><i class="fas fa-times"></i> Reject</button>
        <button class="btn btn-ghost btn-xs" onclick="exportTableCSV('recentAppsTable','applications')"><i class="fas fa-download"></i> Export</button>
      </div>

      <div class="table-wrap">
        <table class="admin-table" id="recentAppsTable" data-table-id="recentAppsTable">
          <thead>
            <tr>
              <th><input type="checkbox" class="row-check" id="masterCheck" aria-label="Select all"></th>
              <th class="sortable">Applicant <i class="fas fa-sort sort-icon"></i></th>
              <th class="sortable">Class <i class="fas fa-sort sort-icon"></i></th>
              <th>Parent</th>
              <th class="sortable">Date <i class="fas fa-sort sort-icon"></i></th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr data-id="1">
              <td data-label=""><input type="checkbox" class="row-check" data-id="1"></td>
              <td data-label="Applicant">
                <div class="user-cell">
                  <div class="user-avatar">CO</div>
                  <div>
                    <div class="td-primary">Chidi Emmanuel Obi</div>
                    <div class="td-sub">RAC-2025-0048</div>
                  </div>
                </div>
              </td>
              <td data-label="Class"><span class="badge badge-royal">JSS 1</span></td>
              <td data-label="Parent"><span class="td-mono">Mr. Obi E.</span></td>
              <td data-label="Date"><span class="td-mono">Jan 10, 2026</span></td>
              <td data-label="Status"><span class="badge badge-pending badge-dot">Pending</span></td>
              <td data-label="Actions" class="td-actions">
                <div class="row-actions">
                  <a href="admissions/detail.html" class="btn btn-outline btn-xs"><i class="fas fa-eye"></i> View</a>
                  <div class="action-menu">
                    <button class="action-menu-btn" aria-label="More actions"><i class="fas fa-ellipsis-vertical"></i></button>
                    <div class="action-menu-dropdown">
                      <a href="admissions/detail.html" class="action-menu-item"><i class="fas fa-eye"></i> View Details</a>
                      <div class="action-menu-item" onclick="approveApplication('1','Chidi Obi')"><i class="fas fa-check-circle" style="color:var(--s-open);"></i> Approve</div>
                      <div class="action-menu-item" onclick="rejectApplication('1','Chidi Obi')"><i class="fas fa-times-circle" style="color:var(--s-rejected);"></i> Reject</div>
                      <div class="action-menu-divider"></div>
                      <div class="action-menu-item danger" data-delete-confirm="Delete application RAC-2025-0048?"><i class="fas fa-trash"></i> Delete</div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr data-id="2">
              <td data-label=""><input type="checkbox" class="row-check" data-id="2"></td>
              <td data-label="Applicant">
                <div class="user-cell">
                  <div class="user-avatar">AU</div>
                  <div>
                    <div class="td-primary">Amaka Chisom Uche</div>
                    <div class="td-sub">RAC-2025-0047</div>
                  </div>
                </div>
              </td>
              <td data-label="Class"><span class="badge badge-royal">Primary 4</span></td>
              <td data-label="Parent"><span class="td-mono">Mrs. Uche N.</span></td>
              <td data-label="Date"><span class="td-mono">Jan 10, 2026</span></td>
              <td data-label="Status"><span class="badge badge-pending badge-dot">Pending</span></td>
              <td data-label="Actions" class="td-actions">
                <div class="row-actions">
                  <a href="admissions/detail.html" class="btn btn-outline btn-xs"><i class="fas fa-eye"></i> View</a>
                  <div class="action-menu">
                    <button class="action-menu-btn"><i class="fas fa-ellipsis-vertical"></i></button>
                    <div class="action-menu-dropdown">
                      <a href="admissions/detail.html" class="action-menu-item"><i class="fas fa-eye"></i> View Details</a>
                      <div class="action-menu-item" onclick="approveApplication('2','Amaka Uche')"><i class="fas fa-check-circle" style="color:var(--s-open);"></i> Approve</div>
                      <div class="action-menu-item" onclick="rejectApplication('2','Amaka Uche')"><i class="fas fa-times-circle" style="color:var(--s-rejected);"></i> Reject</div>
                      <div class="action-menu-divider"></div>
                      <div class="action-menu-item danger" data-delete-confirm="Delete application RAC-2025-0047?"><i class="fas fa-trash"></i> Delete</div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr data-id="3">
              <td data-label=""><input type="checkbox" class="row-check" data-id="3"></td>
              <td data-label="Applicant">
                <div class="user-cell">
                  <div class="user-avatar">TA</div>
                  <div>
                    <div class="td-primary">Tunde Adebayo Akin</div>
                    <div class="td-sub">RAC-2025-0046</div>
                  </div>
                </div>
              </td>
              <td data-label="Class"><span class="badge badge-royal">SSS 1</span></td>
              <td data-label="Parent"><span class="td-mono">Mr. Akin T.</span></td>
              <td data-label="Date"><span class="td-mono">Jan 9, 2026</span></td>
              <td data-label="Status"><span class="badge badge-review badge-dot">In Review</span></td>
              <td data-label="Actions" class="td-actions">
                <div class="row-actions">
                  <a href="admissions/detail.html" class="btn btn-outline btn-xs"><i class="fas fa-eye"></i> View</a>
                  <div class="action-menu">
                    <button class="action-menu-btn"><i class="fas fa-ellipsis-vertical"></i></button>
                    <div class="action-menu-dropdown">
                      <a href="admissions/detail.html" class="action-menu-item"><i class="fas fa-eye"></i> View Details</a>
                      <div class="action-menu-item" onclick="approveApplication('3','Tunde Akin')"><i class="fas fa-check-circle" style="color:var(--s-open);"></i> Approve</div>
                      <div class="action-menu-item" onclick="rejectApplication('3','Tunde Akin')"><i class="fas fa-times-circle" style="color:var(--s-rejected);"></i> Reject</div>
                      <div class="action-menu-divider"></div>
                      <div class="action-menu-item danger" data-delete-confirm="Delete application RAC-2025-0046?"><i class="fas fa-trash"></i> Delete</div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr data-id="4">
              <td data-label=""><input type="checkbox" class="row-check" data-id="4"></td>
              <td data-label="Applicant">
                <div class="user-cell">
                  <div class="user-avatar">BK</div>
                  <div>
                    <div class="td-primary">Bisi Kehinde Lawal</div>
                    <div class="td-sub">RAC-2025-0045</div>
                  </div>
                </div>
              </td>
              <td data-label="Class"><span class="badge badge-royal">Nursery 2</span></td>
              <td data-label="Parent"><span class="td-mono">Mrs. Lawal F.</span></td>
              <td data-label="Date"><span class="td-mono">Jan 8, 2026</span></td>
              <td data-label="Status"><span class="badge badge-open badge-dot">Approved</span></td>
              <td data-label="Actions" class="td-actions">
                <div class="row-actions">
                  <a href="admissions/detail.html" class="btn btn-outline btn-xs"><i class="fas fa-eye"></i> View</a>
                  <div class="action-menu">
                    <button class="action-menu-btn"><i class="fas fa-ellipsis-vertical"></i></button>
                    <div class="action-menu-dropdown">
                      <a href="admissions/detail.html" class="action-menu-item"><i class="fas fa-eye"></i> View Details</a>
                      <div class="action-menu-item danger" data-delete-confirm="Delete application RAC-2025-0045?"><i class="fas fa-trash"></i> Delete</div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr data-id="5">
              <td data-label=""><input type="checkbox" class="row-check" data-id="5"></td>
              <td data-label="Applicant">
                <div class="user-cell">
                  <div class="user-avatar">EN</div>
                  <div>
                    <div class="td-primary">Emeka Nwosu Ike</div>
                    <div class="td-sub">RAC-2025-0044</div>
                  </div>
                </div>
              </td>
              <td data-label="Class"><span class="badge badge-royal">JSS 3</span></td>
              <td data-label="Parent"><span class="td-mono">Mr. Ike S.</span></td>
              <td data-label="Date"><span class="td-mono">Jan 7, 2026</span></td>
              <td data-label="Status"><span class="badge badge-rejected badge-dot">Rejected</span></td>
              <td data-label="Actions" class="td-actions">
                <div class="row-actions">
                  <a href="admissions/detail.html" class="btn btn-outline btn-xs"><i class="fas fa-eye"></i> View</a>
                  <div class="action-menu">
                    <button class="action-menu-btn"><i class="fas fa-ellipsis-vertical"></i></button>
                    <div class="action-menu-dropdown">
                      <a href="admissions/detail.html" class="action-menu-item"><i class="fas fa-eye"></i> View Details</a>
                      <div class="action-menu-item danger" data-delete-confirm="Delete application RAC-2025-0044?"><i class="fas fa-trash"></i> Delete</div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr data-id="6">
              <td data-label=""><input type="checkbox" class="row-check" data-id="6"></td>
              <td data-label="Applicant">
                <div class="user-cell">
                  <div class="user-avatar">FO</div>
                  <div>
                    <div class="td-primary">Fatima Okonkwo Basit</div>
                    <div class="td-sub">RAC-2025-0043</div>
                  </div>
                </div>
              </td>
              <td data-label="Class"><span class="badge badge-royal">Primary 1</span></td>
              <td data-label="Parent"><span class="td-mono">Mr. Basit O.</span></td>
              <td data-label="Date"><span class="td-mono">Jan 6, 2026</span></td>
              <td data-label="Status"><span class="badge badge-open badge-dot">Approved</span></td>
              <td data-label="Actions" class="td-actions">
                <div class="row-actions">
                  <a href="admissions/detail.html" class="btn btn-outline btn-xs"><i class="fas fa-eye"></i> View</a>
                  <div class="action-menu">
                    <button class="action-menu-btn"><i class="fas fa-ellipsis-vertical"></i></button>
                    <div class="action-menu-dropdown">
                      <a href="admissions/detail.html" class="action-menu-item"><i class="fas fa-eye"></i> View Details</a>
                      <div class="action-menu-item danger" data-delete-confirm="Delete application?"><i class="fas fa-trash"></i> Delete</div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        <div class="pagination" data-pagination="recentAppsTable"></div>
        <div style="display:flex;align-items:center;gap:12px;">
          <span class="page-info"></span>
          <button class="btn btn-ghost btn-xs" onclick="exportTableCSV('recentAppsTable','applications')">
            <i class="fas fa-download"></i> Export CSV
          </button>
        </div>
      </div>
    </div>

    <!-- Right column -->
    <div style="display:flex;flex-direction:column;gap:20px;">

      <!-- Quick Actions -->
      <div class="quick-panel">
        <div class="quick-panel-header">
          <div class="quick-panel-title">Quick Actions</div>
        </div>
        <div class="quick-actions-list">
          <a href="blog/editor.html" class="quick-action-btn">
            <div class="qa-icon"><i class="fas fa-pen-to-square"></i></div>
            <span>New Blog Post</span>
            <i class="fas fa-arrow-right qa-arrow"></i>
          </a>
          <a href="events/editor.html" class="quick-action-btn">
            <div class="qa-icon"><i class="fas fa-calendar-plus"></i></div>
            <span>Create Event</span>
            <i class="fas fa-arrow-right qa-arrow"></i>
          </a>
          <a href="admissions/index.html" class="quick-action-btn">
            <div class="qa-icon"><i class="fas fa-folder-open"></i></div>
            <span>Review Applications</span>
            <i class="fas fa-arrow-right qa-arrow"></i>
          </a>
          <a href="enquiries/index.html" class="quick-action-btn">
            <div class="qa-icon"><i class="fas fa-envelope-open-text"></i></div>
            <span>View Enquiries</span>
            <i class="fas fa-arrow-right qa-arrow"></i>
          </a>
          <button class="quick-action-btn" onclick="exportTableCSV('recentAppsTable','dashboard_applications')">
            <div class="qa-icon"><i class="fas fa-file-arrow-down"></i></div>
            <span>Export Report</span>
            <i class="fas fa-arrow-right qa-arrow"></i>
          </button>
          <a href="content/gallery.html" class="quick-action-btn">
            <div class="qa-icon"><i class="fas fa-images"></i></div>
            <span>Upload Media</span>
            <i class="fas fa-arrow-right qa-arrow"></i>
          </a>
        </div>
      </div>

      <!-- Site Status -->
      <div class="quick-panel">
        <div class="quick-panel-header" style="display:flex;align-items:center;justify-content:space-between;">
          <div class="quick-panel-title">Website Status</div>
          <span style="font-family:var(--font-mono);font-size:0.62rem;color:var(--s-open);"><i class="fas fa-circle" style="font-size:0.45rem;"></i> All systems live</span>
        </div>
        <div class="site-status-list">
          <div class="site-status-item">
            <span class="ssi-label"><i class="fas fa-toggle-on" style="color:var(--s-open);"></i> Admissions</span>
            <span class="badge badge-open badge-dot">Open</span>
          </div>
          <div class="site-status-item">
            <span class="ssi-label"><i class="fas fa-image"></i> Hero Banner</span>
            <span class="ssi-val">Live ✓</span>
          </div>
          <div class="site-status-item">
            <span class="ssi-label"><i class="fas fa-images"></i> Gallery</span>
            <span class="ssi-val">34 items</span>
          </div>
          <div class="site-status-item">
            <span class="ssi-label"><i class="fas fa-newspaper"></i> Blog Posts</span>
            <span class="ssi-val">17 published</span>
          </div>
          <div class="site-status-item">
            <span class="ssi-label"><i class="fas fa-rotate"></i> Last Updated</span>
            <span class="ssi-val" data-relative-time="2026-01-12T10:30:00">2h ago</span>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- ── BOTTOM ROW: Events + Enquiries + Activity + Posts ── -->
  <div class="content-grid-3">

    <!-- Upcoming Events -->
    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Upcoming Events</div>
          <div class="card-subtitle">Next 5 scheduled events</div>
        </div>
        <a href="events/index.html" class="btn btn-ghost btn-xs">Manage <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></a>
      </div>
      <div class="card-body" style="padding:12px 20px;">
        <div class="event-mini">
          <div class="event-mini-date"><div class="emd-day">14</div><div class="emd-month">Dec</div></div>
          <div class="event-mini-info">
            <div class="emi-title">Prize Giving Day 2025</div>
            <div class="emi-meta"><i class="fas fa-location-dot" style="font-size:0.6rem;color:var(--amber);"></i> Main Hall · 10:00 AM</div>
          </div>
          <span class="badge badge-amber" style="font-size:0.58rem;">Annual</span>
        </div>
        <div class="event-mini">
          <div class="event-mini-date"><div class="emd-day">6</div><div class="emd-month">Jan</div></div>
          <div class="event-mini-info">
            <div class="emi-title">Third Term Resumption</div>
            <div class="emi-meta"><i class="fas fa-school" style="font-size:0.6rem;color:var(--amber);"></i> All Classes</div>
          </div>
          <span class="badge badge-royal" style="font-size:0.58rem;">Academic</span>
        </div>
        <div class="event-mini">
          <div class="event-mini-date"><div class="emd-day">18</div><div class="emd-month">Jan</div></div>
          <div class="event-mini-info">
            <div class="emi-title">Parent-Teacher Forum</div>
            <div class="emi-meta"><i class="fas fa-location-dot" style="font-size:0.6rem;color:var(--amber);"></i> Assembly Hall</div>
          </div>
          <span class="badge badge-neutral" style="font-size:0.58rem;">Meeting</span>
        </div>
        <div class="event-mini">
          <div class="event-mini-date"><div class="emd-day">25</div><div class="emd-month">Jan</div></div>
          <div class="event-mini-info">
            <div class="emi-title">Inter-House Sports Day</div>
            <div class="emi-meta"><i class="fas fa-location-dot" style="font-size:0.6rem;color:var(--amber);"></i> Sports Ground</div>
          </div>
          <span class="badge badge-royal" style="font-size:0.58rem;">Sports</span>
        </div>
        <div class="event-mini">
          <div class="event-mini-date"><div class="emd-day">8</div><div class="emd-month">Feb</div></div>
          <div class="event-mini-info">
            <div class="emi-title">WAEC Mock Examinations</div>
            <div class="emi-meta"><i class="fas fa-school" style="font-size:0.6rem;color:var(--amber);"></i> SSS Classes</div>
          </div>
          <span class="badge badge-amber" style="font-size:0.58rem;">Exam</span>
        </div>
      </div>
      <div class="card-footer" style="justify-content:center;">
        <a href="events/editor.html" class="btn btn-primary btn-sm w-full" style="justify-content:center;">
          <i class="fas fa-plus"></i> Add New Event
        </a>
      </div>
    </div>

    <!-- Recent Enquiries + Recent Posts stacked -->
    <div style="display:flex;flex-direction:column;gap:20px;">

      <!-- Enquiries -->
      <div class="card" style="flex:1;">
        <div class="card-header">
          <div>
            <div class="card-title">Recent Enquiries</div>
            <div class="card-subtitle">5 unread messages</div>
          </div>
          <a href="enquiries/index.html" class="btn btn-ghost btn-xs">View All <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></a>
        </div>
        <div class="card-body" style="padding:10px 20px;">
          <div class="enquiry-mini">
            <div class="em-avatar">FB</div>
            <div class="em-body">
              <div class="em-name">Mrs. Fatima Bello <span class="em-unread"></span></div>
              <div class="em-preview">Enquiry about Primary 3 admission...</div>
            </div>
            <div class="em-time">5m</div>
          </div>
          <div class="enquiry-mini">
            <div class="em-avatar">CE</div>
            <div class="em-body">
              <div class="em-name">Mr. Chukwuma Eze <span class="em-unread"></span></div>
              <div class="em-preview">Regarding the current fee schedule...</div>
            </div>
            <div class="em-time">1h</div>
          </div>
          <div class="enquiry-mini">
            <div class="em-avatar">NN</div>
            <div class="em-body">
              <div class="em-name">Mrs. Ngozi Nwobi <span class="em-unread"></span></div>
              <div class="em-preview">Is the JSS1 class still open for...</div>
            </div>
            <div class="em-time">3h</div>
          </div>
          <div class="enquiry-mini">
            <div class="em-avatar">AD</div>
            <div class="em-body">
              <div class="em-name">Mr. Ade Dosunmu</div>
              <div class="em-preview">Thank you for the quick response...</div>
            </div>
            <div class="em-time">1d</div>
          </div>
        </div>
      </div>

      <!-- Blog Posts mini -->
      <div class="card" style="flex:1;">
        <div class="card-header">
          <div class="card-title">Recent Posts</div>
          <a href="blog/index.html" class="btn btn-ghost btn-xs">Manage <i class="fas fa-arrow-right" style="font-size:0.6rem;"></i></a>
        </div>
        <div class="card-body" style="padding:10px 20px;">
          <div class="post-mini">
            <div class="post-mini-thumb">📰</div>
            <div class="post-mini-info">
              <div class="pmi-title">New Bulk Purchase Programme for Q3</div>
              <div class="pmi-meta"><span class="badge badge-open" style="font-size:0.55rem;padding:2px 6px;">Published</span> · Jan 10</div>
            </div>
          </div>
          <div class="post-mini">
            <div class="post-mini-thumb">📚</div>
            <div class="post-mini-info">
              <div class="pmi-title">Academic Calendar 2025/2026 Released</div>
              <div class="pmi-meta"><span class="badge badge-draft" style="font-size:0.55rem;padding:2px 6px;">Draft</span> · Jan 8</div>
            </div>
          </div>
          <div class="post-mini">
            <div class="post-mini-thumb">🏆</div>
            <div class="post-mini-info">
              <div class="pmi-title">Prize Giving Day 2025 Highlights</div>
              <div class="pmi-meta"><span class="badge badge-scheduled" style="font-size:0.55rem;padding:2px 6px;">Scheduled</span> · Jan 6</div>
            </div>
          </div>
          <div class="post-mini">
            <div class="post-mini-thumb">🌾</div>
            <div class="post-mini-info">
              <div class="pmi-title">Dry Season Farming: Member Stories</div>
              <div class="pmi-meta"><span class="badge badge-open" style="font-size:0.55rem;padding:2px 6px;">Published</span> · Jan 2</div>
            </div>
          </div>
        </div>
        <div class="card-footer" style="justify-content:center;">
          <a href="blog/editor.html" class="btn btn-primary btn-sm w-full" style="justify-content:center;">
            <i class="fas fa-pen-to-square"></i> Write New Post
          </a>
        </div>
      </div>
    </div>

    <!-- Activity Feed -->
    <div class="card">
      <div class="card-header">
        <div>
          <div class="card-title">Recent Activity</div>
          <div class="card-subtitle">All admin actions today</div>
        </div>
        <button class="btn btn-ghost btn-xs" onclick="Toast.show('Activity log exported','info')"><i class="fas fa-download"></i></button>
      </div>
      <div class="card-body" style="padding:12px 20px;">
        <div class="activity-feed">
          <div class="activity-item">
            <div class="activity-dot amber"><i class="fas fa-folder-open"></i></div>
            <div class="activity-body">
              <div class="activity-text"><strong>New application</strong> received from Chidi Obi for JSS1</div>
              <div class="activity-time">Just now</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="activity-dot green"><i class="fas fa-check"></i></div>
            <div class="activity-body">
              <div class="activity-text"><strong>Approved</strong> application RAC-2025-0040 — Bisi Lawal (Nursery 2)</div>
              <div class="activity-time">1 hour ago</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="activity-dot royal"><i class="fas fa-newspaper"></i></div>
            <div class="activity-body">
              <div class="activity-text"><strong>Published</strong> blog post "Bulk Purchase Programme Q3"</div>
              <div class="activity-time">2 hours ago</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="activity-dot blue"><i class="fas fa-calendar-plus"></i></div>
            <div class="activity-body">
              <div class="activity-text"><strong>Created</strong> event "Inter-House Sports Day — Jan 25"</div>
              <div class="activity-time">3 hours ago</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="activity-dot red"><i class="fas fa-times"></i></div>
            <div class="activity-body">
              <div class="activity-text"><strong>Rejected</strong> application RAC-2025-0039 — Incomplete documents</div>
              <div class="activity-time">4 hours ago</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="activity-dot amber"><i class="fas fa-images"></i></div>
            <div class="activity-body">
              <div class="activity-text"><strong>Uploaded</strong> 8 photos to Gallery — Cultural Day 2025</div>
              <div class="activity-time">Yesterday, 4:12 PM</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="activity-dot green"><i class="fas fa-gear"></i></div>
            <div class="activity-body">
              <div class="activity-text"><strong>Updated</strong> Hero Section content on public website</div>
              <div class="activity-time">Yesterday, 10:45 AM</div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</main>
@endsection

@push('scripts')
<script>
  /* ── Dashboard-specific scripts ── */
  'use strict';

  /* Greeting based on time */
  (function setGreeting() {
    const hour = new Date().getHours();
    const greet = hour < 12 ? 'Good morning' : hour < 17 ? 'Good afternoon' : 'Good evening';
    const el = document.getElementById('greetingText');
    if (el) el.textContent = `${greet}, Mrs. Adeyemi 👋`;
  })();

  /* Live date */
  (function setDate() {
    const el = document.getElementById('currentDate');
    if (!el) return;
    el.textContent = new Date().toLocaleDateString('en-NG', {
      weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
    });
  })();

  /* ── Chart.js Global Defaults ── */
  Chart.defaults.font.family = "'DM Sans', sans-serif";
  Chart.defaults.font.size   = 11;
  Chart.defaults.color       = '#8B7FA0';
  Chart.defaults.plugins.legend.display = false;

  /* ── Applications Over Time — Line Chart ── */
  (function initApplicationsChart() {
    const ctx = document.getElementById('applicationsChart');
    if (!ctx) return;

    const labels = ['Sep', 'Oct', 'Nov', 'Dec', 'Jan'];
    const data = {
      received: [3, 8, 14, 22, 48],
      approved: [0, 4,  9, 16, 28],
      rejected: [0, 1,  2,  3,  4]
    };

    new Chart(ctx, {
      type: 'line',
      data: {
        labels,
        datasets: [
          {
            label: 'Received',
            data: data.received,
            borderColor: '#5B2D9E',
            backgroundColor: 'rgba(91,45,158,0.08)',
            borderWidth: 2.5,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#5B2D9E',
            pointRadius: 4,
            pointHoverRadius: 6
          },
          {
            label: 'Approved',
            data: data.approved,
            borderColor: '#F4C240',
            backgroundColor: 'transparent',
            borderWidth: 2,
            tension: 0.4,
            borderDash: [5, 4],
            pointBackgroundColor: '#F4C240',
            pointRadius: 4,
            pointHoverRadius: 6
          },
          {
            label: 'Rejected',
            data: data.rejected,
            borderColor: 'rgba(181,43,43,0.7)',
            backgroundColor: 'transparent',
            borderWidth: 1.5,
            tension: 0.4,
            borderDash: [3, 3],
            pointBackgroundColor: '#B52B2B',
            pointRadius: 3,
            pointHoverRadius: 5
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        interaction: { mode: 'index', intersect: false },
        plugins: {
          tooltip: {
            backgroundColor: 'rgba(24,10,48,0.95)',
            titleColor: '#fff',
            bodyColor: 'rgba(255,255,255,0.75)',
            borderColor: 'rgba(255,255,255,0.1)',
            borderWidth: 1,
            padding: 12,
            cornerRadius: 10,
            callbacks: {
              label(ctx) {
                return ` ${ctx.dataset.label}: ${ctx.parsed.y} applications`;
              }
            }
          }
        },
        scales: {
          x: {
            grid: { color: 'rgba(228,217,245,0.5)', drawBorder: false },
            ticks: { font: { size: 11, family: "'Outfit', sans-serif" }, color: '#B0A8C0' }
          },
          y: {
            grid: { color: 'rgba(228,217,245,0.5)', drawBorder: false },
            ticks: { font: { size: 11, family: "'Outfit', sans-serif" }, color: '#B0A8C0', stepSize: 10 },
            beginAtZero: true
          }
        }
      }
    });

    /* Chart range toggle */
    document.querySelectorAll('.chart-range-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.chart-range-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
      });
    });
  })();

  /* ── Status Donut Chart ── */
  (function initDonutChart() {
    const ctx = document.getElementById('statusDonut');
    if (!ctx) return;

    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Pending', 'Approved', 'Rejected', 'In Review'],
        datasets: [{
          data: [14, 28, 4, 2],
          backgroundColor: [
            '#F4C240',
            '#5B2D9E',
            '#B52B2B',
            '#1A5C99'
          ],
          borderWidth: 0,
          hoverOffset: 6
        }]
      },
      options: {
        responsive: false,
        cutout: '72%',
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: 'rgba(24,10,48,0.95)',
            titleColor: '#fff',
            bodyColor: 'rgba(255,255,255,0.75)',
            borderColor: 'rgba(255,255,255,0.1)',
            borderWidth: 1,
            padding: 10,
            cornerRadius: 8,
            callbacks: {
              label(ctx) {
                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                const pct = ((ctx.parsed / total) * 100).toFixed(0);
                return ` ${ctx.label}: ${ctx.parsed} (${pct}%)`;
              }
            }
          }
        }
      }
    });
  })();

  /* ── Animated stat counters ── */
  (function animateCounters() {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        const target = parseInt(el.dataset.countTo);
        if (isNaN(target)) return;
        let start = 0;
        const dur = 1400;
        const step = 16;
        const inc = target / (dur / step);
        const timer = setInterval(() => {
          start += inc;
          if (start >= target) { el.textContent = target; clearInterval(timer); return; }
          el.textContent = Math.floor(start);
        }, step);
        observer.unobserve(el);
      });
    }, { threshold: 0.5 });

    document.querySelectorAll('[data-count-to]').forEach(el => observer.observe(el));
  })();

  /* ── Sidebar subnav triggers ── */
  document.querySelectorAll('[data-subnav]').forEach(trigger => {
    trigger.addEventListener('click', () => {
      const id = trigger.dataset.subnav;
      const subnav = document.getElementById(id);
      if (!subnav) return;
      const isOpen = subnav.classList.contains('open');
      document.querySelectorAll('.nav-subnav.open').forEach(s => {
        s.classList.remove('open');
        s.previousElementSibling?.classList.remove('open');
      });
      if (!isOpen) {
        subnav.classList.add('open');
        trigger.classList.add('open');
      }
    });
  });

  /* ── Pagination on recent apps table ── */
  document.addEventListener('DOMContentLoaded', () => {
    initPagination('recentAppsTable', 6);
  });
</script>
@endpush
