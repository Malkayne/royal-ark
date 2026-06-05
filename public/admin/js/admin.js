/* ============================================================
   ROYAL ARK COLLEGE — Admin Dashboard JavaScript
   "Royalty in Excellence" · Internal Management System
   ============================================================ */

'use strict';

/* ══════════════════════════════════════════════════════════
   1. SIDEBAR
══════════════════════════════════════════════════════════ */
const Sidebar = {
  shell: null,
  sidebar: null,
  overlay: null,
  STORAGE_KEY: 'rac_sidebar_collapsed',

  isMobile: () => window.innerWidth <= 1024,

  init() {
    this.shell   = document.querySelector('.admin-shell');
    this.sidebar = document.querySelector('.admin-sidebar');
    this.overlay = document.querySelector('.sidebar-overlay');
    if (!this.shell || !this.sidebar) return;

    // Restore collapsed state on desktop
    if (!this.isMobile() && localStorage.getItem(this.STORAGE_KEY) === 'true') {
      this.shell.classList.add('sidebar-collapsed');
    }

    // Toggle button
    document.querySelector('.topbar-toggle')
      ?.addEventListener('click', () => this.toggle());

    // Overlay click closes on mobile
    this.overlay?.addEventListener('click', () => this.closeMobile());

    // Resize handler
    window.addEventListener('resize', () => this.onResize());

    // Subnav init
    this.initSubnavs();

    // Active item from URL
    this.setActiveFromURL();
  },

  toggle() {
    if (this.isMobile()) {
      this.sidebar.classList.toggle('mobile-open');
      this.overlay?.classList.toggle('open');
      document.body.style.overflow = this.sidebar.classList.contains('mobile-open') ? 'hidden' : '';
    } else {
      this.shell.classList.toggle('sidebar-collapsed');
      localStorage.setItem(
        this.STORAGE_KEY,
        this.shell.classList.contains('sidebar-collapsed')
      );
      // Close all open subnavs when collapsing
      if (this.shell.classList.contains('sidebar-collapsed')) {
        document.querySelectorAll('.nav-subnav.open').forEach(s => {
          s.classList.remove('open');
          s.previousElementSibling?.classList.remove('open');
        });
      }
    }
  },

  closeMobile() {
    this.sidebar.classList.remove('mobile-open');
    this.overlay?.classList.remove('open');
    document.body.style.overflow = '';
  },

  onResize() {
    if (!this.isMobile()) {
      this.sidebar.classList.remove('mobile-open');
      this.overlay?.classList.remove('open');
      document.body.style.overflow = '';
    }
  },

  initSubnavs() {
    document.querySelectorAll('.nav-parent-trigger').forEach(trigger => {
      trigger.addEventListener('click', () => {
        if (this.shell.classList.contains('sidebar-collapsed')) return;
        const subnav = trigger.nextElementSibling;
        if (!subnav?.classList.contains('nav-subnav')) return;
        const isOpen = subnav.classList.contains('open');
        // Close others
        document.querySelectorAll('.nav-subnav.open').forEach(s => {
          s.classList.remove('open');
          s.previousElementSibling?.classList.remove('open');
        });
        if (!isOpen) {
          subnav.classList.add('open');
          trigger.classList.add('open');
        }
      });
    });
  },

  setActiveFromURL() {
    const path = window.location.pathname;
    const allLinks = document.querySelectorAll(
      '.nav-item[href], .nav-sub-item[href], .nav-parent-trigger[href]'
    );
    allLinks.forEach(link => {
      const href = link.getAttribute('href') || '';
      if (href && path.endsWith(href.replace(/^\.\.\//, '').replace(/^\.\//, ''))) {
        link.classList.add('active');
        // If it's a sub-item, open parent subnav
        const subnav = link.closest('.nav-subnav');
        if (subnav) {
          subnav.classList.add('open');
          const trigger = subnav.previousElementSibling;
          trigger?.classList.add('open', 'has-active');
        }
      }
    });
  }
};

/* ══════════════════════════════════════════════════════════
   2. TOPBAR — BREADCRUMB & DROPDOWNS
══════════════════════════════════════════════════════════ */
const Topbar = {
  init() {
    this.initDropdowns();
    this.initNotifDropdown();
    this.initUserDropdown();
  },

  initDropdowns() {
    // Close all dropdowns on outside click
    document.addEventListener('click', e => {
      if (!e.target.closest('.dropdown-wrapper')) {
        document.querySelectorAll('.notif-dropdown.open, .user-dropdown.open')
          .forEach(d => d.classList.remove('open'));
      }
    });
  },

  initNotifDropdown() {
    const trigger = document.querySelector('[data-notif-trigger]');
    const dropdown = document.querySelector('.notif-dropdown');
    if (!trigger || !dropdown) return;

    trigger.addEventListener('click', e => {
      e.stopPropagation();
      const isOpen = dropdown.classList.contains('open');
      document.querySelectorAll('.notif-dropdown.open, .user-dropdown.open')
        .forEach(d => d.classList.remove('open'));
      if (!isOpen) dropdown.classList.add('open');
    });

    // Mark all read
    document.querySelector('.notif-mark-all')?.addEventListener('click', () => {
      document.querySelectorAll('.notif-item.unread').forEach(item => {
        item.classList.remove('unread');
      });
      const badge = document.querySelector('[data-notif-trigger] .topbar-badge');
      if (badge) badge.remove();
      Toast.show('All notifications marked as read', 'success');
    });

    // Individual mark read on click
    document.querySelectorAll('.notif-item').forEach(item => {
      item.addEventListener('click', () => item.classList.remove('unread'));
    });
  },

  initUserDropdown() {
    const trigger = document.querySelector('[data-user-trigger]');
    const dropdown = document.querySelector('.user-dropdown');
    if (!trigger || !dropdown) return;

    trigger.addEventListener('click', e => {
      e.stopPropagation();
      const isOpen = dropdown.classList.contains('open');
      document.querySelectorAll('.notif-dropdown.open, .user-dropdown.open')
        .forEach(d => d.classList.remove('open'));
      if (!isOpen) dropdown.classList.add('open');
    });
  }
};

/* ══════════════════════════════════════════════════════════
   3. NOTICE BAR
══════════════════════════════════════════════════════════ */
const NoticeBars = {
  init() {
    document.querySelectorAll('.notice-bar-close').forEach(btn => {
      btn.addEventListener('click', () => {
        const bar = btn.closest('.notice-bar');
        if (!bar) return;
        bar.style.maxHeight = bar.scrollHeight + 'px';
        requestAnimationFrame(() => {
          bar.style.transition = 'max-height 0.3s ease, padding 0.3s ease, opacity 0.3s ease';
          bar.style.maxHeight = '0';
          bar.style.paddingTop = '0';
          bar.style.paddingBottom = '0';
          bar.style.opacity = '0';
          bar.style.overflow = 'hidden';
        });
        setTimeout(() => bar.remove(), 340);
      });
    });
  }
};

/* ══════════════════════════════════════════════════════════
   4. MODAL SYSTEM
══════════════════════════════════════════════════════════ */
const Modal = {
  _stack: [],

  open(id, options = {}) {
    const backdrop = document.getElementById(id);
    if (!backdrop) return;
    backdrop.classList.add('open');
    document.body.style.overflow = 'hidden';
    this._stack.push(id);

    // Auto-focus first focusable element
    setTimeout(() => {
      const focusable = backdrop.querySelector(
        'input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), [tabindex="0"]'
      );
      focusable?.focus();
    }, 100);

    // Run open callback
    options.onOpen?.();
  },

  close(id) {
    const backdrop = document.getElementById(id);
    if (!backdrop) return;
    backdrop.classList.remove('open');
    this._stack = this._stack.filter(s => s !== id);
    if (this._stack.length === 0) document.body.style.overflow = '';
  },

  closeAll() {
    document.querySelectorAll('.modal-backdrop.open').forEach(b => b.classList.remove('open'));
    this._stack = [];
    document.body.style.overflow = '';
  },

  init() {
    // [data-modal-open] triggers
    document.addEventListener('click', e => {
      const opener = e.target.closest('[data-modal-open]');
      if (opener) {
        e.preventDefault();
        this.open(opener.dataset.modalOpen);
        return;
      }
      // [data-modal-close] triggers
      const closer = e.target.closest('[data-modal-close]');
      if (closer) {
        e.preventDefault();
        this.close(closer.dataset.modalClose);
        return;
      }
      // Backdrop click
      if (e.target.classList.contains('modal-backdrop')) {
        this.close(e.target.id);
      }
    });

    // Escape key
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape' && this._stack.length > 0) {
        this.close(this._stack[this._stack.length - 1]);
      }
    });
  }
};

