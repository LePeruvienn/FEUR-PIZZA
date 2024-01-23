// Récupérer l'élément input par son ID
const cardholderInput = document.getElementById('cardholder_nam');

// Ajouter un gestionnaire d'événements pour l'événement 'input'
cardholderInput.addEventListener('input', function() {
  this.value = this.value.replace(/[^A-Za-zÀ-ÿ\- .]/g, '').toUpperCase(); // Autorise lettres avec accents, '-', espace et '.', convertit en majuscules
});
