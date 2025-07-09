const form = document.getElementById('generateBeneficiary');
const persistedList = document.querySelector('#persistedBeneficiariesList .beneficiary-list');

function addBeneficiaryToList(data) {
    const newBeneficiary = document.createElement('div');
    newBeneficiary.classList.add('beneficiary-card');
    newBeneficiary.innerHTML = `
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