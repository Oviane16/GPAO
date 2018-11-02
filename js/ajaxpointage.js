<?php
include "connection.php";
$mle= $_POST["matricule"];
$motdepasse= $_POST["motdepasse"];
$typepointage = $_POST["validation"];
$result['$typepointage'] = $typepointage;
//$conenregistrement = new connection_base();
$result['alerte'] ='';
$result['typepointage'] ='';
$result['typepointage'] ='coco';
$result['alerte'] ='ato';
echo json_encode($result);
return;



?>