/* ══════════════════════════════════════════════════════════
   5. CONFIRM DIALOG
══════════════════════════════════════════════════════════ */
function confirmAction(message, onConfirm, options = {}) {
  const {
    type = 'danger',         // 'danger' | 'warning'
    confirmLabel = 'Confirm',
    cancelLabel = 'Cancel',
    subtitle = ''
  } = options;

  const modal = document.getElementById('confirmModal');
  if (!modal) {
    if (window.confirm(message)) onConfirm();
    return;
  }

  // Set content
  const titleEl    = modal.querySelector('.confirm-title');
  const msgEl      = modal.querySelector('.confirm-message');
  const subtitleEl = modal.querySelector('.confirm-subtitle');
  const okBtn      = modal.querySelector('#confirmOkBtn');
  const header     = modal.querySelector('.modal-header');

  if (titleEl) titleEl.textContent = type === 'danger' ? '⚠ Confirm Action' : '💬 Confirm';
  if (msgEl) msgEl.textContent = message;
  if (subtitleEl) subtitleEl.textContent = subtitle;

  if (header) {
    header.classList.remove('danger-header', 'warning-header');
    if (type === 'danger') header.classList.add('danger-header');
    if (type === 'warning') header.classList.add('warning-header');
  }

  if (okBtn) {
    okBtn.textContent = confirmLabel;
    okBtn.className = `btn btn-md ${type === 'danger' ? 'btn-danger' : 'btn-warning'}`;

    // Fresh event listener
    const newBtn = okBtn.cloneNode(true);
    okBtn.parentNode.replaceChild(newBtn, okBtn);
    newBtn.textContent = confirmLabel;
    newBtn.className = `btn btn-md ${type === 'danger' ? 'btn-danger' : 'btn-warning'}`;
    newBtn.addEventListener('click', () => {
      Modal.close('confirmModal');
      onConfirm();
    });
  }

  Modal.open('confirmModal');
}
window.confirmAction = confirmAction;

/* ══════════════════════════════════════════════════════════
   6. TOAST SYSTEM
══════════════════════════════════════════════════════════ */
const Toast = {
  container: null,
  MAX: 4,
  DURATION: { success: 4000, info: 4000, warning: 6000, danger: 6000 },
  ICONS: {
    success: 'fas fa-check-circle',
    warning: 'fas fa-exclamation-triangle',
    danger:  'fas fa-times-circle',
    info:    'fas fa-info-circle'
  },

  init() {
    this.container = document.querySelector('.toast-stack');
    if (!this.container) {
      this.container = document.createElement('div');
      this.container.className = 'toast-stack';
      document.body.appendChild(this.container);
    }
  },

  show(message, type = 'success', sub = '', duration) {
    const dur = duration ?? this.DURATION[type] ?? 4000;

    // Limit stack
    const existing = this.container.querySelectorAll('.toast');
    if (existing.length >= this.MAX) {
      existing[0].remove();
    }

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `
      <i class="${this.ICONS[type] || 'fas fa-bell'}"></i>
      <div class="toast-text">
        <span class="toast-msg">${message}</span>
        ${sub ? `<span class="toast-sub">${sub}</span>` : ''}
      </div>
      <button class="toast-close" aria-label="Dismiss"><i class="fas fa-times"></i></button>
      <div class="toast-progress" style="animation-duration:${dur}ms;"></div>
    `;

    this.container.appendChild(toast);
    requestAnimationFrame(() => requestAnimationFrame(() => toast.classList.add('show')));

    // Dismiss button
    toast.querySelector('.toast-close').addEventListener('click', () => this._dismiss(toast));

    // Pause on hover
    let timer = setTimeout(() => this._dismiss(toast), dur);
    toast.addEventListener('mouseenter', () => {
      clearTimeout(timer);
      toast.querySelector('.toast-progress').style.animationPlayState = 'paused';
    });
    toast.addEventListener('mouseleave', () => {
      toast.querySelector('.toast-progress').style.animationPlayState = 'running';
      timer = setTimeout(() => this._dismiss(toast), 1500);
    });
  },

  _dismiss(toast) {
    toast.classList.remove('show');
    setTimeout(() => toast.remove(), 320);
  }
};
window.Toast = Toast;

/* ══════════════════════════════════════════════════════════
   7. INLINE ALERT DISMISS
══════════════════════════════════════════════════════════ */
const Alerts = {
  init() {
    document.addEventListener('click', e => {
      const btn = e.target.closest('.alert-dismiss');
      if (!btn) return;
      const alert = btn.closest('.alert');
      if (!alert) return;
      alert.style.transition = 'opacity 0.2s ease, max-height 0.3s ease, margin 0.3s ease, padding 0.3s ease';
      alert.style.opacity = '0';
      alert.style.overflow = 'hidden';
      const h = alert.scrollHeight;
      alert.style.maxHeight = h + 'px';
      requestAnimationFrame(() => {
        alert.style.maxHeight = '0';
        alert.style.marginBottom = '0';
        alert.style.paddingTop = '0';
        alert.style.paddingBottom = '0';
      });
      setTimeout(() => alert.remove(), 320);
    });
  }
};

/* ══════════════════════════════════════════════════════════
   8. TABLE SYSTEM
══════════════════════════════════════════════════════════ */
const Tables = {
  init() {
    this.initCheckboxes();
    this.initSort();
    this.initSearch();
    this.initActionMenus();
    this.initMobileLabels();
  },

  // ── Checkboxes & Bulk Selection ──
  initCheckboxes() {
    document.querySelectorAll('.admin-table').forEach(table => {
      const masterCb = table.querySelector('thead .row-check');
      if (!masterCb) return;

      masterCb.addEventListener('change', () => {
        table.querySelectorAll('tbody .row-check')
          .forEach(cb => {
            cb.checked = masterCb.checked;
            cb.closest('tr')?.classList.toggle('selected', masterCb.checked);
          });
        this._updateBulkBar(table);
      });

      table.querySelectorAll('tbody .row-check').forEach(cb => {
        cb.addEventListener('change', () => {
          cb.closest('tr')?.classList.toggle('selected', cb.checked);
          const all  = table.querySelectorAll('tbody .row-check');
          const checked = table.querySelectorAll('tbody .row-check:checked');
          masterCb.indeterminate = checked.length > 0 && checked.length < all.length;
          masterCb.checked = checked.length === all.length;
          this._updateBulkBar(table);
        });
      });
    });
  },

  _updateBulkBar(table) {
    const tableId = table.id || table.dataset.tableId;
    const bar = document.querySelector(`[data-bulk-bar="${tableId}"]`);
    if (!bar) return;
    const count = table.querySelectorAll('tbody .row-check:checked').length;
    bar.classList.toggle('visible', count > 0);
    const countEl = bar.querySelector('.bulk-count');
    if (countEl) countEl.textContent = `${count} row${count !== 1 ? 's' : ''} selected`;
  },

  getSelectedIds(tableId) {
    const table = document.getElementById(tableId);
    if (!table) return [];
    return Array.from(table.querySelectorAll('tbody .row-check:checked'))
      .map(cb => cb.closest('tr')?.dataset.id || cb.dataset.id)
      .filter(Boolean);
  },

  // ── Column Sort ──
  initSort() {
    document.querySelectorAll('th.sortable').forEach(th => {
      th.style.cursor = 'pointer';
      if (!th.querySelector('.sort-icon')) {
        th.insertAdjacentHTML('beforeend', ' <i class="fas fa-sort sort-icon"></i>');
      }

      th.addEventListener('click', () => {
        const table = th.closest('table');
        const tbody = table?.querySelector('tbody');
        if (!tbody) return;

        const col   = Array.from(th.parentElement.children).indexOf(th);
        const isAsc = th.dataset.dir !== 'asc';

        // Reset all
        table.querySelectorAll('th.sortable').forEach(t => {
          t.dataset.dir = '';
          t.classList.remove('asc', 'desc');
          const icon = t.querySelector('.sort-icon');
          if (icon) icon.className = 'fas fa-sort sort-icon';
        });

        th.dataset.dir = isAsc ? 'asc' : 'desc';
        th.classList.add(isAsc ? 'asc' : 'desc');
        const icon = th.querySelector('.sort-icon');
        if (icon) icon.className = `fas fa-sort-${isAsc ? 'up' : 'down'} sort-icon`;

        const rows = Array.from(tbody.querySelectorAll('tr'));
        rows.sort((a, b) => {
          const av = a.cells[col]?.textContent.trim() || '';
          const bv = b.cells[col]?.textContent.trim() || '';
          // Numeric sort if both look like numbers
          const an = parseFloat(av.replace(/[^0-9.-]/g, ''));
          const bn = parseFloat(bv.replace(/[^0-9.-]/g, ''));
          if (!isNaN(an) && !isNaN(bn)) {
            return isAsc ? an - bn : bn - an;
          }
          return isAsc
            ? av.localeCompare(bv, undefined, { sensitivity: 'base' })
            : bv.localeCompare(av, undefined, { sensitivity: 'base' });
        });
        rows.forEach(r => tbody.appendChild(r));
      });
    });
  },

  // ── Live Search ──
  initSearch() {
    document.querySelectorAll('[data-search-table]').forEach(input => {
      input.addEventListener('input', () => {
        const tableId = input.dataset.searchTable;
        const table   = document.getElementById(tableId);
        if (!table) return;
        const q = input.value.toLowerCase().trim();
        let visible = 0;

        table.querySelectorAll('tbody tr').forEach(row => {
          const match = row.textContent.toLowerCase().includes(q);
          row.style.display = match ? '' : 'none';
          if (match) visible++;
        });

        // Show empty state
        const emptyState = table.parentElement.querySelector('.empty-state');
        if (emptyState) emptyState.style.display = visible === 0 ? 'block' : 'none';

        // Update count text
        const countEl = document.querySelector(`[data-table-count="${tableId}"]`);
        if (countEl) {
          const total = table.querySelectorAll('tbody tr').length;
          countEl.textContent = q ? `${visible} of ${total}` : total;
        }
      });
    });
  },

  // ── Action Menus (•••) ──
  initActionMenus() {
    document.addEventListener('click', e => {
      const btn = e.target.closest('.action-menu-btn');
      if (btn) {
        e.stopPropagation();
        const menu = btn.nextElementSibling;
        if (!menu?.classList.contains('action-menu-dropdown')) return;
        const isOpen = menu.classList.contains('open');
        // Close all
        document.querySelectorAll('.action-menu-dropdown.open')
          .forEach(m => m.classList.remove('open'));
        if (!isOpen) menu.classList.add('open');
        return;
      }
      // Close on outside click
      if (!e.target.closest('.action-menu')) {
        document.querySelectorAll('.action-menu-dropdown.open')
          .forEach(m => m.classList.remove('open'));
      }
    });
  },

  // ── Mobile: inject data-label from thead ──
  initMobileLabels() {
    document.querySelectorAll('.admin-table').forEach(table => {
      const headers = Array.from(table.querySelectorAll('thead th'))
        .map(th => th.textContent.replace(/[↑↓⇅]/g, '').trim());

      table.querySelectorAll('tbody td').forEach(td => {
        const colIndex = Array.from(td.parentElement.children).indexOf(td);
        if (!td.hasAttribute('data-label') && headers[colIndex]) {
          td.setAttribute('data-label', headers[colIndex]);
        }
      });
    });
  }
};
window.Tables = Tables;

