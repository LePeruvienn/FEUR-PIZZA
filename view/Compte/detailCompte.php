    <main>
        <div class="moncompte">


            <div class="comptegrid">

                <div class="compteleft">
                    <form>

                        <input type="hidden" name="objet" value="Compte">
                        <input type="hidden" name="action" value="Update">

                        <div class="pp">
                            <img src="img/compte.png">
                            
                        </div>

                        <div class="infos">

                            <div class="login">
                                <h2>Login :</h2> <input name="login" type="text" value="<?php echo $compte->get("login");?>">
                            </div>
                    
                            <div class="nom">
                                <h2>Nom :</h2> <input name="nom" type="text" value="<?php echo $compte->get("nom");?>">
                            </div>
                    
                            <div class="prenom">
                                <h2>Prenom :</h2> <input name="prenom" type="text" value="<?php echo $compte->get("prenom");?>">
                            </div>
                    
                            <div class="email">
                                <h2>E-mail :</h2> <input name="email" type="text" value="<?php echo $compte->get("email");?>">
                            </div>
                    
                            <div class="tel">
                                <h2>Telephone :</h2> <input name="telephone" type="text" value="<?php echo $compte->get("telephone");?>">
                            </div>

                            <div class="mdp">
                                <h2>Mot de passe :</h2> <input name="mdp" type="text" placeholder="Nouveau mot de passe">
                            </div>
            
                            <button type="submit">Sauvegarder</button>
                        </div>
                    </form>
                </div>

                <div class="compteright">

                    <div class="adresses">

                        <h2>Adresses</h2>

                        <div class="listeadr">

                            <?php 
                                foreach($adresses as $adresse){
                                    ?>
                                    <div class="adresse">
                                        <div>
                                            <p><?php echo $adresse->get("numero")." ".$adresse->get("rue");?></p>
                                            <p><?php echo $adresse->get("ville")." ".$adresse->get("codePostal");?></p>
                                        </div>
                                        <div>
                                            <form>
                                                <input type="hidden" name="objet" value="Compte">
                                                <input type="hidden" name="action" value="supprAdresse">
                                                <input type="hidden" name="numAdresse" value="<?php echo $adresse->get("numAdresse");?>">
                                                <input type="submit" value="Supprimer">
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                            
                        </div>

                        
                        <div class="buttonPizza">
                            <a onclick="openPopupB()" class="stockInput">Enregister une nouvelle adresse </a>
                        </div>

                    </div>

                    <div class="cartedecredit">

                        <h2>Carte de credits</h2>

                        <div class="listcarte">

                            <?php
                                foreach($cartes as $unecarte){
                                    ?>
                                        <div class="carte">
                                            <div>
                                                <p>Nom du Titulaire de la carte : <?php echo $unecarte->get("nomTitulaire");?> </p>
                                                <p>CCV : <?php echo $unecarte->get("CCV");?></p>
                                            </div>
                                            <div>
                                                <form>
                                                    <input type="hidden" name="objet" value="Compte">
                                                    <input type="hidden" name="action" value="supprCarte">
                                                    <input type="hidden" name="CCV" value="<?php echo $unecarte->get("CCV");?>">
                                                    <input type="hidden" name="nomTitulaire" value="<?php echo $unecarte->get("nomTitulaire");?>">
                                                    <input type="submit" value="Supprimer">
                                                </form>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>

                        </div>
                        
                        <div class="buttonPizza">
                            <a onclick="openPopupD()" class="stockInput">Enregister une nouvelle Carte </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        
        <div class="overlayD" id="overlayD">
        <div class="popup">
            <div class="popupimg">
                <img src="img/fermer.png" alt="Image" onclick="closePopupD()">
            </div>
            <span class="close-btn" onclick="closePopupD()"></span>
            <form>
                <input type="hidden" name="objet" value="Compte">
                <input type="hidden" name="action" value="creationCarte">
               
                <div class="paiement">
                <div class="titulaire">
                    <h3>Nom du Titulaire</h3>
                    <input type="text" id="cardholder_nam" name="cardholder_name" placeholder="Nom" required>
                    <script src="js/verifnom.js"></script>
                </div>

                <div class="numCarte">
                    <h3>Numero de Carte</h3>
                    <input type="num" id="card_number" name="card_number" placeholder="Numéro" minlength="19" maxlength="19" required>
                    <script src="js/verifnumcb.js"></script>
                </div>
                
                <div class="expirationDate">
                    <h3>Date d'Expiration</h3>
                    <input type="text" id="expiry_date" name="expiry_date" placeholder="MM-YY" minlength="7" maxlength="7" required>
                    <p id="result"></p>
                    <script src="js/verifdate.js"></script>
                </div>
                
                <div class="cvv">
                    <h3>CVV</h3>
                    <input type="number" id="cvv" name="cvv" placeholder="CVV" minlength="3" maxlength="3" required>
                    <script src="js/verifcvv.js"></script>
                </div>

                <input type="submit" value="Créer">
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
            
            <form>
                <input type="hidden" name="objet" value="Compte">
                <input type="hidden" name="action" value="creationadresse">
                
                <div class="adressePOP">
                    
                <div class="titulaire">
                    <h3>Nom de la rue</h3>
                    <input type="text" name="rue" placeholder="rue" required>
                </div>

                <div class="titulaire">
                    <h3>Numero de la rue</h3>
                    <input type="number"  name="numero" placeholder="codePostal" minlength="1" required>
                </div>

                <div class="titulaire">
                    <h3>Nom de la ville</h3>
                    <input type="text"  name="ville" placeholder="ville" required>
                </div>

                <div class="titulaire">
                    <h3>Code Postal</h3>
                    <input type="number"  name="codePostal" placeholder="codePostal" minlength="5" maxlength="5" required>
                    <script src="js/verifcp.js"></script>
                </div>

                <input type="submit" value="Créer">
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
    <main>