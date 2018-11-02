<?php
include "connection.php";
$mle= $_POST["matricule"];
$motdepasse= $_POST["motdepasse"];
$con = new connection_base();
$result['valide'] = '';
$result['alerte'] ='';
$result['etape'] ='';
$qr = "SELECT * from \"PERSONNEL\" where \"MATRICULE\" = '$mle' and \"ACTION\"='Actif' and \"MDP\" ='$motdepasse'";
$resultenregistrement = $con->getresult($qr)  or die('échec de la requête personnel : ' . pg_last_error());
$line = pg_fetch_array($resultenregistrement);
if (pg_affected_rows($resultenregistrement)==0){
    $result['alerte'] = "Personnel inconnu";
    $result['valide'] = 'inconnu';
}else{
    $result['prenom']= $line["PRENOM"];
    $result['fonction'] = $line["FONCTION"];
    $result['pseudo'] = $line["PSEUDO"];
    $sql = "SELECT * FROM \"SUIVI_FICHIER\" WHERE (\"ETAPE\"='OCR' and \"MATRICULE\"= '$mle' and  \"DATEFIN\" is null and \"ORAFIN\" is null) ";
    $sql .= "or (\"ETAPE\"='RELECTURE' and \"MATRICULE\"= '$mle' and  \"DATEFIN\" is null and \"ORAFIN\" is null) ";
    $sql .= "or (\"ETAPE\"='SAISIE' and \"MATRICULE\"= '$mle' and  \"DATEFIN\" is null and \"ORAFIN\" is null)";
    $sql .= "or ((\"ETAPE\"='CONTROLE' or \"ETAPE\"='LIVRAISON') and \"MATRICULE\"= '$mle' and  \"DATEFIN\" is null)";
    $sql .= "or ((\"ETAPE\"='TRANSFORMATION' or \"ETAPE\"='LIVRAISON') and \"MATRICULE\"= '$mle' and  \"DATEFIN\" is null)";
    $sql .= "or ((\"ETAPE\"='CONTROLE WEB' or \"ETAPE\"='LIVRAISON') and \"MATRICULE\"= '$mle' and  \"DATEFIN\" is null)";
    $sql .= "or ((\"ETAPE\"='RECHERCHE' or \"ETAPE\"='LIVRAISON') and \"MATRICULE\"= '$mle' and  \"DATEFIN\" is null)";
    $resultsuivi = $con->getresult($sql)  or die('échec de la requête SUIVI_FICHIER : ' . pg_last_error());
    $line1 = pg_fetch_array($resultsuivi);
    if (pg_affected_rows($resultsuivi)!=0) {
        $result['etape']= $line1["ETAPE"];
        $nomfichier = substr($line1["NOM_FICHIER"],0,11);
        $result['$nomfichier'] =  $nomfichier;
        $sql2 = "select * from \"FICHIER\" where \"NOM_FICHIER\"= '$nomfichier'";
        $resultfichier = $con->getresult($sql2)  or die('échec de la requête FICHIER : ' . pg_last_error());
        $result['lava'] = pg_affected_rows($resultfichier);
        $line2 = pg_fetch_array($resultfichier);
//        Vérification si l'opérateur a cliqué sur pointage
        $sql3 = "SELECT * FROM \"POINTAGE\" WHERE \"MATRICULE\"='$mle' ORDER BY \"idpointage\" DESC";
        $resulpointage = $con->getresult($sql3)  or die('échec de la requête POINTAGE : ' . pg_last_error());
        $line3 = pg_fetch_array($resulpointage);
        if (pg_affected_rows($resulpointage)!=0) {
            if ($line3["DATE_ENTREE"] !='' && $line3["HEURE_FIN"] !=''){
                $result['alerte'] = 'Vous n\'avez encore pas fait du pointage';
                $result['valide'] = 'ko';
            }else {
                $result['alerte'] = $line1["NOM_FICHIER"] . " = " . $line2["DEBUT_IMAGE"];
                $result['valide'] = 'ok';
            }
        }else{
            $result['alerte'] = 'Personnel inconnu';
            $result['valide'] = 'inconnu';
        }
    }else{
        $result['alerte'] = "Vous n'avez pas de travail";
        $result['valide'] = 'connu';
    }

}


echo json_encode($result);

?>
