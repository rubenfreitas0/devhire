document.addEventListener('DOMContentLoaded', () => {
    document.documentElement.classList.add('js-enabled');
    document.body.classList.add('is-loaded');

    const cards = Array.from(document.querySelectorAll('[data-job-card]'));

    cards.forEach((card, index) => {
        card.classList.add('card-reveal');
        card.style.setProperty('--stagger', `${index * 40}ms`);
        card.style.transform = 'none';
    });

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    entry.target.style.transform = 'none';
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15 },
    );

    cards.forEach((card) => observer.observe(card));
});
