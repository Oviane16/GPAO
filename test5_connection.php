<?php
include "connect.php";
$connexion = new Connexion(localhost', 'postgres', 'server', 'saisie');
$_SESSION['connexion'] = serialize($connexion);
?>