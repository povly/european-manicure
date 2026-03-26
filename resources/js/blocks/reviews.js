document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.reviews__splide');
    if (container && container.querySelectorAll('[data-slider-slide]').length > 0) {
        new window.CustomSlider('.reviews__splide', {
            breakpoints: {
                0: { loop: true, centerSlides: true },
            },
            onSlideChange: (data) => {
                if (window.lazyLoadInstance) {
                    window.lazyLoadInstance.update();
                }
            }
        });
    }
});

document.addEventListener('livewire:navigated', () => {
    const container = document.querySelector('.reviews__splide');
    if (container && container.querySelectorAll('[data-slider-slide]').length > 0) {
        new window.CustomSlider('.reviews__splide', {
            breakpoints: {
                0: { loop: true, centerSlides: true }
            },
            onSlideChange: (data) => {
                if (window.lazyLoadInstance) {
                    window.lazyLoadInstance.update();
                }
            }
        });
    }
});
