<?php
include "connection.php";
include "isdir.php";
$matricule= $_POST["matricule"];
$conenregistrement = new connection_base();
$qr = "SELECT *  FROM \"FICHIER\" where \"COMMANDE\"='$commande'";
$resultenregistrement = $conenregistrement->getresult($qr)  or die('échec de la requête enregistrement numéro 1 : ' . pg_last_error());
$enregistrement = pg_fetch_array($resultenregistrement);
$tableauenregistrement = array();
if ($enregistrement === false) {
    $result['connection_enregistement'] = false;
    echo json_encode($result);
    exit;
}

?>