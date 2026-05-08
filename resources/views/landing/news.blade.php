@extends('layouts.landing.app')

@section('title', 'News & Updates — Royal Ark Schools')
@section('meta_description', 'Stay updated with the latest news, announcements, and upcoming events at Royal Ark Schools.')
@section('meta_keywords', 'Royal Ark Schools news, school events, latest updates, school announcements')
@section('navbar-class', 'solid')

@push('styles')
<style>
/* Hero search bar */
.hero-search-wrap {
  display: flex;
  align-items: center;
  max-width: 520px;
  margin-top: 24px;
  background: rgba(255,255,255,0.12);
  border: 1px solid rgba(255,255,255,0.25);
  border-radius: var(--radius-pill);
  padding: 4px 4px 4px 20px;
  backdrop-filter: blur(8px);
}
.hero-search-wrap input {
  flex: 1;
  background: transparent;
  border: none;
  color: var(--white);
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  outline: none;
}
.hero-search-wrap input::placeholder { color: rgba(255,255,255,0.55); }
.hero-search-btn {
  width: 40px; height: 40px;
  border-radius: 50%;
  background: var(--amber);
  border: none;
  color: var(--white);
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  transition: background var(--duration-base) var(--ease);
}
.hero-search-btn:hover { background: var(--amber-mid); }

/* Filter tabs */
.filter-tabs {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-bottom: 40px;
  flex-wrap: wrap;
}
.filter-tab {
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  font-weight: 600;
  padding: 8px 22px;
  border-radius: var(--radius-pill);
  border: 1px solid var(--border);
  background: var(--white);
  color: var(--text-mid);
  cursor: pointer;
  transition: all var(--duration-base) var(--ease);
  white-space: nowrap;
}
.filter-tab:hover { border-color: var(--amber); color: var(--amber); }
.filter-tab.active { background: var(--royal); color: var(--white); border-color: var(--royal); }

/* Featured card */
.featured-card {
  display: grid;
  grid-template-columns: 1.1fr 1fr;
  gap: 0;
  background: var(--white);
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  overflow: hidden;
  margin-bottom: 40px;
  transition: transform var(--duration-slow) var(--ease), box-shadow var(--duration-slow) var(--ease);
}
.featured-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
.featured-card-img {
  min-height: 320px;
  background: linear-gradient(135deg, var(--royal-light), var(--royal));
  display: flex; align-items: center; justify-content: center;
  font-size: 5rem;
  position: relative;
}
.featured-card-img .badge-top {
  position: absolute;
  top: 20px; left: 20px;
  display: flex; gap: 8px;
}
.featured-card-body {
  padding: 32px 36px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.featured-card-meta {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 14px;
  flex-wrap: wrap;
}
.featured-card-body h2 {
  font-family: var(--font-display);
  font-size: var(--text-2xl);
  color: var(--ink);
  margin-bottom: 12px;
  line-height: 1.2;
}
.featured-card-body p {
  font-family: var(--font-body);
  font-size: var(--text-base);
  color: var(--text-mid);
  margin-bottom: 20px;
  line-height: 1.7;
}
.featured-card-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 10px;
}
.author-row {
  display: flex; align-items: center; gap: 10px;
  font-family: var(--font-heading);
  font-size: var(--text-xs);
  color: var(--text-light);
}
.author-avatar {
  width: 32px; height: 32px;
  border-radius: 50%;
  background: var(--royal-pale);
  display: flex; align-items: center; justify-content: center;
  color: var(--royal);
  font-size: 0.75rem;
  font-weight: 700;
}

/* News + Events grid layout */
.content-grid {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 40px;
}
@media (max-width: 1024px) { .content-grid { grid-template-columns: 1fr; } }

