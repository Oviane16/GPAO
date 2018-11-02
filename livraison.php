<?php
include "connection.php";
$commande= $_POST["commande"];
$etape= $_POST["etape"];
$result['livraison']= false;
$conenregistrement = new connection_base();
switch($etape) {
    case ("LIVRAISON"):
        $sql2 = "select \"LOT\", \"COMMANDE\", \"ETAPE\", \"NOM_FICHIER\" from \"SUIVI_FICHIER\" as  temp";
        $sql2 .= " where \"NOM_FICHIER\" in (SELECT \"NOM_FICHIER\" from \"SUIVI_FICHIER\" WHERE \"LOT\" in ";
        $sql2 .= "(select  \"NOM_FICHIER\" from \"FICHIER\" WHERE \"NOM_FICHIER\" in ";
        $sql2 .= "(select distinct \"NOM_FICHIER\" from \"FICHIER\" WHERE \"ETAT_LIVRAISON\"='0'))";
        $sql2 .= " AND \"ETAPE\"='LECTURE' AND \"DATEFIN\" is not null and \"ORAFIN\"  is not null AND \"COMMANDE\"='$commande') or ";
        $sql2 .= " \"NOM_FICHIER\" in (SELECT \"NOM_FICHIER\" from \"SUIVI_FICHIER\" WHERE \"LOT\" in";
        $sql2 .= " (select \"NOM_FICHIER\" from \"FICHIER\" WHERE \"NOM_FICHIER\" in ";
        $sql2 .= "(select distinct  \"NOM_FICHIER\" from \"FICHIER\" WHERE \"ETAT_LIVRAISON\"='0')) ";
        $sql2 .= " AND \"ETAPE\"='CONTROLE' AND \"DATEFIN\" is not null and \"ORAFIN\" is not null AND \"COMMANDE\"='$commande') ";
        $sql2 .= " or \"NOM_FICHIER\" in (SELECT \"NOM_FICHIER\" from \"SUIVI_FICHIER\" WHERE \"LOT\" IN ";
        $sql2 .= " (select \"NOM_FICHIER\" from \"FICHIER\" WHERE  \"NOM_FICHIER\" IN";
        $sql2 .= " (select distinct \"NOM_FICHIER\" from \"FICHIER\" WHERE \"ETAT_LIVRAISON\"='0')) ";
        $sql2 .= " AND \"ETAPE\"='CONTROLE WEB' AND \"DATEFIN\" is not null and \"ORAFIN\" is not null AND \"COMMANDE\"='$commande') ORDER BY \"NOM_FICHIER\"";
        $enregistrement = $conenregistrement->getresult($sql2)  or die('échec de la requête livraison : ' . pg_last_error());;
        $tableaulivraison = array();
        if (pg_affected_rows($enregistrement) > 0) {
            while ($line = pg_fetch_array($enregistrement)) {
                $tableaulivraison[] = $line["NOM_FICHIER"];
            }
            $result['donneeslivraison'] = $tableaulivraison;
            $result['livraison']= true;
            $result['enregistrement_ok'] = "fichier_un_a_un";
        }
        else
            $result['enregistrement_ok'] = "tsy nahita";
        break;
    default:
        break;

}
echo json_encode($result);



?>