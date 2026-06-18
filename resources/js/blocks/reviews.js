function initReviews() {
    const section = document.querySelector('.reviews');
    if (!section || section.dataset.initialized) return;
    section.dataset.initialized = 'true';

    const viewport = section.querySelector('.embla__viewport');
    if (viewport && viewport.querySelectorAll('.reviews__slide').length > 0) {
        const prevBtn = section.querySelector('[data-embla-prev]');
        const nextBtn = section.querySelector('[data-embla-next]');

        const embla = window.EmblaCarousel(viewport, {
            loop: true,
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

        embla.on('init', updateNav);
    }

    const title = section.querySelector('.reviews__title');
    if (title) {
        gsap.set(title, { y: 40, opacity: 0 });

        observeOnce(section, () => {
            gsap.to(title, {
                y: 0,
                opacity: 1,
                duration: 1.2,
                ease: 'power3.out',
            });
        });
    }
}

document.addEventListener('DOMContentLoaded', initReviews);
document.addEventListener('livewire:navigated', initReviews);
