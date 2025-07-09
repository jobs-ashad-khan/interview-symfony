// Fonction pour supprimer accents et mettre en minuscule
function normalize(str) {
    return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
}