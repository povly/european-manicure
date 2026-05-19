function initContentSectionAnimations() {
    const section = document.querySelector('.content-section');
    if (!section || section.dataset.animated) return;
    section.dataset.animated = 'true';

    const title = section.querySelector('.content-section__title');
    const descriptions = Array.from(section.querySelectorAll('.content-section__description'));
    const texts = Array.from(section.querySelectorAll('.content-section__text'));
    const itemTitles = Array.from(section.querySelectorAll('.content-section__item-title'));

    const elements = [title, ...descriptions, ...texts, ...itemTitles].filter(Boolean);
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

        const restElements = [...descriptions, ...texts, ...itemTitles];
        if (restElements.length) {
            tl.to(restElements, {
                y: 0,
                opacity: 1,
                duration: 0.6,
                stagger: 0.1,
                ease: 'power2.out',
            }, '-=0.8');
        }
    });
}

document.addEventListener('DOMContentLoaded', initContentSectionAnimations);
document.addEventListener('livewire:navigated', initContentSectionAnimations);
