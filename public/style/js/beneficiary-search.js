const searchInput = document.getElementById('beneficiarySearchInput');

searchInput.addEventListener('input', function () {
    const query = normalize(this.value);
    const cards = document.querySelectorAll('.beneficiary-card');

    cards.forEach(card => {
        const nameEl = card.querySelector('.beneficiary-name');
        if (!nameEl) return;

        const name = normalize(nameEl.textContent);
        const match = name.includes(query);
        card.style.display = (!query || match) ? 'block' : 'none';
    });
});