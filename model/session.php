<?php

    class session {

        public static function compteConnected(){
            return isset($_SESSION["login"]);
        }

        public static function adminConnected(){
            return isset($_SESSION["login"]) && $_SESSION["isAdmin"] == 1;
        }

        public static function compteConnecting(){
            return isset($_GET["action"]) && $_GET["action"] == "connect";
        }
    }

?>