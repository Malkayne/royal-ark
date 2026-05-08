@extends('layouts.landing.app')

@section('title', 'Gallery — Royal Ark Schools')
@section('meta_description', 'Explore life at Royal Ark Schools through our gallery. View photos of our modern facilities, academic sessions, sports activities, and school events.')
@section('meta_keywords', 'Royal Ark Schools gallery, school photos, educational facilities, students life, school events Lagos')
@section('navbar-class', 'solid')

@push('styles')
  <style>
    /* Filter bar */
    .gallery-filter-bar {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-bottom: 40px;
    }

    .filter-pill {
      font-family: var(--font-heading);
      font-size: var(--text-sm);
      font-weight: 600;
      padding: 8px 18px;
      border-radius: var(--radius-pill);
      border: 1px solid var(--border);
      background: var(--white);
      color: var(--text-mid);
      cursor: pointer;
      transition: all var(--duration-base) var(--ease);
      white-space: nowrap;
    }

    .filter-pill:hover {
      border-color: var(--amber);
      color: var(--amber);
    }

    .filter-pill.active {
      background: var(--royal);
      color: var(--white);
      border-color: var(--royal);
    }

    .media-toggle {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-left: 16px;
      padding-left: 16px;
      border-left: 1px solid var(--border);
    }

    .media-toggle-btn {
      font-family: var(--font-heading);
      font-size: var(--text-sm);
      font-weight: 600;
      padding: 8px 16px;
      border-radius: var(--radius-pill);
      border: 1px solid var(--border);
      background: var(--white);
      color: var(--text-mid);
      cursor: pointer;
      transition: all var(--duration-base) var(--ease);
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .media-toggle-btn:hover {
      border-color: var(--amber);
      color: var(--amber);
    }

    .media-toggle-btn.active {
      background: var(--amber-pale);
      color: var(--amber-deep);
      border-color: var(--amber);
    }

    /* Masonry grid */
    .gallery-masonry {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-auto-rows: 200px;
      gap: 16px;
    }

    .gallery-item {
      position: relative;
      border-radius: var(--radius-md);
      overflow: hidden;
      background: var(--royal-pale);
      cursor: pointer;
      transition: transform var(--duration-slow) var(--ease), box-shadow var(--duration-slow) var(--ease);
    }

    .gallery-item:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow-md);
    }

    .gallery-item.hidden {
      display: none;
    }

    .gallery-item.tall {
      grid-row: span 2;
    }

    .gallery-item.wide {
      grid-column: span 2;
    }

    .gallery-item-inner {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 3rem;
      position: relative;
      overflow: hidden;
    }

    .gallery-item-inner img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform var(--duration-slow) var(--ease);
    }

    .gallery-item:hover .gallery-item-inner img {
      transform: scale(1.1);
    }

    .gallery-item-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom, transparent 40%, rgba(28, 8, 54, 0.75));
      opacity: 0;
      transition: opacity var(--duration-base) var(--ease);
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: flex-end;
      padding: 16px;
    }

    .gallery-item:hover .gallery-item-overlay {
      opacity: 1;
    }

    .gallery-item-caption {
      font-family: var(--font-heading);
      font-size: var(--text-sm);
      color: var(--white);
      font-weight: 500;
      margin-bottom: 6px;
    }

    .gallery-item-meta {
      font-family: var(--font-heading);
      font-size: var(--text-xs);
      color: rgba(255, 255, 255, 0.7);
      display: flex;
      gap: 8px;
      align-items: center;
    }

    .gallery-item-magnify {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(8px);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      font-size: 1.1rem;
      opacity: 0;
      transition: opacity var(--duration-base) var(--ease);
    }

    .gallery-item:hover .gallery-item-magnify {
      opacity: 1;
    }

    /* Video cells */
    .gallery-item.video .gallery-item-inner::after {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(28, 8, 54, 0.35);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .gallery-play-btn {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.9);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--royal);
      font-size: 1.3rem;
      z-index: 2;
      transition: transform var(--duration-base) var(--ease-spring), background var(--duration-base) var(--ease);
    }

    .gallery-item:hover .gallery-play-btn {
      transform: translate(-50%, -50%) scale(1.1);
      background: var(--white);
    }

    .gallery-duration {
      position: absolute;
      bottom: 12px;
      right: 12px;
      font-family: var(--font-heading);
      font-size: var(--text-xs);
      font-weight: 700;
      color: var(--white);
      background: rgba(0, 0, 0, 0.6);
      padding: 3px 8px;
      border-radius: var(--radius-xs);
      z-index: 2;
    }

    /* Video highlights */
    .video-highlight-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
    }

    .video-highlight-card {
      background: var(--white);
      border-radius: var(--radius-lg);
      border: 1px solid var(--border);
      overflow: hidden;
      transition: transform var(--duration-slow) var(--ease), box-shadow var(--duration-slow) var(--ease);
      cursor: pointer;
    }

    .video-highlight-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-md);
    }

    .video-highlight-thumb {
      aspect-ratio: 16/9;
      background: var(--royal-pale);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 3rem;
      position: relative;
    }

    .video-highlight-play {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.9);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--royal);
      font-size: 1.3rem;
      transition: transform var(--duration-base) var(--ease-spring);
    }

    .video-highlight-card:hover .video-highlight-play {
      transform: translate(-50%, -50%) scale(1.1);
    }

    .video-highlight-body {
      padding: 20px 24px;
    }

    .video-highlight-title {
      font-family: var(--font-display);
      font-size: var(--text-lg);
      font-weight: 600;
      color: var(--ink);
      margin-bottom: 4px;
    }

    .video-highlight-meta {
      font-family: var(--font-heading);
      font-size: var(--text-xs);
      color: var(--text-muted);
    }

    /* Lightbox */
    .gallery-lightbox {
      position: fixed;
      inset: 0;
      background: rgba(10, 4, 20, 0.92);
      backdrop-filter: blur(12px);
      z-index: 2000;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      visibility: hidden;
      transition: opacity var(--duration-slow) var(--ease), visibility var(--duration-slow) var(--ease);
      padding: 40px;
    }

    .gallery-lightbox.open {
      opacity: 1;
      visibility: visible;
    }

    .gallery-lightbox-img-wrap {
      max-width: 85vw;
      max-height: 80vh;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .gallery-lightbox-img {
      max-width: 100%;
      max-height: 80vh;
      border-radius: var(--radius-md);
      object-fit: contain;
      display: block;
    }

    .gallery-lightbox-video {
      width: min(900px, 85vw);
      aspect-ratio: 16/9;
      background: var(--ink);
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      font-family: var(--font-heading);
    }

    .gallery-lightbox-close {
      position: absolute;
      top: 24px;
      right: 24px;
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: var(--white);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      cursor: pointer;
      transition: background var(--duration-base) var(--ease);
      z-index: 2001;
    }

    .gallery-lightbox-close:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    .gallery-lightbox-nav {
      position: absolute;
      top: 50%;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: var(--white);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      cursor: pointer;
      transition: background var(--duration-base) var(--ease);
      z-index: 2001;
      transform: translateY(-50%);
    }

    .gallery-lightbox-nav:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    .gallery-lightbox-prev {
      left: 24px;
    }

    .gallery-lightbox-next {
      right: 24px;
    }

    .gallery-lightbox-caption {
      position: absolute;
      bottom: 24px;
      left: 50%;
      transform: translateX(-50%);
      font-family: var(--font-heading);
      font-size: var(--text-sm);
      color: rgba(255, 255, 255, 0.8);
      text-align: center;
      max-width: 600px;
      background: rgba(0, 0, 0, 0.4);
      padding: 8px 20px;
      border-radius: var(--radius-pill);
    }

    .gallery-lightbox-download {
      position: absolute;
      top: 24px;
      left: 24px;
      font-family: var(--font-heading);
      font-size: var(--text-xs);
      font-weight: 600;
      color: var(--white);
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      padding: 8px 16px;
      border-radius: var(--radius-pill);
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: background var(--duration-base) var(--ease);
      z-index: 2001;
    }

    .gallery-lightbox-download:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    @media (max-width: 1024px) {
      .gallery-masonry {
        grid-template-columns: repeat(3, 1fr);
      }

      .video-highlight-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .gallery-masonry {
        grid-template-columns: repeat(2, 1fr);
        grid-auto-rows: 160px;
      }

      .gallery-item.tall {
        grid-row: span 2;
      }

      .gallery-item.wide {
        grid-column: span 2;
      }

      .video-highlight-grid {
        grid-template-columns: 1fr;
      }

      .media-toggle {
        margin-left: 0;
        padding-left: 0;
        border-left: none;
        width: 100%;
        justify-content: center;
        margin-top: 8px;
      }

      .gallery-lightbox-prev {
        left: 8px;
      }

      .gallery-lightbox-next {
        right: 8px;
      }

      .gallery-lightbox {
        padding: 16px;
      }
    }

    @media (max-width: 480px) {
      .gallery-masonry {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
      }

      .gallery-item.tall {
        grid-row: span 1;
      }

      .gallery-item.wide {
        grid-column: span 1;
      }
    }

    /* Empty state */
    .gallery-empty-state {
      grid-column: 1 / -1;
      grid-row: span 2;
      display: none;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 60px 40px;
      background: var(--royal-pale);
      border-radius: var(--radius-lg);
      border: 2px dashed rgba(61, 26, 110, 0.1);
      text-align: center;
      margin: 10px 0;
    }

    .gallery-empty-state.visible {
      display: flex;
    }

    .gallery-empty-icon {
      font-size: 4rem;
      margin-bottom: 20px;
      opacity: 0.6;
    }

    .gallery-empty-title {
      font-family: var(--font-display);
      font-size: 1.5rem;
      color: var(--royal-dark);
      margin-bottom: 12px;
    }

    .gallery-empty-desc {
      font-family: var(--font-heading);
      font-size: var(--text-base);
      color: var(--ink-soft);
      max-width: 400px;
      margin: 0 auto;
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
        <span class="current">Gallery</span>
      </nav>
      <h1>Life at Royal Ark</h1>
      <p class="page-hero-sub">Glimpses of the vibrant community that makes Royal Ark Schools more than just a school.</p>
    </div>
  </section>

  {{-- Gallery Grid + Filters --}}
  <section class="section-pad">
    <div class="container">
      <div class="text-center" style="margin-bottom:48px;">
        <div class="section-label center">Visual Stories</div>
        <h2 class="section-title center">Our Gallery</h2>
        <p class="section-subtitle center">Moments captured across academics, sports, events, and everyday school life.
        </p>
      </div>

      <div class="gallery-filter-bar reveal">
        <button class="filter-pill active" data-filter="all">All</button>
        <button class="filter-pill" data-filter="academics">Academics</button>
        <button class="filter-pill" data-filter="sports">Sports</button>
        <button class="filter-pill" data-filter="events">Events</button>
        <button class="filter-pill" data-filter="facilities">Facilities</button>
        <button class="filter-pill" data-filter="arts">Arts &amp; Culture</button>
        <div class="media-toggle">
          <button class="media-toggle-btn active" data-media="all"><i class="fa-solid fa-layer-group"></i> All</button>
          <button class="media-toggle-btn" data-media="photo"><i class="fa-solid fa-camera"></i> Photos</button>
          <button class="media-toggle-btn" data-media="video"><i class="fa-solid fa-video"></i> Videos</button>
        </div>
      </div>

      <div class="gallery-masonry" id="galleryMasonry">
        {{-- Photo items --}}

        {{-- Academics --}}
        <div class="gallery-item wide" data-category="academics" data-media="photo"
          data-caption="Basic Science Laboratory" data-src="{{ asset('landing/img/gallery/basic-science-lab.jpg') }}">
          <div class="gallery-item-inner">
            <img src="{{ asset('landing/img/gallery/basic-science-lab.jpg') }}" alt="Basic Science Laboratory">
          </div>
          <div class="gallery-item-overlay">
            <span class="gallery-item-caption">Basic Science Laboratory</span>
            <span class="gallery-item-meta"><i class="fa-regular fa-image"></i> Academics</span>
          </div>
          <div class="gallery-item-magnify"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        </div>

        <div class="gallery-item tall" data-category="academics" data-media="photo"
          data-caption="Basic Technology Workshop"
          data-src="{{ asset('landing/img/gallery/basic-technology-workshop.jpg') }}">
          <div class="gallery-item-inner">
            <img src="{{ asset('landing/img/gallery/basic-technology-workshop.jpg') }}" alt="Basic Technology Workshop">
          </div>
          <div class="gallery-item-overlay">
            <span class="gallery-item-caption">Basic Technology Workshop</span>
            <span class="gallery-item-meta"><i class="fa-regular fa-image"></i> Academics</span>
          </div>
          <div class="gallery-item-magnify"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        </div>

        <div class="gallery-item" data-category="academics" data-media="photo" data-caption="Computer Science Class"
          data-src="{{ asset('landing/img/gallery/computer-class.jpg') }}">
          <div class="gallery-item-inner">
            <img src="{{ asset('landing/img/gallery/computer-class.jpg') }}" alt="Computer Science Class">
          </div>
          <div class="gallery-item-overlay">
            <span class="gallery-item-caption">Computer Science Class</span>
            <span class="gallery-item-meta"><i class="fa-regular fa-image"></i> Academics</span>
          </div>
          <div class="gallery-item-magnify"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        </div>

        <div class="gallery-item wide" data-category="academics" data-media="photo"
          data-caption="Home Economics Laboratory" data-src="{{ asset('landing/img/gallery/home-economics-lab.jpg') }}">
          <div class="gallery-item-inner">
            <img src="{{ asset('landing/img/gallery/home-economics-lab.jpg') }}" alt="Home Economics Laboratory">
          </div>
          <div class="gallery-item-overlay">
            <span class="gallery-item-caption">Home Economics Laboratory</span>
            <span class="gallery-item-meta"><i class="fa-regular fa-image"></i> Academics</span>
          </div>
          <div class="gallery-item-magnify"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        </div>

        <div class="gallery-item tall" data-category="academics" data-media="photo"
          data-caption="Junior Secondary Class Session" data-src="{{ asset('landing/img/gallery/jss-1.jpg') }}">
          <div class="gallery-item-inner">
            <img src="{{ asset('landing/img/gallery/jss-1.jpg') }}" alt="Junior Secondary Class Session">
          </div>
          <div class="gallery-item-overlay">
            <span class="gallery-item-caption">Junior Secondary Class Session</span>
            <span class="gallery-item-meta"><i class="fa-regular fa-image"></i> Academics</span>
          </div>
          <div class="gallery-item-magnify"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        </div>

        {{-- Facilities --}}
        <div class="gallery-item" data-category="facilities" data-media="photo" data-caption="Modern School Library"
          data-src="{{ asset('landing/img/gallery/library.jpg') }}">
          <div class="gallery-item-inner">
            <img src="{{ asset('landing/img/gallery/library.jpg') }}" alt="Modern School Library">
          </div>
          <div class="gallery-item-overlay">
            <span class="gallery-item-caption">Modern School Library</span>
            <span class="gallery-item-meta"><i class="fa-regular fa-image"></i> Facilities</span>
          </div>
          <div class="gallery-item-magnify"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        </div>

        <div class="gallery-item wide" data-category="facilities" data-media="photo" data-caption="School Main Building"
          data-src="{{ asset('landing/img/gallery/school-building.jpg') }}">
          <div class="gallery-item-inner">
            <img src="{{ asset('landing/img/gallery/school-building.jpg') }}" alt="School Main Building">
          </div>
          <div class="gallery-item-overlay">
            <span class="gallery-item-caption">School Main Building</span>
            <span class="gallery-item-meta"><i class="fa-regular fa-image"></i> Facilities</span>
          </div>
          <div class="gallery-item-magnify"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        </div>

        <div class="gallery-item" data-category="facilities" data-media="photo" data-caption="Health Bay"
          data-src="{{ asset('landing/img/gallery/health-bay.jpg') }}">
          <div class="gallery-item-inner">
            <img src="{{ asset('landing/img/gallery/health-bay.jpg') }}" alt="Health Bay">
          </div>
          <div class="gallery-item-overlay">
            <span class="gallery-item-caption">Health Bay</span>
            <span class="gallery-item-meta"><i class="fa-regular fa-image"></i> Facilities</span>
          </div>
          <div class="gallery-item-magnify"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        </div>

        <div class="gallery-item" data-category="facilities" data-media="photo" data-caption="Staff Room"
          data-src="{{ asset('landing/img/gallery/staff-room-1.jpg') }}">
          <div class="gallery-item-inner">
            <img src="{{ asset('landing/img/gallery/staff-room-1.jpg') }}" alt="Staff Room">
          </div>
          <div class="gallery-item-overlay">
            <span class="gallery-item-caption">Staff Room</span>
            <span class="gallery-item-meta"><i class="fa-regular fa-image"></i> Facilities</span>
          </div>
          <div class="gallery-item-magnify"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        </div>

        <div class="gallery-item wide" data-category="facilities" data-media="photo"
          data-caption="School Exterior - Left View" data-src="{{ asset('landing/img/gallery/left-side-view.jpg') }}">
          <div class="gallery-item-inner">
            <img src="{{ asset('landing/img/gallery/left-side-view.jpg') }}" alt="School Exterior - Left View">
          </div>
          <div class="gallery-item-overlay">
            <span class="gallery-item-caption">School Exterior - Left View</span>
            <span class="gallery-item-meta"><i class="fa-regular fa-image"></i> Facilities</span>
          </div>
          <div class="gallery-item-magnify"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        </div>

        <div class="gallery-item" data-category="facilities" data-media="photo"
          data-caption="Sanitary Facilities (Female)" data-src="{{ asset('landing/img/gallery/female-toilet.jpg') }}">
          <div class="gallery-item-inner">
            <img src="{{ asset('landing/img/gallery/female-toilet.jpg') }}" alt="Sanitary Facilities (Female)">
          </div>
          <div class="gallery-item-overlay">
            <span class="gallery-item-caption">Sanitary Facilities (Female)</span>
            <span class="gallery-item-meta"><i class="fa-regular fa-image"></i> Facilities</span>
          </div>
          <div class="gallery-item-magnify"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        </div>

        <div class="gallery-item" data-category="facilities" data-media="photo" data-caption="Sanitary Facilities (Male)"
          data-src="{{ asset('landing/img/gallery/male-toilet.jpg') }}">
          <div class="gallery-item-inner">
            <img src="{{ asset('landing/img/gallery/male-toilet.jpg') }}" alt="Sanitary Facilities (Male)">
          </div>
          <div class="gallery-item-overlay">
            <span class="gallery-item-caption">Sanitary Facilities (Male)</span>
            <span class="gallery-item-meta"><i class="fa-regular fa-image"></i> Facilities</span>
          </div>
          <div class="gallery-item-magnify"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        </div>

        {{-- Sports --}}
        <div class="gallery-item wide" data-category="sports" data-media="photo"
          data-caption="School Playground & Sports Area" data-src="{{ asset('landing/img/gallery/playing-ground.jpg') }}">
          <div class="gallery-item-inner">
            <img src="{{ asset('landing/img/gallery/playing-ground.jpg') }}" alt="School Playground & Sports Area">
          </div>
          <div class="gallery-item-overlay">
            <span class="gallery-item-caption">School Playground & Sports Area</span>
            <span class="gallery-item-meta"><i class="fa-regular fa-image"></i> Sports</span>
          </div>
          <div class="gallery-item-magnify"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        </div>

        {{-- Empty State Card --}}
        <div class="gallery-empty-state" id="galleryEmptyState">
          <div class="gallery-empty-icon"><i class="fa-solid fa-camera-retro"></i></div>
          <h3 class="gallery-empty-title">No Media Found</h3>
          <p class="gallery-empty-desc">We haven't added any photos or videos to this category yet. Please check back
            later!</p>
        </div>

      </div>
    </div>
  </section>

  {{-- Video Highlights --}}
  <!-- <section class="section-pad" style="background:var(--cream);">
            <div class="container">
              <div class="text-center" style="margin-bottom:40px;">
                <div class="section-label center">Watch</div>
                <h2 class="section-title center">Video Highlights</h2>
                <p class="section-subtitle center">Relive our most memorable moments in motion.</p>
              </div>
              <div class="video-highlight-grid">
                <div class="video-highlight-card reveal" data-video="" data-caption="Annual Day 2024 Highlights">
                  <div class="video-highlight-thumb" style="background:linear-gradient(135deg,#7C4DBF,#3D1A6E);">
                    🎬
                    <div class="video-highlight-play"><i class="fa-solid fa-play"></i></div>
                  </div>
                  <div class="video-highlight-body">
                    <h3 class="video-highlight-title">Annual Day 2024</h3>
                    <p class="video-highlight-meta">4:32 &middot; Prize giving, performances &amp; celebrations</p>
                  </div>
                </div>
                <div class="video-highlight-card reveal reveal-delay-1" data-video="" data-caption="Sports Day 2024">
                  <div class="video-highlight-thumb" style="background:linear-gradient(135deg,#C85A00,#E06B10);">
                    🏆
                    <div class="video-highlight-play"><i class="fa-solid fa-play"></i></div>
                  </div>
                  <div class="video-highlight-body">
                    <h3 class="video-highlight-title">Sports Day Highlights</h3>
                    <p class="video-highlight-meta">3:15 &middot; Inter-house athletics &amp; team spirit</p>
                  </div>
                </div>
                <div class="video-highlight-card reveal reveal-delay-2" data-video="" data-caption="Student Testimonials">
                  <div class="video-highlight-thumb" style="background:linear-gradient(135deg,#5B2D9E,#280E4A);">
                    🎤
                    <div class="video-highlight-play"><i class="fa-solid fa-play"></i></div>
                  </div>
                  <div class="video-highlight-body">
                    <h3 class="video-highlight-title">Student Testimonials</h3>
                    <p class="video-highlight-meta">2:48 &middot; Voices from our student community</p>
                  </div>
                </div>
              </div>
            </div>
          </section> -->

  {{-- CTA --}}
  <section class="section-pad cta-section">
    <div class="cta-bg-crest" aria-hidden="true">RA</div>
    <div class="container cta-inner">
      <div class="cta-text reveal">
        <h2 class="cta-title">Want to see it all in person?</h2>
        <p class="cta-desc">Schedule a campus tour and experience the Royal Ark community firsthand.</p>
      </div>
      <div class="cta-actions reveal reveal-delay-1">
        <a href="{{ route('contact') }}" class="btn btn-gold btn-md">Book a Tour</a>
        <a href="{{ route('apply') }}" class="btn btn-outline-white btn-md">Apply Now</a>
      </div>
    </div>
  </section>

  {{-- Lightbox markup --}}
  <div class="gallery-lightbox" id="galleryLightbox" role="dialog" aria-modal="true" aria-label="Image lightbox">
    <button class="gallery-lightbox-close" aria-label="Close lightbox"><i class="fa-solid fa-xmark"></i></button>
    <a href="#" class="gallery-lightbox-download" id="lightboxDownload" download><i class="fa-solid fa-download"></i>
      Download</a>
    <button class="gallery-lightbox-nav gallery-lightbox-prev" aria-label="Previous image"><i
        class="fa-solid fa-chevron-left"></i></button>
    <button class="gallery-lightbox-nav gallery-lightbox-next" aria-label="Next image"><i
        class="fa-solid fa-chevron-right"></i></button>
    <div class="gallery-lightbox-img-wrap" id="lightboxContent">
      <img src="" alt="" class="gallery-lightbox-img" id="lightboxImg">
      <div class="gallery-lightbox-video" id="lightboxVideo" style="display:none;">
        <span><i class="fa-solid fa-circle-play" style="font-size:2rem;margin-right:12px;"></i> Video player
          placeholder</span>
      </div>
    </div>
    <div class="gallery-lightbox-caption" id="lightboxCaption"></div>
  </div>

@endsection

@push('scripts')
  <script src="/landing/js/gallery.js"></script>
@endpush