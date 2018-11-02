<?php
include "connect.php";
session_start();


if (!isset($_SESSION['connexion']))

{

    $connexion = new Connexion('localhost', 'postgres', 'postgres', 'saisie');

    $_SESSION['connexion'] = $connexion;



    echo 'Actualisez la page !';

}


else

{

    echo '<pre>';

    var_dump($_SESSION['connexion']); // On affiche les infos concernant notre objet.

    echo '</pre>';

}