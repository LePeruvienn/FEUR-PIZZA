<?php

    require_once("objet.php");

    class Espece extends objet {

        protected static string $classe = "Espece";

        protected static string $identifiant = "numEspece";

        protected int $numEspece;
        protected float $total;
        protected float $monnaie;

        public function __construct(int $numEspece = null, float $total = null, float $monnaie = null){
            
            if (!is_null($numEspece)) {
            
                $this->numEspece = $numEspece;
                $this->total = $total;
                $this->monnaie = $monnaie;
            }
        }
        
        public function __toString() {
            $chaine = "Espece, Total : $this->total, Monnaie : $this->monnaie ";

            return $chaine;
        }
    }

?>