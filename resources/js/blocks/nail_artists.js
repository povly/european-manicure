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

    new window.CustomSlider('.nail-artists__splide', {
        breakpoints: {
            0: { loop: true, centerSlides: true }
        },
        onSlideChange: () => {
            if (window.lazyLoadInstance) {
                window.lazyLoadInstance.update();
            }
        }
    });

    updateButtonHeight();
    window.addEventListener('resize', () => {
        clearTimeout(window._nailArtistsResize);
        window._nailArtistsResize = setTimeout(updateButtonHeight, 100);
    });
}

document.addEventListener('DOMContentLoaded', initNailArtists);
document.addEventListener('livewire:navigated', initNailArtists);
