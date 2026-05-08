@extends('layouts.landing.app')

@section('title', 'About — Royal Ark Schools')
@section('meta_description', 'Learn about the legacy, mission, and vision of Royal Ark Schools. Discover how we nurture royalty and inspire excellence in every student.')
@section('meta_keywords', 'about Royal Ark Schools, school mission, educational vision, school leadership, history of Royal Ark Schools')
@section('navbar-class', 'solid')

@push('styles')
<style>
.mvv-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}
.mvv-card {
  background: var(--white);
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  padding: 32px 28px;
  text-align: center;
  transition: transform var(--duration-slow) var(--ease), box-shadow var(--duration-slow) var(--ease), border-color var(--duration-slow) var(--ease);
}
.mvv-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: var(--border-dark); }
.mvv-card.featured {
  background: linear-gradient(160deg, var(--royal), var(--royal-mid));
  color: var(--white);
  border-color: transparent;
  transform: scale(1.02);
  box-shadow: var(--shadow-lg);
}
.mvv-card.featured .mvv-title { color: var(--white); }
.mvv-card.featured .mvv-body { color: rgba(255,255,255,0.75); }
.mvv-card.featured .mvv-icon { color: var(--amber-gold); }
.mvv-icon { font-size: 2rem; margin-bottom: 16px; display: block; }
.mvv-title { font-family: var(--font-display); font-size: var(--text-xl); font-weight: 600; color: var(--ink); margin-bottom: 12px; }
.mvv-body { font-family: var(--font-body); font-size: var(--text-sm); color: var(--text-mid); line-height: 1.7; }

/* About Image */
.about-img-wrap {
  position: relative;
}
.about-img {
  position: relative;
  overflow: hidden;
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-lg);
}
.about-img img {
  width: 100%;
  height: auto;
  display: block;
  transition: transform var(--duration-slow) var(--ease);
}
.about-img-wrap:hover .about-img img {
  transform: scale(1.05);
}
.about-float-badge {
  position: absolute;
  bottom: 20px;
  right: 20px;
  background: var(--amber-gold);
  color: var(--ink);
  padding: 12px 20px;
  border-radius: var(--radius-sm);
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  box-shadow: var(--shadow-md);
}

/* Timeline */
.timeline { position: relative; padding-left: 32px; }
.timeline::before {
  content: '';
  position: absolute; left: 7px; top: 6px; bottom: 6px;
  width: 2px; background: var(--border);
}
.timeline-item { position: relative; margin-bottom: 28px; }
.timeline-item::before {
  content: '';
  position: absolute; left: -28px; top: 6px;
  width: 14px; height: 14px;
  border-radius: 50%;
  background: var(--amber);
  box-shadow: 0 0 0 4px var(--amber-pale);
  transition: box-shadow var(--duration-base) var(--ease);
}
.timeline-item:hover::before { box-shadow: 0 0 0 6px var(--amber-pale); }
.timeline-year {
  font-family: var(--font-heading);
  font-size: var(--text-xs);
  font-weight: 700;
  color: var(--amber);
  letter-spacing: 0.08em;
  text-transform: uppercase;
  margin-bottom: 4px;
}
.timeline-title { font-family: var(--font-heading); font-size: var(--text-md); font-weight: 700; color: var(--ink); margin-bottom: 4px; }
.timeline-desc { font-family: var(--font-body); font-size: var(--text-sm); color: var(--text-mid); line-height: 1.6; }

/* Team */
.team-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
.team-card {
  background: var(--white);
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  overflow: hidden;
  transition: border-color var(--duration-slow) var(--ease), transform var(--duration-slow) var(--ease);
}
.team-card:hover { border-color: var(--amber); transform: translateY(-4px); }
.team-avatar {
  aspect-ratio: 1;
  background: var(--royal-pale);
  display: flex; align-items: center; justify-content: center;
  font-family: var(--font-display);
  font-size: 3.5rem;
  font-weight: 700;
  color: var(--royal);
}
.team-body { padding: 24px; }
.team-name { font-family: var(--font-display); font-size: var(--text-lg); font-weight: 600; color: var(--ink); margin-bottom: 2px; transition: color var(--duration-base) var(--ease); }
.team-card:hover .team-name { color: var(--royal); }
.team-role { font-family: var(--font-heading); font-size: var(--text-xs); font-weight: 700; color: var(--amber); letter-spacing: 0.06em; text-transform: uppercase; margin-bottom: 10px; }
.team-bio { font-family: var(--font-body); font-size: var(--text-sm); color: var(--text-mid); line-height: 1.7; }