/* Article cards (list) */
.article-list { display: flex; flex-direction: column; gap: 24px; }
.article-card {
  display: grid;
  grid-template-columns: 180px 1fr;
  gap: 20px;
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-md);
  overflow: hidden;
  padding: 16px;
  transition: transform var(--duration-slow) var(--ease), box-shadow var(--duration-slow) var(--ease);
}
.article-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
.article-thumb {
  height: 120px;
  border-radius: var(--radius-sm);
  background: var(--royal-pale);
  display: flex; align-items: center; justify-content: center;
  font-size: 2.5rem;
}
.article-card-body { display: flex; flex-direction: column; justify-content: center; }
.article-card-meta {
  display: flex; align-items: center; gap: 8px;
  margin-bottom: 8px;
  font-family: var(--font-heading);
  font-size: var(--text-xs);
  color: var(--text-light);
  flex-wrap: wrap;
}
.article-card-body h3 {
  font-family: var(--font-display);
  font-size: var(--text-lg);
  color: var(--ink);
  margin-bottom: 8px;
  line-height: 1.3;
}
.article-card-body p {
  font-family: var(--font-body);
  font-size: var(--text-sm);
  color: var(--text-mid);
  line-height: 1.6;
  margin-bottom: 12px;
}
.article-card-footer {
  display: flex; align-items: center; gap: 10px;
  font-family: var(--font-heading);
  font-size: var(--text-xs);
  color: var(--text-light);
  flex-wrap: wrap;
}
.article-read-link {
  font-family: var(--font-heading);
  font-size: var(--text-xs);
  font-weight: 700;
  color: var(--royal);
  text-decoration: none;
  display: inline-flex; align-items: center; gap: 4px;
  transition: color var(--duration-base) var(--ease);
}
.article-read-link:hover { color: var(--amber); }

/* Event cards */
.event-card {
  position: relative;
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-md);
  overflow: hidden;
  padding: 24px;
  padding-left: 100px;
  transition: transform var(--duration-slow) var(--ease), box-shadow var(--duration-slow) var(--ease);
}
.event-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); border-left: 3px solid var(--amber); }
.event-date-block {
  position: absolute;
  top: 24px; left: 24px;
  width: 56px; height: 56px;
  background: var(--amber-pale);
  border-radius: var(--radius-sm);
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  font-family: var(--font-heading);
  color: var(--amber);
}
.event-date-block .day { font-size: 1.3rem; font-weight: 700; line-height: 1; }
.event-date-block .month { font-size: 0.6rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; margin-top: 2px; }
.event-card-meta {
  display: flex; align-items: center; gap: 8px;
  margin-bottom: 8px;
  flex-wrap: wrap;
}
.event-card h3 {
  font-family: var(--font-display);
  font-size: var(--text-lg);
  color: var(--ink);
  margin-bottom: 8px;
  line-height: 1.3;
}
.event-card p {
  font-family: var(--font-body);
  font-size: var(--text-sm);
  color: var(--text-mid);
  line-height: 1.6;
  margin-bottom: 12px;
}
.event-details {
  display: flex; gap: 16px;
  flex-wrap: wrap;
  font-family: var(--font-heading);
  font-size: var(--text-xs);
  color: var(--text-light);
}
.event-details span { display: inline-flex; align-items: center; gap: 5px; }

