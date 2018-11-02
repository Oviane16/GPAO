<?php
//$text = "rakoto.doc";
//$last = substr(strrchr($text, "."), 1 );
//print_r($last);
$dir    = 'c:/work';
//$dir    = '\\\\192.168.10.122\\images\\ACTE\\ACTE013\\ACTE0130001\\';
$files1 = scandir($dir);
$files2 = scandir($dir, 1);

print_r($files1);
print_r($files2);
?>