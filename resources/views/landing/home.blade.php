@extends('layouts.landing.app')

@section('title', 'Royal Ark Schools — Nurturing Royalty, Inspiring Excellence')
@section('meta_description', 'Royal Ark Schools is a premier educational institution in Lagos. We provide quality education from Creche to Senior Secondary level, focused on academic royalty and moral excellence.')
@section('meta_keywords', 'Royal Ark Schools, Lagos private schools, best secondary school in Lagos, primary education, creche services, academic excellence, moral values')

@push('styles')
    <link rel="stylesheet" href="/landing/css/home.css">
@endpush

@section('content')

{{-- ====== HERO ====== --}}
<section class="hero" id="home">
    <div class="hero-orb orb-1"></div>
    <div class="hero-orb orb-2"></div>
    <div class="hero-orb orb-3"></div>

    <div class="hero-content">
        <div class="hero-badge">
            <span class="dot"></span>
            Est. 2020 &middot; Accredited Institution
        </div>
        <h1>
            Nurturing <em>Royalty</em>.<br>
            Inspiring <em>Excellence</em>.
        </h1>
        <p class="hero-tagline">
            Royal Ark Schools equips every student &mdash; from Creche through Secondary &mdash; with the character, knowledge, and ambition to lead.
        </p>
        <div class="hero-motto">&ldquo;Royalty in Excellence&rdquo;</div>
        <div class="hero-cta">
            <a href="{{ route('apply') }}" class="btn btn-primary btn-lg">Apply Now</a>
            <a href="{{ route('academics') }}" class="btn btn-outline-white btn-lg">Explore Our Programs</a>
        </div>
    </div>

    <a href="#stats" class="hero-scroll" aria-label="Scroll down">
        <span>Scroll</span>
        <div class="hero-scroll-line"></div>
    </a>
</section>

{{-- ====== STATS BAR ====== --}}
<section class="stats-bar" id="stats">
    <div class="stats-bar-inner">
        <div class="stat-item-home">
            <div class="stat-icon">&#127891;</div>
            <div>
                <div class="stat-number" data-count="120" data-suffix="+">0</div>
                <div class="stat-label">Students</div>
            </div>
        </div>
        <div class="stat-divider-v"></div>
        <div class="stat-item-home">
            <div class="stat-icon">&#128104;&#8205;&#127979;</div>
            <div>
                <div class="stat-number" data-count="12" data-suffix="+">0</div>
                <div class="stat-label">Staff</div>
            </div>
        </div>
        <div class="stat-divider-v"></div>
        <div class="stat-item-home">
            <div class="stat-icon">&#128197;</div>
            <div>
                <div class="stat-number" data-count="5" data-suffix=" Yrs">0</div>
                <div class="stat-label">Since Founded</div>
            </div>
        </div>
        <div class="stat-divider-v"></div>
        <div class="stat-item-home">
            <div class="stat-icon">&#127942;</div>
            <div>
                <div class="stat-number" data-count="95" data-suffix="%">0</div>
                <div class="stat-label">Pass Rate</div>
            </div>
        </div>
    </div>
</section>

