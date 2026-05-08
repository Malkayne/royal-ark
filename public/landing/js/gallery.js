/* ============================================================
   ROYAL ARK SCHOOLS — Gallery JavaScript
   "Royalty in Excellence"
   ============================================================ */

(function () {
  'use strict';

  const $ = (sel, el = document) => el.querySelector(sel);
  const $$ = (sel, el = document) => Array.from(el.querySelectorAll(sel));

  const masonry = $('#galleryMasonry');
  if (!masonry) return;

  const items = $$('.gallery-item', masonry);
  const filterPills = $$('.filter-pill');
  const mediaToggles = $$('.media-toggle-btn');
  const lightbox = $('#galleryLightbox');
  const lightboxImg = $('#lightboxImg');
  const lightboxVideo = $('#lightboxVideo');
  const lightboxCaption = $('#lightboxCaption');
  const lightboxDownload = $('#lightboxDownload');

  let currentFilter = 'all';
  let currentMedia = 'all';
  let currentIndex = 0;

  /* ── Filtering ── */
  function applyFilters() {
    let visibleCount = 0;
    items.forEach(item => {
      const cat = item.dataset.category;
      const media = item.dataset.media;
      const catMatch = currentFilter === 'all' || cat === currentFilter;
      const mediaMatch = currentMedia === 'all' || media === currentMedia;
      const isVisible = catMatch && mediaMatch;
      item.classList.toggle('hidden', !isVisible);
      if (isVisible) visibleCount++;
    });

    // Handle empty state
    const emptyState = $('#galleryEmptyState');
    if (emptyState) {
      emptyState.classList.toggle('visible', visibleCount === 0);
    }
  }

  filterPills.forEach(pill => {
    pill.addEventListener('click', () => {
      filterPills.forEach(p => p.classList.toggle('active', p === pill));
      currentFilter = pill.dataset.filter;
      applyFilters();
    });
  });

  mediaToggles.forEach(btn => {
    btn.addEventListener('click', () => {
      mediaToggles.forEach(b => b.classList.toggle('active', b === btn));
      currentMedia = btn.dataset.media;
      applyFilters();
    });
  });

  /* ── Lightbox helpers ── */
  function getVisibleItems() {
    return items.filter(item => !item.classList.contains('hidden'));
  }

  function openLightbox(item) {
    const visible = getVisibleItems();
    currentIndex = visible.indexOf(item);
    const isVideo = item.dataset.media === 'video';
    const caption = item.dataset.caption || '';

    if (isVideo) {
      lightboxImg.style.display = 'none';
      lightboxVideo.style.display = 'flex';
      lightboxDownload.style.display = 'none';
    } else {
      lightboxImg.style.display = 'block';
      lightboxVideo.style.display = 'none';
      lightboxImg.src = item.dataset.src || '';
      lightboxImg.alt = caption;
      lightboxDownload.style.display = 'inline-flex';
      lightboxDownload.href = item.dataset.src || '#';
    }

    lightboxCaption.textContent = caption;
    lightbox.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    lightbox.classList.remove('open');
    document.body.style.overflow = '';
    lightboxImg.src = '';
  }

  function goToOffset(offset) {
    const visible = getVisibleItems();
    if (visible.length === 0) return;
    currentIndex = ((currentIndex + offset) % visible.length + visible.length) % visible.length;
    openLightbox(visible[currentIndex]);
  }

  /* ── Click handlers ── */
  items.forEach(item => {
    item.addEventListener('click', () => openLightbox(item));
  });

  $('.gallery-lightbox-close', lightbox)?.addEventListener('click', closeLightbox);
  $('.gallery-lightbox-prev', lightbox)?.addEventListener('click', (e) => { e.stopPropagation(); goToOffset(-1); });
  $('.gallery-lightbox-next', lightbox)?.addEventListener('click', (e) => { e.stopPropagation(); goToOffset(1); });

  lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox || e.target.classList.contains('gallery-lightbox-img-wrap')) {
      closeLightbox();
    }
  });

  /* Keyboard navigation */
  document.addEventListener('keydown', (e) => {
    if (!lightbox.classList.contains('open')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') goToOffset(-1);
    if (e.key === 'ArrowRight') goToOffset(1);
  });

  /* Video highlights → lightbox */
  $$('.video-highlight-card').forEach(card => {
    card.addEventListener('click', () => {
      const caption = card.dataset.caption || '';
      lightboxImg.style.display = 'none';
      lightboxVideo.style.display = 'flex';
      lightboxDownload.style.display = 'none';
      lightboxCaption.textContent = caption;
      lightbox.classList.add('open');
      document.body.style.overflow = 'hidden';
    });
  });

})();
