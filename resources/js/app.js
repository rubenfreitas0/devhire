document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('job-search-input');
    if (!input) return;

    const clearButton = document.getElementById('job-search-clear');
    const emptyState = document.getElementById('job-search-empty');
    const cards = Array.from(document.querySelectorAll('[data-job-card]'));

    const normalize = (value) =>
        value
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '');

    const applyFilter = () => {
        const query = normalize(input.value.trim());
        let visibleCount = 0;

        cards.forEach((card) => {
            const haystack = normalize(card.textContent || '');
            const matches = query.length === 0 || haystack.includes(query);
            card.style.display = matches ? '' : 'none';
            if (matches) visibleCount += 1;
        });

        if (clearButton) {
            clearButton.style.display = query.length ? '' : 'none';
        }

        if (emptyState) {
            emptyState.style.display = visibleCount === 0 ? '' : 'none';
        }
    };

    input.addEventListener('input', applyFilter);

    if (clearButton) {
        clearButton.addEventListener('click', () => {
            input.value = '';
            applyFilter();
            input.focus();
        });
    }
});