{{-- ====== ABOUT SNIPPET ====== --}}
<section class="section-pad about-section" id="about">
    <div class="container">
        <div class="about-grid">
            <div class="about-img-wrap reveal reveal-left">
                <div class="about-img">
                    <img src="{{ asset('landing/img/ras-school.jpg') }}" alt="Royal Ark Schools Campus">
                </div>
                <div class="about-float-badge">5+ Years of Excellence</div>
            </div>
            <div class="reveal reveal-right">
                <div class="section-label">About Royal Ark Schools</div>
                <h2 class="section-title">A Legacy of Academic <em>Royalty</em></h2>
                <p style="font-family:var(--font-body);font-size:var(--text-base);color:var(--text-mid);line-height:1.8;margin-bottom:16px;">
            At Royal Ark Schools, excellence is not just a tradition — it is our identity. For years, we have remained committed to raising confident, intelligent, disciplined, and purpose-driven learners who stand out academically and morally.
        </p>
        <p style="font-family:var(--font-body);font-size:var(--text-base);color:var(--text-mid);line-height:1.8;margin-bottom:16px;">
            Our legacy is built on a strong foundation of quality education, dedicated teachers, innovative learning methods, full practical science exposure, and a nurturing environment where every child is inspired to discover and maximize their potential.
        </p>
        <p style="font-family:var(--font-body);font-size:var(--text-base);color:var(--text-mid);line-height:1.8;margin-bottom:20px;">
            We believe every child is born for greatness. Through academic excellence, character development, leadership training, and modern educational standards, we prepare our students not only for examinations, but for life, leadership, and global relevance.
        </p>
                <div class="about-features">
                    <span class="about-pill">&#10003; Accredited</span>
                    <span class="about-pill">&#10003; Experienced Teachers</span>
                    <span class="about-pill">&#10003; Modern Facilities</span>
                </div>
                <a href="{{ route('about') }}" class="btn btn-ghost btn-md" style="margin-top:24px;">
                    Learn Our Story &rarr;
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ====== PROGRAMS ====== --}}
<section class="section-pad programs-section" id="programs">
    <div class="container">
        <div class="section-label center">What We Offer</div>
        <h2 class="section-title center">From First Steps to Final Exams</h2>
        <p class="section-subtitle center" style="margin-bottom:40px;">
            Royal Ark Schools spans every stage of a child's educational journey.
        </p>
        <div class="programs-grid">
            <div class="program-card reveal reveal-scale reveal-delay-1">
                <div class="program-card-icon">&#128056;</div>
                <div class="program-card-title">Creche &amp; Nursery</div>
                <div class="program-card-age">Ages 1 &ndash; 4</div>
                <p class="program-card-desc">A warm, play-based learning environment where young minds blossom through exploration, music, and early literacy.</p>
                <a href="{{ route('academics', ['tab' => 'creche']) }}" class="program-card-link">Learn More &rarr;</a>
            </div>
            <div class="program-card reveal reveal-scale reveal-delay-2">
                <div class="program-card-icon">&#128218;</div>
                <div class="program-card-title">Primary School</div>
                <div class="program-card-age">Ages 5 &ndash; 11</div>
                <p class="program-card-desc">Building strong foundations in literacy, numeracy, sciences, and the arts with dedicated class teachers and modern resources.</p>
                <a href="{{ route('academics', ['tab' => 'primary']) }}" class="program-card-link">Learn More &rarr;</a>
            </div>
            <div class="program-card reveal reveal-scale reveal-delay-3">
                <div class="program-card-icon">&#128300;</div>
                <div class="program-card-title">Junior Secondary</div>
                <div class="program-card-age">JSS 1 &ndash; 3</div>
                <p class="program-card-desc">Transitioning into adolescence with subject-specialist teaching, laboratory exposure, and critical thinking development.</p>
                <a href="{{ route('academics', ['tab' => 'jss']) }}" class="program-card-link">Learn More &rarr;</a>
            </div>
            <div class="program-card reveal reveal-scale reveal-delay-4">
                <div class="program-card-icon">&#127891;</div>
                <div class="program-card-title">Senior Secondary</div>
                <div class="program-card-age">SSS 1 &ndash; 3</div>
                <p class="program-card-desc">Rigorous WAEC/NECO preparation with science, arts, and commercial streams guided by experienced examiners.</p>
                <a href="{{ route('academics', ['tab' => 'sss']) }}" class="program-card-link">Learn More &rarr;</a>
            </div>
        </div>
    </div>
</section>

{{-- ====== ADMISSIONS STATUS ====== --}}
<section class="section-pad admission-section">
    <div class="container">
        <div class="admission-status-block open reveal">
            <div class="admission-status-icon">&#128308;</div>
            <div class="admission-status-body">
                <div class="admission-status-title">Admissions Open &mdash; 2025/2026 Academic Session</div>
                <p class="admission-status-desc">We are now accepting applications for all classes. Secure your child's place in a school committed to excellence.</p>
                <div class="admission-dates">
                    <div class="admission-date-item">
                        Opens
                        <strong>Sep 1, 2025</strong>
                    </div>
                    <div class="admission-date-item">
                        Closes
                        <strong>Nov 30, 2025</strong>
                    </div>
                </div>
            </div>
            <div class="admission-cta">
                <a href="{{ route('apply') }}" class="btn btn-primary btn-md">Apply Now</a>
                <a href="{{ route('admissions') }}" class="btn btn-outline btn-md">View Requirements</a>
            </div>
        </div>
    </div>
