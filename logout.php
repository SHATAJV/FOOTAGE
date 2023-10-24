<?php
session_start(); 
if (session_destroy())//detruire tous les session
{
    header("Location: home.php"); //rediger vers la page d'accueil
}


?>