@extends('layouts.landing.app')

@section('title', 'Admissions — Royal Ark Schools')
@section('meta_description', 'Start your child\'s royal journey. Find everything you need to know about admission requirements, procedures, and enrollment at Royal Ark Schools.')
@section('meta_keywords', 'school admissions Lagos, enroll in Royal Ark Schools, admission requirements, school fees, enrollment process')
@section('navbar-class', 'solid')

@push('styles')
<style>
/* Admission status hero block */
.admission-hero-block {
  background: linear-gradient(135deg, var(--amber-pale), rgba(255,248,225,0.6));
  border: 2px solid rgba(200,90,0,0.2);
  border-radius: var(--radius-lg);
  padding: 32px 36px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 28px;
  flex-wrap: wrap;
  margin-top: 32px;
}
.admission-hero-status {
  display: flex;
  align-items: center;
  gap: 12px;
  font-family: var(--font-heading);
  font-size: var(--text-md);
  font-weight: 700;
  color: var(--ink);
}
.admission-hero-status .pulse-dot { background: var(--success); }
.admission-hero-dates {
  display: flex;
  gap: 24px;
  flex-wrap: wrap;
}
.admission-hero-date { font-family: var(--font-heading); font-size: var(--text-sm); color: var(--text-mid); }
.admission-hero-date strong { display: block; color: var(--ink); font-size: var(--text-base); margin-top: 2px; }

/* Process steps */
.process-track {
  display: flex;
  align-items: flex-start;
  gap: 0;
  justify-content: space-between;
  position: relative;
  max-width: 900px;
  margin: 0 auto;
}
.process-track::before {
  content: '';
  position: absolute;
  top: 24px; left: 40px; right: 40px;
  height: 2px;
  background: var(--border);
  z-index: 0;
}
.process-step {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  position: relative;
  z-index: 1;
  max-width: 140px;
  text-align: center;
}
.process-step-num {
  width: 48px; height: 48px;
  border-radius: 50%;
  background: var(--white);
  border: 2px solid var(--border-dark);
  display: flex; align-items: center; justify-content: center;
  font-family: var(--font-heading);
  font-weight: 700;
  font-size: var(--text-md);
  color: var(--text-light);
  flex-shrink: 0;
}
.process-step.active .process-step-num { background: var(--amber); border-color: var(--amber); color: var(--white); }
.process-step-title { font-family: var(--font-heading); font-size: var(--text-sm); font-weight: 700; color: var(--ink); }
.process-step-desc { font-family: var(--font-body); font-size: var(--text-xs); color: var(--text-light); line-height: 1.5; }

/* Requirements accordion */
.req-accordion { display: flex; flex-direction: column; gap: 12px; }
.req-item {
  background: var(--white);
  border-radius: var(--radius-md);
  border: 1px solid var(--border);
  overflow: hidden;
  transition: border-color var(--duration-base) var(--ease), box-shadow var(--duration-base) var(--ease);
}
.req-item:hover { border-color: var(--border-dark); box-shadow: var(--shadow-sm); }
.req-toggle {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 18px 22px;
  font-family: var(--font-heading);
  font-size: var(--text-md);
  font-weight: 700;
  color: var(--ink);
  cursor: pointer;
  background: none;
  border: none;
  text-align: left;
}
.req-toggle i { transition: transform var(--duration-base) var(--ease); color: var(--amber); font-size: 0.9rem; }
.req-item.open .req-toggle i { transform: rotate(180deg); }
.req-body {
  max-height: 0;
  overflow: hidden;
  transition: max-height var(--duration-slow) var(--ease), padding var(--duration-slow) var(--ease);
  padding: 0 22px;
}
.req-item.open .req-body { max-height: 400px; padding: 0 22px 18px; }
.req-body ul { list-style: none; display: flex; flex-direction: column; gap: 8px; }
.req-body li {
  font-family: var(--font-body);
  font-size: var(--text-sm);
  color: var(--text-mid);
  display: flex;
  align-items: flex-start;
  gap: 10px;
}
.req-body li::before {
  content: '';
  width: 6px; height: 6px;
  border-radius: 50%;
  background: var(--amber);
  margin-top: 8px;
  flex-shrink: 0;
}

