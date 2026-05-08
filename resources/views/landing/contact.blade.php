@extends('layouts.landing.app')

@section('title', 'Contact — Royal Ark Schools')
@section('meta_description', 'Get in touch with Royal Ark Schools. Contact our administration, schedule a campus tour, or find our location in Lagos.')
@section('meta_keywords', 'contact Royal Ark Schools, school phone number, school email, school address Lagos, visit school')
@section('navbar-class', 'solid')

@push('styles')
<style>
.contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.contact-info-wrap {
  background: var(--white);
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  padding: 32px;
}
.contact-block {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  margin-bottom: 24px;
}
.contact-block:last-child { margin-bottom: 0; }
.contact-block i {
  width: 44px; height: 44px;
  border-radius: var(--radius-md);
  background: var(--royal-pale);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.1rem;
  color: var(--royal);
  flex-shrink: 0;
}
.contact-block h4 { font-family: var(--font-heading); font-size: var(--text-sm); font-weight: 700; color: var(--ink); margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.04em; }
.contact-block p { font-family: var(--font-body); font-size: var(--text-sm); color: var(--text-mid); line-height: 1.7; }
.contact-block a { color: var(--royal); text-decoration: underline; text-underline-offset: 2px; }
.contact-social { display: flex; gap: 10px; margin-top: 24px; }
.contact-social a {
  width: 40px; height: 40px;
  border-radius: var(--radius-sm);
  background: var(--royal-pale);
  display: flex; align-items: center; justify-content: center;
  color: var(--royal);
  font-size: 1rem;
  transition: background var(--duration-base) var(--ease), color var(--duration-base) var(--ease);
}
.contact-social a:hover { background: var(--royal); color: var(--white); }

.contact-form-wrap {
  background: var(--white);
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  padding: 32px;
}
.map-placeholder {
  width: 100%;
  aspect-ratio: 16/9;
  background: var(--royal-pale);
  border-radius: var(--radius-md);
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  font-family: var(--font-heading);
  font-size: var(--text-sm);
  color: var(--text-light);
  margin-top: 20px;
  gap: 8px;
}
.map-placeholder i { font-size: 2rem; color: var(--royal-light); }

/* FAQ accordion (copied for self-containment) */
.faq-accordion { display: flex; flex-direction: column; gap: 10px; }
.faq-item {
  background: var(--white);
  border-radius: var(--radius-md);
  border: 1px solid var(--border);
  overflow: hidden;
  transition: box-shadow var(--duration-base) var(--ease);
}
.faq-item:hover { box-shadow: var(--shadow-sm); }
.faq-toggle {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  padding: 18px 22px;
  font-family: var(--font-heading);
  font-size: var(--text-base);
  font-weight: 600;
  color: var(--ink);
  cursor: pointer;
  background: none;
  border: none;
  text-align: left;
}
.faq-toggle i { color: var(--amber); font-size: 0.8rem; transition: transform var(--duration-base) var(--ease); flex-shrink: 0; }
.faq-item.open .faq-toggle i { transform: rotate(180deg); }
.faq-body {
  max-height: 0;
  overflow: hidden;
  transition: max-height var(--duration-slow) var(--ease), padding var(--duration-slow) var(--ease);
  padding: 0 22px;
}
.faq-item.open .faq-body { max-height: 300px; padding: 0 22px 18px; }
.faq-body p { font-family: var(--font-body); font-size: var(--text-sm); color: var(--text-mid); line-height: 1.7; }

/* Quick FAQ */
.faq-small { max-width: 800px; margin: 0 auto; }

