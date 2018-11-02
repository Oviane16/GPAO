<?php
$fichier = $_POST["fichier"];
//$result['coco'] = basename($_FILES[$fichier]);
$result['path'] = realpath(pathinfo($fichier,PATHINFO_DIRNAME));
$result['coco'] = realpath($fichier);

echo realpath($fichier);
echo json_encode($result);
$result['tenaizy'] = $fichier;
//$result['izy'] =  pathinfo($fichier,  PATHINFO_DIRNAME);
//$result['izy'] =  $_SERVER[$fichier];
$result['izy'] =  $_FILE['avatar'][$fichier];
echo json_encode($result);
?>