const beneficiaryModal = document.getElementById('beneficiary-modal');
const form = document.getElementById('beneficiary-form');
const idInput = document.getElementById('beneficiary-id');
const nameInput = document.getElementById('beneficiary-name');
const modalTitle = document.getElementById('modal-title');

function openModal(isEdit = false, data = {}) {
    modalTitle.textContent = !isEdit ? "Ajouter un bénéficiaire" : "Modifier un bénéficiaire";
    idInput.value = data.id || "";
    nameInput.value = data.name || "";
    beneficiaryModal.classList.remove('hidden');
}

function closeModal() {
    beneficiaryModal.classList.add('hidden');
    form.reset();
}

document.querySelector('.close-btn').addEventListener('click', closeModal);
window.addEventListener('click', (e) => {
    if (e.target === beneficiaryModal) closeModal();
});