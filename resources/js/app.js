import './lazyload.js';

import gsap from 'gsap';
import Draggable from 'gsap/Draggable';

gsap.registerPlugin(Draggable);

window.gsap = gsap;
window.Draggable = Draggable;

import EmblaCarousel from 'embla-carousel';
window.EmblaCarousel = EmblaCarousel;

function observeOnce(el, callback) {
    const observer = new IntersectionObserver(
        ([entry], obs) => {
            if (entry.isIntersecting) {
                obs.unobserve(entry.target);
                callback();
            }
        },
        { rootMargin: '0px 0px -15% 0px' }
    );
    observer.observe(el);
}
window.observeOnce = observeOnce;
