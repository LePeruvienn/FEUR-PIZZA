// Récupère l'élément du champ CVV
var cvvInput = document.getElementById('cvv');

// Ajoute un écouteur d'événements pour le changement de valeur dans le champ CVV
cvvInput.addEventListener('input', function(e) {
    // Remplace tout ce qui n'est pas un chiffre par une chaîne vide
    cvvInput = e.target.value.replace(/[^\d]/, '');

    const maxLength = 3;
    if (cvvInput.length > maxLength) {
        cvvInput = cvvInput.slice(0, maxLength);

        // Mise à jour de la valeur dans l'input
    e.target.value = cvvInput;
    }
});
