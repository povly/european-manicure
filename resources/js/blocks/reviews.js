function initReviews() {
    const section = document.querySelector('.reviews');
    if (!section || section.dataset.initialized) return;
    section.dataset.initialized = 'true';

    const container = section.querySelector('.reviews__splide');
    if (container && container.querySelectorAll('[data-slider-slide]').length > 0) {
        new window.CustomSlider('.reviews__splide', {
            breakpoints: {
                0: { loop: true, centerSlides: true },
            },
            onSlideChange: () => {
                if (window.lazyLoadInstance) {
                    window.lazyLoadInstance.update();
                }
            },
        });
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
