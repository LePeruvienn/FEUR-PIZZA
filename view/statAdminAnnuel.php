<main>

<header><h1>STATISTIQUES</h1></header>

    <div class="Stat">
        <div class="wrapper">
            
                <div class="panel-header">
                <h3 class="title">Top sell :  <?php echo $PizzaPlusVendue[0]["PizzaPlusVendue"];?>  :  <?php echo $DessertPlusVendu[0]["DessertPlusVendu"];?>  :  <?php echo $BoissonPlusVendue[0]["BoissonPlusVendue"];?></h3>
                    
                    <div class="calendar">
                        <a href="index.php?objet=Compte&action=Day">journalier</a>
                        <a href="index.php?objet=Compte&action=Mensuel">Mensuel</a>
                        <a href="index.php?objet=Compte&action=Annuel">Annuel</a>
                    </div>
                </div>
            
                <div class="panel-body">
                    <div class="element">
                        <h2 class="ChiffreA">Chiffre d'affaire Annuel</h2>
                        <?php $ChiffreN = "ChiffreN"; echo "<h1 class=".$ChiffreN.">".$ChiffreAffaireAnnuel[0][0]." €</h1>";?>
                    </div>
                </div>
        </div>
    </div>

    <ul>
        <li><a class="deco" href="index.php"> RETOUR A L'ACCEUIL </a></li>
    </ul>
</main>