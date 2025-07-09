const searchInput = document.getElementById('beneficiarySearchInput');

const inputs = document.querySelectorAll('.beneficiarySearchInput');

inputs.forEach(input => {
    const targetSelector = input.dataset.target;
    const targetContainer = document.querySelector(targetSelector);

    if (!targetContainer) return;

    input.addEventListener('input', () => {
        const query = normalize(input.value.trim());
        const cards = targetContainer.querySelectorAll('.beneficiary-card');

        cards.forEach(card => {
            const nameEl = card.querySelector('.beneficiary-name');
            if (!nameEl) return;

            const name = normalize(nameEl.textContent);
            const match = name.includes(query);
            card.style.display = match || query === '' ? 'block' : 'none';
        });
    });
});