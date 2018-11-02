<?php
include "connection.php";
$pass= $_POST["pass"];
$matricule= $_POST["matricule"] ;
$qr = "SELECT * FROM \"PERSONNEL\" where \"MATRICULE\"='$matricule' and \"MDP\"='$pass'" or die('Erreur');
$con = new connection_base();
$resu = $con->getresult($qr);
$line = pg_fetch_array($resu);

if ($line === false) {
    echo json_encode(array(
        'connection' => false,
    ));

    exit;
}
$prenom = $line["PRENOM"];
$nom = $line["NOM"];
$fonction = $line["FONCTION"];
$pseudo = $line["PSEUDO"];

$suivipointage = $con->getResult("SELECT * FROM \"POINTAGE\" WHERE \"MATRICULE\"='$matricule' ORDER BY idpointage DESC") or die('Erreur pointage 22 authentification.php');
$pointage = pg_fetch_array($suivipointage);
if (pg_affected_rows($suivipointage) > 1) {
    if ($suivipointage["DATE_ENTREE"] != "" && $suivipointage["HEURE_FIN" != ""]) {
        $result['pointage'] = false;
    } else {
        $result['pointage'] = true;
    }
};

$suivifichier = $con->getResult("SELECT * FROM \"SUIVI_FICHIER\" WHERE \"MATRICULE\"='$matricule' and  \"DATEFIN\" is null ORDER BY \"COMMANDE\" ASC") or die('Erreur suivi fichier');
$suivi = pg_fetch_array($suivifichier);


//$result = array(
    $result['personne'] = $line;
    $result['connection'] = true;
//);

if (pg_affected_rows($suivifichier) == 1) {
    //manana asa
    $result['zlot'] = $suivi["LOT"];
    $result['zcommande'] = $suivi["COMMANDE"];
    $result['zetape'] = $suivi["ETAPE"];
    $result['hasWork'] = true;
}else{
    $result['hasWork'] = false;
    $quernbCommande = "SELECT DISTINCT \"COMMANDE\" FROM \"FICHIER\" where \"POSITION_FINALE\" <> 'fini' ORDER BY \"COMMANDE\"" or die('Erreur');
    $resnbCommande = $con->getResult($quernbCommande) or die('échec de la requête : ' . pg_last_error());
    $tabloCommande = array();
    if (pg_affected_rows($resnbCommande) > 0) {
        while ($line = pg_fetch_array($resnbCommande, null, PGSQL_ASSOC)) {
            foreach ($line as $col_value) {
            }
            $tabloCommande[] = $col_value;
        }
        $result['commandes'] = $tabloCommande;
        $result['commandes_found'] = true;
    }else{
        $result['commandes_found'] = false;
    }
}
echo json_encode($result);
?>