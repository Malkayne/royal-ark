@extends('layouts.landing.app')

@section('title', 'Academics — Royal Ark Schools')
@section('meta_description', 'Explore our comprehensive academic programs from Creche to Senior Secondary. At Royal Ark Schools, we offer a curriculum designed for holistic growth.')
@section('meta_keywords', 'Royal Ark Schools academics, curriculum, secondary school subjects, primary school curriculum, nursery education')
@section('navbar-class', 'solid')

@push('styles')
<style>
/* Program tabs */
.program-tabs {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
  justify-content: center;
  margin-bottom: 40px;
}
.program-tab {
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  font-weight: 600;
  padding: 10px 20px;
  border-radius: var(--radius-pill);
  border: 1px solid var(--border);
  background: var(--white);
  color: var(--text-mid);
  cursor: pointer;
  transition: all var(--duration-base) var(--ease);
  white-space: nowrap;
}
.program-tab:hover { border-color: var(--amber); color: var(--amber); }
.program-tab.active { background: var(--royal); color: var(--white); border-color: var(--royal); }

.program-panel { display: none; }
.program-panel.active { display: block; animation: fadeIn 0.4s var(--ease); }
@keyframes fadeIn { from { opacity:0; transform: translateY(8px); } to { opacity:1; transform: translateY(0); } }

.program-detail-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  align-items: start;
}
.subject-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 12px; }
.subject-pill {
  font-family: var(--font-heading);
  font-size: var(--text-xs);
  font-weight: 600;
  padding: 6px 14px;
  border-radius: var(--radius-pill);
  background: var(--royal-pale);
  color: var(--royal);
}

/* Program Image */
.program-img-wrap {
  position: relative;
}
.program-img {
  position: relative;
  overflow: hidden;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-lg);
}
.program-img img {
  width: 100%;
  height: auto;
  display: block;
  transition: transform var(--duration-slow) var(--ease);
}
.program-img-wrap:hover .program-img img {
  transform: scale(1.05);
}

/* Calendar */
.term-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
.term-card {
  background: var(--white);
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  overflow: hidden;
  transition: box-shadow var(--duration-slow) var(--ease), transform var(--duration-slow) var(--ease);
}
.term-card:hover { box-shadow: var(--shadow-md); transform: translateY(-4px); }
.term-header {
  background: linear-gradient(135deg, var(--royal), var(--royal-mid));
  color: var(--white);
  padding: 20px 24px;
  text-align: center;
}
.term-header h3 { font-family: var(--font-display); font-size: var(--text-xl); font-weight: 600; }
.term-body { padding: 24px; }
.term-date {
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  font-weight: 700;
  color: var(--amber);
  margin-bottom: 12px;
  text-align: center;
}
.term-events { list-style: none; }
.term-events li {
  font-family: var(--font-body);
  font-size: var(--text-sm);
  color: var(--text-mid);
  padding: 8px 0;
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  gap: 8px;
}
.term-events li:last-child { border-bottom: none; }
.term-break {
  margin-top: 16px;
  padding-top: 16px;
  border-top: 1px dashed var(--border);
  text-align: center;
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  font-weight: 700;
  color: var(--danger);
}

/* Extra-curricular */
.activity-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
.activity-card {
  background: var(--white);
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  padding: 28px 20px;
  text-align: center;
  transition: background var(--duration-base) var(--ease), border-color var(--duration-base) var(--ease), transform var(--duration-slow) var(--ease);
}
.activity-card:hover { background: var(--amber-pale); border-color: var(--amber-light); transform: translateY(-4px); }
.activity-icon { font-size: 2rem; margin-bottom: 12px; display: block; }
.activity-title { font-family: var(--font-heading); font-size: var(--text-sm); font-weight: 700; color: var(--ink); margin-bottom: 6px; }
.activity-desc { font-family: var(--font-body); font-size: var(--text-xs); color: var(--text-mid); line-height: 1.6; }