/* ══════════════════════════════════════════════════════════
   9. PAGINATION
══════════════════════════════════════════════════════════ */
function initPagination(tableId, rowsPerPage = 15) {
  const table = document.getElementById(tableId);
  if (!table) return;

  const pagEl = document.querySelector(`[data-pagination="${tableId}"]`);
  if (!pagEl) return;

  const allRows = () => Array.from(table.querySelectorAll('tbody tr'));
  let currentPage = 1;

  function visibleRows() {
    return allRows().filter(r => r.style.display !== 'none');
  }

  function render() {
    const rows  = visibleRows();
    const total = Math.ceil(rows.length / rowsPerPage);
    currentPage = Math.min(currentPage, total || 1);

    rows.forEach((r, i) => {
      const inPage = i >= (currentPage - 1) * rowsPerPage && i < currentPage * rowsPerPage;
      r.style.display = inPage ? '' : 'none';
    });

    // Update count text
    const countEl = pagEl.parentElement?.querySelector('.page-info');
    if (countEl) {
      const start = (currentPage - 1) * rowsPerPage + 1;
      const end   = Math.min(currentPage * rowsPerPage, rows.length);
      countEl.textContent = `Showing ${rows.length ? start : 0}–${end} of ${rows.length}`;
    }

    if (total <= 1) { pagEl.innerHTML = ''; return; }

    pagEl.innerHTML = '';

    // Prev
    const prev = _pageBtn('<i class="fas fa-chevron-left"></i>', currentPage === 1);
    prev.addEventListener('click', () => { currentPage--; render(); });
    pagEl.appendChild(prev);

    // Page numbers (smart truncation)
    const pages = _smartPageRange(currentPage, total);
    pages.forEach(p => {
      if (p === '…') {
        const ellipsis = document.createElement('button');
        ellipsis.className = 'page-btn';
        ellipsis.textContent = '…';
        ellipsis.disabled = true;
        pagEl.appendChild(ellipsis);
      } else {
        const btn = _pageBtn(p, false, p === currentPage);
        btn.addEventListener('click', () => { currentPage = p; render(); });
        pagEl.appendChild(btn);
      }
    });

    // Next
    const next = _pageBtn('<i class="fas fa-chevron-right"></i>', currentPage === total);
    next.addEventListener('click', () => { currentPage++; render(); });
    pagEl.appendChild(next);
  }

  function _pageBtn(content, disabled, active = false) {
    const btn = document.createElement('button');
    btn.className = `page-btn${active ? ' active' : ''}`;
    btn.innerHTML = content;
    btn.disabled = disabled;
    return btn;
  }

  function _smartPageRange(cur, total) {
    if (total <= 7) return Array.from({ length: total }, (_, i) => i + 1);
    if (cur <= 4)  return [1, 2, 3, 4, 5, '…', total];
    if (cur >= total - 3) return [1, '…', total-4, total-3, total-2, total-1, total];
    return [1, '…', cur - 1, cur, cur + 1, '…', total];
  }

  render();

  // Re-render when search filters rows
  const searchInput = document.querySelector(`[data-search-table="${tableId}"]`);
  searchInput?.addEventListener('input', () => { currentPage = 1; render(); });

  return { render, goTo: (p) => { currentPage = p; render(); } };
}
window.initPagination = initPagination;