/* Facilities */
.facility-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
.facility-card {
  background: var(--white);
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  padding: 28px 24px;
  text-align: center;
  transition: transform var(--duration-slow) var(--ease), box-shadow var(--duration-slow) var(--ease), border-color var(--duration-slow) var(--ease);
}
.facility-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: var(--amber-gold); }
.facility-icon {
  width: 56px; height: 56px;
  border-radius: var(--radius-md);
  background: var(--royal-pale);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.6rem;
  margin: 0 auto 16px;
  transition: background var(--duration-base) var(--ease);
}
.facility-card:hover .facility-icon { background: var(--amber-pale); }
.facility-title { font-family: var(--font-heading); font-size: var(--text-md); font-weight: 700; color: var(--ink); margin-bottom: 6px; }
.facility-desc { font-family: var(--font-body); font-size: var(--text-sm); color: var(--text-mid); line-height: 1.6; }

/* Logo bar */
.logo-bar { display: flex; align-items: center; justify-content: center; gap: 48px; flex-wrap: wrap; opacity: 0.5; filter: grayscale(1); transition: opacity var(--duration-slow) var(--ease), filter var(--duration-slow) var(--ease); }
.logo-bar:hover { opacity: 1; filter: grayscale(0); }
.logo-bar-item {
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  font-weight: 700;
  color: var(--text-mid);
  letter-spacing: 0.04em;
  text-transform: uppercase;
  padding: 8px 16px;
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  background: var(--white);
}

