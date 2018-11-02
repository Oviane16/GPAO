<?php
include "connection.php";
$mle= $_POST["matricule"];
$motdepasse= $_POST["motdepasse"];
$conenregistrement = new connection_base();
$result['valide'] = false;
$result['alerte'] ='';
$qr = "SELECT * from \"PERSONNEL\" where \"MATRICULE\" = '$mle' and \"ACTION\"='Actif' and \"MDP\" ='$motdepasse'";
$resultenregistrement = $conenregistrement->getresult($qr) or die('échec de la requête personnel : ' . pg_last_error());
$enregistrement = pg_fetch_array($resultenregistrement);
$result['pg_affected_rows'] =  pg_affected_rows($resultenregistrement);
if ($enregistrement==0){
    $result['alerte'] = "Personnel inconnu";
    $result['valide'] = false;
}else{
    $result['valide'] = true;
    $result['alerte'] = $enregistrement["PSEUDO"];
}
echo json_encode($result);

?>
