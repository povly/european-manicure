function initHeroAnimations() {
    const hero = document.querySelector('.hero');
    if (!hero || hero.dataset.animated) return;
    hero.dataset.animated = 'true';

    const title = hero.querySelector('.hero__title');
    const subtitles = Array.from(hero.querySelectorAll('.hero__subtitle'));
    const decors = Array.from(hero.querySelectorAll('.hero__decor'));
    const btn = hero.querySelector('.hero__btn');

    const elements = [title, ...subtitles, ...decors, btn].filter(Boolean);
    if (elements.length === 0) return;

    gsap.set(elements, { y: 40, opacity: 0 });

    observeOnce(hero, () => {
        const tl = gsap.timeline();

        if (title) {
            tl.to(title, {
                duration: 1.2,
                y: 0,
                opacity: 1,
                ease: 'power3.out',
            });
        }

        subtitles.forEach((sub) => {
            tl.to(sub, {
                y: 0,
                opacity: 1,
                duration: 0.8,
            }, '-=0.6');
        });

        if (decors.length) {
            tl.to(decors, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                stagger: 0.15,
            }, '-=0.4');
        }

        if (btn) {
            tl.to(btn, {
                opacity: 1,
                y: 0,
                duration: 0.6,
            }, '-=0.4');
        }
    });
}

document.addEventListener('DOMContentLoaded', initHeroAnimations);
document.addEventListener('livewire:navigated', initHeroAnimations);