/* ══════════════════════════════════════════════════════════
   10. ADMIN TABS
══════════════════════════════════════════════════════════ */
const Tabs = {
  init(container) {
    const root = container || document;
    root.querySelectorAll('.admin-tab').forEach(tab => {
      tab.addEventListener('click', () => {
        const group = tab.closest('[data-tab-group]')
          || tab.closest('.card')
          || tab.parentElement.parentElement;

        group.querySelectorAll('.admin-tab').forEach(t => t.classList.remove('active'));
        group.querySelectorAll('.admin-tab-panel').forEach(p => p.classList.remove('active'));

        tab.classList.add('active');
        const panel = group.querySelector(`#${tab.dataset.tab}`);
        if (panel) panel.classList.add('active');
      });
    });

    // Pill tabs
    root.querySelectorAll('.pill-tab').forEach(tab => {
      tab.addEventListener('click', () => {
        const group = tab.closest('[data-pill-group]') || tab.parentElement;
        group.querySelectorAll('.pill-tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        // Filter support
        const target = tab.dataset.filter;
        if (target) filterByCategory(target, tab.dataset.filterTarget);
      });
    });
  }
};

/* ══════════════════════════════════════════════════════════
   11. TOGGLE SWITCHES
══════════════════════════════════════════════════════════ */
const Toggles = {
  init() {
    // Admissions master toggle — needs confirm
    const admissionsToggle = document.querySelector('[data-admissions-toggle]');
    admissionsToggle?.addEventListener('change', function () {
      const willOpen = this.checked;
      const label = willOpen ? 'open' : 'close';
      const original = this.checked;

      // Revert immediately, let confirm decide
      this.checked = !willOpen;

      confirmAction(
        `Are you sure you want to ${label} admissions? This will update the public website immediately.`,
        () => {
          this.checked = willOpen;
          const statusEl = document.querySelector('[data-admissions-status]');
          if (statusEl) {
            statusEl.textContent = willOpen ? 'OPEN' : 'CLOSED';
            statusEl.className   = willOpen
              ? 'admissions-status-open fw-700'
              : 'admissions-status-closed fw-700';
          }
          const banner = document.querySelector('.admission-status-banner');
          if (banner) {
            banner.classList.toggle('open',   willOpen);
            banner.classList.toggle('closed', !willOpen);
          }
          Toast.show(
            `Admissions ${willOpen ? 'opened' : 'closed'} successfully.`,
            'success',
            'Public website updated.'
          );
        },
        {
          type: willOpen ? 'warning' : 'danger',
          confirmLabel: willOpen ? '✅ Yes, Open Admissions' : '🔒 Yes, Close Admissions'
        }
      );
    });

    // Generic toggles with confirm
    document.querySelectorAll('[data-confirm-toggle]').forEach(toggle => {
      toggle.addEventListener('change', function () {
        const willEnable = this.checked;
        const msg = this.dataset.confirmToggle || 'Are you sure?';
        this.checked = !willEnable;
        confirmAction(msg, () => {
          this.checked = willEnable;
          Toast.show(willEnable ? 'Enabled' : 'Disabled', 'success');
        });
      });
    });
  }
};

/* ══════════════════════════════════════════════════════════
   12. FORM VALIDATION
══════════════════════════════════════════════════════════ */
const Forms = {
  init() {
    this.initRealtime();
    this.initSubmitGuard();
    this.initPasswordToggle();
    this.initPasswordStrength();
    this.initCharCounters();
    this.initPasswordRules();
    this.initFileInputLabels();
  },

  // Real-time field validation
  initRealtime() {
    document.querySelectorAll('.form-control[required]').forEach(input => {
      input.addEventListener('blur', () => this.validateField(input));
      input.addEventListener('input', () => {
        if (input.classList.contains('is-error')) this.validateField(input);
      });
    });
  },

  validateField(input) {
    const value = input.value.trim();
    const parent = input.closest('.form-group');
    const errEl = parent?.querySelector('.form-error');
    let error = '';

    if (input.required && !value) {
      error = 'This field is required.';
    } else if (input.type === 'email' && value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
      error = 'Please enter a valid email address.';
    } else if (input.type === 'tel' && value && !/^[\d\s\+\-\(\)]{7,15}$/.test(value)) {
      error = 'Please enter a valid phone number.';
    } else if (input.minLength > 0 && value && value.length < input.minLength) {
      error = `Minimum ${input.minLength} characters required.`;
    } else if (input.dataset.match) {
      const matchInput = document.querySelector(input.dataset.match);
      if (matchInput && value !== matchInput.value) {
        error = 'Passwords do not match.';
      }
    }

    input.classList.toggle('is-error', !!error);
    input.classList.toggle('is-success', !error && !!value);

    if (errEl) {
      errEl.innerHTML = error ? `<i class="fas fa-exclamation-circle"></i> ${error}` : '';
      errEl.style.display = error ? 'flex' : 'none';
    }

    return !error;
  },

  validateForm(form) {
    const inputs = form.querySelectorAll('.form-control[required]');
    let valid = true;
    inputs.forEach(input => {
      if (!this.validateField(input)) valid = false;
    });
    return valid;
  },

  // Submit guard — prevent double submit
  initSubmitGuard() {
    document.querySelectorAll('form[data-admin-form]').forEach(form => {
      form.addEventListener('submit', e => {
        e.preventDefault();
        if (!this.validateForm(form)) {
          Toast.show('Please fix the errors above.', 'danger');
          const firstErr = form.querySelector('.is-error');
          firstErr?.focus();
          firstErr?.scrollIntoView({ behavior: 'smooth', block: 'center' });
          return;
        }
        this.setLoading(form, true);
        // Dispatch custom event for page-specific handler
        form.dispatchEvent(new CustomEvent('admin:submit', { bubbles: true }));
      });
    });
  },

  setLoading(form, loading) {
    const btn = form.querySelector('[type="submit"]');
    if (!btn) return;
    if (loading) {
      btn._originalHTML = btn.innerHTML;
      btn.innerHTML = '<span style="width:14px;height:14px;border:2px solid rgba(255,255,255,0.4);border-top-color:#fff;border-radius:50%;display:inline-block;animation:spin 0.6s linear infinite;"></span> Processing…';
      btn.disabled = true;
      btn.classList.add('loading');
    } else {
      btn.innerHTML = btn._originalHTML || btn.innerHTML;
      btn.disabled = false;
      btn.classList.remove('loading');
    }
  },

  // Password show/hide
  initPasswordToggle() {
    document.querySelectorAll('[data-pw-toggle]').forEach(btn => {
      btn.addEventListener('click', () => {
        const input = document.querySelector(btn.dataset.pwToggle);
        if (!input) return;
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        btn.querySelector('i').className = isHidden ? 'fas fa-eye-slash' : 'fas fa-eye';
      });
    });
  },

  // Password strength meter
  initPasswordStrength() {
    const inputs = document.querySelectorAll('[data-strength-bar]');
    inputs.forEach(input => {
      const barId = input.dataset.strengthBar;
      const bar   = document.getElementById(barId);
      const label = document.querySelector(`[data-strength-label="${barId}"]`);
      if (!bar) return;

      const segs = bar.querySelectorAll('.strength-seg');

      input.addEventListener('input', () => {
        const val = input.value;
        let score = 0;
        if (val.length >= 8)           score++;
        if (/[A-Z]/.test(val))         score++;
        if (/[0-9]/.test(val))         score++;
        if (/[^A-Za-z0-9]/.test(val))  score++;

        const levels = ['', 'weak', 'fair', 'good', 'strong'];
        const texts  = ['', 'Weak — add uppercase & symbols', 'Fair — getting stronger', 'Good — almost there', 'Strong password ✓'];
        const colors = ['', 'var(--s-rejected)', 'var(--amber)', '#82ca9d', 'var(--s-open)'];

        segs.forEach((seg, i) => {
          seg.className = 'strength-seg' + (i < score ? ` ${levels[score]}` : '');
        });
        if (label) {
          label.textContent = texts[score] || '';
          label.style.color = colors[score] || 'var(--text-muted)';
        }
      });
    });
  },

  // Password rules live check
  initPasswordRules() {
    document.querySelectorAll('[data-pw-rules]').forEach(input => {
      const rulesId = input.dataset.pwRules;
      const container = document.getElementById(rulesId);
      if (!container) return;

      const rules = [
        { re: /.{8,}/,        label: 'At least 8 characters', id: 'pw-len'  },
        { re: /[A-Z]/,        label: 'Contains uppercase letter', id: 'pw-uc' },
        { re: /[0-9]/,        label: 'Contains a number', id: 'pw-num' },
        { re: /[^A-Za-z0-9]/, label: 'Contains a symbol', id: 'pw-sym' }
      ];

      // Render rules
      container.innerHTML = rules.map(r => `
        <div class="pw-rule fail" id="${r.id}">
          <i class="fas fa-times"></i> ${r.label}
        </div>
      `).join('');

      input.addEventListener('input', () => {
        rules.forEach(r => {
          const el = container.querySelector(`#${r.id}`);
          if (!el) return;
          const pass = r.re.test(input.value);
          el.className = `pw-rule ${pass ? 'pass' : 'fail'}`;
          el.querySelector('i').className = pass ? 'fas fa-check' : 'fas fa-times';
        });
      });
    });
  },

  // Character counters
  initCharCounters() {
    document.querySelectorAll('[data-max-chars]').forEach(el => {
      const max = parseInt(el.dataset.maxChars);
      const counterId = el.dataset.counter;
      const counter = counterId ? document.getElementById(counterId) : null;
      const display = counter || (() => {
        const d = document.createElement('div');
        d.className = 'char-counter';
        el.insertAdjacentElement('afterend', d);
        return d;
      })();

      el.addEventListener('input', () => {
        const len = el.value.length;
        display.textContent = `${len}/${max}`;
        display.className = 'char-counter' + (len >= max ? ' over' : len >= max * 0.9 ? ' near' : '');
      });

      // Init
      el.dispatchEvent(new Event('input'));
    });
  },

  // Show filename in file inputs
  initFileInputLabels() {
    document.querySelectorAll('input[type="file"]').forEach(input => {
      input.addEventListener('change', () => {
        const label = document.querySelector(`[data-file-label="${input.id}"]`);
        if (!label) return;
        const files = Array.from(input.files);
        label.textContent = files.length
          ? files.map(f => f.name).join(', ')
          : 'No file chosen';
      });
    });
  }
};

/* ══════════════════════════════════════════════════════════
   13. UPLOAD ZONES
══════════════════════════════════════════════════════════ */
const UploadZones = {
  init() {
    document.querySelectorAll('.upload-zone').forEach(zone => {
      zone.addEventListener('dragover', e => {
        e.preventDefault();
        zone.classList.add('drag-over');
      });
      zone.addEventListener('dragleave', e => {
        if (!zone.contains(e.relatedTarget)) zone.classList.remove('drag-over');
      });
      zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.classList.remove('drag-over');
        const files = Array.from(e.dataTransfer?.files || []);
        this._handleFiles(files, zone);
      });
    });
  },

  _handleFiles(files, zone) {
    const accept = zone.dataset.accept || '';
    const maxMb  = parseInt(zone.dataset.maxMb || '10');

    files.forEach(file => {
      // Size check
      if (file.size > maxMb * 1024 * 1024) {
        Toast.show(`${file.name} is too large. Max ${maxMb}MB.`, 'danger');
        return;
      }
      // Type check
      if (accept && !this._matchesAccept(file, accept)) {
        Toast.show(`${file.name}: file type not allowed.`, 'warning');
        return;
      }

      const progressContainer = zone.dataset.progressTarget
        ? document.getElementById(zone.dataset.progressTarget)
        : zone.nextElementSibling;

      if (progressContainer) this._simulateProgress(file, progressContainer);
    });
  },

  _matchesAccept(file, accept) {
    return accept.split(',').some(a => {
      a = a.trim();
      if (a.startsWith('.')) return file.name.toLowerCase().endsWith(a.toLowerCase());
      if (a.includes('*')) return file.type.startsWith(a.split('*')[0]);
      return file.type === a;
    });
  },

  _simulateProgress(file, container) {
    const item = document.createElement('div');
    item.className = 'upload-progress-item';
    item.innerHTML = `
      <div class="upload-progress-name">${file.name}</div>
      <div class="upload-progress-bar-wrap">
        <div class="upload-progress-track">
          <div class="upload-progress-fill" style="width:0%"></div>
        </div>
      </div>
      <span class="upload-progress-pct">0%</span>
      <button class="upload-cancel-btn"><i class="fas fa-times"></i></button>
    `;
    container.appendChild(item);

    const fill = item.querySelector('.upload-progress-fill');
    const pct  = item.querySelector('.upload-progress-pct');
    const cancelBtn = item.querySelector('.upload-cancel-btn');
    let p = 0;
    let cancelled = false;

    cancelBtn.addEventListener('click', () => {
      cancelled = true;
      item.remove();
      Toast.show(`${file.name} upload cancelled.`, 'info');
    });

    const interval = setInterval(() => {
      if (cancelled) { clearInterval(interval); return; }
      p += Math.random() * 15;
      if (p >= 100) {
        p = 100;
        clearInterval(interval);
        pct.textContent = '100%';
        fill.style.width = '100%';
        setTimeout(() => {
          item.style.opacity = '0';
          item.style.transition = 'opacity 0.3s ease';
          setTimeout(() => item.remove(), 320);
        }, 600);
        Toast.show(`${file.name} uploaded successfully.`, 'success');
        return;
      }
      fill.style.width = p + '%';
      pct.textContent = Math.floor(p) + '%';
    }, 120);
  }
};

