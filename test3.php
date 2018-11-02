<?php
$fichier = $_POST["fichier"];
$open =fopen($fichier,"r+");
while(!feof($open)) {
    $lire_ligne = fgets($open,255);
    $result['izy'] =  $lire_ligne;
}

echo json_encode($result);
?>