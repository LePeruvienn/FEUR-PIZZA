<style>
      header {
      background-color: #333;
      color: #fff;
      padding: 1px;
      text-align: center;
    }
   
    .buttonReturn{
          position: absolute;
          margin-top: 15px;
          margin-left: 13px;
      }
  </style>
<main>
<ul class="buttonReturn">
        <li><a class="deco" href="index.php"> RETOUR A L'ACCEUIL </a></li>
    </ul>
  <header>
    <h1>Stock</h1>
  </header>
   


    <div class="Stock">
        <form>
            <input type="hidden" name="objet" value="Ingredient">
            <input type="hidden" name="action" value="Update">
            <div class="IngredientStock">
                <h2>Ingredients</h2>
                
                <?php
                    $i = 0;
                    foreach ($ingredient as $item){
                        // Vérification si la quantité est égale à zéro
                        $quantite = $item->get("quantiteEnStock");
                        $class = '';
                        if ($quantite == 0) {
                            $class = 'zeroQuantity';
                        }
                        elseif ($quantite < 100) {
                            $class = 'lowQuantity';
                        }
                                ?>
                                    <div class="ingredientStockItem" <?php echo $class; ?>">
                                    <label for="prix" class="<?php echo $class; ?>"><?php echo $item->get("nomIngredient"); ?>:</label>
                                        <input type="number" id="prix" name="quantite<?php echo $i;?>" min="0" step="1" value="<?php echo $item->get("quantiteEnStock");?>" required>
                                        <?php echo $item->get("mesure");?>
                                        <input type="hidden" name="numIngredient<?php echo $i;?>" value="<?php echo $item->get("numIngredient");?>"/>
                                    </div>
                                <?php 
                                $i = $i + 1;
                            } 
                ?>
            </div>
            <div class="buttonPizza1">
                    <button  class="stockInput" type="submit">Enregistrer</button>
                </div>
        </form>
        
        <form><?php if(isset( $_GET["selectBoisson"])){
                    $numBoissonChoisie = $_GET["selectBoisson"];
                    
                    ?><input type="hidden" name="selectBoisson" value="<?php echo $numBoissonChoisie ?>"><?php
                }?>
            <input type="hidden" name="objet" value="Compte">
            <input type="hidden" name="action" value="stockAdmin">
            <div class="DessertStock">
                <h2>Dessert</h2>
                        
                        <select name="selectDessert" class="DessertDesc" onchange="this.form.submit()">
                            <?php
                            $numDessertChoisie = 1;
                            $nomDessertChoisie = "Glace";
                            if(isset($_GET["selectDessert"])){
                                $numDessertChoisie = $_GET["selectDessert"];
                                $nomDessertChoisie = Dessert::getOne($numDessertChoisie)->get("nomDessert");
                            }
                            ?>

                            <option value="<?php echo $numDessertChoisie ?>"> <?php echo $nomDessertChoisie ?></option> <?php
                            foreach ($dessert as $item){

                                if($numDessertChoisie != $item->get("numDessert")){

                                    ?><option value="<?php echo $item->get("numDessert"); ?>">
                                    <?php echo $item->get("nomDessert"); ?>
                                    </option><?php
                                }
                                
                            }
                            ?>
                            </select>
                            
                    <?php //<p class="DessertPrix"><?php echo Dessert::getOne($numDessertChoisie);</p>
                        
                        $i = 0; 
                        $isinacommande = false;
                        foreach ($dessert_Exemplaire as $item){
                            foreach ( $commande_Desserts as $itemInACommande){
                                $isinacommande = false;
                                if($itemInACommande->get("numDessertExemplaire") == $item->get("numDessertExemplaire")){
                                    $isinacommande = true;
                                    break;
                                }
                            }
                            if(!$isinacommande){
                                if($item->get("numDessert") == $numDessertChoisie){
                    ?>
                                        <div class="DessertStockItem">
                                            <p class="DessertDesc">
                                                Num Exemplaire Dessert: <?php echo $item->get("numDessertExemplaire"); ?><br>
                                                Date de Peremption: <?php echo $item->get("datePermetionDessert"); ?><br>
                                                Date d'Achat: <?php echo $item->get("dateAchatDessert"); ?><br>

                                                <?php if ($item->get("datePermetionDessert") < date('Y-m-d', strtotime('now'))): ?>
                                                    <span class="expired">L'item est périmé !!!!</span><br>
                                                    <?php $i = $i - 1; ?>
                                                <?php endif; ?>
                                            </p>
                                            <a class="suppDessertExemplaire" href="index.php?objet=Dessert_Exemplaire&action=supprimer&numDessertExemplaire=<?php echo $item->get("numDessertExemplaire");?>">Supprimer</a>
                                        </div>
                                    <?php 
                                    $i = $i + 1;
                                }   
                            }
                        } 
                    ?><p class="DessertPrix"><?php echo "Il y a ".$i." ".Dessert::getOne($numDessertChoisie)." disponible";?></p>
            </div>
            <div class="buttonPizza2">
                <a onclick="openPopupD()" class="stockInput">Enregister de nouveaux Dessert </a>
            </div>
        </form>

        <form> <?php if(isset( $_GET["selectDessert"])){ 
                    $numDessertChoisie = $_GET["selectDessert"];?>
                    <input type="hidden" name="selectDessert" value="<?php echo $numDessertChoisie ?>"><?php
                }?>
            <input type="hidden" name="objet" value="Compte">
            <input type="hidden" name="action" value="stockAdmin">
            
            <div class="BoissonStock">
                <h2>Boisson</h2>
                        <select name="selectBoisson" onchange="this.form.submit()">
                            <?php 
                            
                           
                            $numBoissonChoisie = 1;
                            $nomBoissonChoisie = "Coca-Cola";
                            if(isset($_GET["selectBoisson"])){
                                $numBoissonChoisie = $_GET["selectBoisson"];
                                $nomBoissonChoisie = Boisson::getOne($numBoissonChoisie)->get("nomBoisson");
                            }?>
                            <option value="<?php echo $numBoissonChoisie ?>"> <?php echo $nomBoissonChoisie ?></option> <?php 
                            foreach ($boisson as $item){
                                if($numBoissonChoisie != $item->get("numBoisson")){

                               
                                ?><option value="<?php echo $item->get("numBoisson"); ?>">
                                    <?php echo $item->get("nomBoisson"); ?>
                                </option><?php 
                                }
                            }
                            ?>
                            </select>
                            
                    <?php //<p class="BoissonPrix"><?php echo Boisson::getOne($numBoissonChoisie);</p>
                        $i = 0; 
                        $isinacommande = false;
                        foreach ($boisson_Exemplaire as $item){
                            foreach ( $commande_Boissons as $itemInACommande){
                                $isinacommande = false;
                                if($itemInACommande->get("numBoissonExemplaire") == $item->get("numBoissonExemplaire")){
                                    $isinacommande = true;
                                    break;
                                }
                                
                            }
                            if(!$isinacommande){
                                if($item->get("numBoisson") == $numBoissonChoisie){
                                    ?>
                                        <div class="BoissonStockItem">
                                            <p class="BoissonDesc">
                                                Num Exemplaire Boisson: <?php echo $item->get("numBoissonExemplaire"); ?><br>
                                                Date de Peremption: <?php echo $item->get("datePermetionBoisson"); ?><br>
                                                Date d'Achat: <?php echo $item->get("dateAchatBoisson"); ?><br>

                                                <?php if ($item->get("datePermetionBoisson") < date('Y-m-d', strtotime('now'))): ?>
                                                    <span class="expired">L'item est périmé !!!!</span><br>
                                                    <?php $i = $i - 1; ?>
                                                <?php endif; ?>
                                            </p>
                                           
                                            <a class="suppDessertExemplaire" href="index.php?objet=Boisson_Exemplaire&action=supprimer&numBoissonExemplaire=<?php echo $item->get("numBoissonExemplaire");?>">Supprimer</a>
                                        </div>
                                    <?php 
                                    $i = $i + 1;
                                }   
                            }
                        } 
                    ?><p class="BoissonPrix"><?php echo "Il y a ".$i." ".Boisson::getOne($numBoissonChoisie)." disponible";?></p>
            </div>
            <div class="buttonPizza3">
                <a onclick="openPopupB()" class="stockInput">Enregister de nouvelle Boisson </a>
            </div>
        </form>
    </div>


    <div class="overlayD" id="overlayD">
        <div class="popup">
            <div class="popupimg">
                <img src="img/fermer.png" alt="Image" onclick="closePopupD()">
            </div>
            <span class="close-btn" onclick="closePopupD()"></span>
            
            <div class="newDessert">
            <h2>Creation de Dessert</h2>
            <form>
            <input type="hidden" name="objet" value="Compte">
            <input type="hidden" name="action" value="stockAdmin">
                <label for="name">Type de Dessert : </label>
                <select name="selectDessertForm" required>
                            <option value="">Choisissez un dessert</option>
                            <?php 
                            $numDessertChoisie = 0;
                            $nomDessertChoisie = "";
                            if(isset($_GET["selectDessertForm"])){
                                $numDessertChoisie = $_GET["selectDessertForm"];
                            }
                            foreach ($dessert as $item){
                                ?><option value="<?php echo $item->get("numDessert"); ?>">
                                    <?php echo $item->get("nomDessert"); ?>
                                </option><?php
                            }
                            ?>
                            </select>
                        </br>
                <label for="name">Nombre de Dessert a Ajoute</label>
                <input name="numbreDessertAdd" type="number" value="" required></br>
                <input type="submit" value="Enregistrer">
            </div>
            
            </form>
        </div>
    </div>


    <div class="overlayB" id="overlayB">
        <div class="popup">
            <div class="popupimg">
                <img src="img/fermer.png" alt="Image" onclick="closePopupB()">
            </div>
            <span class="close-btn" onclick="closePopupB()"></span>
            <div class="newBoisson">
            <h2>Creation de Boisson</h2>
            <form>
            <input type="hidden" name="objet" value="Compte">
            <input type="hidden" name="action" value="stockAdmin">
                <label for="name">Type de Boisson : </label>
                <select name="selectBoissonForm">
                            <option value="">Choisissez une boisson</option>
                            <?php 
                            $numBoissonChoisie = 0;
                            $nomBoissonChoisie = "";
                            if(isset($_GET["selectBoisson"])){
                                $numBoissonChoisie = $_GET["selectBoisson"];
                            }
                            foreach ($boisson as $item){
                                ?><option value="<?php echo $item->get("numBoisson"); ?>">
                                    <?php echo $item->get("nomBoisson"); ?>
                                </option><?php
                            }
                            ?>
                            </select>
                        </br>
                <label for="name">Nombre de Boisson a Ajoute</label>
                <input name="numbreBoissonAdd" type="number" value=""></br>
                <input type="submit" value="Enregistrer">
            </div>
            
            </form>
        </div>
    </div>

    
    <script>
    function openPopupD() {
        document.getElementById('overlayD').style.display = 'flex';
    }
    function closePopupD() {
        document.getElementById('overlayD').style.display = 'none';
    }
    function openPopupB() {
        document.getElementById('overlayB').style.display = 'flex';
    }
    function closePopupB() {
        document.getElementById('overlayB').style.display = 'none';
    }
    </script>




    
</main>

