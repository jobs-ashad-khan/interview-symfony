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

function updateBeneficiaryToList(data) {
    const card = persistedList.querySelector(`.beneficiary-card[data-id="${data.id}"]`);
    if (!card) return;
    card.querySelector('.beneficiary-avatar').src = `https://api.dicebear.com/8.x/avataaars/svg?seed=${data.name}`;
    card.querySelector('.beneficiary-avatar').alt = `Avatar de ${data.name}`;
    card.querySelector('.beneficiary-name').textContent = data.name;
}


/* Générer d'un bénéficiaire */
generateBtn.addEventListener('click', async (e) => {
    try {
        const data = await generateBeneficiary();
        addBeneficiaryToList(data);
    } catch (error) {
        console.error(error);
        alert('Erreur lors de la génération du bénéficiaire');
    }
});

/* Ajouter/Modifier un bénéficiaire */
document.getElementById('addBeneficiary').addEventListener('click', () => openModal());

persistedList.addEventListener('click', async (e) => {
    const card = e.target.closest('.beneficiary-card');
    if (!card) return;
    const id = card.dataset.id;

    if (e.target.classList.contains('edit-btn')) {
        openModal(true, {
            id,
            name: card.querySelector('.beneficiary-name').textContent.trim()
        });
    }
});

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = idInput.value;
    const data = {
        name: nameInput.value
    };

    try {
        if (!id) {
            const res = await addBeneficiary(JSON.stringify(data));
            addBeneficiaryToList(res);
        } else {
            const res = await editBeneficiary(id, JSON.stringify(data));
            updateBeneficiaryToList(res)
        }
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

        const confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce bénéficiaire ?");
        if (!confirmation) return;

        try {
            await deleteBeneficiary(id);
            card.remove();
        } catch (error) {
            console.error(error);
            alert('Erreur lors de la suppression du bénéficiaire');
        }
    }
});

