<html>
<?php
//fichier lister_repertoire.php

$repertoire='c:\work'; //le repertoire PRINCIPAL a lister attention mettre le chemin relatif par rapport a ce script
if(isset($_GET['sRep'])){ //si c'est un appel suite a un clik sur un lien d'un sous repertoire on va lister ce sous rep
    $sousRep_a_lister=$_GET['sRep'];
    $array_sRep=array();
    if ($handle = opendir($repertoire."\\".$sousRep_a_lister)) {
        $array_sRep=array();

        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {//on ne tient pas compte des fichiers . et .. (Unix)
                echo $file;
                $array_sRep[]=$file;//on empile dans un array
            }
        }
        closedir($handle);
    }
}else{
    $sousRep_a_lister="";
}

if ($handle = opendir($repertoire)) {
    $array_repertoire=array();
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {//on ne tient pas compte des fichiers . et .. (Unix)
            $array_repertoire[]=$file;//on empile dans un array
        }
    }
    closedir($handle);


    //affichage liste sous REp et eventuellement les fichiers

    for ($i=0;$i<sizeof($array_repertoire);$i++){
        echo '<a href="'.$repertoire."\\".$array_repertoire[$i].'">'.$array_repertoire[$i].'</a><br />';
        //si on doit lister ce sous rep (liste des fichiers)
       // echo $array_repertoire[$i] . "<br>";

        if($array_repertoire[$i]==$sousRep_a_lister){
            for($j=0;$j<sizeof($array_sRep);$j++){

                echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$repertoire."/".$sousRep_a_lister."/".$array_sRep[$j].'>'.$repertoire."/".$sousRep_a_lister."/".$array_sRep[$j].'</a><br />';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$repertoire."/".$sousRep_a_lister."/".$array_sRep[$j].'>'.$repertoire."/".$sousRep_a_lister."/".$array_sRep[$j].'</a><br />';
            }
        }

    }
}
?>
</html>