/* Curriculum pillars */
.pillar-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
.pillar-card {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-md);
  padding: 20px 24px;
  transition: border-color var(--duration-base) var(--ease), box-shadow var(--duration-base) var(--ease);
}
.pillar-card:hover { border-color: var(--amber-gold); box-shadow: var(--shadow-sm); }
.pillar-icon { font-size: 1.6rem; flex-shrink: 0; }
.pillar-title { font-family: var(--font-heading); font-size: var(--text-md); font-weight: 700; color: var(--ink); margin-bottom: 4px; }
.pillar-desc { font-family: var(--font-body); font-size: var(--text-sm); color: var(--text-mid); line-height: 1.6; }

@media (max-width: 1024px) {
  .program-detail-grid { grid-template-columns: 1fr; }
  .term-grid { grid-template-columns: repeat(2, 1fr); }
  .activity-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
  .term-grid { grid-template-columns: 1fr; }
  .activity-grid { grid-template-columns: 1fr 1fr; }
  .pillar-grid { grid-template-columns: 1fr; }
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
      <span class="current">Academics</span>
    </nav>
    <h1>Academic Excellence at Every Level</h1>
    <p class="page-hero-sub">Structured learning pathways designed to develop curious minds and confident futures.</p>
    <div class="program-tabs" style="margin-top:28px;">
      <a href="#programs" class="program-tab">Programs</a>
      <a href="#curriculum" class="program-tab">Curriculum</a>
      <!-- <a href="#calendar" class="program-tab">Calendar</a> -->
      <a href="#extra" class="program-tab">Extra-Curricular</a>
    </div>
  </div>
</section>

{{-- Programs Overview (Tabbed) --}}
<section class="section-pad" id="programs">
  <div class="container">
    <div class="text-center" style="margin-bottom:40px;">
      <div class="section-label center">What We Offer</div>
      <h2 class="section-title center">Programs Overview</h2>
    </div>

    <div class="program-tabs" id="programTabs">
      <button class="program-tab active" data-tab="creche">Creche &amp; Nursery</button>
      <button class="program-tab" data-tab="primary">Primary</button>
      <button class="program-tab" data-tab="jss">Junior Secondary</button>
      <button class="program-tab" data-tab="sss">Senior Secondary</button>
    </div>

    <div id="creche" class="program-panel active">
      <div class="program-detail-grid">
        <div>
          <span class="badge badge-royal mb-12">Ages 1 – 5</span>
          <h3 class="section-title" style="font-size:var(--text-2xl);">Creche &amp; Nursery School</h3>
          <p class="section-subtitle" style="max-width:none;">Our early years program focuses on play-based learning, sensory exploration, and building foundational social skills. Children learn through guided play, music, art, and structured routines that prepare them for primary education.</p>
          <div class="subject-pills">
            <span class="subject-pill">Early Literacy</span>
            <span class="subject-pill">Numeracy</span>
            <span class="subject-pill">Phonics</span>
            <span class="subject-pill">Creative Play</span>
            <span class="subject-pill">Motor Skills</span>
            <span class="subject-pill">Social Skills</span>
          </div>
        </div>
        <div style="background:var(--royal-pale); border-radius:var(--radius-lg); padding:40px; display:flex; align-items:center; justify-content:center; font-size:4rem;">🧸</div>
      </div>
    </div>

    <div id="primary" class="program-panel">
      <div class="program-detail-grid">
        <div>
          <span class="badge badge-royal mb-12">Years 1 – 6</span>
          <h3 class="section-title" style="font-size:var(--text-2xl);">Primary School</h3>
          <p class="section-subtitle" style="max-width:none;">A robust primary curriculum grounded in the Nigerian Basic Education curriculum, enriched with ICT, creative arts, and character education. Pupils develop strong reading, writing, and numeracy skills alongside confidence and discipline.</p>
          <div class="subject-pills">
            <span class="subject-pill">English</span>
            <span class="subject-pill">Mathematics</span>
            <span class="subject-pill">Basic Science</span>
            <span class="subject-pill">Social Studies</span>
            <span class="subject-pill">ICT</span>
            <span class="subject-pill">Creative Arts</span>
            <span class="subject-pill">Agriculture</span>
            <span class="subject-pill">Home Economics</span>
            <span class="subject-pill">Physical Education</span>
            <span class="subject-pill">Civic Education</span>
          </div>
        </div>
        <div style="background:var(--royal-pale); border-radius:var(--radius-lg); padding:40px; display:flex; align-items:center; justify-content:center; font-size:4rem;">📚</div>
      </div>
    </div>

    <div id="jss" class="program-panel">
      <div class="program-detail-grid">
        <div>
          <span class="badge badge-royal mb-12">JSS 1 – 3</span>
          <h3 class="section-title" style="font-size:var(--text-2xl);">Junior Secondary School</h3>
          <p class="section-subtitle" style="max-width:none;">Junior secondary builds on primary foundations with a broader subject range, hands-on science practicals, and introductory technology. Students sit for the Basic Education Certificate Examination (BECE) at the end of JSS 3.</p>
          <div class="subject-pills">
            <span class="subject-pill">English</span>
            <span class="subject-pill">Mathematics</span>
            <span class="subject-pill">Basic Science</span>
            <span class="subject-pill">Basic Technology</span>
            <span class="subject-pill">Business Studies</span>
            <span class="subject-pill">Social Studies</span>
            <span class="subject-pill">Civic Education</span>
            <span class="subject-pill">Agricultural Science</span>
            <span class="subject-pill">Home Economics</span>
            <span class="subject-pill">French</span>
            <span class="subject-pill">Igbo / Yoruba</span>
            <span class="subject-pill">Computer Studies</span>
          </div>
          <p class="section-subtitle" style="margin-top:16px; max-width:none; font-size:var(--text-sm);"><strong>External Exam:</strong> Basic Education Certificate Examination (BECE)</p>
        </div>
        <div class="program-img-wrap reveal reveal-delay-1">
          <div class="program-img">
            <img src="{{ asset('landing/img/gallery/jss-1.jpg') }}" alt="Royal Ark Schools Campus">
          </div>
        </div>
        <!-- <div style="background:var(--royal-pale); border-radius:var(--radius-lg); padding:40px; display:flex; align-items:center; justify-content:center; font-size:4rem;">🎒</div> -->
      </div>
    </div>

    <div id="sss" class="program-panel">
      <div class="program-detail-grid">
        <div>
          <span class="badge badge-royal mb-12">SSS 1 – 3</span>
          <h3 class="section-title" style="font-size:var(--text-2xl);">Senior Secondary School</h3>
          <p class="section-subtitle" style="max-width:none;">Students select one of three specialized streams — Science, Arts, or Commercial — with intensive preparation for WAEC and NECO. Our SS3 program includes mock examinations, counselling, and university placement guidance.</p>
          <div class="subject-pills">
            <span class="subject-pill">English</span>
            <span class="subject-pill">Mathematics</span>
            <span class="subject-pill">Physics</span>
            <span class="subject-pill">Chemistry</span>
            <span class="subject-pill">Biology</span>
            <span class="subject-pill">Economics</span>
            <span class="subject-pill">Government</span>
            <span class="subject-pill">Literature</span>
            <span class="subject-pill">Commerce</span>
            <span class="subject-pill">Accounting</span>
            <span class="subject-pill">Geography</span>
            <span class="subject-pill">Further Maths</span>
          </div>
          <p class="section-subtitle" style="margin-top:16px; max-width:none; font-size:var(--text-sm);"><strong>External Exams:</strong> WAEC SSCE &amp; NECO SSCE</p>
        </div>
        <div style="background:var(--royal-pale); border-radius:var(--radius-lg); padding:40px; display:flex; align-items:center; justify-content:center; font-size:4rem;">🎓</div>
      </div>
    </div>
  </div>
</section>

{{-- Curriculum Philosophy --}}
<section class="section-pad" style="background:var(--cream);" id="curriculum">
  <div class="container">
    <div class="grid-2" style="align-items:center; gap:64px;">
      <div class="reveal">
        <div class="section-label">Our Approach</div>
        <h2 class="section-title">Curriculum Philosophy</h2>
        <p class="section-subtitle" style="max-width:none;">Our curriculum is built on the Nigerian national standards, enriched with global best practices. We balance knowledge acquisition with skill development, ensuring every student is prepared for both local examinations and international opportunities.</p>
        <p class="section-subtitle" style="max-width:none; margin-top:12px;">Regular assessments, project-based learning, and digital literacy are woven into every subject area. Teachers receive continuous professional development to stay ahead of pedagogical trends.</p>
      </div>
      <div class="pillar-grid reveal reveal-delay-1">
        <div class="pillar-card">
          <span class="pillar-icon">📖</span>
          <div>
            <h4 class="pillar-title">Knowledge-First</h4>
            <p class="pillar-desc">Strong subject mastery as the foundation for critical thinking.</p>
          </div>
        </div>
        <div class="pillar-card">
          <span class="pillar-icon">🧠</span>
          <div>
            <h4 class="pillar-title">Critical Thinking</h4>
            <p class="pillar-desc">Encouraging analysis, problem-solving, and independent inquiry.</p>
          </div>
        </div>
        <div class="pillar-card">
          <span class="pillar-icon">🤝</span>
          <div>
            <h4 class="pillar-title">Character Building</h4>
            <p class="pillar-desc">Values, ethics, and leadership integrated into daily school life.</p>
          </div>
        </div>
        <div class="pillar-card">
          <span class="pillar-icon">🌱</span>
          <div>
            <h4 class="pillar-title">Growth Mindset</h4>
            <p class="pillar-desc">Resilience, effort, and the belief that abilities can be developed.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Academic Calendar --}}
