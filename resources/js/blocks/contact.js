function initContact() {
    const section = document.querySelector('.contact');
    if (!section || section.dataset.animated) return;
    section.dataset.animated = 'true';

    const titles = Array.from(section.querySelectorAll('.contact__title'));
    const descriptions = Array.from(section.querySelectorAll('.contact__description'));

    const elements = [...titles, ...descriptions];
    if (elements.length === 0) return;

    gsap.set(elements, { y: 40, opacity: 0 });

    observeOnce(section, () => {
        const tl = gsap.timeline();

        titles.forEach(el => {
            tl.to(el, {
                y: 0,
                opacity: 1,
                duration: 1.2,
                ease: 'power3.out',
            }, 0);
        });

        descriptions.forEach(el => {
            tl.to(el, {
                y: 0,
                opacity: 1,
                duration: 1,
                ease: 'power3.out',
            }, 0.2);
        });
    });
}

document.addEventListener('DOMContentLoaded', initContact);
document.addEventListener('livewire:navigated', initContact);
