// Sélection de l'élément input
const cardNumberInput = document.getElementById('card_number');

// Écoute des événements de saisie dans l'input
cardNumberInput.addEventListener('input', function(e) {
    // Récupération de la valeur sans les espaces et autres caractères non-numériques
    let cardNumberValue = e.target.value.replace(/\D/g, '');

    // Ajout d'espaces tous les quatre caractères
    cardNumberValue = cardNumberValue.replace(/(\d{4})(?=\d)/g, '$1 ').trim();

    // Limiter la longueur maximale
    const maxLength = 19;
    if (cardNumberValue.length > maxLength) {
        cardNumberValue = cardNumberValue.slice(0, maxLength);
    }

    // Mise à jour de la valeur dans l'input
    e.target.value = cardNumberValue;
});