<!-- <section class="section-pad" id="calendar">
  <div class="container">
    <div class="text-center" style="margin-bottom:40px;">
      <div class="section-label center">Plan Ahead</div>
      <h2 class="section-title center">Academic Calendar — 2025/2026</h2>
      <p class="section-subtitle center">Key dates for the current session.</p>
    </div>
    <div class="term-grid">
      <div class="term-card reveal">
        <div class="term-header">
          <h3>First Term</h3>
        </div>
        <div class="term-body">
          <div class="term-date">Resumption: Sep 8, 2025</div>
          <ul class="term-events">
            <li><i class="fa-regular fa-calendar" style="color:var(--amber);"></i> Welcome Assembly</li>
            <li><i class="fa-regular fa-calendar" style="color:var(--amber);"></i> Open Day — Mid Term</li>
            <li><i class="fa-regular fa-calendar" style="color:var(--amber);"></i> Inter-House Sports</li>
            <li><i class="fa-regular fa-calendar" style="color:var(--amber);"></i> End-of-Term Exams</li>
          </ul>
          <div class="term-break">Break: Dec 12, 2025</div>
        </div>
      </div>
      <div class="term-card reveal reveal-delay-1">
        <div class="term-header">
          <h3>Second Term</h3>
        </div>
        <div class="term-body">
          <div class="term-date">Resumption: Jan 6, 2026</div>
          <ul class="term-events">
            <li><i class="fa-regular fa-calendar" style="color:var(--amber);"></i> New Year Assembly</li>
            <li><i class="fa-regular fa-calendar" style="color:var(--amber);"></i> Career Day</li>
            <li><i class="fa-regular fa-calendar" style="color:var(--amber);"></i> Mid-Term Assessments</li>
            <li><i class="fa-regular fa-calendar" style="color:var(--amber);"></i> Prize Giving Rehearsals</li>
          </ul>
          <div class="term-break">Break: Apr 3, 2026</div>
        </div>
      </div>
      <div class="term-card reveal reveal-delay-2">
        <div class="term-header">
          <h3>Third Term</h3>
        </div>
        <div class="term-body">
          <div class="term-date">Resumption: Apr 20, 2026</div>
          <ul class="term-events">
            <li><i class="fa-regular fa-calendar" style="color:var(--amber);"></i> WAEC / NECO Prep</li>
            <li><i class="fa-regular fa-calendar" style="color:var(--amber);"></i> Excursions &amp; Field Trips</li>
            <li><i class="fa-regular fa-calendar" style="color:var(--amber);"></i> Final Exams</li>
            <li><i class="fa-regular fa-calendar" style="color:var(--amber);"></i> Graduation &amp; Prize Day</li>
          </ul>
          <div class="term-break">Long Vacation: Jul 18, 2026</div>
        </div>
      </div>
    </div>
    <div class="text-center" style="margin-top:32px;">
      <a href="#" class="btn btn-outline btn-md" onclick="event.preventDefault(); alert('Calendar PDF download coming soon.');"><i class="fa-solid fa-download"></i> Download Calendar (PDF)</a>
    </div>
  </div>