/* Sidebar */
.sidebar { display: flex; flex-direction: column; gap: 28px; }
.sidebar-box {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-md);
  padding: 24px;
}
.sidebar-box h4 {
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: var(--ink);
  margin-bottom: 16px;
}
.category-chips { display: flex; flex-wrap: wrap; gap: 8px; }
.sidebar-recent-item {
  display: flex; gap: 12px;
  padding: 12px 0;
  border-bottom: 1px solid var(--border);
  text-decoration: none;
  align-items: flex-start;
  transition: background var(--duration-fast) var(--ease);
}
.sidebar-recent-item:last-child { border-bottom: none; }
.sidebar-recent-thumb {
  width: 48px; height: 48px;
  border-radius: var(--radius-sm);
  background: var(--cream);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.2rem;
  flex-shrink: 0;
}
.sidebar-recent-body { flex: 1; }
.sidebar-recent-title {
  font-family: var(--font-heading);
  font-size: var(--text-xs);
  font-weight: 600;
  color: var(--ink);
  line-height: 1.4;
  margin-bottom: 2px;
}
.sidebar-recent-date {
  font-family: var(--font-heading);
  font-size: 0.65rem;
  color: var(--text-muted);
}
.sidebar-cta {
  background: linear-gradient(135deg, var(--royal), var(--royal-mid));
  border-radius: var(--radius-md);
  padding: 24px;
  color: var(--white);
  text-align: center;
}
.sidebar-cta h4 {
  font-family: var(--font-display);
  font-size: var(--text-lg);
  margin-bottom: 8px;
}
.sidebar-cta p {
  font-family: var(--font-body);
  font-size: var(--text-sm);
  color: rgba(255,255,255,0.75);
  margin-bottom: 16px;
  line-height: 1.6;
}

/* Load more */
.load-more-wrap { text-align: center; margin-top: 40px; }

/* Pagination */
.pagination {
  display: flex;
  justify-content: center;
  gap: 6px;
  margin-top: 40px;
}
.pagination a, .pagination span {
  min-width: 40px; height: 40px;
  display: inline-flex; align-items: center; justify-content: center;
  border-radius: var(--radius-sm);
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  font-weight: 600;
  text-decoration: none;
  transition: all var(--duration-base) var(--ease);
}
.pagination a {
  background: var(--white);
  border: 1px solid var(--border);
  color: var(--text-mid);
}
.pagination a:hover { border-color: var(--amber); color: var(--amber); }
.pagination span.current {
  background: var(--royal);
  color: var(--white);
  border: 1px solid var(--royal);
}

@media (max-width: 768px) {
  .featured-card { grid-template-columns: 1fr; }
  .featured-card-img { min-height: 200px; }
  .featured-card-body { padding: 24px; }
  .article-card { grid-template-columns: 1fr; }
  .article-thumb { height: 160px; }
  .event-card { padding-left: 24px; padding-top: 90px; }
  .event-date-block { top: 20px; left: 20px; }
}
</style>
@endpush

@section('content')

{{-- Page Hero --}}
<section class="page-hero">
  <div class="page-hero-pattern"></div>
  <div class="page-hero-crest" aria-hidden="true">RA</div>
  <div class="container page-hero-content">
    <nav class="breadcrumb" aria-label="breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span class="breadcrumb-sep"><i class="fa-solid fa-chevron-right"></i></span>
      <span class="current">News</span>
    </nav>
    <h1>News & Updates</h1>
    <p class="page-hero-sub">Stay informed with the latest from Royal Ark Schools — from school announcements to upcoming events.</p>
    <div class="hero-search-wrap reveal">
      <input type="text" placeholder="Search news and events..." id="newsSearchInput">
      <button class="hero-search-btn" aria-label="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
  </div>
</section>

{{-- Filter Tabs --}}
<section class="section-pad" style="padding-bottom:0;">
  <div class="container">
    <div class="filter-tabs reveal">
      <button class="filter-tab active" data-filter="all">All</button>
      <button class="filter-tab" data-filter="news">News</button>
      <button class="filter-tab" data-filter="events">Events</button>
    </div>
  </div>
</section>

