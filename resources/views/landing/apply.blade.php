@extends('layouts.landing.app')

@section('title', 'Apply Now — Royal Ark Schools')
@section('meta_description', 'Apply online for the 2025/2026 academic session at Royal Ark Schools. Complete our easy enrollment form and join our community of excellence.')
@section('meta_keywords', 'apply online school, Royal Ark Schools application, student enrollment form')
@section('navbar-class', 'solid')
@section('hide-navbar')
@endsection

@push('styles')
  <link rel="stylesheet" href="/landing/css/forms.css">
@endpush

@section('content')

  {{-- Minimal Header --}}
  <header class="apply-header">
    <div class="container apply-header-inner">
      <a href="{{ route('home') }}" class="navbar-logo">
        <img src="{{ asset('landing/img/ras-logo.jpg') }}" class="logo-crest" alt="Royal Ark Schools Logo">
        <div class="logo-text">
          <span class="logo-name">Royal Ark Schools</span>
          <span class="logo-motto">Royalty in Excellence</span>
        </div>
      </a>
      <a href="tel:+2349021062859" class="apply-help-link">
        <i class="fa-solid fa-phone"></i> Need Help?
      </a>
    </div>
  </header>

  {{-- Progress Steps --}}
  <section class="section-pad" style="padding-bottom: 0;">
    <div class="container">
      <div class="progress-track" id="progressTrack">
        <div class="progress-fill" id="progressFill" style="width: 0%;"></div>
        <div class="progress-step active" data-step="1">
          <div class="step-bubble"><i class="fa-solid fa-1"></i></div>
          <span class="step-label">Student Info</span>
        </div>
        <div class="progress-step" data-step="2">
          <div class="step-bubble"><i class="fa-solid fa-2"></i></div>
          <span class="step-label">Parent Info</span>
        </div>
        <div class="progress-step" data-step="3">
          <div class="step-bubble"><i class="fa-solid fa-3"></i></div>
          <span class="step-label">Prev. School</span>
        </div>
        <div class="progress-step" data-step="4">
          <div class="step-bubble"><i class="fa-solid fa-4"></i></div>
          <span class="step-label">Documents</span>
        </div>
        <div class="progress-step" data-step="5">
          <div class="step-bubble"><i class="fa-solid fa-5"></i></div>
          <span class="step-label">Review</span>
        </div>
      </div>
    </div>
  </section>

  {{-- Form Steps --}}
  <section class="section-pad" style="padding-top: 32px;">
    <div class="container">
      <form class="apply-form-card" id="applyForm" novalidate>

        {{-- Step 1: Student Information --}}
        <div class="apply-step active" data-step="1">
          <h2 class="section-title" style="font-size:1.5rem;margin-bottom:8px;">Student Information</h2>
          <p class="section-subtitle" style="margin-bottom:28px;">Tell us about the applicant.</p>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="sFirstName">First Name <span class="req">*</span></label>
              <input type="text" id="sFirstName" name="sFirstName" class="form-control" placeholder="e.g. Adeoluwa"
                required>
              <div class="error-msg">First name is required.</div>
            </div>
            <div class="form-group">
              <label class="form-label" for="sLastName">Last Name <span class="req">*</span></label>
              <input type="text" id="sLastName" name="sLastName" class="form-control" placeholder="e.g. Okafor" required>
              <div class="error-msg">Last name is required.</div>
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="sDob">Date of Birth <span class="req">*</span></label>
              <input type="date" id="sDob" name="sDob" class="form-control" required>
              <div class="error-msg">Date of birth is required.</div>
            </div>
            <div class="form-group">
              <label class="form-label" for="sGender">Gender <span class="req">*</span></label>
              <select id="sGender" name="sGender" class="form-control" required>
                <option value="" disabled selected>Select gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <div class="error-msg">Gender is required.</div>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="sClass">Class Applying For <span class="req">*</span></label>
            <select id="sClass" name="sClass" class="form-control" required>
              <option value="" disabled selected>Select a class</option>
              <option value="Creche">Creche</option>
              <option value="Pre-Nursery">Pre-Nursery</option>
              <option value="Nursery 1">Nursery 1</option>
              <option value="Nursery 2">Nursery 2</option>
              <option value="Primary 1">Primary 1</option>
              <option value="Primary 2">Primary 2</option>
              <option value="Primary 3">Primary 3</option>
              <option value="Primary 4">Primary 4</option>
              <option value="Primary 5">Primary 5</option>
              <option value="Primary 6">Primary 6</option>
              <option value="JSS 1">JSS 1</option>
              <option value="JSS 2">JSS 2</option>
              <option value="JSS 3">JSS 3</option>
              <option value="SS 1">SS 1</option>
              <option value="SS 2">SS 2</option>
              <option value="SS 3">SS 3</option>
            </select>
            <div class="error-msg">Please select a class.</div>
          </div>

          <div class="form-group">
            <label class="form-label" for="sPrevClass">Previous Class Attended</label>
            <input type="text" id="sPrevClass" name="sPrevClass" class="form-control" placeholder="e.g. Primary 5">
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="sNationality">Nationality</label>
              <input type="text" id="sNationality" name="sNationality" class="form-control" value="Nigerian">
            </div>
            <div class="form-group">
              <label class="form-label" for="sState">State of Origin</label>
              <input type="text" id="sState" name="sState" class="form-control" placeholder="e.g. Lagos State">
            </div>
          </div>
        </div>

        {{-- Step 2: Parent / Guardian Information --}}
        <div class="apply-step" data-step="2">
          <h2 class="section-title" style="font-size:1.5rem;margin-bottom:8px;">Parent / Guardian Information</h2>
          <p class="section-subtitle" style="margin-bottom:28px;">Primary contact for the applicant.</p>

          <div class="form-group">
            <label class="form-label" for="pFullName">Parent / Guardian Full Name <span class="req">*</span></label>
            <input type="text" id="pFullName" name="pFullName" class="form-control" placeholder="e.g. Mrs. Ngozi Okafor"
              required>
            <div class="error-msg">Full name is required.</div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="pRelationship">Relationship <span class="req">*</span></label>
              <select id="pRelationship" name="pRelationship" class="form-control" required>
                <option value="" disabled selected>Select relationship</option>
                <option value="Mother">Mother</option>
                <option value="Father">Father</option>
                <option value="Guardian">Guardian</option>
                <option value="Other">Other</option>
              </select>
              <div class="error-msg">Relationship is required.</div>
            </div>
            <div class="form-group">
              <label class="form-label" for="pOccupation">Occupation</label>
              <input type="text" id="pOccupation" name="pOccupation" class="form-control"
                placeholder="e.g. Civil Engineer">
            </div>
          </div>

          <div class="form-grid-2">
            <div class="form-group">
              <label class="form-label" for="pPhone">Phone Number <span class="req">*</span></label>
              <input type="tel" id="pPhone" name="pPhone" class="form-control" placeholder="e.g. +234 800 000 0000"
                required>
              <div class="error-msg">Phone number is required.</div>
            </div>
            <div class="form-group">
              <label class="form-label" for="pEmail">Email Address <span class="req">*</span></label>
              <input type="email" id="pEmail" name="pEmail" class="form-control" placeholder="e.g. parent@example.com"
                required>
              <div class="error-msg">A valid email is required.</div>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="pAddress">Home Address <span class="req">*</span></label>
            <textarea id="pAddress" name="pAddress" class="form-control" rows="3" placeholder="Full residential address"
              required></textarea>
            <div class="error-msg">Home address is required.</div>
          </div>

          <div class="divider"></div>

          <div class="form-group">
            <label class="form-label" for="eName">Emergency Contact Name</label>
            <input type="text" id="eName" name="eName" class="form-control" placeholder="Different from parent/guardian">
          </div>
          <div class="form-group">
            <label class="form-label" for="ePhone">Emergency Contact Phone</label>
            <input type="tel" id="ePhone" name="ePhone" class="form-control" placeholder="e.g. +234 800 000 0000">
          </div>
        </div>

        {{-- Step 3: Previous School --}}
        <div class="apply-step" data-step="3">
          <h2 class="section-title" style="font-size:1.5rem;margin-bottom:8px;">Previous School</h2>
          <p class="section-subtitle" style="margin-bottom:28px;">Where has the student studied before?</p>

          <div class="form-group">
            <label class="form-label" for="prevSchoolName">Previous School Name</label>
            <input type="text" id="prevSchoolName" name="prevSchoolName" class="form-control"
              placeholder="e.g. Sunshine Nursery & Primary School">
          </div>

          <div class="form-group">
            <label class="form-label" for="prevSchoolAddress">Address of School</label>
            <textarea id="prevSchoolAddress" name="prevSchoolAddress" class="form-control" rows="2"
              placeholder="School address"></textarea>
          </div>

          <div class="form-group">
            <label class="form-label" for="prevClass">Last Class Attended / Completed</label>
            <input type="text" id="prevClass" name="prevClass" class="form-control" placeholder="e.g. Primary 5">
          </div>

          <div class="form-group">
            <label class="form-label" for="prevReason">Reason for Leaving</label>
            <textarea id="prevReason" name="prevReason" class="form-control" rows="2"
              placeholder="Briefly explain why the student is changing schools"></textarea>
          </div>

          <div class="divider"></div>

          <div class="form-group">
            <label class="form-label">Any special learning needs?</label>
            <div class="toggle-row">
              <div class="toggle-group">
                <button type="button" class="toggle-btn" data-need="no">No</button>
                <button type="button" class="toggle-btn" data-need="yes">Yes</button>
              </div>
            </div>
            <input type="hidden" id="specialNeeds" name="specialNeeds" value="">
            <div class="form-group" id="specialNeedsDetailGroup" style="display:none;">
              <label class="form-label" for="specialNeedsDetail">Please provide details</label>
              <textarea id="specialNeedsDetail" name="specialNeedsDetail" class="form-control" rows="3"
                placeholder="Describe any learning needs, allergies, or medical conditions we should know about"></textarea>
            </div>
          </div>
        </div>

        {{-- Step 4: Documents Upload --}}
        <div class="apply-step" data-step="4">
          <h2 class="section-title" style="font-size:1.5rem;margin-bottom:8px;">Documents Upload</h2>
          <p class="section-subtitle" style="margin-bottom:28px;">Upload the required documents. Drag & drop or click to
            browse.</p>

          <div class="upload-grid">
            <div class="upload-zone" data-upload="birthCert">
              <input type="file" id="birthCert" name="birthCert" accept=".pdf,.jpg,.jpeg,.png">
              <div class="upload-zone-icon"><i class="fa-solid fa-file-lines"></i></div>
              <div class="upload-zone-title">Birth Certificate <span style="color:var(--danger);">*</span></div>
              <div class="upload-zone-hint">PDF, JPG or PNG — max 2MB</div>
              <div class="upload-file-name" id="birthCertName"></div>
            </div>

            <div class="upload-zone" data-upload="passportPhoto">
              <input type="file" id="passportPhoto" name="passportPhoto" accept=".jpg,.jpeg,.png">
              <div class="upload-zone-icon"><i class="fa-solid fa-camera"></i></div>
              <div class="upload-zone-title">Passport Photograph <span style="color:var(--danger);">*</span></div>
              <div class="upload-zone-hint">JPG or PNG — max 2MB</div>
              <div class="upload-file-name" id="passportPhotoName"></div>
            </div>

            <div class="upload-zone" data-upload="reportCard">
              <input type="file" id="reportCard" name="reportCard" accept=".pdf,.jpg,.jpeg,.png">
              <div class="upload-zone-icon"><i class="fa-solid fa-clipboard-list"></i></div>
              <div class="upload-zone-title">Last School Report Card</div>
              <div class="upload-zone-hint">PDF, JPG or PNG — max 2MB</div>
              <div class="upload-file-name" id="reportCardName"></div>
            </div>

            <div class="upload-zone" data-upload="parentId">
              <input type="file" id="parentId" name="parentId" accept=".pdf,.jpg,.jpeg,.png">
              <div class="upload-zone-icon"><i class="fa-solid fa-id-card"></i></div>
              <div class="upload-zone-title">Parent / Guardian ID</div>
              <div class="upload-zone-hint">PDF, JPG or PNG — max 2MB</div>
              <div class="upload-file-name" id="parentIdName"></div>
            </div>

            <div class="upload-zone" data-upload="immunisation">
              <input type="file" id="immunisation" name="immunisation" accept=".pdf,.jpg,.jpeg,.png">
              <div class="upload-zone-icon"><i class="fa-solid fa-syringe"></i></div>
              <div class="upload-zone-title">Immunisation Record</div>
              <div class="upload-zone-hint">For nursery / primary applicants. PDF, JPG or PNG — max 2MB</div>
              <div class="upload-file-name" id="immunisationName"></div>
            </div>
          </div>
        </div>

        {{-- Step 5: Review & Submit --}}
        <div class="apply-step" data-step="5">
          <h2 class="section-title" style="font-size:1.5rem;margin-bottom:8px;">Review & Submit</h2>
          <p class="section-subtitle" style="margin-bottom:28px;">Please review your information before submitting.</p>

          <div id="reviewContainer">
            {{-- Populated by JS --}}
          </div>

          <div class="divider"></div>

          <label class="form-check" style="margin-bottom:24px;">
            <input type="checkbox" id="agreement" name="agreement" required>
            <span class="form-check-label">I confirm that all information provided is accurate and complete to the best of
              my knowledge. I understand that providing false information may result in the rejection of this
              application.</span>
          </label>
          <div class="error-msg" id="agreementError" style="margin-top:-12px;margin-bottom:16px;">You must agree before
            submitting.</div>
        </div>

        {{-- Step Actions --}}
        <div class="step-actions">
          <button type="button" class="btn btn-ghost btn-md" id="btnPrev" style="display:none;">
            <i class="fa-solid fa-arrow-left" style="margin-right:6px;"></i> Back
          </button>
          <div class="step-actions-right" style="margin-left:auto;">
            <button type="button" class="btn btn-outline btn-md" id="btnSave">Save Progress</button>
            <button type="button" class="btn btn-primary btn-md" id="btnNext">Continue <i class="fa-solid fa-arrow-right"
                style="margin-left:6px;"></i></button>
            <button type="submit" class="btn btn-gold btn-md" id="btnSubmit" style="display:none;">
              Submit Application <i class="fa-solid fa-paper-plane" style="margin-left:6px;"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </section>

  {{-- Success Modal --}}
  <div class="modal-overlay" id="successModal" role="dialog" aria-modal="true" aria-label="Application submitted">
    <div class="modal-box">
      <div class="modal-icon"><i class="fa-solid fa-check"></i></div>
      <h2 class="modal-title">Application Received!</h2>
      <p class="modal-desc">Thank you for applying to Royal Ark Schools. We have sent a confirmation email to <strong
          id="confirmEmail">your email</strong>.</p>
      <div class="ref-number" id="refNumber">RAC-2025-XXXXX</div>
      <p class="modal-desc" style="font-size:var(--text-sm);margin-top:-12px;">We will contact you within 3–5 working
        days.</p>
      <div class="modal-actions">
        <button type="button" class="btn btn-royal btn-md" id="btnCopyRef"><i class="fa-solid fa-copy"
            style="margin-right:6px;"></i> Copy Ref.</button>
        <a href="{{ route('home') }}" class="btn btn-primary btn-md">Back to Home</a>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
  <script src="/landing/js/apply.js"></script>
@endpush