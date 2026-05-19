function initFaq() {
    const section = document.querySelector('.faq');
    if (!section || section.dataset.animated) return;
    section.dataset.animated = 'true';

    const title = section.querySelector('.faq__title');
    const subtitle = section.querySelector('.faq__subtitle');

    const elements = [title, subtitle].filter(Boolean);
    if (elements.length === 0) return;

    gsap.set(elements, { y: 40, opacity: 0 });

    observeOnce(section, () => {
        const tl = gsap.timeline();

        if (title) {
            tl.to(title, {
                y: 0,
                opacity: 1,
                duration: 1.2,
                ease: 'power3.out',
            });
        }

        if (subtitle) {
            tl.to(subtitle, {
                y: 0,
                opacity: 1,
                duration: 1,
                ease: 'power3.out',
            }, '-=0.8');
        }
    });
}

document.addEventListener('DOMContentLoaded', initFaq);
document.addEventListener('livewire:navigated', initFaq);
