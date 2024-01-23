<?php

    require_once("objet.php");

    class Alerte extends objet {

        protected static string $classe = "Alerte";

        protected static string $identifiant = "numAlerte";

        protected int $numAlerte;
        protected string $dateAlerte;
        protected string $message;

        public function __construct(int $numAlerte = null, string $dateAlerte = null, string $message = null){
            
            if (!is_null($numAlerte)) {
            
                $this->numAlerte = $numAlerte;
                $this->dateAlerte = $dateAlerte;
                $this->message = $message;

            }
        }
        
        public function __toString() {
            $chaine = "Alerte le $this->dateAlerte : $this->message";
            return $chaine;
        }
    }

?>