/* ══════════════════════════════════════════════════════════
   14. GALLERY LIGHTBOX
══════════════════════════════════════════════════════════ */
const Lightbox = {
  backdrop: null,
  items: [],
  current: 0,
  _touchStartX: 0,

  init() {
    this.backdrop = document.getElementById('adminLightbox');
    if (!this.backdrop) return;

    // Nav buttons
    this.backdrop.querySelector('.lightbox-prev')
      ?.addEventListener('click', () => this.prev());
    this.backdrop.querySelector('.lightbox-next')
      ?.addEventListener('click', () => this.next());
    this.backdrop.querySelector('.lightbox-close')
      ?.addEventListener('click', () => this.close());

    // Keyboard
    document.addEventListener('keydown', e => {
      if (!this.backdrop?.classList.contains('open')) return;
      if (e.key === 'ArrowLeft')  this.prev();
      if (e.key === 'ArrowRight') this.next();
      if (e.key === 'Escape')     this.close();
    });

    // Touch swipe
    this.backdrop.addEventListener('touchstart', e => {
      this._touchStartX = e.touches[0].clientX;
    }, { passive: true });
    this.backdrop.addEventListener('touchend', e => {
      const dx = e.changedTouches[0].clientX - this._touchStartX;
      if (Math.abs(dx) > 50) dx < 0 ? this.next() : this.prev();
    }, { passive: true });

    // Media grid click delegation
    document.addEventListener('click', e => {
      const cell = e.target.closest('[data-lightbox-group]');
      if (!cell) return;
      const group = cell.dataset.lightboxGroup;
      const allItems = Array.from(document.querySelectorAll(`[data-lightbox-group="${group}"]`));
      this.open(
        allItems.map(el => ({
          src:     el.dataset.lightboxSrc || el.querySelector('img')?.src || '',
          caption: el.dataset.lightboxCaption || '',
          type:    el.dataset.lightboxType || 'image'
        })),
        allItems.indexOf(cell)
      );
    });
  },

  open(items, startIndex = 0) {
    if (!this.backdrop) return;
    this.items   = items;
    this.current = startIndex;
    this.backdrop.classList.add('open');
    document.body.style.overflow = 'hidden';
    this._render();
  },

  close() {
    if (!this.backdrop) return;
    this.backdrop.classList.remove('open');
    document.body.style.overflow = '';
  },

  prev() {
    if (this.items.length < 2) return;
    this.current = (this.current - 1 + this.items.length) % this.items.length;
    this._render();
  },

  next() {
    if (this.items.length < 2) return;
    this.current = (this.current + 1) % this.items.length;
    this._render();
  },

  _render() {
    const item    = this.items[this.current];
    if (!item) return;

    const imgEl   = this.backdrop.querySelector('.lightbox-img');
    const captEl  = this.backdrop.querySelector('.lightbox-caption-bar');
    const countEl = this.backdrop.querySelector('.lightbox-counter');

    if (imgEl)   { imgEl.src = item.src; imgEl.alt = item.caption || ''; }
    if (captEl)  captEl.textContent = item.caption || '';
    if (countEl) countEl.textContent = `${this.current + 1} / ${this.items.length}`;

    const prevBtn = this.backdrop.querySelector('.lightbox-prev');
    const nextBtn = this.backdrop.querySelector('.lightbox-next');
    if (prevBtn) prevBtn.style.display = this.items.length > 1 ? '' : 'none';
    if (nextBtn) nextBtn.style.display = this.items.length > 1 ? '' : 'none';

    // Caption input (editable panel)
    const captInput = this.backdrop.querySelector('.lightbox-caption-input');
    if (captInput) captInput.value = item.caption || '';
  }
};

/* ══════════════════════════════════════════════════════════
   15. MEDIA GRID SELECTION
══════════════════════════════════════════════════════════ */
const MediaGrid = {
  selected: new Set(),

  init() {
    document.addEventListener('click', e => {
      const check = e.target.closest('.media-check');
      if (!check) return;
      e.stopPropagation();
      const item = check.closest('.media-item');
      if (!item) return;
      const id = item.dataset.id || item.dataset.mediaId;

      if (this.selected.has(id)) {
        this.selected.delete(id);
        item.classList.remove('selected');
      } else {
        this.selected.add(id);
        item.classList.add('selected');
      }
      this._updateBulkBar();
    });
  },

  _updateBulkBar() {
    const bar = document.querySelector('[data-media-bulk-bar]');
    if (!bar) return;
    bar.classList.toggle('visible', this.selected.size > 0);
    const countEl = bar.querySelector('.bulk-count');
    if (countEl) countEl.textContent = `${this.selected.size} item${this.selected.size !== 1 ? 's' : ''} selected`;
  },

  clearAll() {
    this.selected.clear();
    document.querySelectorAll('.media-item.selected').forEach(el => el.classList.remove('selected'));
    this._updateBulkBar();
  }
};

/* ══════════════════════════════════════════════════════════
   16. CONTENT SECTION COLLAPSIBLES
══════════════════════════════════════════════════════════ */
const ContentSections = {
  init() {
    document.querySelectorAll('.content-section-header').forEach(header => {
      header.addEventListener('click', () => {
        const card = header.closest('.content-section-card');
        if (!card) return;
        const wasExpanded = card.classList.contains('expanded');
        // Optionally close others
        if (card.closest('[data-accordion]')) {
          card.closest('[data-accordion]').querySelectorAll('.content-section-card.expanded')
            .forEach(c => c.classList.remove('expanded'));
        }
        if (!wasExpanded) card.classList.add('expanded');
        else card.classList.remove('expanded');
      });
    });
  }
};

