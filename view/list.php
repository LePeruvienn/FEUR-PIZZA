<style>
      .titreAdmin {
      background-color: #333;
      color: #fff;
      padding: 22px;
      text-align: center;
    }
   
    .buttonReturn{
          position: absolute;
          margin-top: -10px;
          margin-left: 10px;
      }
  </style>
<main><?php 
                    if($_SESSION["isAdmin"] == 0){ 
                        
                        ?><div class="titre"><h1>Les <?php echo $classeRecupere."S" ?></h1></div><?php 
                    } 
                    if($_SESSION["isAdmin"] == 1){ 
                        ?><div class="titreAdmin"><h1>Les <?php echo $classeRecupere."S" ?></h1></div><?php 
                    } ?>

    
    <div class="containerarticle">

        <?php
    require_once("./model/Boisson_Exemplaire.php");
            foreach ($tableau as $un) {

                $id = $un->get($identifiant);

                if($classeRecupere::getOne($id)->affichable()){
                    
                   if($_SESSION["isAdmin"] == 0){ 
                         $lienDetails = "<a href='index.php?objet=$classeRecupere&action=displayOne&$identifiant=$id'><p>Plus d'info</p></a>";
                    } 
                    if($_SESSION["isAdmin"] == 1){ 
                        $lienDetails = "<a href='index.php?objet=$classeRecupere&action=modifyPizzaAdmin&numPizza=$id'><p>Modifier</p></a>";
                        $lienDetailsInfo = "<a href='index.php?objet=$classeRecupere&action=allergene&numPizza=$id'><p>Plus d'info</p></a>";
                        $lienDetailsSup = "<a href='index.php?objet=$classeRecupere&action=supprimer&numPizza=$id'><p>Supprimer</p></a>"; 
                        $lienAjouterImage = "<a href='index.php?objet=$classeRecupere&action=ajouterImagePizza&numPizza=$id'><p>Image</p></a>";
                    } 

                    $nom = "nom".ucfirst($classeRecupere)

                    ?>
                        <div class="article">
                            <div class="box1">
                                <img src="<?php echo "img/".$classeRecupere."/".str_replace(' ','',$un->getNom()).".png"?>">
                                <h3 class="h3"><?php echo "{$un->getNom()}";?> </h3>
                                <p><?php echo "{$un->get("prix".ucfirst($classeRecupere))}";?> €</p>
                            </div>
                            <?php if($_SESSION["isAdmin"] == 0){ ?>
                            <div class="box2">


                                <?php $classeRecupereToUse = $classeRecupere."_Exemplaire";
                                if($classeRecupere != "Pizza"){ 
                                    $Rep = $classeRecupereToUse::existe($id);
                                    if($Rep){ ?>
                                    <a href="<?php echo "index.php?objet=Panier&action=add&articleAdd=$id&type=$classeRecupere"?>"><h3 class="h3">Ajoutez au panier</h3></a>
                                    <?php }else{?>
                                        <a ><h3 class="Rupture">En Rupture de stock</h3></a>
                                    <?php } ?>
                                <?php } else{ ?>
                                    <a href="<?php echo "index.php?objet=Panier&action=add&articleAdd=$id&type=$classeRecupere"?>"><h3 class="h3">Ajoutez au panier</h3></a>
                                 <?php } ?>


                                <?php echo "$lienDetails";?>
                            </div>
                            <?php } ?>
                            <?php if($_SESSION["isAdmin"] == 1){ ?>
                            <div class="box2">
                                <?php echo "$lienDetails";?>
                                <?php echo "$lienDetailsInfo";?>
                                <?php echo "$lienAjouterImage";?>
                                <?php echo "$lienDetailsSup";?>
                            </div>
                            <?php } ?>
                        </div>

                    <?php
                }
            }
        ?>
        </div>
</main>