</section>

{{-- ====== WHAT WE OFFER ====== --}}
<section class="section-pad why-section" id="why">
    <div class="container">
        <div class="section-label center">Why Us?</div>
        <h2 class="section-title center">The Royal Ark <em>Advantage</em></h2>
        <p class="section-subtitle center" style="margin-bottom:40px;">
            A well-rounded educational experience designed to nurture excellence in every child.
        </p>
        <div class="why-grid" style="grid-template-columns: repeat(5, 1fr);">
            <div class="feature-card reveal reveal-delay-1">
                <span class="feature-card-icon">&#128218;</span>
                <div class="feature-card-title">Academic Excellence</div>
                <p class="feature-card-desc">A strong and structured curriculum that promotes outstanding performance and lifelong learning.</p>
            </div>
            <div class="feature-card reveal reveal-delay-2">
                <span class="feature-card-icon">&#128104;&#8205;&#127979;</span>
                <div class="feature-card-title">Qualified Teachers</div>
                <p class="feature-card-desc">Dedicated educators committed to personalized learning and student success.</p>
            </div>
            <div class="feature-card reveal reveal-delay-3">
                <span class="feature-card-icon">&#128300;</span>
                <div class="feature-card-title">Science Practicals</div>
                <p class="feature-card-desc">Hands-on laboratory experiences that enhance understanding, innovation, and scientific discovery.</p>
            </div>
            <div class="feature-card reveal reveal-delay-4">
                <span class="feature-card-icon">&#9889;</span>
                <div class="feature-card-title">Moral Development</div>
                <p class="feature-card-desc">We instil discipline, integrity, leadership, and strong moral values in every learner.</p>
            </div>
            <div class="feature-card reveal reveal-delay-5">
                <span class="feature-card-icon">&#127963;</span>
                <div class="feature-card-title">Modern Environment</div>
                <p class="feature-card-desc">Safe, stimulating, and technology-friendly classrooms designed for effective learning.</p>
            </div>
            <div class="feature-card reveal reveal-delay-1">
                <span class="feature-card-icon">&#128081;</span>
                <div class="feature-card-title">Leadership Training</div>
                <p class="feature-card-desc">Activities and programs that help students develop communication, creativity, and leadership skills.</p>
            </div>
            <div class="feature-card reveal reveal-delay-2">
                <span class="feature-card-icon">&#9917;</span>
                <div class="feature-card-title">Extracurriculars</div>
                <p class="feature-card-desc">Sports, arts, music, debates, clubs, and other engaging activities that promote all-round development.</p>
            </div>
            <div class="feature-card reveal reveal-delay-3">
                <span class="feature-card-icon">&#128100;</span>
                <div class="feature-card-title">Individual Attention</div>
                <p class="feature-card-desc">We recognize the uniqueness of every child and provide support tailored to their learning needs.</p>
            </div>
            <div class="feature-card reveal reveal-delay-4">
                <span class="feature-card-icon">&#128106;</span>
                <div class="feature-card-title">Parental Partnership</div>
                <p class="feature-card-desc">Strong collaboration with parents to ensure continuous academic and personal growth.</p>
            </div>
            <div class="feature-card reveal reveal-delay-5">
                <span class="feature-card-icon">&#127758;</span>
                <div class="feature-card-title">Future-Focused</div>
                <p class="feature-card-desc">Preparing students to excel academically and compete confidently in a global world.</p>
            </div>
        </div>
    </div>
</section>

