/* Ajout d'un bénéficiaire */
const form = document.getElementById('generateBeneficiary');
const persistedList = document.querySelector('#persistedBeneficiariesList .beneficiary-list');

function addBeneficiaryToList(data) {
    const newBeneficiary = document.createElement('div');
    newBeneficiary.classList.add('beneficiary-card');
    newBeneficiary.dataset.id = data.id;

    newBeneficiary.innerHTML = `
                <button class="delete-beneficiary-btn" title="Supprimer">×</button>
                <img class="beneficiary-avatar" src="${data.avatarUrl}" alt="Avatar de ${data.name}">
                <span class="beneficiary-name">${data.name}</span>
            `;
    // Ajoute l'élément à la liste des bénéficiaires stockés
    persistedList.appendChild(newBeneficiary);
}

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    try {
        const data = await generateBeneficiary();
        addBeneficiaryToList(data);
    } catch (error) {
        console.error(error);
        alert('Erreur lors de l’ajout du bénéficiaire');
    }
});

/* Suppression d'un bénéficiaire */

persistedList.addEventListener('click', async (e) => {
    if (e.target.classList.contains('delete-beneficiary-btn')) {
        const card = e.target.closest('.beneficiary-card');
        const id = card.dataset.id;

        try {
            await deleteBeneficiary(id);
            card.remove();
        } catch (error) {
            console.error(error);
            alert('Erreur lors de la suppression du bénéficiaire');
        }
    }
});