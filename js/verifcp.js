// Récupère l'élément du champ Code Postal
var cpInput = document.getElementById('cardholder_name');

// Ajoute un écouteur d'événements pour le changement de valeur dans le champ Code Postal
cpInput.addEventListener('input', function(e) {
    // Remplace tout ce qui n'est pas un chiffre par une chaîne vide
    var cpValue = e.target.value.replace(/\D/g, ''); // Utilisation de \D pour cibler les non-chiffres
    // Mise à jour de la valeur dans l'input
    e.target.value = cpValue;
});