/* ══════════════════════════════════════════════════════════
   17. ENQUIRY SPLIT PANE
══════════════════════════════════════════════════════════ */
const Enquiries = {
  init() {
    document.querySelectorAll('.enquiry-list-item').forEach(item => {
      item.addEventListener('click', () => {
        // Active state
        document.querySelectorAll('.enquiry-list-item').forEach(i => i.classList.remove('active'));
        item.classList.add('active');
        item.classList.remove('unread');

        // On mobile: show detail pane
        const detailPane = document.querySelector('.enquiry-detail-pane');
        if (detailPane) {
          detailPane.classList.add('mobile-open');
          // Show back button if mobile
          const backBtn = detailPane.querySelector('[data-enquiry-back]');
          backBtn?.addEventListener('click', () => {
            detailPane.classList.remove('mobile-open');
          }, { once: true });
        }

        // Update unread badge
        const badge = document.querySelector('[data-notif-trigger] .topbar-badge');
        const unreadCount = document.querySelectorAll('.enquiry-list-item.unread').length;
        if (badge) {
          badge.textContent = unreadCount || '';
          if (!unreadCount) badge.style.display = 'none';
        }
      });
    });

    // Enquiry reply form
    document.querySelector('[data-enquiry-reply]')?.addEventListener('click', () => {
      const textarea = document.querySelector('.enquiry-reply-input');
      if (!textarea?.value.trim()) {
        Toast.show('Please type a reply before sending.', 'warning');
        return;
      }
      const btn = document.querySelector('[data-enquiry-reply]');
      btn.textContent = 'Sending…';
      btn.disabled = true;
      setTimeout(() => {
        Toast.show('Reply sent successfully.', 'success');
        textarea.value = '';
        btn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Reply';
        btn.disabled = false;
      }, 1200);
    });
  }
};

/* ══════════════════════════════════════════════════════════
   18. ADMISSIONS TOGGLE CARD
══════════════════════════════════════════════════════════ */
function initAdmissionsCard() {
  const card = document.querySelector('.admissions-toggle-card');
  if (!card) return;

  const toggle = card.querySelector('[data-admissions-toggle]');
  const actions = card.querySelectorAll('[data-admission-action]');

  actions.forEach(btn => {
    btn.addEventListener('click', () => {
      const action = btn.dataset.admissionAction;
      if (action === 'view') {
        window.location.href = btn.dataset.href || 'admissions/index.html';
      } else if (action === 'settings') {
        window.location.href = 'settings/admissions.html';
      }
    });
  });
}

/* ══════════════════════════════════════════════════════════
   19. FILTER BY CATEGORY (gallery, events, etc.)
══════════════════════════════════════════════════════════ */
function filterByCategory(category, targetSelector) {
  const target = targetSelector
    ? document.querySelector(targetSelector)
    : document;

  (target || document).querySelectorAll('[data-category]').forEach(el => {
    const match = category === 'all' || el.dataset.category === category;
    el.style.display = match ? '' : 'none';
  });

  // Update count
  const visibleCount = (target || document).querySelectorAll('[data-category]:not([style*="none"])').length;
  const countEl = document.querySelector('[data-filter-count]');
  if (countEl) countEl.textContent = visibleCount;
}
window.filterByCategory = filterByCategory;

/* ══════════════════════════════════════════════════════════
   20. SKELETON LOADERS
══════════════════════════════════════════════════════════ */
const Skeletons = {
  show(containerId, template = 'row', count = 5) {
    const container = document.getElementById(containerId);
    if (!container) return;
    const templates = {
      row: `
        <div class="skeleton-row">
          <div class="skeleton skeleton-avatar"></div>
          <div style="flex:1;display:flex;flex-direction:column;gap:6px;">
            <div class="skeleton skeleton-text w-75"></div>
            <div class="skeleton skeleton-text w-50"></div>
          </div>
          <div class="skeleton skeleton-badge"></div>
        </div>`,
      card: `
        <div class="card" style="padding:16px;display:flex;flex-direction:column;gap:10px;">
          <div class="skeleton skeleton-text w-75"></div>
          <div class="skeleton skeleton-text w-50"></div>
          <div class="skeleton skeleton-text w-33"></div>
          <div class="skeleton skeleton-btn" style="margin-top:6px;"></div>
        </div>`
    };
    container.innerHTML = Array(count).fill(templates[template] || templates.row).join('');
  },

  hide(containerId) {
    const container = document.getElementById(containerId);
    if (container) container.innerHTML = '';
  }
};
window.Skeletons = Skeletons;

/* ══════════════════════════════════════════════════════════
   21. EMPTY STATES
══════════════════════════════════════════════════════════ */
function showEmptyState(containerId, { icon = '📋', title = 'Nothing here yet', desc = '', actionLabel = '', actionFn = null } = {}) {
  const container = document.getElementById(containerId);
  if (!container) return;
  container.innerHTML = `
    <div class="empty-state">
      <span class="empty-icon">${icon}</span>
      <h4 class="empty-title">${title}</h4>
      ${desc ? `<p class="empty-desc">${desc}</p>` : ''}
      ${actionLabel ? `<button class="btn btn-primary btn-md" id="_emptyAction">${actionLabel}</button>` : ''}
    </div>`;
  if (actionFn) container.querySelector('#_emptyAction')?.addEventListener('click', actionFn);
}
window.showEmptyState = showEmptyState;

/* ══════════════════════════════════════════════════════════
   22. COPY TO CLIPBOARD
══════════════════════════════════════════════════════════ */
function copyToClipboard(text, label = 'Copied') {
  if (navigator.clipboard?.writeText) {
    navigator.clipboard.writeText(text)
      .then(() => Toast.show(`${label} copied to clipboard.`, 'success', '', 2500))
      .catch(() => _fallbackCopy(text, label));
  } else {
    _fallbackCopy(text, label);
  }
}
function _fallbackCopy(text, label) {
  const ta = document.createElement('textarea');
  ta.value = text;
  ta.style.cssText = 'position:fixed;opacity:0;top:0;left:0;';
  document.body.appendChild(ta);
  ta.select();
  document.execCommand('copy');
  ta.remove();
  Toast.show(`${label} copied.`, 'success', '', 2500);
}
window.copyToClipboard = copyToClipboard;

// Copy text element click delegation
document.addEventListener('click', e => {
  const el = e.target.closest('.copy-text[data-copy]');
  if (!el) return;
  copyToClipboard(el.dataset.copy, el.dataset.copyLabel || 'Text');
});