/* Fees table */
.fees-table-wrap { overflow-x: auto; border-radius: var(--radius-lg); border: 1px solid var(--border); }
.fees-table { width: 100%; border-collapse: collapse; font-family: var(--font-heading); font-size: var(--text-sm); }
.fees-table th {
  background: linear-gradient(135deg, var(--royal), var(--royal-mid));
  color: var(--white);
  padding: 14px 18px;
  text-align: left;
  font-weight: 600;
  white-space: nowrap;
}
.fees-table td {
  padding: 14px 18px;
  border-bottom: 1px solid var(--border);
  color: var(--text-dark);
}
.fees-table tr:last-child td { border-bottom: none; }
.fees-table tr:nth-child(even) { background: var(--cream-2); }
.fees-table .fee-total { font-weight: 700; color: var(--ink); }

/* Checklist */
.checklist-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.checklist-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 14px 18px;
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-md);
  font-family: var(--font-body);
  font-size: var(--text-sm);
  color: var(--text-mid);
  transition: border-color var(--duration-base) var(--ease);
}
.checklist-item:hover { border-color: var(--amber-gold); }
.checklist-item i { color: var(--amber); font-size: 1.1rem; }

/* FAQ */
.faq-accordion { display: flex; flex-direction: column; gap: 10px; max-width: 800px; margin: 0 auto; }
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

/* Contact enquiry */
.enquiry-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }
.enquiry-info { display: flex; flex-direction: column; gap: 20px; }
.enquiry-block {
  display: flex;
  align-items: flex-start;
  gap: 14px;
}
.enquiry-block i { width: 40px; height: 40px; border-radius: var(--radius-sm); background: var(--royal-pale); display: flex; align-items: center; justify-content: center; font-size: 1rem; color: var(--royal); flex-shrink: 0; }
.enquiry-block h4 { font-family: var(--font-heading); font-size: var(--text-sm); font-weight: 700; color: var(--ink); margin-bottom: 2px; }
.enquiry-block p { font-family: var(--font-body); font-size: var(--text-sm); color: var(--text-mid); line-height: 1.6; }

@media (max-width: 1024px) {
  .process-track { flex-wrap: wrap; gap: 24px; }
  .process-track::before { display: none; }
  .process-step { flex-direction: row; text-align: left; gap: 16px; max-width: 100%; width: 100%; align-items: center; }
  .checklist-grid { grid-template-columns: 1fr; }
  .enquiry-grid { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
  .admission-hero-block { padding: 24px; }
  .fees-table th, .fees-table td { padding: 12px 14px; font-size: var(--text-xs); }
  .process-step { gap: 12px; }
  .process-step-num { width: 40px; height: 40px; font-size: var(--text-sm); }
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
      <span class="current">Admissions</span>
    </nav>
    <h1>Admissions — 2025/2026 Session</h1>
    <p class="page-hero-sub">Transparent process. Supportive team. A school worth choosing.</p>

    <div class="admission-hero-block reveal">
      <div class="admission-hero-status">
        <span class="pulse-dot"></span>
        Applications Open
      </div>
      <div class="admission-hero-dates">
        <div class="admission-hero-date">Opens:<strong>Sep 1, 2025</strong></div>
        <div class="admission-hero-date">Closes:<strong>Nov 30, 2025</strong></div>
      </div>
      <a href="{{ route('apply') }}" class="btn btn-primary btn-md">Apply Now</a>
    </div>
  </div>
</section>

{{-- How to Apply --}}
<section class="section-pad">
  <div class="container">
    <div class="text-center" style="margin-bottom:48px;">
      <div class="section-label center">Your Journey</div>
      <h2 class="section-title center">How to Apply</h2>
      <p class="section-subtitle center">Five simple steps from enquiry to enrolment.</p>
    </div>
    <div class="process-track reveal">
      <div class="process-step active">
        <div class="process-step-num">1</div>
        <div>
          <div class="process-step-title">Fill Form</div>
          <div class="process-step-desc">Complete the online application form.</div>
        </div>
      </div>
      <div class="process-step">
        <div class="process-step-num">2</div>
        <div>
          <div class="process-step-title">Submit Docs</div>
          <div class="process-step-desc">Upload required documents via the form.</div>
        </div>
      </div>
      <div class="process-step">
        <div class="process-step-num">3</div>
        <div>
          <div class="process-step-title">Pay Fee</div>
          <div class="process-step-desc">Pay the non-refundable application fee online.</div>
        </div>
      </div>
      <div class="process-step">
        <div class="process-step-num">4</div>
        <div>
          <div class="process-step-title">Interview</div>
          <div class="process-step-desc">Attend a brief interview if required.</div>
        </div>
      </div>
      <div class="process-step">
        <div class="process-step-num">5</div>
        <div>
          <div class="process-step-title">Resumption</div>
          <div class="process-step-desc">Receive admission letter and resume.</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Requirements per Level --}}
