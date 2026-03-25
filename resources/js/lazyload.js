import LazyLoad from "vanilla-lazyload";
window.LazyLoad = LazyLoad;

document.addEventListener('DOMContentLoaded', function() {
    const lazyLoadInstance = new LazyLoad({
        elements_selector: '.lazy',
        thresholds: '200px',
        class_loaded: 'is-loaded',
        class_loading: 'is-loading',
        class_error: 'has-error',
    });

    // Re-init lazy load after Livewire updates
    if (window.Livewire) {
        window.Livewire.hook('morph.updated', () => {
            lazyLoadInstance.update();
        });
    }

    window.lazyLoadInstance = lazyLoadInstance;
});