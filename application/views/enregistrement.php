<?php
include "connection.php";
include "isdir.php";
$commande= $_POST["commande"];
$etape= $_POST["etape"];
$matricule= $_POST["matricule"];
$conenregistrement = new connection_base();
$creation = new create_folder();
$qr = "SELECT *  FROM \"FICHIER\" where \"COMMANDE\"='$commande'";
$resultenregistrement = $conenregistrement->getresult($qr)  or die('échec de la requête enregistrement numéro 1 : ' . pg_last_error());
$enregistrement = pg_fetch_array($resultenregistrement);
$tableauenregistrement = array();
if ($enregistrement === false) {
    $result['connection_enregistement'] = false;
    echo json_encode($result);
    exit;
}
$type_etape =$enregistrement["TYPE_TRAITEMENT"];
$qr = "SELECT *  FROM \"FICHIER\" where \"COMMANDE\"='$commande'";
switch($etape) {
    case ("IMAGE"):
        $qr .= " AND \"ETAT_SAISIE\"='0'";
        break;
    case("OCR"):
        //0 non entamé, 1 en cours, 2 fini en OCR, 3 rejet, 4  à suivre,  5 fini
        $qr .= " AND \"ETAT_SAISIE\"='0'";
        $qr .= " AND \"ETAT_CONTROLE\"='0'";
        $qr .= " AND \"ETAT_LECTURE\"='0'";
        $qr .= " AND \"ETAT_LIVRAISON\"='0'";
        break;
    case("SAISIE 1"):
        //0 non entamé, 1 en cours, 2 fini en OCR, 3 rejet, 4  à suivre,  5 fini
        $qr .= " AND \"ETAT_SAISIE\"='0'";
        $qr .= " AND \"ETAT_CONTROLE\"='0'";
        $qr .= " AND \"ETAT_LECTURE\"='0'";
        $qr .= " AND \"ETAT_LIVRAISON\"='0'";
        break;
    case("TRANSFORMATION"):
        //0 non entamé, 1 en cours, 2 fini en OCR, 3 rejet, 4  à suivre,  5 fini
        $qr .= " AND \"ETAT_SAISIE\"='0'";
        $qr .= " AND \"ETAT_CONTROLE\"='0'";
        $qr .= " AND \"ETAT_LECTURE\"='0'";
        $qr .= " AND \"ETAT_LIVRAISON\"='0'";
        break;
    case ("CONTROLE WEB"):
        $qr .= " AND \"ETAT_SAISIE\"='2'";
        $qr .= " AND \"ETAT_CONTROLE\"='0'";
        $qr .= " AND \"ETAT_LECTURE\"='2'";
        $qr .= " AND \"ETAT_LIVRAISON\"='0'";
        break;
    case ("CONTROLE"):
        $qr .= " AND \"ETAT_SAISIE\"='2'";
        $qr .= " AND \"ETAT_CONTROLE\"='0'";
        $qr .= " AND \"ETAT_LECTURE\"='0'";
        $qr .= " AND \"ETAT_LIVRAISON\"='0'";
        break;
    case ("CONTROLE ECH"):
        $qr .= " AND \"ETAT_SAISIE\"='2'";
        $qr .= " AND \"ETAT_CONTROLE\"='0'";
        $qr .= " AND \"ETAT_LECTURE\"='0'";
        $qr .= " AND \"ETAT_LIVRAISON\"='0'";
        break;
    case ("RECHERCHE"):
        $qr .= " AND \"ETAT_SAISIE\"='2'";
        $qr .= " AND \"ETAT_CONTROLE\"='0'";
        $qr .= " AND \"ETAT_LECTURE\"='0'";
        $qr .= " AND \"ETAT_LIVRAISON\"='0'";
        break;
    case ("RELECTURE"):
        $qr .= " AND \"ETAT_SAISIE\"='3'";
        $qr .= " AND \"ETAT_CONTROLE\"='2'";
        $qr .= " AND \"ETAT_LECTURE\"='0'";
        $qr .= " AND \"ETAT_LIVRAISON\"='0'";
        $qr .= " AND \"MATRICULE_SAISIE\"<>' + $matricule + '";
        break;
    case ("REJET"):
        $qr .= " AND \"ETAT_SAISIE\"='3'";
        $qr .= " AND \"ETAT_CONTROLE\"='2'";
        $qr .= " AND \"ETAT_LECTURE\"='0'";
        $qr .= " AND \"ETAT_LIVRAISON\"='0'";
        $qr .= " AND \"MATRICULE_SAISIE\"<>' + $matricule + '";
        break;
    case ("LIVRAISON"):
        if ($type_etape <> "COUPON" And $type_etape <> "ANNUAIRE"){
            $qr .= " AND \"ETAT_SAISIE\"='2'";
            $qr .= " AND \"ETAT_CONTROLE\"='2'";
            $qr .= " AND \"ETAT_LIVRAISON\"='0'";
        }else{
            $qr .= " AND \"ETAT_SAISIE\"='2'";
            $qr .= " AND \"ETAT_CONTROLE\"='2'";
            $qr .= " AND \"ETAT_FORMATAGE\"='2'";
            $qr .= " AND \"ETAT_LIVRAISON\"='0'";
        }
    case ("FORMATAGE"):
        if ($type_etape <> "COUPON" And $type_etape <> "ANNUAIRE"){
            $qr .= " AND \"ETAT_SAISIE\"='2'";
            $qr .= " AND \"ETAT_CONTROLE\"='2'";
            $qr .= " AND \"ETAT_LIVRAISON\"='0'";
        }else{
            $qr .= " AND \"ETAT_SAISIE\"='2'";
            $qr .= " AND \"ETAT_CONTROLE\"='2'";
            $qr .= " AND \"ETAT_FORMATAGE\"='2'";
            $qr .= " AND \"ETAT_LIVRAISON\"='0'";
        }
        break;
}
$qr .=  " ORDER BY \"idfichier\" ASC";
$resultenregistrement = $conenregistrement->getresult($qr)  or die('échec de la requête enregistrement numero 2 : ' . pg_last_error());
$lineenregistrement = pg_fetch_array($resultenregistrement);
if ($lineenregistrement === false) {
    $result["tache"] = false;
    $result["commande"] = $commande;
    $result["etape"] = $etape;
    $result["requete"] = $qr;
    echo json_encode($result);
    exit;
}
$idfichier =$lineenregistrement["idfichier"];

