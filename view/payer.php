<main>
  <?php //echo "<pre>";?>
  <?php //print_r($_SESSION);?>
  <?php //echo "</pre>";

       
    ?>
     <!--CHOISIR ADRESSE-->
  <form method="get">
  <div class="choix_adresse">
  
    <h1>Adresse</h1>
    <select name ="adresse" id="choix_adresse">
      <?php
      // Assuming $compteAdressesArray is an array containing Compte_Adresses objects
      foreach ($compteAdressesArray as $compteAdresses) {
        $numAdresse = $compteAdresses->get("numAdresse");
        echo "<option value='$numAdresse'> {$compteAdresses->get("rue")}, {$compteAdresses->get("numero")}, {$compteAdresses->get("ville")}, {$compteAdresses->get("codePostal")}</option>";
      }
      ?>
    </select>
   

  </div>

       <!--BON DE REDUCTION

  <div class="reduction">
    <h3>Bon de reduction</h3>
    <input type="text" id="reduction" name="reduction" placeholder="Bon de reduction" required>
    <button>Appliquer</button>
    <br>
    <h1>Reduction Total : XX €</h1>
  </div>
  <br>
     CARTE BANCAIRE-->

  <div class="paiement">

      <h1>Cartes de credit</h1>
      <select name="carteDeCredit">
        <?php
        // Assuming $compteAdressesArray is an array containing Compte_Adresses objects
        foreach ($cartes as $unecarte) {
                $numCarteDeCredit = $unecarte->get("numCarteDeCredit");
                $nomTitulaire = $unecarte->get("nomTitulaire");
                $numeros = $unecarte->get("numeros");
                $dateExpiration = $unecarte->get("dateExpiration");
          echo "<option value='$numCarteDeCredit'>$nomTitulaire : $numeros $dateExpiration</option>";
        }
        ?>
      </select>

      <input type="hidden" name="objet" value="Compte">
      <input type="hidden" name="action" value="Payment">


      <div class="payer">
        <h1>Total : <?php echo $prixTotalPanier;?> €</h1>
        <button type="submit">Payer</button>
      </div>
   
  </div>
  </form>
  
  <div class="modifInfo">
    <form>  
          <input type="hidden" name="objet" value="Compte">
          <input type="hidden" name="action" value="displayCompte">

          <button>Modifier les informations</button>
    </form>

  </div>
       <!--PAYER-->



</main>