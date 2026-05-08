/* ============================================================
   ROYAL ARK SCHOOLS — Apply Page JavaScript
   Multi-step form, validation, file upload, review & submit
   ============================================================ */

(function () {
  'use strict';

  const form = document.getElementById('applyForm');
  if (!form) return;

  const steps = Array.from(document.querySelectorAll('.apply-step'));
  const progressSteps = Array.from(document.querySelectorAll('.progress-step'));
  const progressFill = document.getElementById('progressFill');
  const btnPrev = document.getElementById('btnPrev');
  const btnNext = document.getElementById('btnNext');
  const btnSave = document.getElementById('btnSave');
  const btnSubmit = document.getElementById('btnSubmit');
  const successModal = document.getElementById('successModal');
  const reviewContainer = document.getElementById('reviewContainer');
  const refNumber = document.getElementById('refNumber');
  const confirmEmail = document.getElementById('confirmEmail');

  let currentStep = 1;
  const totalSteps = steps.length;

  /* ── Step Navigation ── */
  function showStep(n) {
    steps.forEach((s, i) => {
      s.classList.toggle('active', i + 1 === n);
    });
    progressSteps.forEach((ps, i) => {
      ps.classList.remove('active', 'completed');
      if (i + 1 < n) ps.classList.add('completed');
      if (i + 1 === n) ps.classList.add('active');
    });
    // Update bubble icons
    progressSteps.forEach((ps, i) => {
      const bubble = ps.querySelector('.step-bubble');
      if (i + 1 < n) {
        bubble.innerHTML = '<i class="fa-solid fa-check"></i>';
      } else {
        bubble.innerHTML = '<i class="fa-solid fa-' + (i + 1) + '"></i>';
      }
    });
    const pct = ((n - 1) / (totalSteps - 1)) * 100;
    progressFill.style.width = pct + '%';

    btnPrev.style.display = n === 1 ? 'none' : 'inline-flex';
    btnNext.style.display = n === totalSteps ? 'none' : 'inline-flex';
    btnSubmit.style.display = n === totalSteps ? 'inline-flex' : 'none';

    if (n === totalSteps) buildReview();
  }

  function validateStep(n) {
    const step = steps[n - 1];
    const required = step.querySelectorAll('[required]');
    let valid = true;

    required.forEach(field => {
      field.classList.remove('error');
      const err = field.closest('.form-group')?.querySelector('.error-msg');
      if (err) err.classList.remove('show');

      if (!field.value.trim() || (field.type === 'checkbox' && !field.checked)) {
        valid = false;
        field.classList.add('error');
        if (err) err.classList.add('show');
      }
      if (field.type === 'email' && field.value.trim()) {
        const emailRx = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRx.test(field.value.trim())) {
          valid = false;
          field.classList.add('error');
          if (err) err.classList.add('show');
        }
      }
    });

    if (n === 4) {
      // Birth cert & passport photo required
      const bc = document.getElementById('birthCert');
      const pp = document.getElementById('passportPhoto');
      if (!bc.files.length) {
        valid = false;
        bc.closest('.upload-zone').style.borderColor = 'var(--danger)';
      } else {
        bc.closest('.upload-zone').style.borderColor = '';
      }
      if (!pp.files.length) {
        valid = false;
        pp.closest('.upload-zone').style.borderColor = 'var(--danger)';
      } else {
        pp.closest('.upload-zone').style.borderColor = '';
      }
    }

    return valid;
  }

  btnNext.addEventListener('click', () => {
    if (validateStep(currentStep)) {
      currentStep++;
      showStep(currentStep);
    }
  });

  btnPrev.addEventListener('click', () => {
    if (currentStep > 1) {
      currentStep--;
      showStep(currentStep);
    }
  });

  /* ── Special Needs Toggle ── */
  document.querySelectorAll('.toggle-btn[data-need]').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.toggle-btn[data-need]').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const val = btn.dataset.need;
      document.getElementById('specialNeeds').value = val;
      document.getElementById('specialNeedsDetailGroup').style.display = val === 'yes' ? 'block' : 'none';
    });
  });

  /* ── File Uploads ── */
  document.querySelectorAll('.upload-zone input[type="file"]').forEach(input => {
    const zone = input.closest('.upload-zone');
    const nameEl = zone.querySelector('.upload-file-name');

    zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('dragover'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
    zone.addEventListener('drop', e => {
      e.preventDefault();
      zone.classList.remove('dragover');
      if (e.dataTransfer.files.length) {
        input.files = e.dataTransfer.files;
        updateFileDisplay(zone, input.files[0]);
      }
    });
    input.addEventListener('change', () => {
      if (input.files.length) updateFileDisplay(zone, input.files[0]);
    });
  });

  function updateFileDisplay(zone, file) {
    const nameEl = zone.querySelector('.upload-file-name');
    const size = (file.size / 1024 / 1024).toFixed(2);
    nameEl.textContent = file.name + ' (' + size + ' MB)';
    zone.classList.add('has-file');
    zone.style.borderColor = '';
  }

  /* ── Build Review ── */
  function buildReview() {
    const fields = {
      'Student Information': [
        { label: 'First Name', id: 'sFirstName' },
        { label: 'Last Name', id: 'sLastName' },
        { label: 'Date of Birth', id: 'sDob' },
        { label: 'Gender', id: 'sGender' },
        { label: 'Class Applying For', id: 'sClass' },
        { label: 'Previous Class', id: 'sPrevClass' },
        { label: 'Nationality', id: 'sNationality' },
        { label: 'State of Origin', id: 'sState' },
      ],
      'Parent / Guardian Information': [
        { label: 'Full Name', id: 'pFullName' },
        { label: 'Relationship', id: 'pRelationship' },
        { label: 'Occupation', id: 'pOccupation' },
        { label: 'Phone', id: 'pPhone' },
        { label: 'Email', id: 'pEmail' },
        { label: 'Home Address', id: 'pAddress' },
        { label: 'Emergency Contact', id: 'eName' },
        { label: 'Emergency Phone', id: 'ePhone' },
      ],
      'Previous School': [
        { label: 'Previous School', id: 'prevSchoolName' },
        { label: 'School Address', id: 'prevSchoolAddress' },
        { label: 'Last Class Completed', id: 'prevClass' },
        { label: 'Reason for Leaving', id: 'prevReason' },
        { label: 'Special Needs', fn: () => {
          const v = document.getElementById('specialNeeds').value;
          if (!v) return 'Not specified';
          const d = document.getElementById('specialNeedsDetail').value;
          return v === 'yes' ? 'Yes — ' + (d || 'Details provided') : 'No';
        }},
      ],
      'Documents': [
        { label: 'Birth Certificate', fn: () => fileStatus('birthCert') },
        { label: 'Passport Photo', fn: () => fileStatus('passportPhoto') },
        { label: 'Report Card', fn: () => fileStatus('reportCard') },
        { label: 'Parent ID', fn: () => fileStatus('parentId') },
        { label: 'Immunisation Record', fn: () => fileStatus('immunisation') },
      ],
    };

    let html = '';
    for (const [section, items] of Object.entries(fields)) {
      html += '<div class="review-block">';
      html += '<div class="review-header">';
      html += '<h3>' + section + '</h3>';
      html += '<button type="button" class="review-edit" data-goto="' + Object.keys(fields).indexOf(section) + '">Edit</button>';
      html += '</div>';
      html += '<table class="review-table">';
      for (const item of items) {
        let val = '';
        if (item.fn) {
          val = item.fn();
        } else {
          const el = document.getElementById(item.id);
          val = el ? (el.value || '—') : '—';
        }
        html += '<tr><td>' + item.label + '</td><td>' + val + '</td></tr>';
      }
      html += '</table></div>';
    }
    reviewContainer.innerHTML = html;

    // Wire edit buttons
    reviewContainer.querySelectorAll('.review-edit').forEach(btn => {
      btn.addEventListener('click', () => {
        const idx = parseInt(btn.dataset.goto) + 1;
        currentStep = idx;
        showStep(currentStep);
      });
    });
  }

  function fileStatus(id) {
    const el = document.getElementById(id);
    return el && el.files.length ? '<span style="color:var(--success);font-weight:700;"><i class="fa-solid fa-check"></i> Uploaded</span>' : '—';
  }

  /* ── Save Progress Toast ── */
  btnSave.addEventListener('click', () => {
    const data = {};
    form.querySelectorAll('input, select, textarea').forEach(el => {
      if (el.name) data[el.name] = el.value;
    });
    localStorage.setItem('royalArkApply', JSON.stringify(data));
    showToast('Progress saved. You can resume later.', 'success');
  });

  /* ── Restore Progress ── */
  (function restore() {
    const saved = localStorage.getItem('royalArkApply');
    if (!saved) return;
    const data = JSON.parse(saved);
    Object.entries(data).forEach(([name, value]) => {
      const el = form.querySelector('[name="' + name + '"]');
      if (el && value) el.value = value;
    });
  })();

  /* ── Submit ── */
  form.addEventListener('submit', e => {
    e.preventDefault();
    const agreement = document.getElementById('agreement');
    const agreementErr = document.getElementById('agreementError');
    if (!agreement.checked) {
      agreementErr.classList.add('show');
      return;
    }
    agreementErr.classList.remove('show');

    btnSubmit.classList.add('btn-loading');
    btnSubmit.disabled = true;

    setTimeout(() => {
      btnSubmit.classList.remove('btn-loading');
      btnSubmit.disabled = false;

      const email = document.getElementById('pEmail').value;
      confirmEmail.textContent = email || 'your email';

      const ref = 'RAC-2025-' + Math.random().toString(36).substr(2, 5).toUpperCase();
      refNumber.textContent = ref;

      successModal.classList.add('open');
      document.body.style.overflow = 'hidden';
      localStorage.removeItem('royalArkApply');
    }, 1500);
  });

  /* ── Copy Ref Number ── */
  document.getElementById('btnCopyRef')?.addEventListener('click', () => {
    navigator.clipboard.writeText(refNumber.textContent);
    showToast('Reference number copied!', 'success');
  });

  /* ── Modal Close ── */
  successModal.addEventListener('click', e => {
    if (e.target === successModal) {
      successModal.classList.remove('open');
      document.body.style.overflow = '';
    }
  });

  /* ── Clear error on input ── */
  form.querySelectorAll('.form-control').forEach(el => {
    el.addEventListener('input', () => {
      el.classList.remove('error');
      const err = el.closest('.form-group')?.querySelector('.error-msg');
      if (err) err.classList.remove('show');
    });
  });

  /* ── Toast Helper ── */
  function showToast(message, type = 'info') {
    const stack = document.querySelector('.toast-stack');
    if (!stack) return;
    const toast = document.createElement('div');
    toast.className = 'toast ' + type;
    const icons = { success: 'fa-circle-check', info: 'fa-circle-info', warning: 'fa-triangle-exclamation', danger: 'fa-circle-xmark' };
    toast.innerHTML = '<span class="toast-icon"><i class="fa-solid ' + (icons[type] || icons.info) + '"></i></span><span>' + message + '</span>';
    stack.appendChild(toast);
    requestAnimationFrame(() => toast.classList.add('show'));
    setTimeout(() => {
      toast.classList.remove('show');
      setTimeout(() => toast.remove(), 300);
    }, 4000);
  }

})();
