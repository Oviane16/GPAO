<?php
include "connection.php";
$mle= $_POST["matricule"];
$motdepasse= $_POST["motdepasse"];
$typepointage = $_POST["position"];
$conenregistrement = new connection_base();
$daty =  getdate () ;
if (strlen($daty['hours']) == 1) {
    $hours ="0" . $daty['hours'];
}
else{
    $hours = $daty['hours'];}
if (strlen($daty['minutes']) == 1){
    $minutes ="0" . $daty['minutes'];}
else{
    $minutes = $daty['minutes'];}
if (strlen($daty['seconds']) == 1){
    $seconds ="0" . $daty['seconds'];}
else{
    $seconds = $daty['seconds'];}
$ora = $hours . ":" . $minutes . ":" . $seconds;
$andro = $daty['year'] . "-" . $daty['mon'] . "-" . $daty['mday'];

$qr = "SELECT * from \"POINTAGE\" where \"MATRICULE\" = '$mle' ORDER BY \"idpointage\" DESC";

$resultpointage = $conenregistrement->getresult($qr)  or die('échec de la requête pointage : ' . pg_last_error());
$lineenregistrement = pg_fetch_array($resultpointage);
if (pg_affected_rows($resultpointage)==0){
    $result['alerte'] ='Personnel inconnu';
    echo json_encode($result);
    return;
}
if ($typepointage=='Entrer'){
    //$zlot = $lineenregistrement["DATE_ENTREE"];

        $sql1 = "SELECT * FROM \"POINTAGE\" WHERE \"MATRICULE\"='$mle' and \"HEURE_FIN\" is null  ORDER BY \"idpointage\" DESC";
        $resultpointage2 = $conenregistrement->getresult($sql1)  or die('échec de la requête pointage2 : ' . pg_last_error());
        $line1 = pg_fetch_array($resultpointage2);
        if (pg_affected_rows($resultpointage2)!=0){
            $result['alerte'] ='Vous n\'avez pas fait de sortie le ' .  $line1["DATE_ENTREE"];
            echo json_encode($result);
            return;
        }
        $sql3 = "SELECT * FROM \"POINTAGE\" WHERE \"MATRICULE\"='$mle' and \"DATE_ENTREE\" = '$andro'  ORDER BY \"idpointage\" DESC";
        $resultpointage3 = $conenregistrement->getresult($sql3)  or die('échec de la requête pointage3 : ' . pg_last_error());
        if (pg_affected_rows($resultpointage3)!=0){
            $result['alerte'] ='Vous avez déjà fait le pointage entrée aujourd\'hui';
            $result['typepointage'] = 'Entrer';
            echo json_encode($result);
            return;
        }
        if ($lineenregistrement["DATE_ENTREE"] ==''){
            $sql4 = "insert into \"POINTAGE\"(\"MATRICULE\",\"DATE_ENTREE\", \"HEURE_ENTREE\")";
            $sql4 .= " values ('$mle'::text, '$andro'::date, '$ora'::text)";
            $resultpointage4 = $conenregistrement->getresult($sql4)  or die('échec de la requête pointage4 : ' . pg_last_error());
            if ($resultpointage4) {
                $result['typepointage'] = 'Sortir';
                $result['alerte'] = "Entrée bien enregistrée";
                echo json_encode($result);
                return;
            }else{
                $result['typepointage'] = 'Entrer';
                $result['alerte'] = "Entrée non enregistrée";
                echo json_encode($result);
                return;
            }
        }else{
            if ($lineenregistrement["HEURE_FIN"]!=''){
                $sql4 = "insert into \"POINTAGE\"(\"MATRICULE\",\"DATE_ENTREE\", \"HEURE_ENTREE\")";
                $sql4 .= " values ('$mle'::text, '$andro'::date, '$ora'::text)";
                $resultpointage4 = $conenregistrement->getresult($sql4)  or die('échec de la requête pointage4 : ' . pg_last_error());
                if ($resultpointage4) {
                    $result['typepointage'] = 'Sortir';
                    $result['alerte'] = "Entrée bien enregistrée";
                    echo json_encode($result);
                    return;
                }else{
                    $result['typepointage'] = 'Entrer';
                    $result['alerte'] = "Entrée non enregistrée";
                    echo json_encode($result);
                    return;
                }

            }
        }
    }else {
    if ($typepointage == 'Sortir') {
        if ($resultpointage) {
            $sql1 = "SELECT * FROM \"POINTAGE\" WHERE \"MATRICULE\"='$mle' and \"HEURE_FIN\" IS NULL  ORDER BY \"idpointage\" DESC";
            $resultpointage2 = $conenregistrement->getresult($sql1) or die('échec de la requête pointage1 : ' . pg_last_error());
            $line2 = pg_fetch_array($resultpointage2);
            if (pg_affected_rows($resultpointage2) != 0) {
                if ($line2["DATE_ENTREE"] != $andro) {
                    $result['alerte'] = 'Vous n\'avez pas fait de sortie le ' . $line2["DATE_ENTREE"];
                    $result['typepointage'] = 'Sortir';
                    echo json_encode($result);
                    return;
                }
                if ($line2["HEURE_FIN"] == '' and $line2["HEURE_ENTREE" != '']) {
                    $pointage = $line2['idpointage'];
                    $sql = "update \"POINTAGE\" set \"MATRICULE\"='$mle'::text,\"DATE_SORTIE\"='$andro'::date, \"HEURE_FIN\"='$ora'::text  WHERE \"idpointage\"='$pointage'";
                    $resultpointage4 = $conenregistrement->getresult($sql) or die('échec de la requête pointage10 : ' . pg_last_error());
                    if ($resultpointage4) {
                        $result['alerte'] = 'Sortie bien enregistrée';
                        $result['typepointage'] = 'Entrer';
                        echo json_encode($result);
                        return;
                    }
                    else{
                        $result['alerte'] = 'Sortie non enregistrée';
                        $result['typepointage'] = 'Sortir';
                        echo json_encode($result);
                        return;

                    }
                }
            }
        }
    }
};
?>