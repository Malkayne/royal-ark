/* ============================================================
   ROYAL ARK COLLEGE — Main JavaScript
   "Royalty in Excellence"
   ============================================================ */

(function () {
  'use strict';

  const $ = (sel, el = document) => el.querySelector(sel);
  const $$ = (sel, el = document) => Array.from(el.querySelectorAll(sel));

  /* ── Navbar Scroll State ── */
  const navbar = $('.navbar');
  function updateNavbar() {
    if (!navbar) return;
    const isTransparent = navbar.classList.contains('transparent');
    if (window.scrollY > 40) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  }
  window.addEventListener('scroll', updateNavbar, { passive: true });
  updateNavbar();

  /* ── Mobile Drawer ── */
  const hamburger = $('.navbar-hamburger');
  const drawer = $('.mobile-drawer');
  const drawerOverlay = $('.drawer-overlay');
  const drawerClose = $('.mobile-drawer-close');

  function toggleDrawer(open) {
    if (!drawer) return;
    hamburger?.classList.toggle('open', open);
    drawer.classList.toggle('open', open);
    drawerOverlay?.classList.toggle('open', open);
    document.body.style.overflow = open ? 'hidden' : '';
  }

  hamburger?.addEventListener('click', () => toggleDrawer(!drawer.classList.contains('open')));
  drawerClose?.addEventListener('click', () => toggleDrawer(false));
  drawerOverlay?.addEventListener('click', () => toggleDrawer(false));

  /* Close drawer on Escape */
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') toggleDrawer(false);
  });

  /* Close drawer on link click */
  $$('.mobile-drawer a').forEach(link => {
    link.addEventListener('click', () => toggleDrawer(false));
  });

  /* ── Community Dropdown (Desktop) ── */
  const dropdown = $('.nav-dropdown');
  const dropdownToggle = $('.nav-dropdown-toggle');

  dropdownToggle?.addEventListener('click', (e) => {
    e.stopPropagation();
    dropdown?.classList.toggle('open');
  });

  document.addEventListener('click', (e) => {
    if (dropdown && !dropdown.contains(e.target)) {
      dropdown.classList.remove('open');
    }
  });

  /* ── Admission Alert Bar Close ── */
  const admitBarClose = $('.admit-bar-close');
  const admitBar = $('.admit-bar');
  admitBarClose?.addEventListener('click', () => {
    if (admitBar) {
      admitBar.style.height = admitBar.offsetHeight + 'px';
      admitBar.offsetHeight; /* force reflow */
      admitBar.style.transition = 'height .3s ease, opacity .3s ease, margin .3s ease';
      admitBar.style.height = '0';
      admitBar.style.opacity = '0';
      admitBar.style.margin = '0';
      setTimeout(() => admitBar.remove(), 350);
    }
  });

  /* ── Scroll-to-Top ── */
  const scrollTopBtn = $('.scroll-top-btn');
  function updateScrollTop() {
    if (!scrollTopBtn) return;
    scrollTopBtn.classList.toggle('visible', window.scrollY > 600);
  }
  window.addEventListener('scroll', updateScrollTop, { passive: true });
  scrollTopBtn?.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  /* ── Scroll Reveal (Intersection Observer) ── */
  const revealEls = $$('.reveal');
  if (revealEls.length && 'IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    revealEls.forEach(el => revealObserver.observe(el));
  } else {
    revealEls.forEach(el => el.classList.add('is-visible'));
  }

  /* ── Stat Counter Animation ── */
  const statNumbers = $$('.stat-number[data-count]');
  if (statNumbers.length && 'IntersectionObserver' in window) {
    const counterObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const target = parseInt(el.dataset.count, 10);
          const suffix = el.dataset.suffix || '';
          const prefix = el.dataset.prefix || '';
          const duration = 1500;
          const start = performance.now();

          function tick(now) {
            const progress = Math.min((now - start) / duration, 1);
            const ease = 1 - Math.pow(1 - progress, 3); /* easeOutCubic */
            const current = Math.round(ease * target);
            el.textContent = prefix + current.toLocaleString() + suffix;
            if (progress < 1) requestAnimationFrame(tick);
          }
          requestAnimationFrame(tick);
          counterObserver.unobserve(el);
        }
      });
    }, { threshold: 0.5 });
    statNumbers.forEach(el => counterObserver.observe(el));
  }

  /* ── Testimonial Slider ── */
  const testimonialTrack = $('.testimonial-track');
  const testimonialDots = $$('.testimonial-dot');
  const testimonialPrev = $('.testimonial-prev');
  const testimonialNext = $('.testimonial-next');

  if (testimonialTrack) {
    let currentSlide = 0;
    const slides = $$('.testimonial-card', testimonialTrack);
    const total = slides.length;

    function goToSlide(index) {
      if (total === 0) return;
      currentSlide = ((index % total) + total) % total;
      testimonialTrack.style.transform = `translateX(-${currentSlide * 100}%)`;
      testimonialDots.forEach((dot, i) => {
        dot.classList.toggle('active', i === currentSlide);
        dot.setAttribute('aria-current', i === currentSlide ? 'true' : 'false');
      });
    }

    testimonialDots.forEach((dot, i) => {
      dot.addEventListener('click', () => goToSlide(i));
    });

    testimonialPrev?.addEventListener('click', () => goToSlide(currentSlide - 1));
    testimonialNext?.addEventListener('click', () => goToSlide(currentSlide + 1));

    /* Auto-advance every 6s */
    let autoSlide = setInterval(() => goToSlide(currentSlide + 1), 6000);
    testimonialTrack.addEventListener('mouseenter', () => clearInterval(autoSlide));
    testimonialTrack.addEventListener('mouseleave', () => {
      autoSlide = setInterval(() => goToSlide(currentSlide + 1), 6000);
    });

    /* Swipe support */
    let startX = 0;
    testimonialTrack.addEventListener('touchstart', (e) => { startX = e.touches[0].clientX; }, { passive: true });
    testimonialTrack.addEventListener('touchend', (e) => {
      const diff = startX - e.changedTouches[0].clientX;
      if (Math.abs(diff) > 40) goToSlide(currentSlide + (diff > 0 ? 1 : -1));
    }, { passive: true });

    goToSlide(0);
  }

  /* ── Smooth Scroll for Anchor Links ── */
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const id = this.getAttribute('href');
      if (id === '#') return;
      const target = document.querySelector(id);
      if (target) {
        e.preventDefault();
        const offset = navbar ? navbar.offsetHeight + 16 : 80;
        const top = target.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });

})();