{{-- Featured Item --}}
<section class="section-pad" style="padding-top:28px; padding-bottom:20px;">
  <div class="container">
    <div class="featured-card reveal" data-type="news">
      <div class="featured-card-img">
        <div class="badge-top">
          <span class="badge badge-royal badge-pill">Featured</span>
          <span class="badge badge-amber badge-pill">News</span>
        </div>
        📰
      </div>
      <div class="featured-card-body">
        <div class="featured-card-meta">
          <span class="badge badge-royal badge-pill">Academics</span>
          <span><i class="fa-regular fa-calendar"></i> May 5, 2025</span>
          <span><i class="fa-regular fa-clock"></i> 5 min read</span>
        </div>
        <h2>Royal Ark Schools Ranked Among Top 10 Private Schools in Lagos State</h2>
        <p>We are thrilled to announce that Royal Ark Schools has been recognised among the top 10 private schools in Lagos State for the 2024/2025 academic year by the Lagos State Ministry of Education...</p>
        <div class="featured-card-footer">
          <div class="author-row">
            <div class="author-avatar">AB</div>
            <span>By Admin &middot; 5 min read</span>
          </div>
          <a href="{{ url('/news/royal-ark-ranked-top-10') }}" class="btn btn-primary btn-sm">Read Full Story <i class="fa-solid fa-arrow-right" style="margin-left:6px;"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Content Grid: Articles + Sidebar --}}