<section class="section-pad" style="background:var(--cream);" id="requirement">
  <div class="container">
    <div class="text-center" style="margin-bottom:40px;">
      <div class="section-label center">What You Need</div>
      <h2 class="section-title center">Admission Requirements</h2>
      <p class="section-subtitle center">Requirements vary slightly by level. Click to expand each section.</p>
    </div>
    <div class="req-accordion reveal">
      <div class="req-item open">
        <button class="req-toggle" onclick="this.parentElement.classList.toggle('open')">
          Creche &amp; Nursery Admission Requirements <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="req-body">
          <ul>
            <li>Age: 1 – 4 years at time of entry</li>
            <li>Birth Certificate (original + photocopy)</li>
            <li>4 recent passport photographs</li>
            <li>Immunisation record card</li>
            <li>No entrance examination required</li>
          </ul>
        </div>
      </div>
      <div class="req-item">
        <button class="req-toggle" onclick="this.parentElement.classList.toggle('open')">
          Primary School Admission Requirements <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="req-body">
          <ul>
            <li>Age: 5 – 10 years at time of entry</li>
            <li>Birth Certificate (original + photocopy)</li>
            <li>4 recent passport photographs</li>
            <li>Immunisation record card</li>
            <li>Previous school report card (if transferring)</li>
            <li>Entrance assessment in Literacy &amp; Numeracy</li>
          </ul>
        </div>
      </div>
      <div class="req-item">
        <button class="req-toggle" onclick="this.parentElement.classList.toggle('open')">
          Junior Secondary (JSS1) Requirements <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="req-body">
          <ul>
            <li>Age: 10 – 12 years at time of entry</li>
            <li>Birth Certificate (original + photocopy)</li>
            <li>4 recent passport photographs</li>
            <li>Primary school leaving certificate</li>
            <li>Last two term report cards</li>
            <li>Entrance examination in English, Maths &amp; General Knowledge</li>
          </ul>
        </div>
      </div>
      <div class="req-item">
        <button class="req-toggle" onclick="this.parentElement.classList.toggle('open')">
          Senior Secondary (SSS1) Requirements <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="req-body">
          <ul>
            <li>Age: 13 – 15 years at time of entry</li>
            <li>Birth Certificate (original + photocopy)</li>
            <li>4 recent passport photographs</li>
            <li>Junior Secondary School certificate / BECE result</li>
            <li>Last two term report cards</li>
            <li>Entrance examination in core subjects</li>
            <li>Interview with student and parent/guardian</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Fees Schedule --}}
