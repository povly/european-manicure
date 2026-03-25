document.addEventListener('DOMContentLoaded', () => {
    new window.CustomSlider('.nail-artists__splide', {
        breakpoints: {
            0: { loop: true, centerSlides: true }
        },
        onSlideChange: (data) => {
            if (window.lazyLoadInstance) {
                window.lazyLoadInstance.update();
            }
        }
    });
});

document.addEventListener('livewire:navigated', () => {
    new window.CustomSlider('.nail-artists__splide', {
        breakpoints: {
            0: { loop: true, centerSlides: true }
        },
        onSlideChange: (data) => {
            if (window.lazyLoadInstance) {
                window.lazyLoadInstance.update();
            }
        }
    });
});
