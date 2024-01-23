<?php

    require_once("objet.php");

    class Allergene extends objet {

        protected static string $classe = "Allergene";

        protected static string $identifiant = "numAllergene";

        protected int $numAllergene;
        protected string $nomAllergene;

        public function __construct(int $numAllergene = null, string $nomAllergene = null){
            
            if (!is_null($numAllergene)) {
            
                $this->numAllergene = $numAllergene;
                $this->nomAllergene = $nomAllergene;

            }
        }
        
        public function __toString() {
            $chaine = "Allergène $this->nomAllergene";
            return $chaine;
        }
    }

?>