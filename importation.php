<?php
include "connection.php";
include "isdir.php";
$creation = new create_folder();
$result['alerte'] = '';
$result['valide'] ='';
$result['message']='';
$matricule= $_POST["matricule"] ;
$qr = "SELECT * FROM \"PERSONNEL\" where \"MATRICULE\"='$matricule'" or die('Erreur matricule');
$con = new connection_base();
$resu = $con->getresult($qr);
$line = pg_fetch_array($resu);
if (pg_affected_rows($resu)> 0){
    $sql = "select * from \"SUIVI_FICHIER\" where \"MATRICULE\"= '$matricule' AND \"DATEFIN\" is null  ORDER BY \"idenr\" ASC";
    $resu = $con->getresult($sql);
    $line = pg_fetch_array($resu);
    $commande = $line["COMMANDE"];
    $zlot = $line["LOT"];
    $lotencours  = $line["NOM_FICHIER"];
    $createfolder = $creation->creation_repertoire($commande,$zlot);
    if ($line["ETAPE"] == 'RECHERCHE'){
        $sql2 = "select * from \"SUIVI_FICHIER\" where \"LOT\"= '$zlot' AND \"ETAPE\"='TRANSFORMATION' ORDER BY \"idenr\" ASC";
        $resu2 = $con->getresult($sql2);
        $line2 = pg_fetch_array($resu2);
        while ($line = pg_fetch_array($resu2)) {
            $serveursaisie = "\\\\192.168.10.122\\saisies\\" . $line2["COMMANDE"] . "\\" . $line2["NOM_FICHIER"];
            $destination = "C:\\work\\atraiter\\" . $line2["COMMANDE"] . "\\" . $line2["NOM_FICHIER"];
            if (!copy($serveursaisie, $destination)) {
                $result['alerte'] = "La copie $lien du fichier au $destination a échoué...";
                $result['valide'] = "ko";
                echo json_encode($result);
                return;
            }
            $destination = "C:\\work\\fini\\" . $line["COMMANDE"] . "\\" . $lotencours;
            if (!copy($serveursaisie, $destination)) {
                $result['alerte'] = "La copie $lien du fichier au $destination a échoué...";
                $result['valide'] = "ko";
                echo json_encode($result);
                return;
            }
        }
        $result['message'] = "Copie des fichiers terminée";
    }
    if ($line["ETAPE"] == 'CONTROLE WEB'){
        $sql2 = "select * from \"SUIVI_FICHIER\" where \"LOT\"= '$zlot' AND \"ETAPE\"='RECHERCHE' ORDER BY \"idenr\" ASC";
        $resu2 = $con->getresult($sql2);
        while ($line2 = pg_fetch_array($resu2)) {
            $serveursaisie = "\\\\192.168.10.122\\rejets\\" . $line2["COMMANDE"] . "\\" . $line2["NOM_FICHIER"];
            $destination = "C:\\work\\atraiter\\" . $line2["COMMANDE"] . "\\" . $line2["NOM_FICHIER"];
            if (!copy($serveursaisie, $destination)) {
                $result['alerte'] = "La copie $lien du fichier au $destination a échoué...";
                $result['valide'] = "ko";
                echo json_encode($result);
                return;
        }
            $destination = "C:\\work\\fini\\" . $line2["COMMANDE"] . "\\" . $lotencours;
            if (!copy($serveursaisie, $destination)) {
                $result['alerte'] = "La copie $lien du fichier au $destination a échoué...";
                $result['valide'] = "ko";
                echo json_encode($result);
                return;
        }
        }
        $result['message'] = "Copie des fichiers terminée";

    }
    if ($line["ETAPE"] == 'LIVRAISON'){
        $sql4 = "select * from \"SUIVI_FICHIER\" where \"LOT\"= '$zlot' AND \"ETAPE\"='CONTROLE WEB' ORDER BY \"idenr\" ASC";
        $resu4 = $con->getresult($sql4);
        $line4 = pg_fetch_array($resu4);
        $serveursaisie = "\\\\192.168.10.122\\controles\\"  . $line["COMMANDE"] . "\\" .  $line["NOM_FICHIER"];
        $destination = "C:\\work\\atraiter\\" .  $line4["NOM_FICHIER"];
        if (!copy($serveursaisie, $destination)) {
            $result['alerte'] = "La copie $lien du fichier au $destination a échoué...";
            $result['valide'] = "ko";
            echo json_encode($result);
            return;
        }
        $destination = "C:\\work\\fini\\" . $line2["COMMANDE"] . "\\" . $lotencours;
        if (!copy($serveursaisie, $destination)) {
            $result['alerte'] = "La copie $lien du fichier au $destination a échoué...";
            $result['valide'] = "ko";
            echo json_encode($result);
            return;
        }

        $result['message'] = "Copie des fichiers terminée";

    }
    if ($line["ETAPE"] == 'TRANSFORMATION'){
        $result['message'] = "Le nom de votre fichier est " . $lotencours;
    }
    $result['alerte'] = $line["NOM_FICHIER"];
    $result['valide'] ='ok';
}

else{
    $result['alerte'] = 'Personnel inconnu';
    $result['valide'] ='ko';
}
echo json_encode($result);

?>