$date = date("d-m-Y");
$heure = date("H:i");
$username = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    //adresse IP $_SERVER['REMOTE_ADDR'];
$zlot = $lineenregistrement["NOM_FICHIER"];
$zextension = $lineenregistrement["EXTENSION"];
$idcommande = $lineenregistrement["ID_COMMANDE"];
switch($etape) {
    case ("SAISIE 1"):
        $update_fichier = "update \"FICHIER\" SET \"ETAT_SAISIE\"='1', \"MATRICULE_SAISIE\"= '$matricule'  Where idfichier= $idfichier";
        $enregistrement = $conenregistrement->getresult($update_fichier)  or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
        if ($enregistrement){
            $result['enregistrement_ok'] = "fichier";
            $result['lot'] = $zlot;
        }
        $SQL1 = "insert into \"SUIVI_FICHIER\"(\"LOT\", \"COMMANDE\", \"NOM_FICHIER\", \"MATRICULE\",";
        $SQL1 .=  "\"DATEDEBUT\", \"ORADEBUT\", \"MACHINE\", \"ETAPE\", \"ETAT_SAISIE\", \"ID_COMMANDE\")";
        $SQL1 .=  " values ('$zlot', '$commande' ,";
        $nomfic = $zlot . "SAI" . $matricule . "." . $zextension;
        $SQL1 .=  " '$nomfic', '$matricule', '$date', '$heure', '$username',  '$etape', '1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "suivi_fichier";
        //création des répertoires
        $createfolder = $creation->creation_repertoire($commande,$zlot);
        if ($etape !='COUPON' && $etape != 'ANNUAIRE' && $etape!='WEB'){
                $requeteimage = "SELECT * from \"LISTEIMAGE\" where \"NOM_FICHIER\"='$zlot'";
                $image = $conenregistrement->getresult($requeteimage)  or die('échec de la requête traitement image enregistrement.php ligne 147 : ' . pg_last_error());
                $tableaulien = array();
                $tableaudestination = array();
                //$lienimage = pg_fetch_array($image);
                while ($line = pg_fetch_array($image)) {
                    $lien = $line["LIEN"] . "\\" . $line["NAMEIMAGE"];
                    $destination = "C:\\work\\" . $line["COMMANDE"] . "\\" . $line["NOM_FICHIER"] . "\\" . $line["NAMEIMAGE"];
                    if (!copy($lien, $destination)) {
                        echo "La copie $lien du fichier au $destination a échoué...\n";
                    }
                }
            $result['enregistrement_ok'] = "fichier_un_a_un";
        }else {
            $SQL1 = "insert into \"FICHIER_UN_A_UN\"(\"NOM_FICHIER\",\"LOT\", \"MATRICULE\", \"DATEDEBUT\", \"HEUREDEBUT\",";
            $SQL1 .= "\"COMMANDE\", \"ETAPE\", \"ETAT\", \"ID_COMMANDE\")";
            $SQL1 .= " values ('$nomfic', '$zlot', '$matricule',  '$date',";
            $SQL1 .= "  '$heure', '$commande' ,  '$etape','1', '$idcommande')";
            $enregistrement = $conenregistrement->getresult($SQL1) or die('échec de la requête mise à jour FICHIER_UN_A_UN : ' . pg_last_error());
            if ($enregistrement) $result['enregistrement_ok'] = "fichier_un_a_un";
        }
        break;
    case ("OCR"):
        $update_fichier = "update \"FICHIER\" SET \"ETAT_SAISIE\"='1', \"MATRICULE_SAISIE\"= '$matricule'  Where idfichier= $idfichier";
        $enregistrement = $conenregistrement->getresult($update_fichier)  or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
        if ($enregistrement){
            $result['enregistrement_ok'] = "fichier";
            $result['lot'] = $zlot;
        }
        $SQL1 = "insert into \"SUIVI_FICHIER\"(\"LOT\", \"COMMANDE\", \"NOM_FICHIER\", \"MATRICULE\",";
        $SQL1 .=  "\"DATEDEBUT\", \"ORADEBUT\", \"MACHINE\", \"ETAPE\", \"ETAT_SAISIE\", \"ID_COMMANDE\")";
        $SQL1 .=  " values ('$zlot', '$commande' ,";
        $nomfic = $zlot . "SAI" . $matricule . "." . $zextension;
        $SQL1 .=  " '$nomfic', '$matricule', '$date', '$heure', '$username',  '$etape', '1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "suivi_fichier";
        //création des répertoires
        $createfolder = $creation->creation_repertoire($commande,$zlot);
        if ($etape !='COUPON' && $etape != 'ANNUAIRE' && $etape!='WEB'){
            $requeteimage = "SELECT * from \"LISTEIMAGE\" where \"NOM_FICHIER\"='$zlot'";
            $image = $conenregistrement->getresult($requeteimage)  or die('échec de la requête traitement image enregistrement.php ligne 147 : ' . pg_last_error());
            $tableaulien = array();
            $tableaudestination = array();
            //$lienimage = pg_fetch_array($image);
            while ($line = pg_fetch_array($image)) {
                $lien = $line["LIEN"] . "\\" . $line["NAMEIMAGE"];
                $destination = "C:\\work\\" . $line["COMMANDE"] . "\\" . $line["NOM_FICHIER"] . "\\" . $line["NAMEIMAGE"];
                if (!copy($lien, $destination)) {
                    echo "La copie $lien du fichier au $destination a échoué...\n";
                }
            }
            $result['enregistrement_ok'] = "fichier_un_a_un";
        }else {
            $SQL1 = "insert into \"FICHIER_UN_A_UN\"(\"NOM_FICHIER\",\"LOT\", \"MATRICULE\", \"DATEDEBUT\", \"HEUREDEBUT\",";
            $SQL1 .= "\"COMMANDE\", \"ETAPE\", \"ETAT\", \"ID_COMMANDE\")";
            $SQL1 .= " values ('$nomfic', '$zlot', '$matricule',  '$date',";
            $SQL1 .= "  '$heure', '$commande' ,  '$etape','1', '$idcommande')";
            $enregistrement = $conenregistrement->getresult($SQL1) or die('échec de la requête mise à jour FICHIER_UN_A_UN : ' . pg_last_error());
            if ($enregistrement) $result['enregistrement_ok'] = "fichier_un_a_un";
        }
        break;
    case ("SAISIE"):
        $update_fichier = "update \"FICHIER\" SET \"ETAT_SAISIE\"='1', \"MATRICULE_SAISIE\"= '$matricule'  Where idfichier= $idfichier";
        $enregistrement = $conenregistrement->getresult($update_fichier)  or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
        if ($enregistrement){
            $result['enregistrement_ok'] = "fichier";
            $result['lot'] = $zlot;
        }
        $SQL1 = "insert into \"SUIVI_FICHIER\"(\"LOT\", \"COMMANDE\", \"NOM_FICHIER\", \"MATRICULE\",";
        $SQL1 .=  "\"DATEDEBUT\", \"ORADEBUT\", \"MACHINE\", \"ETAPE\", \"ETAT_SAISIE\", \"ID_COMMANDE\")";
        $SQL1 .=  " values ('$zlot', '$commande' ,";
        $nomfic = $zlot . "SAI" . $matricule . "." . $zextension;
        $SQL1 .=  " '$nomfic', '$matricule', '$date', '$heure', '$username',  '$etape', '1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "suivi_fichier";
        //création des répertoires
        $createfolder = $creation->creation_repertoire($commande,$zlot);
        if ($etape !='COUPON' && $etape != 'ANNUAIRE' && $etape!='WEB'){
            $requeteimage = "SELECT * from \"LISTEIMAGE\" where \"NOM_FICHIER\"='$zlot'";
            $image = $conenregistrement->getresult($requeteimage)  or die('échec de la requête traitement image enregistrement.php ligne 147 : ' . pg_last_error());
            $tableaulien = array();
            $tableaudestination = array();
            //$lienimage = pg_fetch_array($image);
            while ($line = pg_fetch_array($image)) {
                $lien = $line["LIEN"] . "\\" . $line["NAMEIMAGE"];
                $destination = "C:\\work\\" . $line["COMMANDE"] . "\\" . $line["NOM_FICHIER"] . "\\" . $line["NAMEIMAGE"];
                if (!copy($lien, $destination)) {
                    echo "La copie $lien du fichier au $destination a échoué...\n";
                }
            }
            $result['enregistrement_ok'] = "fichier_un_a_un";
        }else {
            $SQL1 = "insert into \"FICHIER_UN_A_UN\"(\"NOM_FICHIER\",\"LOT\", \"MATRICULE\", \"DATEDEBUT\", \"HEUREDEBUT\",";
            $SQL1 .= "\"COMMANDE\", \"ETAPE\", \"ETAT\", \"ID_COMMANDE\")";
            $SQL1 .= " values ('$nomfic', '$zlot', '$matricule',  '$date',";
            $SQL1 .= "  '$heure', '$commande' ,  '$etape','1', '$idcommande')";
            $enregistrement = $conenregistrement->getresult($SQL1) or die('échec de la requête mise à jour FICHIER_UN_A_UN : ' . pg_last_error());
            if ($enregistrement) $result['enregistrement_ok'] = "fichier_un_a_un";
        }
        break;
    case ("TRANSFORMATION"):
        $update_fichier = "update \"FICHIER\" SET \"ETAT_SAISIE\"='1', \"MATRICULE_SAISIE\"= '$matricule'  Where idfichier= $idfichier";
        $enregistrement = $conenregistrement->getresult($update_fichier)  or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
        if ($enregistrement){
            $result['enregistrement_ok'] = "fichier";
            $result['lot'] = $zlot;
        }
        $SQL1 = "insert into \"SUIVI_FICHIER\"(\"LOT\", \"COMMANDE\", \"NOM_FICHIER\", \"MATRICULE\",";
        $SQL1 .=  "\"DATEDEBUT\", \"ORADEBUT\", \"MACHINE\", \"ETAPE\", \"ETAT_SAISIE\", \"ID_COMMANDE\")";
        $SQL1 .=  " values ('$zlot', '$commande' ,";
        $nomfic = $zlot . "SAI" . $matricule . "." . $zextension;
        $SQL1 .=  " '$nomfic', '$matricule', '$date', '$heure', '$username',  '$etape', '1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "suivi_fichier";
        //création des répertoires
        $createfolder = $creation->creation_repertoire($commande,$zlot);
        if ($etape !='COUPON' && $etape != 'ANNUAIRE' && $etape!='WEB'){
            $requeteimage = "SELECT * from \"LISTEIMAGE\" where \"NOM_FICHIER\"='$zlot'";
            $image = $conenregistrement->getresult($requeteimage)  or die('échec de la requête traitement image enregistrement.php ligne 147 : ' . pg_last_error());
            $tableaulien = array();
            $tableaudestination = array();
          //  $lienimage = pg_fetch_array($image);
            while ($line = pg_fetch_array($image)) {
                $lien = $line["LIEN"] . "\\" . $line["NAMEIMAGE"];
                $destination = "C:\\work\\" . $line["COMMANDE"] . "\\" . $line["NOM_FICHIER"] . "\\" . $line["NAMEIMAGE"];
                if (!copy($lien, $destination)) {
                    echo "La copie $lien du fichier au $destination a échoué...\n";
                }
            }
            $result['enregistrement_ok'] = "fichier_un_a_un";
        }else {
            $SQL1 = "insert into \"FICHIER_UN_A_UN\"(\"NOM_FICHIER\",\"LOT\", \"MATRICULE\", \"DATEDEBUT\", \"HEUREDEBUT\",";
            $SQL1 .= "\"COMMANDE\", \"ETAPE\", \"ETAT\", \"ID_COMMANDE\")";
            $SQL1 .= " values ('$nomfic', '$zlot', '$matricule',  '$date',";
            $SQL1 .= "  '$heure', '$commande' ,  '$etape','1', '$idcommande')";
            $enregistrement = $conenregistrement->getresult($SQL1) or die('échec de la requête mise à jour FICHIER_UN_A_UN : ' . pg_last_error());
            if ($enregistrement) $result['enregistrement_ok'] = "fichier_un_a_un";
        }
        break;
    case ("IMAGE"):
        $update_fichier = "update \"FICHIER\" SET \"ETAT_SAISIE\"='1', \"MATRICULE_SAISIE\"= '$matricule'  Where idfichier= $idfichier";
        $enregistrement = $conenregistrement->getresult($update_fichier)  or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
        if ($enregistrement){
            $result['enregistrement_ok'] = "fichier";
            $result['lot'] = $zlot;
        }
        $SQL1 = "insert into \"SUIVI_FICHIER\"(\"LOT\", \"COMMANDE\", \"NOM_FICHIER\", \"MATRICULE\",";
        $SQL1 .=  "\"DATEDEBUT\", \"ORADEBUT\", \"MACHINE\", \"ETAPE\", \"ETAT_SAISIE\", \"ID_COMMANDE\")";
        $SQL1 .=  " values ('$zlot', '$commande' ,";
        $nomfic = $zlot . "SAI" . $matricule . "." . $zextension;
        $SQL1 .=  " '$nomfic', '$matricule', '$date', '$heure', '$username',  '$etape', '1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "suivi_fichier";
        //création des répertoires
        $createfolder = $creation->creation_repertoire($commande,$zlot);
        $requeteimage = "SELECT * from \"LISTEIMAGE\" where \"NOM_FICHIER\"='$zlot'";
        $image = $conenregistrement->getresult($requeteimage)  or die('échec de la requête traitement image enregistrement.php ligne 147 : ' . pg_last_error());
        $tableaulien = array();
        $tableaudestination = array();
        //$lienimage = pg_fetch_array($image);
        while ($line = pg_fetch_array($image)) {
            $lien = $line["LIEN"] . "\\" . $line["NAMEIMAGE"];
            $destination = "C:\\work\\" . $line["COMMANDE"] . "\\" . $line["NOM_FICHIER"] . "\\" . $line["NAMEIMAGE"];
            if (!copy($lien, $destination)) {
                echo "La copie $lien du fichier au $destination a échoué...\n";
            };
        };
/*
        $SQL1 = "insert into \"FICHIER_UN_A_UN\"(\"NOM_FICHIER\",\"LOT\", \"MATRICULE\", \"DATEDEBUT\", \"HEUREDEBUT\",";
        $SQL1 .=  "\"COMMANDE\", \"ETAPE\", \"ETAT\", \"ID_COMMANDE\")";
        $SQL1 .=  " values ('$nomfic', '$zlot', '$matricule',  '$date',";
        $SQL1 .=  "  '$heure', '$commande' ,  '$etape','1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour FICHIER_UN_A_UN : ' . pg_last_error());
*/
        $result['enregistrement_ok'] = "fichier_un_a_un";
        break;
    case ("RECHERCHE"):
        $update_fichier = "update \"FICHIER\" SET \"ETAT_LECTURE\"='1', \"MATRICULE_LECTURE\"= '$matricule'  Where idfichier= $idfichier";
        $enregistrement = $conenregistrement->getresult($update_fichier)  or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
        if ($enregistrement){
            $result['enregistrement_ok'] = "fichier";
            $result['lot'] = $zlot;
        }
        $SQL1 = "insert into \"SUIVI_FICHIER\"(\"LOT\", \"COMMANDE\", \"NOM_FICHIER\", \"MATRICULE\",";
        $SQL1 .=  "\"DATEDEBUT\", \"ORADEBUT\", \"MACHINE\", \"ETAPE\", \"ETAT_SAISIE\", \"ID_COMMANDE\")";
        $SQL1 .=  " values ('$zlot', '$commande' ,";
        $nomfic = $zlot . "LEC" . $matricule . "." . $zextension;
        $SQL1 .=  " '$nomfic', '$matricule', '$date', '$heure', '$username',  '$etape', '1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "suivi_fichier";
        //création des répertoires
        $createfolder = $creation->creation_repertoire($commande,$zlot);
        if ($etape !='COUPON' && $etape != 'ANNUAIRE'){
            $requeteimage = "SELECT * from \"LISTEIMAGE\" where \"NOM_FICHIER\"='$zlot'";
            $image = $conenregistrement->getresult($requeteimage)  or die('échec de la requête traitement image enregistrement.php ligne 147 : ' . pg_last_error());
            $tableaulien = array();
            $tableaudestination = array();
            //$lienimage = pg_fetch_array($image);
            while ($line = pg_fetch_array($image)) {
                $lien = $line["LIEN"] . "\\" . $line["NAMEIMAGE"];
                $destination = "C:\\work\\" . $line["COMMANDE"] . "\\" . $line["NOM_FICHIER"] . "\\" . $line["NAMEIMAGE"];
                if (!copy($lien, $destination)) {
                    echo "La copie $lien du fichier au $destination a échoué...\n";
                }
            }
            $result['enregistrement_ok'] = "fichier_un_a_un";
        }
        $SQL1 = "insert into \"FICHIER_UN_A_UN\"(\"NOM_FICHIER\",\"LOT\", \"MATRICULE\", \"DATEDEBUT\", \"HEUREDEBUT\",";
        $SQL1 .= "\"COMMANDE\", \"ETAPE\", \"ETAT\", \"ID_COMMANDE\")";
        $SQL1 .= " values ('$nomfic', '$zlot', '$matricule',  '$date',";
        $SQL1 .= "  '$heure', '$commande' ,  '$etape','1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1) or die('échec de la requête mise à jour FICHIER_UN_A_UN : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "fichier_un_a_un";

        break;
    case ("RELECTURE"):
        $update_fichier = "update \"FICHIER\" SET \"ETAT_LECTURE\"='1', \"MATRICULE_LECTURE\"= '$matricule'  Where idfichier= $idfichier";
        $enregistrement = $conenregistrement->getresult($update_fichier)  or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
        if ($enregistrement){
            $result['enregistrement_ok'] = "fichier";
            $result['lot'] = $zlot;
        }
        $SQL1 = "insert into \"SUIVI_FICHIER\"(\"LOT\", \"COMMANDE\", \"NOM_FICHIER\", \"MATRICULE\",";
        $SQL1 .=  "\"DATEDEBUT\", \"ORADEBUT\", \"MACHINE\", \"ETAPE\", \"ETAT_SAISIE\", \"ID_COMMANDE\")";
        $SQL1 .=  " values ('$zlot', '$commande' ,";
        $nomfic = $zlot . "LEC" . $matricule . "." . $zextension;
        $SQL1 .=  " '$nomfic', '$matricule', '$date', '$heure', '$username',  '$etape', '1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "suivi_fichier";
        //création des répertoires
        $createfolder = $creation->creation_repertoire($commande,$zlot);
        if ($etape !='COUPON' && $etape != 'ANNUAIRE' && $etape!='WEB'){
            $requeteimage = "SELECT * from \"LISTEIMAGE\" where \"NOM_FICHIER\"='$zlot'";
            $image = $conenregistrement->getresult($requeteimage)  or die('échec de la requête traitement image enregistrement.php ligne 147 : ' . pg_last_error());
            $tableaulien = array();
            $tableaudestination = array();
            //$lienimage = pg_fetch_array($image);
            while ($line = pg_fetch_array($image)) {
                $lien = $line["LIEN"] . "\\" . $line["NAMEIMAGE"];
                $destination = "C:\\work\\" . $line["COMMANDE"] . "\\" . $line["NOM_FICHIER"] . "\\" . $line["NAMEIMAGE"];
                if (!copy($lien, $destination)) {
                    echo "La copie $lien du fichier au $destination a échoué...\n";
                }
            }
            $result['enregistrement_ok'] = "fichier_un_a_un";
        }else {
            $SQL1 = "insert into \"FICHIER_UN_A_UN\"(\"NOM_FICHIER\",\"LOT\", \"MATRICULE\", \"DATEDEBUT\", \"HEUREDEBUT\",";
            $SQL1 .= "\"COMMANDE\", \"ETAPE\", \"ETAT\", \"ID_COMMANDE\")";
            $SQL1 .= " values ('$nomfic', '$zlot', '$matricule',  '$date',";
            $SQL1 .= "  '$heure', '$commande' ,  '$etape','1', '$idcommande')";
            $enregistrement = $conenregistrement->getresult($SQL1) or die('échec de la requête mise à jour FICHIER_UN_A_UN : ' . pg_last_error());
            if ($enregistrement) $result['enregistrement_ok'] = "fichier_un_a_un";
        }
        break;
    case ("CONTROLE WEB"):
        $update_fichier = "update \"FICHIER\" SET \"ETAT_CONTROLE\"='1', \"MATRICULE_CONTROLE\"= '$matricule'  Where idfichier= $idfichier";
        $enregistrement = $conenregistrement->getresult($update_fichier)  or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
        if ($enregistrement){
            $result['enregistrement_ok'] = "fichier";
            $result['lot'] = $zlot;
        }
        $SQL1 = "SELECT \"NOM_FICHIER\" FROM  \"SUIVI_FICHIER\" WHERE \"LOT\"='$zlot' AND \"ETAPE\"='RECHERCHE' AND \"ETAT_SAISIE\"='2'";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER selection nom_fichier : ' . pg_last_error());
        $nomfichiersaisie=$enregistrement['NOM_FICHIER'];

        $SQL1 = "insert into \"SUIVI_FICHIER\"(\"LOT\", \"COMMANDE\", \"NOM_FICHIER\", \"MATRICULE\",";
        $SQL1 .=  "\"DATEDEBUT\", \"ORADEBUT\", \"MACHINE\", \"ETAPE\", \"ETAT_SAISIE\", \"ID_COMMANDE\")";
        $SQL1 .=  " values ('$zlot', '$commande' ,";
        $nomfic = $zlot . "CTL" . $matricule . "." . $zextension;
        $SQL1 .=  " '$nomfic', '$matricule', '$date', '$heure', '$username',  '$etape', '1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "suivi_fichier";
        //création des répertoires
        $createfolder = $creation->creation_repertoire($commande,$zlot);
        $SQL1 = "insert into \"FICHIER_UN_A_UN\"(\"NOM_FICHIER\",\"LOT\", \"MATRICULE\", \"DATEDEBUT\", \"HEUREDEBUT\",";
        $SQL1 .= "\"COMMANDE\", \"ETAPE\", \"ETAT\", \"ID_COMMANDE\")";
        $SQL1 .= " values ('$nomfic', '$zlot', '$matricule',  '$date',";
        $SQL1 .= "  '$heure', '$commande' ,  '$etape','1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1) or die('échec de la requête mise à jour FICHIER_UN_A_UN : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "fichier_un_a_un";
        break;
    case ("CONTROLE"):
        $result['fichier_saisie'] = true;
        $update_fichier = "update \"FICHIER\" SET \"ETAT_CONTROLE\"='1', \"MATRICULE_CONTROLE\"= '$matricule'  Where idfichier= $idfichier";
        $enregistrement = $conenregistrement->getresult($update_fichier)  or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
        if ($enregistrement){
            $result['enregistrement_ok'] = "fichier";
            $result['lot'] = $zlot;
        }
        $sql1 = "SELECT \"NOM_FICHIER\" FROM  \"SUIVI_FICHIER\" WHERE \"LOT\"='$zlot' AND \"ETAPE\"='SAISIE 1' AND \"ETAT_SAISIE\"='2'";
        $enregistrement = $conenregistrement->getresult($sql1)  or die('échec de la requête mise à jour SUIVI_FICHIER selection nom_fichier : ' . pg_last_error());
        $nomfichiersaisie=$enregistrement["NOM_FICHIER"];
        if ($nomfichiersaisie==null){
            $result['fichier_saisie'] = false;
            $result['$SQL1'] = $sql1;
        };
        $SQL1 = "insert into \"SUIVI_FICHIER\"(\"LOT\", \"COMMANDE\", \"NOM_FICHIER\", \"MATRICULE\",";
        $SQL1 .=  "\"DATEDEBUT\", \"ORADEBUT\", \"MACHINE\", \"ETAPE\", \"ETAT_SAISIE\", \"ID_COMMANDE\")";
        $SQL1 .=  " values ('$zlot', '$commande' ,";
        $nomfic = $zlot . "CTL" . $matricule . "." . $zextension;
        $SQL1 .=  " '$nomfic', '$matricule', '$date', '$heure', '$username',  '$etape', '1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "suivi_fichier";
        $result['$commande'] = $commande;
        $result['$zlot'] = $zlot;
        //création des répertoires
        $createfolder = $creation->creation_repertoire($commande,$zlot);
        if ($etape !='COUPON' && $etape != 'ANNUAIRE'){
            $requeteimage = "SELECT * from \"LISTEIMAGE\" where \"NOM_FICHIER\"='$zlot'";
            $image = $conenregistrement->getresult($requeteimage)  or die('échec de la requête traitement image enregistrement.php ligne 147 : ' . pg_last_error());
            $tableaulien = array();
            $tableaudestination = array();
            //$lienimage = pg_fetch_array($image);
            while ($line = pg_fetch_array($image)) {
                $lien = $line["LIEN"] . "\\" . $line["NAMEIMAGE"];
                $destination = "C:\\work\\" . $line["COMMANDE"] . "\\" . $line["NOM_FICHIER"] . "\\" . $line["NAMEIMAGE"];
                if (!copy($lien, $destination)) {
                    echo "La copie $lien du fichier au $destination a échoué...\n";
                }
            }
            if ($nomfichiersaisie != null) {
                $serveursaisie = "\\\\192.168.10.122\saisies\\" . $commande . "\\" . $nomfichiersaisie;
                $destination = "c:\work\atraiter\\" . $line["COMMANDE"] . "\\" . $nomfichiersaisie;
                if (!copy($serveursaisie, $destination)) {
                    echo "La copie $serveursaisie du fichier au $destination a échoué...\n";
                }
            }
        }
        $SQL1 = "insert into \"FICHIER_UN_A_UN\"(\"NOM_FICHIER\",\"LOT\", \"MATRICULE\", \"DATEDEBUT\", \"HEUREDEBUT\",";
        $SQL1 .= "\"COMMANDE\", \"ETAPE\", \"ETAT\", \"ID_COMMANDE\")";
        $SQL1 .= " values ('$nomfic', '$zlot', '$matricule',  '$date',";
        $SQL1 .= "  '$heure', '$commande' ,  '$etape','1', '$idcommande')";
//        $result['jereenake'] = $SQL1;
        $enregistrement = $conenregistrement->getresult($SQL1) or die('échec de la requête mise à jour FICHIER_UN_A_UN : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "fichier_un_a_un";
        break;
    case ("CONTROLE ECH"):
        $update_fichier = "update \"FICHIER\" SET \"ETAT_CONTROLE\"='1', \"MATRICULE_CONTROLE\"= '$matricule'  Where idfichier= $idfichier";
        $enregistrement = $conenregistrement->getresult($update_fichier)  or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
        if ($enregistrement){
            $result['enregistrement_ok'] = "fichier";
            $result['lot'] = $zlot;
        }
        $SQL1 = "SELECT \"NOM_FICHIER\" FROM  \"SUIVI_FICHIER\" WHERE \"LOT\"='$zlot' AND \"ETAPE\"='RECHERCHE' AND \"ETAT_SAISIE\"='2'";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER selection nom_fichier : ' . pg_last_error());
        $nomfichiersaisie=$enregistrement['NOM_FICHIER'];

        $SQL1 = "insert into \"SUIVI_FICHIER\"(\"LOT\", \"COMMANDE\", \"NOM_FICHIER\", \"MATRICULE\",";
        $SQL1 .=  "\"DATEDEBUT\", \"ORADEBUT\", \"MACHINE\", \"ETAPE\", \"ETAT_SAISIE\", \"ID_COMMANDE\")";
        $SQL1 .=  " values ('$zlot', '$commande' ,";
        $nomfic = $zlot . "CTL" . $matricule . "." . $zextension;
        $SQL1 .=  " '$nomfic', '$matricule', '$date', '$heure', '$username',  '$etape', '1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "suivi_fichier";
        //création des répertoires
        $createfolder = $creation->creation_repertoire($commande,$zlot);
        if ($etape !='COUPON' && $etape != 'ANNUAIRE' && $etape!='WEB'){
            $requeteimage = "SELECT * from \"LISTEIMAGE\" where \"NOM_FICHIER\"='$zlot'";
            $image = $conenregistrement->getresult($requeteimage)  or die('échec de la requête traitement image enregistrement.php ligne 147 : ' . pg_last_error());
            $tableaulien = array();
            $tableaudestination = array();
            //$lienimage = pg_fetch_array($image);
            while ($line = pg_fetch_array($image)) {
                $lien = $line["LIEN"] . "\\" . $line["NAMEIMAGE"];
                $destination = "C:\\work\\" . $line["COMMANDE"] . "\\" . $line["NOM_FICHIER"] . "\\" . $line["NAMEIMAGE"];
                if (!copy($lien, $destination)) {
                    echo "La copie $lien du fichier au $destination a échoué...\n";
                }
            }
            $result['enregistrement_ok'] = "fichier_un_a_un";
        }
        $SQL1 = "insert into \"FICHIER_UN_A_UN\"(\"NOM_FICHIER\",\"LOT\", \"MATRICULE\", \"DATEDEBUT\", \"HEUREDEBUT\",";
        $SQL1 .= "\"COMMANDE\", \"ETAPE\", \"ETAT\", \"ID_COMMANDE\")";
        $SQL1 .= " values ('$nomfic', '$zlot', '$matricule',  '$date',";
        $SQL1 .= "  '$heure', '$commande' ,  '$etape','1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1) or die('échec de la requête mise à jour FICHIER_UN_A_UN : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "fichier_un_a_un";

        break;
    case ("REJET"):
        $SQL1 = "SELECT \"NOM_FICHIER\" FROM  \"SUIVI_FICHIER\" WHERE \"LOT\"='$zlot' AND \"ETAPE\"='CONTROLE ECH' AND \"ETAT_SAISIE\"='3'";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER selection nom_fichier : ' . pg_last_error());
        $nomfichiersaisie=$enregistrement['NOM_FICHIER'];

        $update_fichier = "update \"FICHIER\" SET \"ETAT_LECTURE\"='1', \"MATRICULE_LECTURE\"= '$matricule'  Where idfichier= $idfichier";
        $enregistrement = $conenregistrement->getresult($update_fichier)  or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
        if ($enregistrement){
            $result['enregistrement_ok'] = "fichier";
            $result['lot'] = $zlot;
        }
        $SQL1 = "insert into \"SUIVI_FICHIER\"(\"LOT\", \"COMMANDE\", \"NOM_FICHIER\", \"MATRICULE\",";
        $SQL1 .=  "\"DATEDEBUT\", \"ORADEBUT\", \"MACHINE\", \"ETAPE\", \"ETAT_SAISIE\", \"ID_COMMANDE\")";
        $SQL1 .=  " values ('$zlot', '$commande' ,";
        $nomfic = $zlot . "LEC" . $matricule . "." . $zextension;
        $SQL1 .=  " '$nomfic', '$matricule', '$date', '$heure', '$username',  '$etape', '1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1)  or die('échec de la requête mise à jour SUIVI_FICHIER : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "suivi_fichier";
        //création des répertoires
        $createfolder = $creation->creation_repertoire($commande,$zlot);
        if ($etape !='COUPON' && $etape != 'ANNUAIRE' && $etape!='WEB'){
            $requeteimage = "SELECT * from \"LISTEIMAGE\" where \"NOM_FICHIER\"='$zlot'";
            $image = $conenregistrement->getresult($requeteimage)  or die('échec de la requête traitement image enregistrement.php ligne 147 : ' . pg_last_error());
            $tableaulien = array();
            $tableaudestination = array();
            //$lienimage = pg_fetch_array($image);
            while ($line = pg_fetch_array($image)) {
                $lien = $line["LIEN"] . "\\" . $line["NAMEIMAGE"];
                $destination = "C:\\work\\" . $line["COMMANDE"] . "\\" . $line["NOM_FICHIER"] . "\\" . $line["NAMEIMAGE"];
                if (!copy($lien, $destination)) {
                    echo "La copie $lien du fichier au $destination a échoué...\n";
                }
            }
            $result['enregistrement_ok'] = "fichier_un_a_un";
        }
        $SQL1 = "insert into \"FICHIER_UN_A_UN\"(\"NOM_FICHIER\",\"LOT\", \"MATRICULE\", \"DATEDEBUT\", \"HEUREDEBUT\",";
        $SQL1 .= "\"COMMANDE\", \"ETAPE\", \"ETAT\", \"ID_COMMANDE\")";
        $SQL1 .= " values ('$nomfic', '$zlot', '$matricule',  '$date',";
        $SQL1 .= "  '$heure', '$commande' ,  '$etape','1', '$idcommande')";
        $enregistrement = $conenregistrement->getresult($SQL1) or die('échec de la requête mise à jour FICHIER_UN_A_UN : ' . pg_last_error());
        if ($enregistrement) $result['enregistrement_ok'] = "fichier_un_a_un";

        break;
    case "FORMATAGE":
        $result['enregistrement_ok'] = "fichier_un_a_un";
        break;
    case ("LIVRAISON"):
        $result['enregistrement_ok'] = "fichier_un_a_un";
        break;

}
echo json_encode($result);
?>
