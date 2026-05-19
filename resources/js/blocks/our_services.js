function updateButtonHeight() {
    const section = document.querySelector('.our-services');
    if (!section) return;

    const items = section.querySelectorAll('.our-services__item');

    if (window.innerWidth < 1200) {
        items.forEach(item => item.style.removeProperty('--btn-height'));
        return;
    }

    let maxH = 0;
    items.forEach(item => {
        const btn = item.querySelector('.our-services__item-button');
        if (btn) {
            item.style.removeProperty('--btn-height');
            maxH = Math.max(maxH, btn.offsetHeight);
        }
    });
    items.forEach(item => {
        item.style.setProperty('--btn-height', maxH + 'px');
    });
}

function initOurServicesAnimations() {
    const section = document.querySelector('.our-services');
    if (!section || section.dataset.animated) return;
    section.dataset.animated = 'true';

    const title = section.querySelector('.our-services__title');
    const description = section.querySelector('.our-services__description');

    const elements = [title, description].filter(Boolean);
    if (elements.length === 0) return;

    gsap.set(elements, { y: 40, opacity: 0 });

    observeOnce(section, () => {
        const tl = gsap.timeline();

        if (title) {
            tl.to(title, {
                duration: 1.2,
                y: 0,
                opacity: 1,
                ease: 'power3.out',
            });
        }

        if (description) {
            tl.to(description, {
                y: 0,
                opacity: 1,
                duration: 0.6,
                ease: 'power2.out',
            }, '-=0.8');
        }
    });

    updateButtonHeight();
    window.addEventListener('resize', () => {
        clearTimeout(window._ourServicesResize);
        window._ourServicesResize = setTimeout(updateButtonHeight, 100);
    });
}

document.addEventListener('DOMContentLoaded', initOurServicesAnimations);
document.addEventListener('livewire:navigated', initOurServicesAnimations);