<section class="section-pad" id="fees">
  <div class="container">
    <div class="text-center" style="margin-bottom:40px;">
      <div class="section-label center">Investment</div>
      <h2 class="section-title center">Fee Structure</h2>
      <p class="section-subtitle center">Fees shown are indicative. Contact our office for current session rates and payment plans.</p>
    </div>
    <div class="fees-table-wrap reveal">
      <table class="fees-table">
        <thead>
          <tr>
            <th>Level</th>
            <th>Tuition (per term)</th>
            <th>Registration</th>
            <th>Development Levy</th>
            <th class="fee-total">Total (per term)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Creche</strong></td>
            <td>₦85,000</td>
            <td>₦15,000</td>
            <td>₦10,000</td>
            <td class="fee-total">₦110,000</td>
          </tr>
          <tr>
            <td><strong>Nursery</strong></td>
            <td>₦95,000</td>
            <td>₦15,000</td>
            <td>₦12,000</td>
            <td class="fee-total">₦122,000</td>
          </tr>
          <tr>
            <td><strong>Primary 1–3</strong></td>
            <td>₦120,000</td>
            <td>₦20,000</td>
            <td>₦15,000</td>
            <td class="fee-total">₦155,000</td>
          </tr>
          <tr>
            <td><strong>Primary 4–6</strong></td>
            <td>₦135,000</td>
            <td>₦20,000</td>
            <td>₦18,000</td>
            <td class="fee-total">₦173,000</td>
          </tr>
          <tr>
            <td><strong>JSS 1–3</strong></td>
            <td>₦165,000</td>
            <td>₦25,000</td>
            <td>₦20,000</td>
            <td class="fee-total">₦210,000</td>
          </tr>
          <tr>
            <td><strong>SSS 1–3</strong></td>
            <td>₦185,000</td>
            <td>₦25,000</td>
            <td>₦25,000</td>
            <td class="fee-total">₦235,000</td>
          </tr>
        </tbody>
      </table>
    </div>
    <p class="text-center" style="margin-top:16px; font-family:var(--font-body); font-size:var(--text-xs); color:var(--text-muted);">Fees are payable per term. A 5% discount applies when full-year fees are paid upfront. Sibling discounts available.</p>
    <!-- <div class="text-center" style="margin-top:24px;">
      <a href="#" class="btn btn-outline btn-md" onclick="event.preventDefault(); alert('Detailed fee sheet download coming soon.');"><i class="fa-solid fa-download"></i> Request Detailed Fee Sheet</a>
    </div> -->
  </div>
</section>

{{-- Documents Checklist --}}
<section class="section-pad" style="background:var(--cream);">
  <div class="container">
    <div class="text-center" style="margin-bottom:40px;">
      <div class="section-label center">Be Prepared</div>
      <h2 class="section-title center">Documents Required</h2>
      <p class="section-subtitle center">Ensure you have these documents ready before starting your application.</p>
    </div>
    <div class="checklist-grid reveal">
      <div class="checklist-item"><i class="fa-regular fa-file-lines"></i> Birth Certificate (original + photocopy)</div>
      <div class="checklist-item"><i class="fa-regular fa-file-lines"></i> Previous School Report Card (last 2 terms)</div>
      <div class="checklist-item"><i class="fa-regular fa-image"></i> Passport Photographs (4 copies)</div>
      <div class="checklist-item"><i class="fa-regular fa-id-card"></i> Parent / Guardian ID</div>
      <div class="checklist-item"><i class="fa-solid fa-syringe"></i> Immunisation Card (Nursery / Primary)</div>
      <div class="checklist-item"><i class="fa-regular fa-file-lines"></i> BECE Result (for SSS1 entry)</div>
    </div>
    <!-- <div class="text-center" style="margin-top:28px;">
      <a href="#" class="btn btn-outline btn-md" onclick="event.preventDefault(); alert('Download checklist PDF coming soon.');"><i class="fa-solid fa-download"></i> Download Checklist (PDF)</a>
    </div> -->
  </div>
</section>

{{-- FAQ --}}
<section class="section-pad" id="faq">
  <div class="container">
    <div class="text-center" style="margin-bottom:40px;">
      <div class="section-label center">Questions</div>
      <h2 class="section-title center">Frequently Asked Questions</h2>
    </div>
    <div class="faq-accordion reveal">
      <div class="faq-item open">
        <button class="faq-toggle" onclick="this.parentElement.classList.toggle('open')">
          Is there an entrance examination? <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="faq-body">
          <p>Yes. All applicants for Primary 1 and above sit for an entrance assessment. Nursery and Creche applicants do not require an exam — only an informal readiness observation.</p>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-toggle" onclick="this.parentElement.classList.toggle('open')">
          Can my child join mid-session? <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="faq-body">
          <p>Mid-session transfers are considered on a case-by-case basis, subject to space availability and a satisfactory entrance assessment. Please contact the admissions office for guidance.</p>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-toggle" onclick="this.parentElement.classList.toggle('open')">
          What is the school's feeding arrangement? <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="faq-body">
          <p>We provide a balanced daily lunch prepared in our on-site kitchen. A termly meal plan fee covers all school-day meals. Special dietary needs can be accommodated with advance notice.</p>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-toggle" onclick="this.parentElement.classList.toggle('open')">
          Do you offer bursaries or scholarships? <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="faq-body">
          <p>Yes. Merit-based scholarships are awarded to outstanding BECE and WAEC candidates. Need-based bursaries are also available. Applications open each May for the following session.</p>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-toggle" onclick="this.parentElement.classList.toggle('open')">
          What is the uniform policy? <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="faq-body">
          <p>All students wear the prescribed Royal Ark Schools uniform, available from the school store. Uniforms must be worn neatly on all school days, with designated sports wear for Fridays.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Enquiry Block --}}