</section> -->

{{-- Extra-Curricular --}}
<section class="section-pad" style="background:var(--cream);" id="extra">
  <div class="container">
    <div class="text-center" style="margin-bottom:40px;">
      <div class="section-label center">Beyond the Classroom</div>
      <h2 class="section-title center">Extra-Curricular Activities</h2>
      <p class="section-subtitle center">Developing well-rounded students through sport, art, and leadership.</p>
    </div>
    <div class="activity-grid">
      <div class="activity-card reveal"><span class="activity-icon">⚽</span><h4 class="activity-title">Football</h4><p class="activity-desc">Inter-house and external competitions.</p></div>
      <div class="activity-card reveal reveal-delay-1"><span class="activity-icon">🏀</span><h4 class="activity-title">Basketball</h4><p class="activity-desc">Skills training and friendly matches.</p></div>
      <div class="activity-card reveal reveal-delay-2"><span class="activity-icon">🎭</span><h4 class="activity-title">Drama Club</h4><p class="activity-desc">Stage productions and public speaking.</p></div>
      <div class="activity-card reveal reveal-delay-3"><span class="activity-icon">🎵</span><h4 class="activity-title">Music / Choir</h4><p class="activity-desc">Vocal training and instrumental music.</p></div>
      <div class="activity-card reveal"><span class="activity-icon">🧪</span><h4 class="activity-title">Science Club</h4><p class="activity-desc">Experiments, fairs, and innovation.</p></div>
      <div class="activity-card reveal reveal-delay-1"><span class="activity-icon">🎨</span><h4 class="activity-title">Art &amp; Design</h4><p class="activity-desc">Fine arts, crafts, and digital design.</p></div>
      <div class="activity-card reveal reveal-delay-2"><span class="activity-icon">📰</span><h4 class="activity-title">Debate Club</h4><p class="activity-desc">Critical argument and eloquence.</p></div>
      <div class="activity-card reveal reveal-delay-3"><span class="activity-icon">💻</span><h4 class="activity-title">Coding Club</h4><p class="activity-desc">Programming, robotics, and app design.</p></div>
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="section-pad cta-section">
  <div class="cta-bg-crest" aria-hidden="true">RA</div>
  <div class="container cta-inner">
    <div class="cta-text reveal">
      <h2 class="cta-title">Ready to enrol your child in a school built for excellence?</h2>
      <p class="cta-desc">Applications are open for the 2025/2026 academic session.</p>
    </div>
    <div class="cta-actions reveal reveal-delay-1">
      <a href="{{ route('apply') }}" class="btn btn-gold btn-md">Apply for Admission</a>
      <a href="{{ route('contact') }}" class="btn btn-outline-white btn-md">Contact Us</a>
    </div>
  </div>
</section>

@push('scripts')
<script>
(function() {
  const tabs = document.querySelectorAll('#programTabs .program-tab');
  const panels = document.querySelectorAll('.program-panel');
  
  // Function to activate a specific tab
  function activateTab(tabId) {
    tabs.forEach(t => t.classList.toggle('active', t.dataset.tab === tabId));
    panels.forEach(p => p.classList.toggle('active', p.id === tabId));
  }
  
  // Check for tab query parameter on page load
  const urlParams = new URLSearchParams(window.location.search);
  const tabParam = urlParams.get('tab');
  if (tabParam && document.getElementById(tabParam)) {
    activateTab(tabParam);
  }
  
  // Tab click handlers
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const target = tab.dataset.tab;
      activateTab(target);
      // Update URL without page reload
      const newUrl = new URL(window.location);
      newUrl.searchParams.set('tab', target);
      window.history.replaceState({}, '', newUrl);
    });
  });
})();
</script>
@endpush

@endsection
