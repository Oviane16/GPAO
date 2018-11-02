<?php
include "connection.php";
$mle= $_POST["matricule"];
$motdepasse= $_POST["motdepasse"];
$conenregistrement = new connection_base();
$result['pointage'] = '';
$result['alerte'] ='';
$qr = "SELECT * from \"PERSONNEL\" where \"MATRICULE\" = '$mle' and \"ACTION\"='Actif' and \"MDP\" ='$motdepasse'";
$resultenregistrement = $conenregistrement->getresult($qr)  or die('échec de la requête personnel : ' . pg_last_error());
$enregistrement = pg_fetch_array($resultenregistrement);
if ($enregistrement==0){
    $result['alerte'] = "Personnel inconnu";
    echo json_encode($result);
    exit;
}

$sql1 = "SELECT * FROM \"POINTAGE\" WHERE \"MATRICULE\"='$mle' and \"DATE_SORTIE\" is null ORDER BY \"idpointage\" DESC";
$resultenregistrement = $conenregistrement->getresult($sql1)  or die('échec de la requête pointage : ' . pg_last_error());
$nombre_enregistrement1 = pg_fetch_array($resultenregistrement);
$result['lava'] = pg_num_rows($resultenregistrement);
if (pg_num_rows($resultenregistrement)==0)
        $result['pointage'] = "Entrer";
     else
        $result['pointage'] = "Sortir";
echo json_encode($result);
?>