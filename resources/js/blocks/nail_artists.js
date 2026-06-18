function updateButtonHeight() {
    const section = document.querySelector('.nail-artists');
    if (!section) return;

    const slides = section.querySelectorAll('.nail-artists__slide');

    if (window.innerWidth < 1200) {
        slides.forEach(slide => slide.style.removeProperty('--btn-height'));
        return;
    }

    let maxH = 0;
    slides.forEach(slide => {
        const btn = slide.querySelector('.nail-artists__slide-button');
        if (btn) {
            slide.style.removeProperty('--btn-height');
            maxH = Math.max(maxH, btn.offsetHeight);
        }
    });
    slides.forEach(slide => {
        slide.style.setProperty('--btn-height', maxH + 'px');
    });
}

function initNailArtists() {
    const section = document.querySelector('.nail-artists');
    if (!section || section.dataset.initialized) return;
    section.dataset.initialized = 'true';

    const viewport = section.querySelector('.embla__viewport');
    if (!viewport) return;

    const prevBtn = section.querySelector('[data-embla-prev]');
    const nextBtn = section.querySelector('[data-embla-next]');
    const controls = section.querySelector('.nail-artists__controls');

    const embla = window.EmblaCarousel(viewport, {
        loop: false,
        align: 'center',
        containScroll: 'trimSnaps',
    });

    const updateNav = () => {
        if (prevBtn) prevBtn.disabled = !embla.canScrollPrev();
        if (nextBtn) nextBtn.disabled = !embla.canScrollNext();
    };

    if (prevBtn) prevBtn.addEventListener('click', () => embla.scrollPrev());
    if (nextBtn) nextBtn.addEventListener('click', () => embla.scrollNext());

    embla.on('select', () => {
        updateNav();
        if (window.lazyLoadInstance) window.lazyLoadInstance.update();
    });

    embla.on('init', () => {
        updateNav();
        if (controls && !embla.canScrollPrev() && !embla.canScrollNext()) {
            controls.style.display = 'none';
        }
    });

    updateButtonHeight();
    window.addEventListener('resize', () => {
        clearTimeout(window._nailArtistsResize);
        window._nailArtistsResize = setTimeout(() => {
            updateButtonHeight();
            updateNav();
        }, 100);
    });
}

document.addEventListener('DOMContentLoaded', initNailArtists);
document.addEventListener('livewire:navigated', initNailArtists);