@media (max-width: 1024px) {
  .mvv-grid { grid-template-columns: 1fr; }
  .mvv-card.featured { transform: none; }
  .team-grid { grid-template-columns: repeat(2, 1fr); }
  .facility-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
  .team-grid { grid-template-columns: 1fr; }
  .facility-grid { grid-template-columns: 1fr; }
  .logo-bar { gap: 16px; }
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
      <span class="current">About</span>
    </nav>
    <h1>About Royal Ark Schools</h1>
    <p class="page-hero-sub">Two decades of shaping futures with purpose, pride, and an unwavering commitment to excellence.</p>
  </div>
</section>

{{-- Mission / Vision / Values --}}
<section class="section-pad">
  <div class="container">
    <div class="text-center" style="margin-bottom:48px;">
      <div class="section-label center">Our Foundation</div>
      <h2 class="section-title center">Mission, Vision &amp; Values</h2>
    </div>
    <div class="mvv-grid">
      <div class="mvv-card reveal">
        <span class="mvv-icon">🎯</span>
        <h3 class="mvv-title">Our Mission</h3>
        <p class="mvv-body">To provide a holistic education that nurtures every child's intellectual, moral, social, and physical development within a values-driven environment.</p>
      </div>
      <div class="mvv-card featured reveal reveal-delay-1">
        <span class="mvv-icon">🌟</span>
        <h3 class="mvv-title">Our Vision</h3>
        <p class="mvv-body">To be a leading institution recognised for producing confident, ethical, and innovative leaders who transform their communities and the world.</p>
      </div>
      <div class="mvv-card reveal reveal-delay-2">
        <span class="mvv-icon">👑</span>
        <h3 class="mvv-title">Our Values</h3>
        <p class="mvv-body">Excellence · Integrity · Respect · Discipline · Compassion · Innovation · Responsibility</p>
      </div>
    </div>
  </div>
</section>

{{-- Our Story / Timeline --}}
<section class="section-pad" style="background:var(--cream);">
  <div class="container">
    <div class="grid-2" style="align-items:start; gap:64px;">
      <div class="reveal">
        <div class="section-label">Our Journey</div>
        <h2 class="section-title">Our Story</h2>
        <p class="section-subtitle" style="max-width:none; margin-bottom: 20px;">Royal Ark College and Royal Ark Nursery & Primary School was established with a clear vision of becoming a beacon of moral and academic excellence, dedicated to nurturing every child into a well-rounded global citizen. From its inception, the school has remained committed to providing a solid educational foundation that combines sound academic training with strong moral values.</p>
        <p class="section-subtitle" style="max-width:none; margin-bottom: 20px;">Built on the belief that true education goes beyond classroom instruction, Royal Ark College and Royal Ark Nursery & Primary School was founded to raise learners who are intellectually sound, morally upright, socially responsible, and fully equipped to excel in a dynamic global society. Through a child-centered approach to learning, the school focuses on developing excellence, leadership, creativity, discipline, and confidence in every pupil and student.</p>
        <p class="section-subtitle" style="max-width:none; margin-bottom: 20px;">The school has continued to grow as a center of learning where academic distinction and character formation go hand in hand. With a team of dedicated educators and a conducive learning environment, Royal Ark College and Royal Ark Nursery & Primary School consistently nurtures young minds to become future leaders capable of making meaningful impact both locally and globally.</p>
        <p class="section-subtitle" style="max-width:none; margin-bottom: 20px;">Today, the school stands as a symbol of its founding vision—shaping well-rounded individuals prepared for excellence in life, leadership, and service to humanity.</p>
      </div>
      <!-- <div class="timeline reveal reveal-delay-1">
        <div class="timeline-item">
          <div class="timeline-year">2005</div>
          <div class="timeline-title">School Founded</div>
          <div class="timeline-desc">Royal Ark Schools opens its doors with Nursery and Primary sections.</div>
        </div>
        <div class="timeline-item">
          <div class="timeline-year">2008</div>
          <div class="timeline-title">Secondary Section Added</div>
          <div class="timeline-desc">Junior Secondary School launched to bridge the gap into adolescence.</div>
        </div>
        <div class="timeline-item">
          <div class="timeline-year">2012</div>
          <div class="timeline-title">First WAEC Candidates</div>
          <div class="timeline-desc">Our pioneer SS3 students sit for WAEC with a 100% pass rate.</div>
        </div>
        <div class="timeline-item">
          <div class="timeline-year">2018</div>
          <div class="timeline-title">New Campus Facility</div>
          <div class="timeline-desc">Modern classrooms, science labs, and a multi-purpose hall commissioned.</div>
        </div>
        <div class="timeline-item">
          <div class="timeline-year">2023</div>
          <div class="timeline-title">ICT Centre Commissioned</div>
          <div class="timeline-desc">State-of-the-art computer lab and digital learning resources unveiled.</div>
        </div>
        <div class="timeline-item">
          <div class="timeline-year">2025</div>
          <div class="timeline-title">Digital Portal Launched</div>
          <div class="timeline-desc">New student management and parent communication portal goes live.</div>
        </div>
      </div> -->
      <div class="about-img-wrap reveal reveal-delay-1">
        <div class="about-img">
          <img src="{{ asset('landing/img/gallery/right-side-view.jpg') }}" alt="Royal Ark Schools Campus">
          <img src="{{ asset('landing/img/gallery/left-side-view.jpg') }}" alt="Royal Ark Schools Campus">
        </div>
      </div>
    </div>
  </div>
</section>

{{-- School Levels --}}
<section class="section-pad">
  <div class="container">
    <div class="text-center" style="margin-bottom:48px;">
      <div class="section-label center">Academic Structure</div>
      <h2 class="section-title center">School Levels &amp; Structure</h2>
      <p class="section-subtitle center">A seamless pathway from early childhood through secondary education.</p>
    </div>
    <div class="grid-4" style="gap:24px;">
      <div class="program-card reveal">
        <div class="program-card-icon">🧸</div>
        <h3 class="program-card-title">Creche &amp; Nursery</h3>
        <div class="program-card-age">Ages 1 – 5</div>
        <p class="program-card-desc">Play-based foundation focusing on motor skills, early literacy, numeracy, and social interaction.</p>
        <a href="{{ url('/academics#creche') }}" class="program-card-link">Learn more <i class="fa-solid fa-arrow-right"></i></a>
      </div>
      <div class="program-card reveal reveal-delay-1">
        <div class="program-card-icon">📚</div>
        <h3 class="program-card-title">Primary School</h3>
        <div class="program-card-age">Years 1 – 6</div>
        <p class="program-card-desc">Strong core subjects with creative arts, ICT, and character education integrated into daily learning.</p>
        <a href="{{ url('/academics#primary') }}" class="program-card-link">Learn more <i class="fa-solid fa-arrow-right"></i></a>
      </div>
      <div class="program-card reveal reveal-delay-2">
        <div class="program-card-icon">🎒</div>
        <h3 class="program-card-title">Junior Secondary</h3>
        <div class="program-card-age">JSS 1 – 3</div>
        <p class="program-card-desc">Broad-based curriculum preparing students for BECE with hands-on science, tech, and arts exposure.</p>
        <a href="{{ url('/academics#jss') }}" class="program-card-link">Learn more <i class="fa-solid fa-arrow-right"></i></a>
      </div>
      <div class="program-card reveal reveal-delay-3">
        <div class="program-card-icon">🎓</div>
        <h3 class="program-card-title">Senior Secondary</h3>
        <div class="program-card-age">SSS 1 – 3</div>
        <p class="program-card-desc">Science, Arts, and Commercial streams with intensive WAEC and NECO preparation.</p>
        <a href="{{ url('/academics#sss') }}" class="program-card-link">Learn more <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </div>
</section>

{{-- Leadership Team --}}
<section class="section-pad" style="background:var(--cream);">
  <div class="container">
    <div class="text-center" style="margin-bottom:48px;">
      <div class="section-label center">Meet the Team</div>
      <h2 class="section-title center">Our Leadership</h2>
      <p class="section-subtitle center">Experienced educators guiding Royal Ark with vision and dedication.</p>
    </div>
    <div class="team-grid">
      <div class="team-card reveal">
        <div class="team-avatar"><img src="{{ asset('landing/img/gallery/head-master.jpg') }}" alt="Mr. Olufunke Adeyemi"></div>
        <div class="team-body">
          <h3 class="team-name">Mr. Olufunke Adeyemi</h3>
          <div class="team-role">Principal</div>
          <p class="team-bio">Over 25 years in education leadership. Former WAEC examiner with a passion for institutional excellence.</p>
        </div>
      </div>
      <div class="team-card reveal reveal-delay-1">
        <div class="team-avatar">JO</div>
        <div class="team-body">
          <h3 class="team-name">Mr. James Okafor</h3>
          <div class="team-role">Vice Principal (Academics)</div>
          <p class="team-bio">Mathematics specialist and curriculum developer. Leads the school's STEM initiative.</p>
        </div>
      </div>
      <div class="team-card reveal reveal-delay-2">
        <div class="team-avatar">CN</div>
        <div class="team-body">
          <h3 class="team-name">Mrs. Chidinma Nwosu</h3>
          <div class="team-role">Vice Principal (Admin)</div>
          <p class="team-bio">Operations expert ensuring the seamless day-to-day running of the school community.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Facilities --}}
