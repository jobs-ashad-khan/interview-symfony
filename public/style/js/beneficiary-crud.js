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