<section class="section-pad" style="padding-top:20px;">
  <div class="container content-grid">

    {{-- Main Content --}}
    <div class="main-content">

      {{-- News Items --}}
      <div class="article-list" id="newsList">
        <article class="article-card reveal" data-type="news">
          <div class="article-thumb">🎓</div>
          <div class="article-card-body">
            <div class="article-card-meta">
              <span class="badge badge-royal badge-pill">News</span>
              <span><i class="fa-regular fa-calendar"></i> Apr 28, 2025</span>
            </div>
            <h3>2025/2026 Admissions Now Open — Apply Early</h3>
            <p>Applications for the 2025/2026 academic session are now being accepted across all levels. Early applicants enjoy a streamlined process and priority placement.</p>
            <div class="article-card-footer">
              <span><i class="fa-regular fa-user"></i> Admissions Office</span>
              <span><i class="fa-regular fa-clock"></i> 3 min read</span>
              <a href="{{ url('/news/admissions-2025-2026-open') }}" class="article-read-link">Read more <i class="fa-solid fa-arrow-right"></i></a>
            </div>
          </div>
        </article>

        <article class="article-card reveal" data-type="news">
          <div class="article-thumb">🔬</div>
          <div class="article-card-body">
            <div class="article-card-meta">
              <span class="badge badge-royal badge-pill">News</span>
              <span><i class="fa-regular fa-calendar"></i> Apr 15, 2025</span>
            </div>
            <h3>Students Excel at National Science Olympiad</h3>
            <p>Three of our senior secondary students qualified for the national finals of the 2025 Science Olympiad, bringing home two silver medals and one bronze.</p>
            <div class="article-card-footer">
              <span><i class="fa-regular fa-user"></i> Academic Team</span>
              <span><i class="fa-regular fa-clock"></i> 4 min read</span>
              <a href="{{ url('/news/science-olympiad-2025') }}" class="article-read-link">Read more <i class="fa-solid fa-arrow-right"></i></a>
            </div>
          </div>
        </article>

        <article class="event-card reveal" data-type="events">
          <div class="event-date-block">
            <span class="day">14</span>
            <span class="month">DEC</span>
          </div>
          <div class="event-card-meta">
            <span class="badge badge-amber badge-pill">Annual Event</span>
            <span><i class="fa-regular fa-calendar"></i> Dec 14, 2025</span>
          </div>
          <h3>2025 Prize Giving & Graduation Day</h3>
          <p>Join us as we celebrate the achievements of our graduating class and recognise outstanding students across all levels.</p>
          <div class="event-details">
            <span><i class="fa-solid fa-location-dot"></i> School Auditorium</span>
            <span><i class="fa-regular fa-clock"></i> 10:00 AM — 2:00 PM</span>
          </div>
        </article>

        <article class="article-card reveal" data-type="news">
          <div class="article-thumb">🏆</div>
          <div class="article-card-body">
            <div class="article-card-meta">
              <span class="badge badge-royal badge-pill">News</span>
              <span><i class="fa-regular fa-calendar"></i> Mar 22, 2025</span>
            </div>
            <h3>Inter-House Sports: Emerald House Claims Victory</h3>
            <p>After two days of thrilling athletic competition, Emerald House emerged as the overall champion of the 2025 Inter-House Sports Competition.</p>
            <div class="article-card-footer">
              <span><i class="fa-regular fa-user"></i> Sports Department</span>
              <span><i class="fa-regular fa-clock"></i> 3 min read</span>
              <a href="{{ url('/news/inter-house-sports-2025') }}" class="article-read-link">Read more <i class="fa-solid fa-arrow-right"></i></a>
            </div>
          </div>
        </article>

        <article class="event-card reveal" data-type="events">
          <div class="event-date-block">
            <span class="day">22</span>
            <span class="month">NOV</span>
          </div>
          <div class="event-card-meta">
            <span class="badge badge-amber badge-pill">Open Day</span>
            <span><i class="fa-regular fa-calendar"></i> Nov 22, 2025</span>
          </div>
          <h3>Parent-Teacher Open Day & Campus Tour</h3>
          <p>An opportunity for parents to meet with teachers, review student progress, and tour our newly upgraded science and ICT facilities.</p>
          <div class="event-details">
            <span><i class="fa-solid fa-location-dot"></i> Main Campus</span>
            <span><i class="fa-regular fa-clock"></i> 9:00 AM — 12:00 PM</span>
          </div>
        </article>

        <article class="article-card reveal" data-type="news">
          <div class="article-thumb">🎨</div>
          <div class="article-card-body">
            <div class="article-card-meta">
              <span class="badge badge-royal badge-pill">News</span>
              <span><i class="fa-regular fa-calendar"></i> Mar 8, 2025</span>
            </div>
            <h3>Art Exhibition: "Colours of Royal Ark" Opens This Week</h3>
            <p>Our annual student art exhibition showcases paintings, sculptures, and digital art created by students from Primary 1 through SS3.</p>
            <div class="article-card-footer">
              <span><i class="fa-regular fa-user"></i> Arts Department</span>
              <span><i class="fa-regular fa-clock"></i> 2 min read</span>
              <a href="{{ url('/news/art-exhibition-2025') }}" class="article-read-link">Read more <i class="fa-solid fa-arrow-right"></i></a>
            </div>
          </div>
        </article>

        <article class="event-card reveal" data-type="events">
          <div class="event-date-block">
            <span class="day">05</span>
            <span class="month">OCT</span>
          </div>
          <div class="event-card-meta">
            <span class="badge badge-amber badge-pill">Competition</span>
            <span><i class="fa-regular fa-calendar"></i> Oct 5, 2025</span>
          </div>
          <h3>Inter-School Debate Championship 2025</h3>
          <p>Royal Ark hosts the annual inter-school debate championship, welcoming teams from 12 schools across Lagos to compete for the trophy.</p>
          <div class="event-details">
            <span><i class="fa-solid fa-location-dot"></i> School Hall</span>
            <span><i class="fa-regular fa-clock"></i> 9:00 AM — 4:00 PM</span>
          </div>
        </article>
      </div>

      {{-- Pagination --}}
      <div class="pagination reveal">
        <span class="current">1</span>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#"><i class="fa-solid fa-chevron-right"></i></a>
      </div>
    </div>

    {{-- Sidebar --}}
    <aside class="sidebar">
      <div class="sidebar-box reveal">
        <h4>Categories</h4>
        <div class="category-chips">
          <button class="filter-pill active" data-cat="all">All</button>
          <button class="filter-pill" data-cat="academics">Academics</button>
          <button class="filter-pill" data-cat="sports">Sports</button>
          <button class="filter-pill" data-cat="events">Events</button>
          <button class="filter-pill" data-cat="admissions">Admissions</button>
          <button class="filter-pill" data-cat="arts">Arts</button>
        </div>
      </div>

      <div class="sidebar-box reveal reveal-delay-1">
        <h4>Recent Posts</h4>
        <a href="{{ url('/news/royal-ark-ranked-top-10') }}" class="sidebar-recent-item">
          <div class="sidebar-recent-thumb">📰</div>
          <div class="sidebar-recent-body">
            <div class="sidebar-recent-title">Royal Ark Ranked Top 10 in Lagos</div>
            <div class="sidebar-recent-date">May 5, 2025</div>
          </div>
        </a>
        <a href="{{ url('/news/admissions-2025-2026-open') }}" class="sidebar-recent-item">
          <div class="sidebar-recent-thumb">🎓</div>
          <div class="sidebar-recent-body">
            <div class="sidebar-recent-title">2025/2026 Admissions Now Open</div>
            <div class="sidebar-recent-date">Apr 28, 2025</div>
          </div>
        </a>
        <a href="{{ url('/news/science-olympiad-2025') }}" class="sidebar-recent-item">
          <div class="sidebar-recent-thumb">🔬</div>
          <div class="sidebar-recent-body">
            <div class="sidebar-recent-title">Science Olympiad Success</div>
            <div class="sidebar-recent-date">Apr 15, 2025</div>
          </div>
        </a>
        <a href="{{ url('/news/inter-house-sports-2025') }}" class="sidebar-recent-item">
          <div class="sidebar-recent-thumb">🏆</div>
          <div class="sidebar-recent-body">
            <div class="sidebar-recent-title">Inter-House Sports Results</div>
            <div class="sidebar-recent-date">Mar 22, 2025</div>
          </div>
        </a>
      </div>

      <div class="sidebar-cta reveal reveal-delay-2">
        <h4>Join Royal Ark</h4>
        <p>Admissions for the 2025/2026 session are open. Secure your child's place today.</p>
        <a href="{{ route('admissions') }}" class="btn btn-gold btn-md" style="width:100%;">Apply Now</a>
      </div>

      <div class="sidebar-box reveal reveal-delay-3">
        <h4>Newsletter</h4>
        <p style="font-size:var(--text-xs);color:var(--text-mid);line-height:1.6;margin-bottom:12px;">Get the latest news and event updates delivered to your inbox.</p>
        <form class="newsletter-input-group" style="flex-direction:column;gap:8px;" onsubmit="event.preventDefault();alert('Thanks for subscribing!');">
          <input type="email" class="newsletter-input" placeholder="Your email" required style="border-radius:var(--radius-sm);">
          <button type="submit" class="newsletter-btn" style="border-radius:var(--radius-sm);width:100%;">Subscribe</button>
        </form>
      </div>
    </aside>

  </div>