@media (max-width: 1024px) {
  .contact-grid { grid-template-columns: 1fr; }
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
      <span class="current">Contact</span>
    </nav>
    <h1>Get in Touch</h1>
    <p class="page-hero-sub">We'd love to hear from you — prospective parents, current families, or anyone with a question.</p>
  </div>
</section>

{{-- Contact Info + Form --}}
<section class="section-pad">
  <div class="container">
    <div class="contact-grid">
      <div class="contact-info-wrap reveal">
        <div class="section-label" style="margin-bottom:20px;">Contact Details</div>
        <h2 class="section-title" style="font-size:var(--text-2xl); margin-bottom:24px;">Reach Us</h2>

        <div class="contact-block">
          <i class="fa-solid fa-location-dot"></i>
          <div>
            <h4>Address</h4>
            <p>21, Were Avenue, Mopol Bus Stop<br>Egan Road, Iyana Ijesha, Ogun State</p>
          </div>
        </div>

        <div class="contact-block">
          <i class="fa-solid fa-phone"></i>
          <div>
            <h4>Phone</h4>
            <p>Main: <a href="tel:09021062859">0902 106 2859</a><br>Enquiry: <a href="tel:08134324765">0813 432 4765</a></p>
          </div>
        </div>

        <div class="contact-block">
          <i class="fa-solid fa-envelope"></i>
          <div>
            <h4>Email</h4>
            <p>General: <a href="mailto:info@ras.com">info@ras.com</a></p>
          </div>
        </div>

        <div class="contact-block">
          <i class="fa-brands fa-whatsapp"></i>
          <div>
            <h4>WhatsApp</h4>
            <p><a href="https://wa.me/2349021062859" target="_blank" rel="noopener">+234 902 106 2859</a></p>
          </div>
        </div>

        <div class="contact-block">
          <i class="fa-regular fa-clock"></i>
          <div>
            <h4>Office Hours</h4>
            <p>Monday – Thursday: 8:00 AM – 4:00 PM<br>Friday: 8:00 AM – 2:00 PM</p>
          </div>
        </div>

        <div class="contact-social">
          <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" aria-label="X / Twitter"><i class="fa-brands fa-x-twitter"></i></a>
          <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
        </div>

        <!-- <div class="map-placeholder">
          <i class="fa-solid fa-map-location-dot"></i>
          <span>Interactive Map Coming Soon</span>
        </div> -->
      </div>

      <div class="contact-form-wrap reveal reveal-delay-1">
        <div class="section-label" style="margin-bottom:20px;">Send a Message</div>
        <h2 class="section-title" style="font-size:var(--text-2xl); margin-bottom:24px;">Write to Us</h2>
        <form onsubmit="event.preventDefault(); alert('Thank you! Your message has been sent. We will respond within 24 hours.');">
          <div class="form-group">
            <label class="form-label">Name <span class="req">*</span></label>
            <input type="text" class="form-control" placeholder="Your full name" required>
          </div>
          <div class="form-group">
            <label class="form-label">Email <span class="req">*</span></label>
            <input type="email" class="form-control" placeholder="your@email.com" required>
          </div>
          <div class="form-group">
            <label class="form-label">Phone</label>
            <input type="tel" class="form-control" placeholder="+234 ...">
          </div>
          <div class="form-group">
            <label class="form-label">Subject <span class="req">*</span></label>
            <select class="form-control" required>
              <option value="">Select a subject</option>
              <option value="admissions">Admissions</option>
              <option value="general">General Enquiry</option>
              <option value="academics">Academics</option>
              <option value="fees">Fees &amp; Payments</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Message <span class="req">*</span></label>
            <textarea class="form-control" rows="5" placeholder="How can we help you?" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-md w-full">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</section>

{{-- Quick FAQ --}}
<section class="section-pad" style="background:var(--cream);">
  <div class="container">
    <div class="text-center" style="margin-bottom:40px;">
      <div class="section-label center">Common Questions</div>
      <h2 class="section-title center">Quick Answers</h2>
    </div>
    <div class="faq-small">
      <div class="faq-accordion reveal">
        <div class="faq-item open">
          <button class="faq-toggle" onclick="this.parentElement.classList.toggle('open')">
            When does the school day start and end? <i class="fa-solid fa-chevron-down"></i>
          </button>
          <div class="faq-body">
            <p>Classes begin at 8:00 AM and end at 2:30 PM for primary, and 3:00 PM for secondary. After-school clubs run until 4:30 PM on selected days.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-toggle" onclick="this.parentElement.classList.toggle('open')">
            Is there a school bus service? <i class="fa-solid fa-chevron-down"></i>
          </button>
          <div class="faq-body">
            <p>Yes. We operate a fleet of air-conditioned buses covering major routes across Lagos. Bus fees are billed per term and can be arranged during admission.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-toggle" onclick="this.parentElement.classList.toggle('open')">
            What is the student-to-teacher ratio? <i class="fa-solid fa-chevron-down"></i>
          </button>
          <div class="faq-body">
            <p>We maintain an average ratio of 15:1 in the early years and 20:1 in secondary. This ensures every student receives personalised attention.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-toggle" onclick="this.parentElement.classList.toggle('open')">
            Do you accept international students? <i class="fa-solid fa-chevron-down"></i>
          </button>
          <div class="faq-body">
            <p>Yes. We welcome students from all backgrounds. Our curriculum is based on Nigerian standards with global enrichment, making it suitable for international transitions.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-toggle" onclick="this.parentElement.classList.toggle('open')">
            How do I book a school tour? <i class="fa-solid fa-chevron-down"></i>
          </button>
          <div class="faq-body">
            <p>School tours are available every Wednesday and Saturday morning. Call our admissions line or fill the enquiry form to schedule a visit.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center" style="margin-top:32px;">
      <a href="{{ url('/admissions#faq') }}" class="btn btn-outline btn-md">View All FAQs on Admissions</a>
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="section-pad cta-section">
  <div class="cta-bg-crest" aria-hidden="true">RA</div>
  <div class="container cta-inner">
    <div class="cta-text reveal">
      <h2 class="cta-title">Prefer to Visit? <em>We're Here.</em></h2>
      <p class="cta-desc">Walk-ins are welcome during office hours. Schedule a tour to experience Royal Ark firsthand.</p>
    </div>
    <div class="cta-actions reveal reveal-delay-1">
      <a href="{{ route('apply') }}" class="btn btn-gold btn-md">Apply Now</a>
      <a href="{{ url('/admissions#requirement') }}" class="btn btn-outline-white btn-md">Admission Details</a>
    </div>
  </div>
</section>

@endsection
