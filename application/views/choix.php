<?php
include "connection.php";
$commande= $_POST["commande"];
$qr = "SELECT DISTINCT \"ETAPE\" FROM \"ETAPE\" where \"COMMANDE\"='$commande' ORDER BY \"ETAPE\"";
$conetape = new connection_base();
$resultetape = $conetape->getresult($qr)  or die('échec de la requête ETAPE  choix.php ligne 4 ' . pg_last_error());
$tableauetape = array();
if (pg_affected_rows($resultetape) > 0) {
    while ($lineetape = pg_fetch_array($resultetape, null, PGSQL_ASSOC)) {
        foreach ($lineetape as $col_value) {
        }
            $tableauetape[] = $col_value;

    }
    $result['connect_etape'] = $tableauetape;
    $result['connection_etape'] = true;
    $result['izy'] = $qr;


}else{
    $result['connection_etape'] = false;
}
echo json_encode($result);
?>