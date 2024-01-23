<main>
        <div class="titre">
            <h1>Les <?php echo $classeRecupere."S FEUR" ?></h1>
        </div>
    
        <div class="containerarticle">
    
            <?php
                foreach ($tableau as $un) {
    
                    $id = $un->get($identifiant);
    
                    if($classeRecupere::getOne($id)->affichable()){
    
                        $lienDetails = "<a href='index.php?objet=$classeRecupere&action=displayOne&$identifiant=$id'><p>Plus d'info</p></a>";
    
                        $nom = "nom".ucfirst($classeRecupere)
    
                        ?>
                            <div class="article">
                                <div class="box1">
                                    <img src="<?php echo "img/".$classeRecupere."/".str_replace(' ','',$un->getNom()).".png"?>">
                                    <h3><?php echo "{$un->getNom()}";?> </h3>
                                    <p><?php echo "{$un->get("prix".ucfirst($classeRecupere))}";?> €</p>
                                </div>
    
                                <div class="box2">
                                    <a href="#"><h3>Ajoutez au panier</h3></a>
                                    <?php echo "$lienDetails";?>
                                </div>
                            </div>
    
                        <?php
                    }
                }
            ?>
            </div>
            <ul>
        <li><a class="deco" href="index.php?"> RETOUR EN ARRIERE </a></li>
    </ul>
    </main>