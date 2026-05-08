@extends('layouts.landing.app')

@section('title', 'Royal Ark Schools Ranked Among Top 10 Private Schools in Lagos — Royal Ark Schools')
@section('navbar-class', 'solid')

@push('styles')
<style>
/* Article layout */
.article-layout {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 48px;
  align-items: start;
}
@media (max-width: 1024px) { .article-layout { grid-template-columns: 1fr; } }

/* Article header */
.article-header { margin-bottom: 32px; }
.article-hero-img {
  width: 100%;
  aspect-ratio: 16/9;
  background: linear-gradient(135deg, var(--royal-light), var(--royal));
  border-radius: var(--radius-lg);
  display: flex; align-items: center; justify-content: center;
  font-size: 6rem;
  margin-bottom: 28px;
  overflow: hidden;
}
.article-meta-bar {
  display: flex;
  align-items: center;
  gap: 16px;
  flex-wrap: wrap;
  margin-bottom: 16px;
}
.article-title {
  font-family: var(--font-display);
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  color: var(--ink);
  line-height: 1.15;
  margin-bottom: 20px;
}
.article-excerpt {
  font-family: var(--font-body);
  font-size: var(--text-md);
  color: var(--text-mid);
  line-height: 1.7;
  margin-bottom: 24px;
}

/* Author box */
.author-box {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 20px 24px;
  background: var(--cream);
  border-radius: var(--radius-md);
  border: 1px solid var(--border);
  margin-bottom: 32px;
}
.author-box-avatar {
  width: 52px; height: 52px;
  border-radius: 50%;
  background: var(--royal-pale);
  display: flex; align-items: center; justify-content: center;
  color: var(--royal);
  font-family: var(--font-heading);
  font-size: 1.1rem;
  font-weight: 700;
  flex-shrink: 0;
}
.author-box-info { flex: 1; }
.author-box-name {
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  font-weight: 700;
  color: var(--ink);
  margin-bottom: 2px;
}
.author-box-role {
  font-family: var(--font-heading);
  font-size: var(--text-xs);
  color: var(--text-light);
}

/* Article body */
.article-body {
  font-family: var(--font-body);
  font-size: var(--text-base);
  color: var(--text-dark);
  line-height: 1.85;
}
.article-body p { margin-bottom: 1.3em; }
.article-body h2 {
  font-family: var(--font-display);
  font-size: var(--text-xl);
  color: var(--ink);
  margin: 1.8em 0 0.6em;
}
.article-body h3 {
  font-family: var(--font-heading);
  font-size: var(--text-lg);
  color: var(--ink);
  margin: 1.5em 0 0.5em;
}
.article-body ul, .article-body ol {
  margin: 0 0 1.3em 1.5em;
  padding-left: 0.5em;
}
.article-body li { margin-bottom: 0.5em; }
.article-body blockquote {
  border-left: 4px solid var(--amber);
  background: var(--cream);
  padding: 20px 24px;
  border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
  margin: 1.5em 0;
  font-style: italic;
  color: var(--text-mid);
}
.article-body .pull-quote {
  float: right;
  width: 280px;
  margin: 0 0 20px 24px;
  font-family: var(--font-display);
  font-size: 1.35rem;
  color: var(--royal);
  line-height: 1.4;
  border-left: 4px solid var(--amber);
  padding-left: 20px;
}
@media (max-width: 768px) {
  .article-body .pull-quote { float: none; width: 100%; margin: 20px 0; }
}

/* Tags */
.article-tags {
  display: flex; flex-wrap: wrap; gap: 8px;
  margin: 32px 0;
  padding-top: 24px;
  border-top: 1px solid var(--border);
}
.article-tag {
  font-family: var(--font-heading);
  font-size: var(--text-xs);
  font-weight: 600;
  color: var(--text-mid);
  background: var(--cream);
  border: 1px solid var(--border);
  padding: 6px 14px;
  border-radius: var(--radius-pill);
  text-decoration: none;
  transition: all var(--duration-base) var(--ease);
}
.article-tag:hover { border-color: var(--amber); color: var(--amber); background: var(--amber-pale); }

