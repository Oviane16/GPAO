<?php
include "connection.php";
include "isdir.php";
$creation = new create_folder();
$result['alerte'] = '';
$result['valide'] ='';
$result['message']='';
$matricule= $_POST["matricule"] ;
$con = new connection_base();
$sql = "select * from \"SUIVI_FICHIER\" where \"MATRICULE\"= '$matricule' AND \"DATEFIN\" is null  ORDER BY \"idenr\" ASC";
$resu = $con->getresult($sql);
$line = pg_fetch_array($resu);
$commande = $line["COMMANDE"];
$lotencours  = $line["LOT"];
$nomfichier = $line["NOM_FICHIER"];
$result['etape'] = $line["ETAPE"];
if ($line["ETAPE"] == 'TRANSFORMATION'){
    if (is_dir('c:\\work\\fini\\' . $commande . '\\' . $lotencours)== false){
        $result['alerte']('le fichier c:\\work\\fini\\' . $commande . '\\' . $lotencours . ' est introuvable');
        $result['valide'] = "ko";
    };
    if (is_dir('\\\\192.168.10.122\\saisies\\' . $commande)== false){
        mkdir('\\\\192.168.10.122\\saisies\\' . $commande, 0777);
    };
    if (is_dir('\\\\192.168.10.122\\reserve\\' . $commande)== false){
        mkdir('\\\\192.168.10.122\\reserve\\' . $commande, 0777);
    };
    if (is_dir('\\\\192.168.10.122\\reserve\\' . $commande . '\\arechercher')== false){
        mkdir('\\\\192.168.10.122\\reserve\\' . $commande . '\\arechercher', 0777);
    };

    $fichieracopier = 'c:\\work\\fini\\' . $commande . '\\' . $lotencours . '\\' . $nomfichier;
    $destination ='\\\\192.168.10.122\\reserve\\' . $commande . '\\arechercher\\' . $nomfichier;
    if (!copy($fichieracopier, $destination)) {
        $result['alerte'] = "La copie $fichieracopier du fichier au $destination a échoué...";
        $result['valide'] = "ko";
        return;
    }
    $destination ='\\\\192.168.10.122\\saisies\\' . $commande;
    if (!copy($fichieracopier, $destination)) {
        $result['alerte'] = "La copie $fichieracopier du fichier au $destination a échoué...";
        $result['valide'] = "ko";
        return;
    }
    $date = date("d-m-Y");
    $heure = date("H:i");
    $username = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $update_fichier = "update \"FICHIER\" SET \"ETAT_SAISIE\"='2' where \"COMMANDE\"='$commande' and \"NOM_FICHIER\"='$lotencours' and \"MATRICULE_SAISIE\"= '$matricule'";
    $maj_fichier = $conenregistrement->getresult($update_fichier)  or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
    if (!$maj_fichier){
        $result['alerte'] = "La mise à jour de la table FICHIER a échoué...";
        $result['valide'] = "ko";
        return;
    }
    $update_fichier_un_a_un = "update \"FICHIER_UN_A_UN\" SET \"DATEFIN\"='$date', \"HEUREFIN\"='$heure' where \"COMMANDE\"='$commande' and \"LOT\"='$lotencours' and \"MATRICULE_SAISIE\"= '$matricule'";
    $maj_fichier = $conenregistrement->getresult($update_fichier_un_a_un)  or die('échec de la requête mise à jour FICHIER UN A UN: ' . pg_last_error());
    if (!$maj_fichier){
        $result['alerte'] = "La mise à jour de la table FICHIER_UN_A_UN a échoué...";
        $result['valide'] = "ko";
        return;
    }
    $update_suivi_fichier = "update \"SUIVI_FICHIER\" set \"DATEFIN\"='$date', \"ORAFIN\"='$heure', \"ETAT_SAISIE\"='2'";
    $update_suivi_fichier .=  " where \"COMMANDE\"='$commande' and \"LOT\"='$lotencours' and \"MATRICULE\"='$matricule'";
    $maj_fichier = $conenregistrement->getresult($update_suivi_fichier)  or die('échec de la requête mise à jour SUIVI FICHIER: ' . pg_last_error());
    if (!$maj_fichier){
        $result['alerte'] = "La mise à jour de la table SUIVI FICHIER a échoué...";
        $result['valide'] = "ko";
        return;
    }
    $result['alerte'] = "Exportation terminée";
    $result['valide'] = "ok";
    return;

}
if ($line["ETAPE"] == 'RECHERCHE') {
    if (is_dir('c:\\work\\fini\\' . $commande . '\\' . $lotencours) == false) {
        $result['alerte']('le fichier c:\\work\\fini\\' . $commande . '\\' . $lotencours . ' est introuvable');
        $result['valide'] = "ko";
    };
    if (is_dir('\\\\192.168.10.122\\rejets\\' . $commande) == false) {
        mkdir('\\\\192.168.10.122\\rejets\\' . $commande, 0777);
    };
    if (is_dir('\\\\192.168.10.122\\reserve\\' . $commande) == false) {
        mkdir('\\\\192.168.10.122\\reserve\\' . $commande, 0777);
    };
    if (is_dir('\\\\192.168.10.122\\reserve\\' . $commande . '\\acontroler') == false) {
        mkdir('\\\\192.168.10.122\\reserve\\' . $commande . '\\acontroler', 0777);
    };

    $fichieracopier = 'c:\\work\\fini\\' . $commande . '\\' . $lotencours . '\\' . $nomfichier;
    $destination = '\\\\192.168.10.122\\reserve\\' . $commande . '\\arechercher\\' . $nomfichier;
    if (!copy($fichieracopier, $destination)) {
        $result['alerte'] = "La copie $fichieracopier du fichier au $destination a échoué...";
        $result['valide'] = "ko";
        return;
    }
    $destination = '\\\\192.168.10.122\\rejets\\' . $commande;
    if (!copy($fichieracopier, $destination)) {
        $result['alerte'] = "La copie $fichieracopier du fichier au $destination a échoué...";
        $result['valide'] = "ko";
        return;
    }
    $date = date("d-m-Y");
    $heure = date("H:i");
    $username = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $update_fichier = "update \"FICHIER\" SET \"ETAT_LECTURE\"='2' where \"COMMANDE\"='$commande' and \"NOM_FICHIER\"='$lotencours' and \"MATRICULE_LECTURE\"= '$matricule'";
    $maj_fichier = $conenregistrement->getresult($update_fichier) or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
    if (!$maj_fichier) {
        $result['alerte'] = "La mise à jour de la table FICHIER a échoué...";
        $result['valide'] = "ko";
        return;
    }
    $update_fichier_un_a_un = "update \"FICHIER_UN_A_UN\" SET \"DATEFIN\"='$date', \"HEUREFIN\"='$heure' where \"COMMANDE\"='$commande' and \"LOT\"='$lotencours' and \"MATRICULE_SAISIE\"= '$matricule'";
    $maj_fichier = $conenregistrement->getresult($update_fichier_un_a_un) or die('échec de la requête mise à jour FICHIER UN A UN: ' . pg_last_error());
    if (!$maj_fichier) {
        $result['alerte'] = "La mise à jour de la table FICHIER_UN_A_UN a échoué...";
        $result['valide'] = "ko";
        return;
    }
    $update_suivi_fichier = "update \"SUIVI_FICHIER\" set \"DATEFIN\"='$date', \"ORAFIN\"='$heure', \"ETAT_SAISIE\"='2'";
    $update_suivi_fichier .= " where \"COMMANDE\"='$commande' and \"LOT\"='$lotencours' and \"MATRICULE\"='$matricule'";
    $maj_fichier = $conenregistrement->getresult($update_suivi_fichier) or die('échec de la requête mise à jour SUIVI FICHIER: ' . pg_last_error());
    if (!$maj_fichier) {
        $result['alerte'] = "La mise à jour de la table SUIVI FICHIER a échoué...";
        $result['valide'] = "ko";
        return;
    }
    $result['alerte'] = "Exportation terminée";
    $result['valide'] = "ok";
    return;
}
if ($line["ETAPE"] == 'CONTROLE WEB') {
    $tadiavina = 'c:\work\fini\\' . $commande;
    if ($handle = opendir('c:\\work\\fini\\CHDE012\\')) {
        $nahita = false;
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                if (substr(strrchr($file, "."), 1 )=='xls')
                    if ($file == $nomfichier) {
                        $nahita = true;

                    };
            }
        }
        closedir($handle);
    }
    if (!$nahita){
        $result['alerte'] = $tadiavina . ' est introuvable';
        $result['valide'] = "ko";
        echo json_encode($result);
        return;
    }

    if (is_dir('\\\\192.168.10.122\\controles\\' . $commande) == false) {
        mkdir('\\\\192.168.10.122\\controles\\' . $commande, 0777);
    };
    if (is_dir('\\\\192.168.10.122\\reserve\\' . $commande) == false) {
        mkdir('\\\\192.168.10.122\\reserve\\' . $commande, 0777);
    };
    if (is_dir('\\\\192.168.10.122\\controles\\' . $commande . '\\alivrer') == false) {
        mkdir('\\\\192.168.10.122\\controles\\' . $commande . '\\alivrer', 0777);
    };

    $fichieracopier = 'c:\\work\\fini\\' . $commande . '\\' . $nomfichier;
    $destination = '\\\\192.168.10.122\\reserve\\' . $commande . '\\alivrer\\' . $nomfichier;
    if (!copy($fichieracopier, $destination)) {
        $result['alerte'] = "La copie $fichieracopier du fichier au $destination a échoué...";
        $result['valide'] = "ko";
        echo json_encode($result);
        return;
    }
    $destination = '\\\\192.168.10.122\\controles\\' . $commande . "\\" . $nomfichier;
    if (!copy($fichieracopier, $destination)) {
        $result['alerte'] = "La copie $fichieracopier du fichier au $destination a échoué...";
        $result['valide'] = "ko";
        echo json_encode($result);
        return;
    }


    $date = date("d-m-Y");
    $heure = date("H:i");
    $username = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $update_fichier = "update \"FICHIER\" SET \"ETAT_CONTROLE\"='2' where \"COMMANDE\"='$commande' and \"NOM_FICHIER\"='$lotencours' and \"MATRICULE_CONTROLE\"= '$matricule'"  or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
    $maj_fichier = $con->getresult($update_fichier);
    if (!$maj_fichier) {
        $result['alerte'] = "La mise à jour de la table FICHIER a échoué...";
        $result['valide'] = "ko";
        echo json_encode($result);
        return;
    }
    $update_fichier_un_a_un = "update \"FICHIER_UN_A_UN\" SET \"DATEFIN\"='$date', \"HEUREFIN\"='$heure' where \"COMMANDE\"='$commande' and \"LOT\"='$lotencours' and \"MATRICULE\"= '$matricule' AND \"ETAPE\"='CONTROLE WEB'";
    $maj_fichier = $con->getresult($update_fichier_un_a_un) or die('échec de la requête mise à jour FICHIER UN A UN: ' . pg_last_error());
    if (!$maj_fichier) {
        $result['alerte'] = "La mise à jour de la table FICHIER_UN_A_UN a échoué...";
        $result['valide'] = "ko";
        echo json_encode($result);
        return;
    }
    $update_suivi_fichier = "update \"SUIVI_FICHIER\" set \"DATEFIN\"='$date', \"ORAFIN\"='$heure', \"ETAT_SAISIE\"='2'";
    $update_suivi_fichier .= " where \"COMMANDE\"='$commande' and \"LOT\"='$lotencours' and \"MATRICULE\"='$matricule'";
    $result['$update_suivi_fichier'] = $update_suivi_fichier;

    $maj_fichier = $con->getresult($update_suivi_fichier) or die('échec de la requête mise à jour SUIVI FICHIER: ' . pg_last_error());
    if (!$maj_fichier) {
        $result['alerte'] = "La mise à jour de la table SUIVI FICHIER a échoué...";
        $result['valide'] = "ko";
        echo json_encode($result);
        return;
    }

    $result['alerte'] = "Exportation terminée";
    $result['message'] = "Exportation terminée";
    $result['valide'] = "ok";
}
if ($line["ETAPE"] == 'LIVRAISON') {
    $sql2 = "select * from \"FICHIER\" where \"ETAT_LIVRAISON\"= '1' AND \"MATRICULE_LIVRAISON\"='$matricule' and \"COMMANDE\"='$commande' ORDER BY \"idenr\" ASC";
    $resu2 = $con->getresult($sql2);
    if (pg_affected_rows($resu2) > 0) {
        while ($line2 = pg_fetch_array($resu2)) {
            $destination = "\\\\192.168.10.122\\reserve\\" . $line2["COMMANDE"] . "\\livrer\\" . $line2["NOM_FICHIER"];
            $fichieracopier = "C:\\work\\fini\\" . $line2["COMMANDE"] . "\\" . $line2["NOM_FICHIER"];
            if (!copy($fichieracopier, $destination)) {
                $result['alerte'] = "La copie $fichieracopier du fichier au $destination a échoué...";
                $result['valide'] = "ko";
                echo json_encode($result);
                return;
            }
            $destination = "\\\\192.168.10.122\\livraisons\\" . $line2["COMMANDE"] . $line2["NOM_FICHIER"];
            if (!copy($serveursaisie, $destination)) {
                $result['alerte'] = "La copie $lien du fichier au $destination a échoué...";
                $result['valide'] = "ko";
                echo json_encode($result);
                return;
            }
            $date = date("d-m-Y");
            $heure = date("H:i");
            $username = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $nomfichier = $line2["NOM_FICHIER"];
            $update_fichier = "update \"FICHIER\" SET \"ETAT_LIVRAISON\"='2' where \"COMMANDE\"='$commande' and \"NOM_FICHIER\"='$nomfichier' and \"MATRICULE_LIVRAISON\"= '$matricule'";
            $maj_fichier = $conenregistrement->getresult($update_fichier) or die('échec de la requête mise à jour FICHIER : ' . pg_last_error());
            if (!$maj_fichier) {
                $result['alerte'] = "La mise à jour de la table FICHIER a échoué...";
                $result['valide'] = "ko";
                echo json_encode($result);
                return;
            }
            $update_fichier_un_a_un = "update \"FICHIER_UN_A_UN\" SET \"DATEFIN\"='$date', \"HEUREFIN\"='$heure' where \"COMMANDE\"='$commande' and \"NOM_FICHIER\"='$nomfichier' and \"MATRICULE\"= '$matricule' AND \"ETAPE\"='LIVRAISON'";
            $maj_fichier = $conenregistrement->getresult($update_fichier_un_a_un) or die('échec de la requête mise à jour FICHIER UN A UN: ' . pg_last_error());
            if (!$maj_fichier) {
                $result['alerte'] = "La mise à jour de la table FICHIER_UN_A_UN a échoué...";
                $result['valide'] = "ko";
                echo json_encode($result);
                return;
            }
            $update_suivi_fichier = "update \"SUIVI_FICHIER\" set \"DATEFIN\"='$date', \"ORAFIN\"='$heure', \"ETAT_SAISIE\"='2'";
            $update_suivi_fichier .= " where \"COMMANDE\"='$commande' and \"NOM_FICHIER\"='$nomfichier' and \"MATRICULE\"='$matricule'";
            $maj_fichier = $conenregistrement->getresult($update_suivi_fichier) or die('échec de la requête mise à jour SUIVI FICHIER: ' . pg_last_error());
            if (!$maj_fichier) {
                $result['alerte'] = "La mise à jour de la table SUIVI FICHIER a échoué...";
                $result['valide'] = "ko";
                echo json_encode($result);
                return;
            }

        }
        $result['message'] = "Exportation des fichiers terminée";
        $result['valide'] = "ok";

    }
}
echo json_encode($result);

?>