<!-- <section class="section-pad" style="background:var(--cream);">
  <div class="container">
    <div class="enquiry-grid">
      <div class="reveal">
        <div class="section-label">Still Have Questions?</div>
        <h2 class="section-title" style="font-size:var(--text-2xl);">Reach Out to Us</h2>
        <p class="section-subtitle" style="max-width:none;">Our admissions team is happy to answer your questions and guide you through the process.</p>
        <div class="enquiry-info" style="margin-top:24px;">
          <div class="enquiry-block">
            <i class="fa-solid fa-phone"></i>
            <div>
              <h4>Phone</h4>
              <p>+234 800 000 0000<br>Mon – Fri, 8:00 AM – 4:00 PM</p>
            </div>
          </div>
          <div class="enquiry-block">
            <i class="fa-solid fa-envelope"></i>
            <div>
              <h4>Email</h4>
              <p>admissions@royalarkcollege.edu.ng</p>
            </div>
          </div>
          <div class="enquiry-block">
            <i class="fa-brands fa-whatsapp"></i>
            <div>
              <h4>WhatsApp</h4>
              <p>+234 800 000 0001</p>
            </div>
          </div>
          <div class="enquiry-block">
            <i class="fa-solid fa-location-dot"></i>
            <div>
              <h4>Address</h4>
              <p>Royal Ark Schools, Lagos, Nigeria</p>
            </div>
          </div>
        </div>
      </div>
      <div class="reveal reveal-delay-1" style="background:var(--white); border-radius:var(--radius-lg); border:1px solid var(--border); padding:32px;">
        <h3 class="section-title" style="font-size:var(--text-xl); margin-bottom:20px;">Quick Enquiry</h3>
        <form onsubmit="event.preventDefault(); alert('Thank you! Your enquiry has been sent. We will respond within 24 hours.');">
          <div class="form-group">
            <label class="form-label">Your Name <span class="req">*</span></label>
            <input type="text" class="form-control" placeholder="Full name" required>
          </div>
          <div class="form-group">
            <label class="form-label">Phone <span class="req">*</span></label>
            <input type="tel" class="form-control" placeholder="Phone number" required>
          </div>
          <div class="form-group">
            <label class="form-label">Message <span class="req">*</span></label>
            <textarea class="form-control" rows="4" placeholder="How can we help?" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-md w-full">Send Enquiry</button>
        </form>
      </div>
    </div>
  </div>
</section> -->

{{-- CTA --}}
<section class="section-pad cta-section">
  <div class="cta-bg-crest" aria-hidden="true">RA</div>
  <div class="container cta-inner">
    <div class="cta-text reveal">
      <h2 class="cta-title">Secure Your Child's Future at Royal Ark Schools</h2>
      <p class="cta-desc">Applications for the 2025/2026 session are open. Spaces fill quickly — apply today.</p>
    </div>
    <div class="cta-actions reveal reveal-delay-1">
      <a href="{{ route('apply') }}" class="btn btn-gold btn-md">Apply Online Now</a>
      <!-- <a href="#" class="btn btn-outline-white btn-md" onclick="event.preventDefault(); alert('Prospectus download coming soon.');"><i class="fa-solid fa-download"></i> Download Prospectus</a> -->
    </div>
  </div>
</section>

@endsection
