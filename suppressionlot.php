<?php
include "connection.php";
$commande= strtoupper($_POST["commande"]);
$conenregistrement = new connection_base();

$qr = "DELETE FROM \"LISTEIMAGE\" where \"COMMANDE\"='$commande'";
$resultdelete = $conenregistrement->getresult($qr)  or die('échec : ' . pg_last_error());
$qr = "DELETE FROM \"FICHIER\" where \"COMMANDE\"='$commande'";
$resultdelete = $conenregistrement->getresult($qr)  or die('échec : ' . pg_last_error());
$qr = "DELETE FROM \"PREPARATION\" where \"COMMANDE\"='$commande'";
$resultdelete = $conenregistrement->getresult($qr)  or die('échec : ' . pg_last_error());
$qr = "DELETE FROM \"ETAPE\" where \"COMMANDE\"='$commande'";
$resultdelete = $conenregistrement->getresult($qr)  or die('échec : ' . pg_last_error());
$result['test'] ='ok';
$dossier = '\\\\192.168.10.122\\images\\' . substr($commande,0,4) . '\\' . $commande;
/*
$result['message'] = 'Suppression des images du dossier '  . $commande . ' terminée';
echo json_encode($result);
exit;
$dir_iterator = new RecursiveDirectoryIterator($dossier);
$iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::CHILD_FIRST);

// On supprime chaque dossier et chaque fichier	du dossier cible
foreach($iterator as $fichier){
    echo $fichier . "<br/>\n";
    $fichier->isDir() ? rmdir($fichier) or die(pg_last_error()): unlink($fichier) or die(pg_last_error());
}

// On supprime le dossier cible
rmdir($dossier) or die(pg_last_error());
*/
if (is_dir($dossier)== false){
    $result['message'] = 'Pas d\'images pour la commande '  . $commande;
    echo json_encode($result);
    return;
}

if ($handle = opendir($dossier)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
//            echo $file . " REPERTOIRE<br/>\n";

            if ($handle1 = opendir($dossier . '\\' . $file)) {
                while (false !== ($file1 = readdir($handle1))) {
                    if ($file1 != "." && $file1 != "..") {
//                        echo $file1 . " FICHIER<br/>\n";
//                        echo $dossier . '\\' . $file . '\\'. $file1 . " ireo<br>\n";
                        unlink($dossier . '\\' . $file . '\\'. $file1);
                    }
                }
                closedir($handle1);
            };
            rmdir($dossier . '\\' . $file );
            }
    }
    closedir($handle);
    rmdir($dossier);
};

$result['message'] = 'Suppression '  . $commande . ' terminée';
echo json_encode($result);
return;



?>         

                                                                                                                                                                                                                                                                                                                                                                                                                                               