</section>

{{-- CTA --}}
<section class="section-pad cta-section">
  <div class="cta-bg-crest" aria-hidden="true">RA</div>
  <div class="container cta-inner">
    <div class="cta-text reveal">
      <h2 class="cta-title">Never miss an update</h2>
      <p class="cta-desc">Follow us on social media for real-time announcements, event photos, and school highlights.</p>
    </div>
    <div class="cta-actions reveal reveal-delay-1">
      <a href="#" class="btn btn-gold btn-md"><i class="fa-brands fa-facebook-f" style="margin-right:8px;"></i> Facebook</a>
      <a href="#" class="btn btn-outline-white btn-md"><i class="fa-brands fa-instagram" style="margin-right:8px;"></i> Instagram</a>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
(function() {
  'use strict';
  const tabs = document.querySelectorAll('.filter-tab');
  const cards = document.querySelectorAll('#newsList > [data-type]');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.toggle('active', t === tab));
      const filter = tab.dataset.filter;
      cards.forEach(card => {
        const show = filter === 'all' || card.dataset.type === filter;
        card.style.display = show ? '' : 'none';
      });
    });
  });

  // Simple search filter
  const searchInput = document.getElementById('newsSearchInput');
  if (searchInput) {
    searchInput.addEventListener('input', () => {
      const q = searchInput.value.toLowerCase();
      cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(q) ? '' : 'none';
      });
    });
  }
})();
</script>
@endpush
