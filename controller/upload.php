<?php

    echo "upload.php";
    /*
    // Vérifie si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer le fichier envoyé
        $image = $_FILES["image"];

        $nomPizza = $_POST["nomPizza"];

        echo $nomPizza;
    
        // Vérifier si le fichier existe
        $uploadDir = "/var/www/html/saes3-apinel2/interface_commande/img/Pizza/";
        $destination = $uploadDir . $nomPizza . ".png";
    
        if (file_exists($destination)) {
            // Supprimer le fichier existant
            unlink($destination);
        }
    
        // Déplacer le nouveau fichier vers le dossier de destination
        move_uploaded_file($image["tmp_name"], $destination);
    
        echo "L'image a été enregistrée avec succès.";

        clearstatcache();
        opcache_reset();
    }
    */
?>