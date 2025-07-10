async function generateBeneficiary() {
    const response = await fetch('/beneficiary/generate', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    });

    if (!response.ok) {
        throw new Error('Erreur lors de la génération du bénéficiaire');
    }

    return await response.json();
}

async function deleteBeneficiary(id) {
    const response = await fetch(`api/beneficiaries/${id}`, {
        method: 'DELETE',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    });

    if (!response.ok) {
        throw new Error('Erreur lors de la suppression du bénéficiaire');
    }

    return response;
}

async function addBeneficiary(data) {
    const res = await fetch('/api/beneficiaries', {
        method: 'POST',
        headers: { 'Content-Type': 'application/ld+json' },
        body: data
    });

    if (!res.ok) throw new Error("Erreur lors de l'enregistrement");

    return await res.json();
}

async function editBeneficiary(id, data) {
    const res = await fetch(`/api/beneficiaries/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/ld+json' },
        body: data
    });

    if (!res.ok) throw new Error("Erreur lors de la modification");

    return await res.json();
}