<section class="section-pad">
  <div class="container">
    <div class="text-center" style="margin-bottom:48px;">
      <div class="section-label center">Campus</div>
      <h2 class="section-title center">World-Class Facilities</h2>
      <p class="section-subtitle center">A campus built for inspired learning.</p>
    </div>
    <div class="facility-grid">
      <div class="facility-card reveal">
        <div class="facility-icon">🏫</div>
        <h3 class="facility-title">Modern Classrooms</h3>
        <p class="facility-desc">Spacious, well-ventilated rooms with whiteboards and projector systems.</p>
      </div>
      <div class="facility-card reveal reveal-delay-1">
        <div class="facility-icon">🔬</div>
        <h3 class="facility-title">Science Laboratory</h3>
        <p class="facility-desc">Fully equipped for biology, chemistry, and physics practical sessions.</p>
      </div>
      <div class="facility-card reveal reveal-delay-2">
        <div class="facility-icon">💻</div>
        <h3 class="facility-title">ICT Centre</h3>
        <p class="facility-desc">High-speed internet, modern desktops, and coding workstations.</p>
      </div>
      <div class="facility-card reveal reveal-delay-3">
        <div class="facility-icon">📚</div>
        <h3 class="facility-title">Library</h3>
        <p class="facility-desc">Extensive collection of textbooks, novels, and digital learning resources.</p>
      </div>
      <div class="facility-card reveal">
        <div class="facility-icon">⚽</div>
        <h3 class="facility-title">Sports Complex</h3>
        <p class="facility-desc">Football pitch, basketball court, and indoor games for physical development.</p>
      </div>
      <div class="facility-card reveal reveal-delay-1">
        <div class="facility-icon">🎨</div>
        <h3 class="facility-title">Arts Studio</h3>
        <p class="facility-desc">Dedicated space for fine arts, music practice, and cultural expression.</p>
      </div>
      <div class="facility-card reveal reveal-delay-2">
        <div class="facility-icon">🍽️</div>
        <h3 class="facility-title">Dining Hall</h3>
        <p class="facility-desc">Hygenic, spacious cafeteria serving balanced, nutritious meals daily.</p>
      </div>
      <div class="facility-card reveal reveal-delay-3">
        <div class="facility-icon">🏥</div>
        <h3 class="facility-title">Health Centre</h3>
        <p class="facility-desc">On-site clinic staffed by a qualified nurse for first aid and health monitoring.</p>
      </div>
    </div>
  </div>
</section>

{{-- Accreditations --}}
<section class="section-pad-sm" style="background:var(--cream-2);">
  <div class="container">
    <div class="text-center" style="margin-bottom:32px;">
      <div class="section-label center">Recognised By</div>
      <h2 class="section-title center">Accreditations &amp; Affiliations</h2>
    </div>
    <div class="logo-bar reveal">
      <span class="logo-bar-item">Ministry of Education</span>
      <span class="logo-bar-item">WAEC</span>
      <span class="logo-bar-item">NECO</span>
      <span class="logo-bar-item">Lagos State Government</span>
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="section-pad cta-section">
  <div class="cta-bg-crest" aria-hidden="true">RA</div>
  <div class="container cta-inner">
    <div class="cta-text reveal">
      <h2 class="cta-title">Discover what makes Royal Ark the right choice for your child.</h2>
      <p class="cta-desc">Visit our campus, meet our team, and experience the Royal Ark difference firsthand.</p>
    </div>
    <div class="cta-actions reveal reveal-delay-1">
      <a href="{{ route('admissions') }}" class="btn btn-gold btn-md">Learn About Admissions</a>
      <a href="{{ route('contact') }}" class="btn btn-outline-white btn-md">Contact Us</a>
    </div>
  </div>
</section>

@endsection