/* Share box */
.share-box {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
  margin-bottom: 40px;
}
.share-label {
  font-family: var(--font-heading);
  font-size: var(--text-xs);
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: var(--text-light);
}
.share-btn {
  display: inline-flex; align-items: center; gap: 6px;
  font-family: var(--font-heading);
  font-size: var(--text-xs);
  font-weight: 600;
  padding: 8px 14px;
  border-radius: var(--radius-sm);
  border: 1px solid var(--border);
  background: var(--white);
  color: var(--text-mid);
  cursor: pointer;
  text-decoration: none;
  transition: all var(--duration-base) var(--ease);
}
.share-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow-sm); }
.share-btn.whatsapp:hover { border-color: #25D366; color: #25D366; background: #eafff2; }
.share-btn.facebook:hover { border-color: #1877F2; color: #1877F2; background: #e8f2ff; }
.share-btn.twitter:hover { border-color: #0f1419; color: #0f1419; background: #e8ebed; }
.share-btn.copy-link:hover { border-color: var(--amber); color: var(--amber); background: var(--amber-pale); }

/* Sidebar (reuses article-list styles from index) */
.sidebar-related h4 {
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: var(--ink);
  margin-bottom: 16px;
}
.related-card {
  display: flex;
  gap: 14px;
  padding: 16px 0;
  border-bottom: 1px solid var(--border);
  text-decoration: none;
  align-items: flex-start;
  transition: transform var(--duration-base) var(--ease);
}
.related-card:last-child { border-bottom: none; }
.related-card:hover { transform: translateX(4px); }
.related-thumb {
  width: 72px; height: 72px;
  border-radius: var(--radius-sm);
  background: var(--cream);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.8rem;
  flex-shrink: 0;
}
.related-body { flex: 1; }
.related-title {
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  font-weight: 600;
  color: var(--ink);
  line-height: 1.4;
  margin-bottom: 4px;
}
.related-meta {
  font-family: var(--font-heading);
  font-size: 0.65rem;
  color: var(--text-muted);
}

/* Prev / Next nav */
.article-nav {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
  margin-top: 48px;
  padding-top: 32px;
  border-top: 1px solid var(--border);
}
.article-nav a {
  text-decoration: none;
  padding: 20px;
  border-radius: var(--radius-md);
  border: 1px solid var(--border);
  background: var(--white);
  transition: all var(--duration-base) var(--ease);
}
.article-nav a:hover { border-color: var(--amber); box-shadow: var(--shadow-sm); }
.article-nav a.next { text-align: right; }
.article-nav-label {
  font-family: var(--font-heading);
  font-size: var(--text-xs);
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: var(--text-muted);
  margin-bottom: 6px;
  display: flex; align-items: center; gap: 6px;
}
.article-nav a.next .article-nav-label { justify-content: flex-end; }
.article-nav-title {
  font-family: var(--font-display);
  font-size: var(--text-lg);
  color: var(--ink);
  line-height: 1.3;
}

@media (max-width: 768px) {
  .article-nav { grid-template-columns: 1fr; }
  .article-nav a.next { text-align: left; }
}
</style>
@endpush

@section('content')

{{-- Page Hero --}}
<section class="page-hero" style="min-height:260px;">
  <div class="page-hero-pattern"></div>
  <div class="page-hero-crest" aria-hidden="true">RA</div>
  <div class="container page-hero-content">
    <nav class="breadcrumb" aria-label="breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span class="breadcrumb-sep"><i class="fa-solid fa-chevron-right"></i></span>
      <a href="{{ route('news') }}">News</a>
      <span class="breadcrumb-sep"><i class="fa-solid fa-chevron-right"></i></span>
      <span class="current">Article</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);">News & Updates</h1>
  </div>
</section>

{{-- Article --}}
<section class="section-pad">
  <div class="container article-layout">

    {{-- Main Article --}}
    <article class="article-main">
      <div class="article-hero-img reveal">📰</div>

      <header class="article-header reveal">
        <div class="article-meta-bar">
          <span class="badge badge-royal badge-pill">Academics</span>
          <span class="badge badge-amber badge-pill">Featured</span>
          <span style="font-family:var(--font-heading);font-size:var(--text-xs);color:var(--text-light);"><i class="fa-regular fa-calendar" style="margin-right:4px;"></i> May 5, 2025</span>
          <span style="font-family:var(--font-heading);font-size:var(--text-xs);color:var(--text-light);"><i class="fa-regular fa-clock" style="margin-right:4px;"></i> 5 min read</span>
        </div>
        <h1 class="article-title">Royal Ark Schools Ranked Among Top 10 Private Schools in Lagos State</h1>
        <p class="article-excerpt">The Lagos State Ministry of Education released its annual ranking of private institutions, and Royal Ark Schools is proud to be recognised for academic excellence, modern facilities, and holistic student development.</p>
      </header>

      <div class="author-box reveal">
        <div class="author-box-avatar">AB</div>
        <div class="author-box-info">
          <div class="author-box-name">Administration Board</div>
          <div class="author-box-role">School Communications &middot; Published May 5, 2025</div>
        </div>
      </div>

      <div class="article-body reveal">
        <p>The annual evaluation by the Lagos State Ministry of Education assessed over 400 private schools across the state on criteria including academic performance in external examinations, quality of teaching staff, infrastructure, co-curricular offerings, and student welfare provisions.</p>

        <p>Royal Ark Schools scored particularly highly in the categories of <strong>Science & Technology Education</strong> and <strong>Student Character Development</strong>, two pillars that have defined our institutional philosophy since our founding in 2005.</p>

        <blockquote>"This recognition belongs to our students, parents, and staff who work tirelessly to make Royal Ark a place where excellence is not just expected, but lived every day."</blockquote>

        <h2>What the Rankings Measured</h2>
        <p>The Ministry's evaluation framework covers six key domains:</p>
        <ul>
          <li><strong>Academic Performance:</strong> WAEC, NECO, and JAMB results over a 5-year rolling window</li>
          <li><strong>Teaching Quality:</strong> Staff qualifications, continuous professional development, and student-teacher ratios</li>
          <li><strong>Infrastructure:</strong> Classroom standards, laboratory equipment, ICT facilities, and sports amenities</li>
          <li><strong>Student Welfare:</strong> Counselling services, health facilities, and safety protocols</li>
          <li><strong>Co-curricular Activity:</strong> Sports, arts, debate, and community engagement programmes</li>
          <li><strong>Administrative Standards:</strong> Governance, financial transparency, and parent communication</li>
        </ul>

        <h2>Looking Ahead</h2>
        <p>As we celebrate this milestone, we remain committed to continuous improvement. Our 2025 strategic plan includes the expansion of our STEM laboratories, the launch of a coding and robotics academy, and enhanced scholarship opportunities for outstanding students from underserved communities.</p>

        <p>We extend our deepest gratitude to every parent who entrusts us with their child's education, and to every staff member who brings dedication and passion to their work each day.</p>
      </div>

      <div class="article-tags reveal">
        <span class="share-label">Tags:</span>
        <a href="#" class="article-tag">Academics</a>
        <a href="#" class="article-tag">Awards</a>
        <a href="#" class="article-tag">Lagos</a>
        <a href="#" class="article-tag">Education</a>
      </div>

      <div class="share-box reveal">
        <span class="share-label">Share:</span>
        <a href="https://wa.me/?text={{ urlencode('Royal Ark Schools Ranked Among Top 10 Private Schools in Lagos State - '.url('/news/royal-ark-ranked-top-10')) }}" target="_blank" rel="noopener" class="share-btn whatsapp"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/news/royal-ark-ranked-top-10')) }}" target="_blank" rel="noopener" class="share-btn facebook"><i class="fa-brands fa-facebook-f"></i> Facebook</a>
        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('/news/royal-ark-ranked-top-10')) }}&text={{ urlencode('Royal Ark Schools ranked Top 10 in Lagos!') }}" target="_blank" rel="noopener" class="share-btn twitter"><i class="fa-brands fa-x-twitter"></i> X / Twitter</a>
        <button type="button" class="share-btn copy-link" onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied to clipboard!');"><i class="fa-solid fa-link"></i> Copy Link</button>
      </div>

      <nav class="article-nav reveal">
        <a href="{{ url('/news/admissions-2025-2026-open') }}">
          <div class="article-nav-label"><i class="fa-solid fa-arrow-left"></i> Previous</div>
          <div class="article-nav-title">2025/2026 Admissions Now Open — Apply Early</div>
        </a>
        <a href="{{ url('/news/science-olympiad-2025') }}" class="next">
          <div class="article-nav-label">Next <i class="fa-solid fa-arrow-right"></i></div>
          <div class="article-nav-title">Students Excel at National Science Olympiad</div>
        </a>
      </nav>
    </article>

    {{-- Sidebar --}}
    <aside class="sidebar sidebar-related">
      <div class="sidebar-box reveal">
        <h4>Related Articles</h4>
        <a href="{{ url('/news/science-olympiad-2025') }}" class="related-card">
          <div class="related-thumb">🔬</div>
          <div class="related-body">
            <div class="related-title">Students Excel at National Science Olympiad</div>
            <div class="related-meta">Apr 15, 2025 &middot; Academics</div>
          </div>
        </a>
        <a href="{{ url('/news/inter-house-sports-2025') }}" class="related-card">
          <div class="related-thumb">🏆</div>
          <div class="related-body">
            <div class="related-title">Inter-House Sports: Emerald House Claims Victory</div>
            <div class="related-meta">Mar 22, 2025 &middot; Sports</div>
          </div>
        </a>
        <a href="{{ url('/news/art-exhibition-2025') }}" class="related-card">
          <div class="related-thumb">🎨</div>
          <div class="related-body">
            <div class="related-title">Art Exhibition: "Colours of Royal Ark" Opens</div>
            <div class="related-meta">Mar 8, 2025 &middot; Arts</div>
          </div>
        </a>
        <a href="{{ url('/news/admissions-2025-2026-open') }}" class="related-card">
          <div class="related-thumb">🎓</div>
          <div class="related-body">
            <div class="related-title">2025/2026 Admissions Now Open</div>
            <div class="related-meta">Apr 28, 2025 &middot; Admissions</div>
          </div>
        </a>
      </div>

      <div class="sidebar-box reveal reveal-delay-1">
        <h4>Categories</h4>
        <div class="category-chips">
          <a href="#" class="filter-pill active">All</a>
          <a href="#" class="filter-pill">Academics</a>
          <a href="#" class="filter-pill">Sports</a>
          <a href="#" class="filter-pill">Admissions</a>
          <a href="#" class="filter-pill">Arts</a>
        </div>
      </div>

      <div class="sidebar-cta reveal reveal-delay-2">
        <h4>Stay Updated</h4>
        <p>Get the latest news and event updates delivered to your inbox.</p>
        <form class="newsletter-input-group" style="flex-direction:column;gap:8px;" onsubmit="event.preventDefault();alert('Thanks for subscribing!');">
          <input type="email" class="newsletter-input" placeholder="Your email" required style="border-radius:var(--radius-sm);">
          <button type="submit" class="newsletter-btn" style="border-radius:var(--radius-sm);width:100%;">Subscribe</button>
        </form>
      </div>
    </aside>

  </div>
</section>

@endsection