/* ══════════════════════════════════════════════════════════
   23. SCROLL TO TOP
══════════════════════════════════════════════════════════ */
function initScrollTop() {
  const btn = document.querySelector('.scroll-top-btn');
  if (!btn) return;
  const content = document.querySelector('.admin-content') || window;

  const onScroll = () => {
    const scrolled = content === window ? window.scrollY : content.scrollTop;
    btn.classList.toggle('visible', scrolled > 280);
  };

  content.addEventListener('scroll', onScroll, { passive: true });
  btn.addEventListener('click', () => {
    if (content === window) window.scrollTo({ top: 0, behavior: 'smooth' });
    else content.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

/* ══════════════════════════════════════════════════════════
   24. AUTH PAGE
══════════════════════════════════════════════════════════ */
const Auth = {
  init() {
    this.initRoleTabs();
    this.initLoginForm();
    this.initForgotForm();
    this.initResetForm();
  },

  initRoleTabs() {
    document.querySelectorAll('.role-tab').forEach(tab => {
      tab.addEventListener('click', () => {
        document.querySelectorAll('.role-tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        const roleInput = document.querySelector('[name="role"]');
        if (roleInput) roleInput.value = tab.dataset.role || tab.textContent.trim().toLowerCase();
      });
    });
  },

  initLoginForm() {
    const form = document.getElementById('loginForm');
    if (!form) return;

    form.addEventListener('submit', e => {
      e.preventDefault();
      const email = form.querySelector('[name="email"]')?.value.trim();
      const pw    = form.querySelector('[name="password"]')?.value;

      if (!email || !pw) {
        Toast.show('Please fill in all fields.', 'danger');
        return;
      }

      const btn = form.querySelector('[type="submit"]');
      btn._orig = btn.innerHTML;
      btn.innerHTML = '<span style="width:14px;height:14px;border:2px solid rgba(255,255,255,0.4);border-top-color:#fff;border-radius:50%;display:inline-block;animation:spin 0.6s linear infinite;"></span> Signing in…';
      btn.disabled = true;

      const errEl = document.getElementById('loginError');

      // Simulate auth (replace with real fetch)
      setTimeout(() => {
        // Demo: accept any @royalark.edu.ng email
        if (email.endsWith('@royalark.edu.ng') || email === 'admin@royalark.com') {
          Toast.show('Login successful! Redirecting…', 'success');
          btn.innerHTML = '<i class="fas fa-check"></i> Logged in!';
          setTimeout(() => { window.location.href = '../admin/dashboard.html'; }, 1200);
        } else {
          if (errEl) {
            errEl.innerHTML = '<i class="fas fa-exclamation-circle"></i> <div class="alert-body">Invalid email or password. Please try again.</div>';
            errEl.style.display = 'flex';
          }
          btn.innerHTML = btn._orig;
          btn.disabled = false;
        }
      }, 1400);
    });
  },

  initForgotForm() {
    const form = document.getElementById('forgotForm');
    if (!form) return;

    form.addEventListener('submit', e => {
      e.preventDefault();
      const email = form.querySelector('[name="email"]')?.value.trim();
      if (!email) { Toast.show('Please enter your email address.', 'warning'); return; }

      const btn = form.querySelector('[type="submit"]');
      btn._orig = btn.innerHTML;
      btn.innerHTML = '<span style="width:14px;height:14px;border:2px solid rgba(255,255,255,0.4);border-top-color:#fff;border-radius:50%;display:inline-block;animation:spin 0.6s linear infinite;"></span> Sending…';
      btn.disabled = true;

      setTimeout(() => {
        form.style.display = 'none';
        const successEl = document.getElementById('forgotSuccess');
        if (successEl) {
          successEl.style.display = 'flex';
          const emailDisplay = successEl.querySelector('[data-sent-email]');
          if (emailDisplay) emailDisplay.textContent = email;
          this._startResendCountdown(successEl);
        }
      }, 1500);
    });
  },

  _startResendCountdown(container) {
    const resendBtn = container.querySelector('[data-resend]');
    if (!resendBtn) return;
    let seconds = 60;
    resendBtn.disabled = true;
    resendBtn.textContent = `Resend in ${seconds}s`;
    const interval = setInterval(() => {
      seconds--;
      if (seconds <= 0) {
        clearInterval(interval);
        resendBtn.disabled = false;
        resendBtn.textContent = 'Resend link';
        resendBtn.addEventListener('click', () => Toast.show('Reset link resent.', 'info'));
      } else {
        resendBtn.textContent = `Resend in ${seconds}s`;
      }
    }, 1000);
  },

  initResetForm() {
    const form = document.getElementById('resetForm');
    if (!form) return;

    form.addEventListener('submit', e => {
      e.preventDefault();
      const pw  = form.querySelector('[name="password"]')?.value;
      const cpw = form.querySelector('[name="confirm_password"]')?.value;

      if (!pw || !cpw) { Toast.show('Please fill in all fields.', 'danger'); return; }
      if (pw !== cpw)  { Toast.show('Passwords do not match.', 'danger'); return; }
      if (pw.length < 8) { Toast.show('Password must be at least 8 characters.', 'danger'); return; }

      const btn = form.querySelector('[type="submit"]');
      btn._orig = btn.innerHTML;
      btn.innerHTML = '<span style="width:14px;height:14px;border:2px solid rgba(255,255,255,0.4);border-top-color:#fff;border-radius:50%;display:inline-block;animation:spin 0.6s linear infinite;"></span> Updating…';
      btn.disabled = true;

      setTimeout(() => {
        Toast.show('Password updated successfully. Please log in.', 'success');
        setTimeout(() => { window.location.href = 'login.html'; }, 1800);
      }, 1400);
    });
  }
};

/* ══════════════════════════════════════════════════════════
   25. RICH TEXT EDITOR (Quill)
══════════════════════════════════════════════════════════ */
const RTE = {
  instances: {},

  init(selector = '[data-quill]', options = {}) {
    if (typeof Quill === 'undefined') return;

    document.querySelectorAll(selector).forEach(el => {
      const id      = el.id || ('quill_' + Math.random().toString(36).slice(2));
      const toolbar = el.dataset.quillToolbar || 'full';

      const toolbars = {
        full: [
          [{ header: [1, 2, 3, false] }],
          ['bold', 'italic', 'underline', 'strike'],
          ['blockquote', 'code-block'],
          [{ list: 'ordered' }, { list: 'bullet' }],
          [{ align: [] }],
          ['link', 'image'],
          ['clean']
        ],
        simple: [['bold', 'italic', 'underline'], ['link'], [{ list: 'bullet' }]]
      };

      const instance = new Quill(el, {
        theme: 'snow',
        modules: { toolbar: toolbars[toolbar] || toolbars.full },
        placeholder: el.dataset.placeholder || 'Start writing…',
        ...options
      });

      // Sync to hidden input on change
      const hiddenInput = document.querySelector(`[data-quill-target="${id}"]`);
      if (hiddenInput) {
        instance.on('text-change', () => {
          hiddenInput.value = instance.root.innerHTML;
        });
      }

      this.instances[id] = instance;
    });
  },

  get(id) { return this.instances[id]; }
};
window.RTE = RTE;

/* ══════════════════════════════════════════════════════════
   26. DRAG TO REORDER (SortableJS)
══════════════════════════════════════════════════════════ */
const DragSort = {
  init() {
    if (typeof Sortable === 'undefined') return;
    document.querySelectorAll('[data-sortable]').forEach(list => {
      Sortable.create(list, {
        animation: 180,
        handle: '.drag-handle',
        ghostClass: 'sortable-ghost',
        chosenClass: 'sortable-chosen',
        onEnd(evt) {
          Toast.show('Order updated. Remember to save.', 'info', '', 3000);
          // Dispatch event with new order
          const ids = Array.from(list.querySelectorAll('[data-sort-id]')).map(el => el.dataset.sortId);
          list.dispatchEvent(new CustomEvent('admin:reordered', { detail: { ids }, bubbles: true }));
        }
      });
    });
  }
};

/* ══════════════════════════════════════════════════════════
   27. COUNTDOWN TIMER (admissions deadline)
══════════════════════════════════════════════════════════ */
function initCountdown(targetDate, containerId) {
  const container = document.getElementById(containerId);
  if (!container || !targetDate) return;

  const end = new Date(targetDate).getTime();

  function update() {
    const now  = Date.now();
    const diff = end - now;

    if (diff <= 0) {
      container.innerHTML = '<span style="font-weight:700;color:var(--s-rejected);">Admissions Closed</span>';
      return;
    }

    const d = Math.floor(diff / 86400000);
    const h = Math.floor((diff % 86400000) / 3600000);
    const m = Math.floor((diff % 3600000) / 60000);
    const s = Math.floor((diff % 60000) / 1000);

    const pad = n => String(n).padStart(2, '0');
    container.querySelectorAll('[data-cd-days]').forEach(el => el.textContent = d);
    container.querySelectorAll('[data-cd-hours]').forEach(el => el.textContent = pad(h));
    container.querySelectorAll('[data-cd-mins]').forEach(el => el.textContent = pad(m));
    container.querySelectorAll('[data-cd-secs]').forEach(el => el.textContent = pad(s));
  }

  update();
  setInterval(update, 1000);
}
window.initCountdown = initCountdown;

/* ══════════════════════════════════════════════════════════
   28. FORMAT HELPERS
══════════════════════════════════════════════════════════ */
function formatDate(d, opts = {}) {
  return new Date(d).toLocaleDateString('en-NG', {
    day: '2-digit', month: 'short', year: 'numeric', ...opts
  });
}
function formatDateTime(d) {
  return new Date(d).toLocaleString('en-NG', {
    day: '2-digit', month: 'short', year: 'numeric',
    hour: '2-digit', minute: '2-digit'
  });
}
function formatRelative(d) {
  const diff = Date.now() - new Date(d).getTime();
  const mins  = Math.floor(diff / 60000);
  const hours = Math.floor(diff / 3600000);
  const days  = Math.floor(diff / 86400000);
  if (mins < 1)   return 'Just now';
  if (mins < 60)  return `${mins}m ago`;
  if (hours < 24) return `${hours}h ago`;
  if (days < 7)   return `${days}d ago`;
  return formatDate(d);
}
function slugify(str) {
  return str.toLowerCase().trim()
    .replace(/[^a-z0-9\s-]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-');
}
window.formatDate     = formatDate;
window.formatDateTime = formatDateTime;
window.formatRelative = formatRelative;
window.slugify        = slugify;

/* ── Auto-slug from title input ── */
document.querySelectorAll('[data-slug-source]').forEach(input => {
  const targetId = input.dataset.slugSource;
  const target   = document.getElementById(targetId);
  if (!target) return;
  let manual = false;
  target.addEventListener('input', () => { manual = true; });
  input.addEventListener('input', () => {
    if (!manual) target.value = slugify(input.value);
  });
});

/* ══════════════════════════════════════════════════════════
   29. ADMISSIONS — APPROVE / REJECT ACTIONS
══════════════════════════════════════════════════════════ */
function approveApplication(id, name) {
  Modal.open('approveModal');
  const modal = document.getElementById('approveModal');
  if (!modal) return;
  const nameEl = modal.querySelector('[data-applicant-name]');
  if (nameEl) nameEl.textContent = name;

  const confirmBtn = modal.querySelector('[data-approve-confirm]');
  if (!confirmBtn) return;
  const fresh = confirmBtn.cloneNode(true);
  confirmBtn.parentNode.replaceChild(fresh, confirmBtn);
  fresh.dataset.approveConfirm = '';

  fresh.addEventListener('click', () => {
    const row = document.querySelector(`tr[data-id="${id}"]`);
    const badge = row?.querySelector('.badge');
    if (badge) {
      badge.className = 'badge badge-open badge-dot';
      badge.innerHTML = '<span class="badge-dot"></span> Approved';
    }
    Modal.close('approveModal');
    Toast.show(`${name} approved successfully.`, 'success', 'Confirmation email sent to parent.');
  });
}

function rejectApplication(id, name) {
  Modal.open('rejectModal');
  const modal = document.getElementById('rejectModal');
  if (!modal) return;
  const nameEl = modal.querySelector('[data-applicant-name]');
  if (nameEl) nameEl.textContent = name;

  const confirmBtn = modal.querySelector('[data-reject-confirm]');
  if (!confirmBtn) return;
  const fresh = confirmBtn.cloneNode(true);
  confirmBtn.parentNode.replaceChild(fresh, confirmBtn);
  fresh.dataset.rejectConfirm = '';

  fresh.addEventListener('click', () => {
    const row = document.querySelector(`tr[data-id="${id}"]`);
    const badge = row?.querySelector('.badge');
    if (badge) {
      badge.className = 'badge badge-rejected badge-dot';
      badge.innerHTML = '<span class="badge-dot"></span> Rejected';
    }
    Modal.close('rejectModal');
    Toast.show(`${name}'s application rejected.`, 'warning', 'Parent will be notified.');
  });
}
window.approveApplication = approveApplication;
window.rejectApplication  = rejectApplication;

/* ══════════════════════════════════════════════════════════
   30. BLOG POST — PUBLISH STATUS
══════════════════════════════════════════════════════════ */
function initPostEditor() {
  const statusSelect = document.getElementById('postStatus');
  const scheduleDateGroup = document.getElementById('scheduleDateGroup');
  if (!statusSelect) return;

  statusSelect.addEventListener('change', () => {
    if (scheduleDateGroup) {
      scheduleDateGroup.style.display = statusSelect.value === 'scheduled' ? 'block' : 'none';
    }
  });

  const saveDraftBtn = document.getElementById('saveDraftBtn');
  saveDraftBtn?.addEventListener('click', () => {
    Toast.show('Draft saved successfully.', 'info', 'Not yet visible to the public.', 3500);
  });

  const publishBtn = document.getElementById('publishNowBtn');
  publishBtn?.addEventListener('click', () => {
    confirmAction(
      'Publish this post now? It will be immediately visible on the public website.',
      () => Toast.show('Post published successfully.', 'success', 'Now visible on website.'),
      { type: 'warning', confirmLabel: '🚀 Publish Now' }
    );
  });
}

/* ══════════════════════════════════════════════════════════
   31. SETTINGS — UNSAVED CHANGES GUARD
══════════════════════════════════════════════════════════ */
function initUnsavedGuard(formId) {
  const form = document.getElementById(formId);
  if (!form) return;

  let isDirty = false;
  form.addEventListener('input', () => { isDirty = true; });
  form.addEventListener('change', () => { isDirty = true; });
  form.addEventListener('submit', () => { isDirty = false; });

  window.addEventListener('beforeunload', e => {
    if (isDirty) {
      e.preventDefault();
      e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
    }
  });
}
window.initUnsavedGuard = initUnsavedGuard;

/* ══════════════════════════════════════════════════════════
   32. EXPORT CSV
══════════════════════════════════════════════════════════ */
function exportTableCSV(tableId, filename = 'export') {
  const table = document.getElementById(tableId);
  if (!table) { Toast.show('Nothing to export.', 'warning'); return; }

  const headers = Array.from(table.querySelectorAll('thead th'))
    .map(th => th.textContent.replace(/[↑↓⇅]/g, '').trim())
    .filter(h => h && h !== '☐');

  const rows = Array.from(table.querySelectorAll('tbody tr'))
    .filter(r => r.style.display !== 'none')
    .map(row => {
      return Array.from(row.querySelectorAll('td'))
        .filter((_, i) => {
          const h = table.querySelectorAll('thead th')[i];
          return h && h.textContent.trim() !== '☐';
        })
        .map(td => `"${td.textContent.trim().replace(/"/g, '""')}"`)
        .join(',');
    });

  const csv  = [headers.join(','), ...rows].join('\n');
  const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
  const url  = URL.createObjectURL(blob);
  const a    = document.createElement('a');
  a.href     = url;
  a.download = `${filename}_${new Date().toISOString().slice(0,10)}.csv`;
  document.body.appendChild(a);
  a.click();
  a.remove();
  URL.revokeObjectURL(url);
  Toast.show('CSV export downloaded.', 'success');
}
window.exportTableCSV = exportTableCSV;

/* ══════════════════════════════════════════════════════════
   33. GLOBAL EVENT DELEGATION (misc inline actions)
══════════════════════════════════════════════════════════ */
document.addEventListener('click', e => {
  // Approve btn inline
  const approveBtn = e.target.closest('[data-inline-approve]');
  if (approveBtn) {
    const { id, name } = approveBtn.dataset;
    approveApplication(id || '0', name || 'this applicant');
    return;
  }

  // Reject btn inline
  const rejectBtn = e.target.closest('[data-inline-reject]');
  if (rejectBtn) {
    const { id, name } = rejectBtn.dataset;
    rejectApplication(id || '0', name || 'this applicant');
    return;
  }

  // Delete with confirm
  const deleteBtn = e.target.closest('[data-delete-confirm]');
  if (deleteBtn) {
    const msg  = deleteBtn.dataset.deleteConfirm || 'Delete this item?';
    const href = deleteBtn.dataset.deleteHref;
    const row  = deleteBtn.closest('tr');
    confirmAction(msg, () => {
      if (href) { window.location.href = href; return; }
      if (row) {
        row.style.transition = 'opacity 0.2s ease, height 0.2s ease';
        row.style.opacity = '0';
        setTimeout(() => row.remove(), 220);
        Toast.show('Item deleted.', 'success');
      }
    }, { type: 'danger', confirmLabel: '🗑 Yes, Delete' });
    return;
  }

  // Hide/show toggle inline
  const hideBtn = e.target.closest('[data-toggle-visibility]');
  if (hideBtn) {
    const targetId = hideBtn.dataset.toggleVisibility;
    const targetEl = document.getElementById(targetId);
    if (targetEl) {
      const isHidden = targetEl.style.display === 'none' || targetEl.hidden;
      targetEl.style.display = isHidden ? '' : 'none';
      hideBtn.innerHTML = isHidden
        ? '<i class="fas fa-eye-slash"></i>'
        : '<i class="fas fa-eye"></i>';
    }
    return;
  }
});

/* ══════════════════════════════════════════════════════════
   34. INITIALISE EVERYTHING
══════════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
  // Core shell
  Sidebar.init();
  Topbar.init();
  NoticeBars.init();
  Modal.init();
  Toast.init();
  Alerts.init();

  // Tables
  Tables.init();
  document.querySelectorAll('[data-pagination]').forEach(el => {
    initPagination(el.dataset.pagination, parseInt(el.dataset.perPage) || 15);
  });

  // UI components
  Tabs.init();
  Toggles.init();
  Forms.init();
  UploadZones.init();
  Lightbox.init();
  MediaGrid.init();
  ContentSections.init();
  DragSort.init();
  Enquiries.init();

  // Page-specific
  Auth.init();
  initAdmissionsCard();
  initPostEditor();
  initScrollTop();

  // Quill (only if loaded)
  if (typeof Quill !== 'undefined') RTE.init();

  // Countdown timers
  document.querySelectorAll('[data-countdown]').forEach(el => {
    initCountdown(el.dataset.countdown, el.id);
  });

  // Unsaved guards
  document.querySelectorAll('form[data-unsaved-guard]').forEach(form => {
    initUnsavedGuard(form.id);
  });

  // Auto-relative timestamps
  document.querySelectorAll('[data-relative-time]').forEach(el => {
    el.textContent = formatRelative(el.dataset.relativeTime);
    el.title = formatDateTime(el.dataset.relativeTime);
  });
});

/* ══════════════════════════════════════════════════════════
   EXPOSE GLOBALS
══════════════════════════════════════════════════════════ */
window.Modal            = Modal;
window.Toast            = Toast;
window.Sidebar          = Sidebar;
window.Tables           = Tables;
window.Tabs             = Tabs;
window.Lightbox         = Lightbox;
window.MediaGrid        = MediaGrid;
window.Skeletons        = Skeletons;
window.Auth             = Auth;
window.RTE              = RTE;
