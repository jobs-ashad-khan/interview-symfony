/* Générer d'un bénéficiaire */
const generateBtn = document.getElementById('generateBeneficiary');
const persistedList = document.querySelector('#persistedBeneficiariesList .beneficiary-list');

function addBeneficiaryToList(data) {
    const newBeneficiary = document.createElement('div');
    newBeneficiary.classList.add('beneficiary-card');
    newBeneficiary.dataset.id = data.id;

    newBeneficiary.innerHTML = `
                <button class="delete-beneficiary-btn" title="Supprimer">×</button>
                <img class="beneficiary-avatar" src="${data.avatarUrl}" alt="Avatar de ${data.name}">
                <span class="beneficiary-name">${data.name}</span>
                <button id="editBeneficiary" class="edit-btn" title="Modifier">✎</button>
            `;
    // Ajoute l'élément à la liste des bénéficiaires stockés
    persistedList.appendChild(newBeneficiary);
}

generateBtn.addEventListener('click', async (e) => {
    try {
        const data = await generateBeneficiary();
        addBeneficiaryToList(data);
    } catch (error) {
        console.error(error);
        alert('Erreur lors de la génération du bénéficiaire');
    }
});

/* Ajouter un bénéficiaire */
document.getElementById('addBeneficiary').addEventListener('click', () => openModal());

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const data = {
        name: nameInput.value
    };

    try {
        const res = await addBeneficiary(JSON.stringify(data));
        addBeneficiaryToList(res);
        closeModal();
    } catch (err) {
        console.error(err);
        alert('Erreur lors de la génération du bénéficiaire');
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