{{-- ====== GALLERY PREVIEW ====== --}}
<section class="section-pad gallery-section" id="gallery">
    <div class="container">
        <div class="section-label center">School Life</div>
        <h2 class="section-title center">Royal Ark in <em>Action</em></h2>
        <p class="section-subtitle center" style="margin-bottom:40px;">
            A glimpse into the vibrant community at Royal Ark Schools.
        </p>
        <div class="gallery-grid-home">
            <div class="gallery-cell gallery-cell-home reveal reveal-delay-1" data-src="{{ asset('landing/img/gallery/playing-ground.jpg') }}" data-caption="School Playground" data-media="photo">
                <div class="gallery-cell-inner">
                    <img src="{{ asset('landing/img/gallery/playing-ground.jpg') }}" alt="School Playground">
                </div>
                <div class="gallery-cell-overlay">
                    <span class="gallery-cell-caption">School Playground</span>
                </div>
                <div class="gallery-cell-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
            </div>
            <div class="gallery-cell gallery-cell-home reveal reveal-delay-2" data-src="{{ asset('landing/img/gallery/jss-1.jpg') }}" data-caption="Junior Secondary Class" data-media="photo">
                <div class="gallery-cell-inner">
                    <img src="{{ asset('landing/img/gallery/jss-1.jpg') }}" alt="Junior Secondary Class">
                </div>
                <div class="gallery-cell-overlay">
                    <span class="gallery-cell-caption">Junior Secondary Class</span>
                </div>
                <div class="gallery-cell-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
            </div>
            <div class="gallery-cell gallery-cell-home reveal reveal-delay-3" data-src="{{ asset('landing/img/gallery/basic-science-lab.jpg') }}" data-caption="Basic Science Lab" data-media="photo">
                <div class="gallery-cell-inner">
                    <img src="{{ asset('landing/img/gallery/basic-science-lab.jpg') }}" alt="Basic Science Lab">
                </div>
                <div class="gallery-cell-overlay">
                    <span class="gallery-cell-caption">Basic Science Lab</span>
                </div>
                <div class="gallery-cell-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
            </div>
            <div class="gallery-cell gallery-cell-home reveal reveal-delay-4" data-src="{{ asset('landing/img/gallery/staff-room-1.jpg') }}" data-caption="Staff Room" data-media="photo">
                <div class="gallery-cell-inner">
                    <img src="{{ asset('landing/img/gallery/staff-room-1.jpg') }}" alt="Staff Room">
                </div>
                <div class="gallery-cell-overlay">
                    <span class="gallery-cell-caption">Staff Room</span>
                </div>
                <div class="gallery-cell-icon"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
            </div>
        </div>
        <div class="text-center" style="margin-top:32px;">
            <a href="{{ route('gallery') }}" class="btn btn-outline btn-md">View Full Gallery &rarr;</a>
        </div>
    </div>
</section>

