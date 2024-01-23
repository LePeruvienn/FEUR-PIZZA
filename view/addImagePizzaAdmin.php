<?php
    $nom = $pizza->get("nomPizza");
?>

<main>

    <header><h1> <?php echo $nom; ?> </h1></header>

    <div class="AdminImagePizza">

        <div>
            <img src="img/Pizza/<?php echo str_replace(' ','',$nom); ?>.png">
        </div>

        <div>
            <form action="index.php?objet=Compte&action=updateImagePizza" method="post" enctype="multipart/form-data">

                <input type="hidden" name="nomPizza" value="<?php echo $nom;?>">    

                <label for="fileInput">Choisissez une image (png uniquement):</label>
            
                <input type="file" name="image" id="fileInput" accept="image/*" required>
                
                <br>

                <button type="submit"> Envoyer </button>
            </form>
        </div>

    </div>
    
</main>