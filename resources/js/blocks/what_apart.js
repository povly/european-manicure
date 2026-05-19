function initWhatApartAnimations() {
    const section = document.querySelector('.what-apart');
    if (!section || section.dataset.animated) return;
    section.dataset.animated = 'true';

    const title = section.querySelector('.what-apart__title');
    const description = section.querySelector('.what-apart__description-p');
    const itemTitles = Array.from(section.querySelectorAll('.what-apart__item-title'));
    const itemDescriptions = Array.from(section.querySelectorAll('.what-apart__item-description'));

    const elements = [title, description, ...itemTitles, ...itemDescriptions].filter(Boolean);
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

        if (description) {
            tl.to(description, {
                y: 0,
                opacity: 1,
                duration: 1,
                ease: 'power3.out',
            }, '-=0.8');
        }

        itemTitles.forEach((el, i) => {
            tl.to(el, {
                y: 0,
                opacity: 1,
                duration: 0.8,
                ease: 'power3.out',
            }, `-=${i === 0 ? 0.6 : 0.4}`);
        });

        itemDescriptions.forEach(el => {
            tl.to(el, {
                y: 0,
                opacity: 1,
                duration: 0.8,
                ease: 'power3.out',
            }, '-=0.6');
        });
    });
}

document.addEventListener('DOMContentLoaded', initWhatApartAnimations);
document.addEventListener('livewire:navigated', initWhatApartAnimations);