{{-- ====== NEWS & EVENTS ====== --}}
<section class="section-pad news-section" id="news">
    <div class="container">
        <div class="section-label center">Latest Updates</div>
        <h2 class="section-title center">News &amp; <em>Events</em></h2>
        <!-- <div class="news-grid-home">
            <div class="news-card news-card-featured reveal reveal-delay-1">
                <div class="news-card-img">&#127891;</div>
                <div class="news-card-body">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                        <span class="badge badge-amber">Featured</span>
                        <span class="news-card-meta">Oct 15, 2025</span>
                    </div>
                    <h3 class="news-card-title">2025 Prize Giving &amp; Graduation Ceremony</h3>
                    <p class="news-card-excerpt">Join us as we celebrate the achievements of our graduating class and honour outstanding students across all levels at our annual prize giving day.</p>
                    <a href="{{ url('/news/admissions-2025-2026-open') }}" class="program-card-link" style="margin-top:8px;">Read More &rarr;</a>
                </div>
            </div>
            <div class="news-card reveal reveal-delay-2">
                <div class="news-card-img">&#128104;&#8205;&#127979;</div>
                <div class="news-card-body">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                        <span class="badge badge-royal">News</span>
                        <span class="news-card-meta">Sep 28, 2025</span>
                    </div>
                    <h3 class="news-card-title">New ICT Centre Commissioned</h3>
                    <p class="news-card-excerpt">Our state-of-the-art ICT centre is now open, featuring 40 workstations and high-speed internet for digital literacy programmes.</p>
                    <a href="{{ url('/news/admissions-2025-2026-open') }}" class="program-card-link" style="margin-top:8px;">Read More &rarr;</a>
                </div>
            </div>
            <div class="news-card reveal reveal-delay-3">
                <div class="news-card-img">&#127942;</div>
                <div class="news-card-body">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                        <span class="badge badge-success">Achievement</span>
                        <span class="news-card-meta">Aug 12, 2025</span>
                    </div>
                    <h3 class="news-card-title">98% WAEC Pass Rate This Year</h3>
                    <p class="news-card-excerpt">Our senior secondary students have once again excelled, recording a 98% pass rate with 45 distinctions in Mathematics and English.</p>
                    <a href="{{ url('/news/admissions-2025-2026-open') }}" class="program-card-link" style="margin-top:8px;">Read More &rarr;</a>
                </div>
            </div>
        </div>
        <div class="text-center" style="margin-top:32px;display:flex;align-items:center;justify-content:center;gap:14px;flex-wrap:wrap;">
            <a href="{{ route('news') }}" class="btn btn-outline btn-md">All News &rarr;</a>
        </div> -->

        <div class="news-empty-state">
            <div class="news-empty-icon">&#128214;</div>
            <h3 class="news-empty-title">No News & Events Yet</h3>
            <p class="news-empty-desc">Stay tuned for upcoming updates, announcements, and events from Royal Ark Schools.</p>
        </div>
    </div>
</section>

{{-- ====== TESTIMONIALS ====== --}}
<!-- <section class="section-pad testimonials-section" id="testimonials">
    <div class="container testimonials-wrap">
        <div class="section-label center">What Parents Say</div>
        <h2 class="section-title center">Voices from Our <em>Community</em></h2>

        <div class="testimonial-slider">
            <div class="testimonial-track">
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <p class="testimonial-text">Royal Ark Schools transformed my daughter's confidence. The teachers are incredibly dedicated, and the facilities are world-class. We couldn't have made a better choice.</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">MO</div>
                            <div>
                                <div class="testimonial-name">Mrs. Olufunmilayo</div>
                                <div class="testimonial-role">Parent, Primary Section</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <p class="testimonial-text">As an alumnus, I can confidently say Royal Ark prepared me for university and beyond. The values I learned here still guide my decisions today.</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">DA</div>
                            <div>
                                <div class="testimonial-name">David Adeyemi</div>
                                <div class="testimonial-role">Alumnus, Class of 2019</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <p class="testimonial-text">The attention to safety and pastoral care gives me peace of mind every day. My sons love going to school, and their progress in reading has been remarkable.</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">EO</div>
                            <div>
                                <div class="testimonial-name">Mr. Emeka Obi</div>
                                <div class="testimonial-role">Parent, Nursery &amp; Primary</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <p class="testimonial-text">The STEM programme and science club ignited my son's passion for engineering. The lab resources and teacher mentorship are truly outstanding.</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">JA</div>
                            <div>
                                <div class="testimonial-name">Dr. James Adeleke</div>
                                <div class="testimonial-role">Parent, Senior Secondary</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="testimonial-controls">
            <button class="testimonial-arrow testimonial-prev" aria-label="Previous testimonial">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <div class="testimonial-dots">
                <button class="testimonial-dot active" aria-label="Go to slide 1" aria-current="true"></button>
                <button class="testimonial-dot" aria-label="Go to slide 2" aria-current="false"></button>
                <button class="testimonial-dot" aria-label="Go to slide 3" aria-current="false"></button>
                <button class="testimonial-dot" aria-label="Go to slide 4" aria-current="false"></button>
            </div>
            <button class="testimonial-arrow testimonial-next" aria-label="Next testimonial">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section> -->

