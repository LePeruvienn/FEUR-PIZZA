let expiryDateInput = document.getElementById("expiry_date");

expiryDateInput.addEventListener("input", function(event) {
    let input = this.value;

    if (event.inputType !== "deleteContentBackward") {
        if (input.length === 2 && !input.includes("/")) {
            this.value = input + "/";
        }
    }
    
    // Remplace tout caractère non numérique sauf le /
    this.value = this.value.replace(/[^\d/]/g, '');

    // Vérification de la longueur pour conserver uniquement MM/YYYY (7 caractères)
    if (this.value.length > 7) {
        this.value = this.value.slice(0, 7);
    }
    // Vérification de la validité de la date uniquement si elle est complète (7 caractères)
    if (input.length === 7) {
        validateDate(input);
    } else {
        document.getElementById("result").innerText = ""; // Efface le message si la date n'est pas complète
    }
});

function validateDate(input) {
    let regex = /^(0[1-9]|1[0-2])\/\d{4}$/; // Vérifie le format MM/YYYY

    if (regex.test(input)) {
        document.getElementById("result").innerText = ""; // Efface le message si la date est valide
    } else {
        document.getElementById("result").innerText = "Format invalide. Entrez MM/YYYY";
    }
}