{{-- ====== CTA BANNER ====== --}}
<section class="section-pad-lg cta-section-home">
    <div class="container cta-inner">
        <div class="cta-text">
            <h2 class="cta-title">Begin Your <em>Royal Journey</em></h2>
            <p class="cta-desc">Applications are open for the 2025/2026 session. Secure your child's place in an institution committed to excellence.</p>
            <p style="font-family:var(--font-heading);font-size:var(--text-sm);color:rgba(255,255,255,0.45);margin-top:12px;">
                Have questions? Call us: <strong style="color:rgba(255,255,255,0.7);"><a href="tel:09021062859">+234 902 106 2859</a></strong>
            </p>
        </div>
        <div class="cta-actions">
            <a href="{{ route('apply') }}" class="btn btn-primary btn-lg">Apply Now</a>
            <a href="{{ route('contact') }}" class="btn btn-outline-white btn-lg">Contact Us</a>
        </div>
    </div>
</section>

{{-- Lightbox markup --}}
<div class="gallery-lightbox" id="galleryLightbox" role="dialog" aria-modal="true" aria-label="Image lightbox">
  <button class="gallery-lightbox-close" aria-label="Close lightbox"><i class="fa-solid fa-xmark"></i></button>
  <a href="#" class="gallery-lightbox-download" id="lightboxDownload" download><i class="fa-solid fa-download"></i> Download</a>
  <button class="gallery-lightbox-nav gallery-lightbox-prev" aria-label="Previous image"><i class="fa-solid fa-chevron-left"></i></button>
  <button class="gallery-lightbox-nav gallery-lightbox-next" aria-label="Next image"><i class="fa-solid fa-chevron-right"></i></button>
  <div class="gallery-lightbox-img-wrap" id="lightboxContent">
    <img src="" alt="" class="gallery-lightbox-img" id="lightboxImg">
    <div class="gallery-lightbox-video" id="lightboxVideo" style="display:none;">
      <span><i class="fa-solid fa-circle-play" style="font-size:2rem;margin-right:12px;"></i> Video player placeholder</span>
    </div>
  </div>
  <div class="gallery-lightbox-caption" id="lightboxCaption"></div>
</div>

@push('scripts')
<script>
(function() {
  'use strict';
  const galleryCells = document.querySelectorAll('.gallery-cell-home');
  const lightbox = document.getElementById('galleryLightbox');
  const lightboxImg = document.getElementById('lightboxImg');
  const lightboxCaption = document.getElementById('lightboxCaption');
  const lightboxDownload = document.getElementById('lightboxDownload');
  let currentIndex = 0;

  function openLightbox(cell) {
    const visibleCells = Array.from(galleryCells);
    currentIndex = visibleCells.indexOf(cell);
    const src = cell.dataset.src || '';
    const caption = cell.dataset.caption || '';

    lightboxImg.src = src;
    lightboxImg.alt = caption;
    lightboxCaption.textContent = caption;
    lightboxDownload.href = src;
    lightbox.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    lightbox.classList.remove('open');
    document.body.style.overflow = '';
    lightboxImg.src = '';
  }

  function goToOffset(offset) {
    const visibleCells = Array.from(galleryCells);
    if (visibleCells.length === 0) return;
    currentIndex = ((currentIndex + offset) % visibleCells.length + visibleCells.length) % visibleCells.length;
    openLightbox(visibleCells[currentIndex]);
  }

  galleryCells.forEach(cell => {
    cell.addEventListener('click', () => openLightbox(cell));
  });

  document.querySelector('.gallery-lightbox-close')?.addEventListener('click', closeLightbox);
  document.querySelector('.gallery-lightbox-prev')?.addEventListener('click', (e) => { e.stopPropagation(); goToOffset(-1); });
  document.querySelector('.gallery-lightbox-next')?.addEventListener('click', (e) => { e.stopPropagation(); goToOffset(1); });

  lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox || e.target.classList.contains('gallery-lightbox-img-wrap')) {
      closeLightbox();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (!lightbox.classList.contains('open')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') goToOffset(-1);
    if (e.key === 'ArrowRight') goToOffset(1);
  });
})();
</script>
@endpush

@endsection

