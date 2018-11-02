<?php
Class Relever_contrl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('assets_helper');
        $this->load->library('PHPExcel');
        $this->load->model('relever_model');
        $this->load->model('adminenpouce_model');
    }
    public function index()
    {
        $data['commande'] = $this->adminenpouce_model->get_commande();
        $this->load->view('relever_view',$data);
    }
    public function get_etape($commande='')
    {
        $data['erreur']=  '<script> alert("Aucun etape trouté pour ce commande");</script>';

        $data['etape'] = $this->adminenpouce_model->get_etape($commande);
        $this->load->view('etape_relever',$data);
    }
    public function traitement($date_debut='',$date_fin='',$et='')
    {
        $rapport = 0;
        $etape = urldecode($et);

        if(PHP_OS == 'WIN32' || PHP_OS == 'WINNT' || PHP_OS == 'Windows')
        {

            if($date_debut != 'tsisy_daty_debut'  && $date_fin!= 'tsisy_daty_fin' )
            {

                $commandes = $_POST['commandes'];
                $commands = (explode(',', $commandes));

                $phpExcel = new PHPExcel();
                $phpExcel->setActiveSheetIndex(0);
                $phpExcel->getActiveSheet()->setTitle("Relever");
                $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
                $phpExcel->getActiveSheet()->SetCellValue('A1', 'LOT');
                $phpExcel->getActiveSheet()->SetCellValue('B1', 'COMMANDE');
                $phpExcel->getActiveSheet()->SetCellValue('C1', 'MATRICULE');
                $phpExcel->getActiveSheet()->SetCellValue('D1', 'NOMBRECARACTERE');
                $phpExcel->getActiveSheet()->SetCellValue('E1', 'DATE DEBUT');
                $phpExcel->getActiveSheet()->SetCellValue('F1', 'DATE FIN');
                $phpExcel->getActiveSheet()->SetCellValue('G1', 'HEURE DEBUT');
                $phpExcel->getActiveSheet()->SetCellValue('H1', 'HEURE FIN');
                $phpExcel->getActiveSheet()->SetCellValue('I1', 'DUREE');
                $phpExcel->getActiveSheet()->SetCellValue('J1', 'EN MINUTE');
                $phpExcel->getActiveSheet()->SetCellValue('K1', 'VITESSE/HEURE');
                $phpExcel->getActiveSheet()->SetCellValue('L1', 'OBJECTIF');
                $phpExcel->getActiveSheet()->SetCellValue('M1', 'ATTEINTE OBJ');
                $phpExcel->getActiveSheet()->SetCellValue('N1', 'FICHIER CLIENT');

                $i = 2;
                foreach($commands as $comm)
                {
                    $suivi_fic = $this->relever_model->get_suivi_fic($comm,$date_debut,$date_fin,$etape);
                    if($suivi_fic)
                    {
                        $rapport =2;
                        foreach($suivi_fic as $fic)
                        {
                            $etape_tableau = $this->relever_model->get_objectif($comm,$etape);
                            if($etape_tableau)
                            {
                                foreach($etape_tableau as $et)
                                {
                                    $objectif = $et->OBJECTIF;
                                }
                            }
                            $debut = "$fic->DATEDEBUT".' '."$fic->ORADEBUT";
                            $fin = "$fic->DATEFIN".' '."$fic->ORAFIN";
                            $date_debu = new DateTime($debut);
                            $date_fi = new DateTime($fin);
                            $duree = $date_debu->diff($date_fi);
                            $annee =  $duree->format("%Y");
                            $moi =  $duree->format("%m");
                            $j =  $duree->format("%d");
                            $heurre =  $duree->format("%H");
                            $min =  $duree->format("%I");
                            $sec =  $duree->format("%S");

                            $durre_en_sec = $this->changer_en_sec($annee,$moi,$j,$heurre,$min,$sec);
                            $ora_tsiasana = "17:56";
                            if($debut != $fin)
                            {
                                $oratsiasana_en_sec = $this->changer_en_sec2($ora_tsiasana);
                                $durre_en_sec = $durre_en_sec - ($oratsiasana_en_sec*$j);
                            }
                            $duree_en_heurre = $this->changer_en_heurre($durre_en_sec);
                            $duree_en_min = $this->changer_en_minute($durre_en_sec);

                            $valeur_heurre = $this->valeur_heurre($durre_en_sec);
                            $vitess_par_heurre = 60/($duree_en_min/$fic->NOMBRECARACTERE);

                            $fich_client = $this->relever_model->get_fic_cliern($comm);
                            if($fich_client)
                            {
                                foreach($fich_client as $fic_cli)
                                {
                                    $fichier_client = $fic_cli->FICHIER_CLIENT;
                                }
                            }
                            $boj_atteint = ($vitess_par_heurre/$objectif)*100;

                            $phpExcel->getActiveSheet()->SetCellValue("A$i", "$fic->LOT");
                            $phpExcel->getActiveSheet()->SetCellValue("B$i", "$fic->COMMANDE");
                            $phpExcel->getActiveSheet()->setCellValueExplicit("C$i" ,"$fic->MATRICULE", PHPExcel_Cell_DataType::TYPE_STRING);
                            $phpExcel->getActiveSheet()->SetCellValue("D$i", "$fic->NOMBRECARACTERE");
                            $phpExcel->getActiveSheet()->SetCellValue("E$i", "$fic->DATEDEBUT");

                            $phpExcel->getActiveSheet()->SetCellValue("F$i", "$fic->DATEFIN");
                            $phpExcel->getActiveSheet()->SetCellValue("G$i", "$fic->ORADEBUT");
                            $phpExcel->getActiveSheet()->SetCellValue("H$i", "$fic->ORAFIN");
                            $phpExcel->getActiveSheet()->SetCellValue("I$i", "$duree_en_heurre");
                            $phpExcel->getActiveSheet()->SetCellValue("J$i", "$duree_en_min");//en minute
                            $phpExcel->getActiveSheet()->SetCellValue("K$i", "$vitess_par_heurre");//vitesse par heurre
                            $phpExcel->getActiveSheet()->SetCellValue("L$i", "$objectif");//objectif
                            $phpExcel->getActiveSheet()->SetCellValue("M$i", "$boj_atteint%");//objectif atteint
                            $phpExcel->getActiveSheet()->SetCellValue("N$i", "$fichier_client");//fichier client
                            $i++;
                        }
                    }
                }


                if($rapport ==2)
                {
                    $verifier = @opendir("C:\\Releve");
                    if(!$verifier)
                    {
                        mkdir("C:\\Releve");
                    }
                    $writer = new PHPExcel_Writer_Excel5($phpExcel);
                    $writer->save("C:\\Releve\\releve.xls");
                    $data['alerte'] = "Traitement terminé le fichier excel se trouve dans C:'.\. Presence'";
                    echo json_encode($data);
                }
                else
                {
                    $data['alerte'] = "Aucun traitemen fait";
                    echo json_encode($data);
                }
            }
            else if($date_debut == 'tsisy_daty_debut' && $date_fin == 'tsisy_daty_fin')
            {

                $commandes = $_POST['commandes'];
                $commands = (explode(',', $commandes));

                $phpExcel = new PHPExcel();
                $phpExcel->setActiveSheetIndex(0);
                $phpExcel->getActiveSheet()->setTitle("Relever");
                $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
                $phpExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
                $phpExcel->getActiveSheet()->SetCellValue('A1', 'LOT');
                $phpExcel->getActiveSheet()->SetCellValue('B1', 'COMMANDE');
                $phpExcel->getActiveSheet()->SetCellValue('C1', 'MATRICULE');
                $phpExcel->getActiveSheet()->SetCellValue('D1', 'NOMBRECARACTERE');
                $phpExcel->getActiveSheet()->SetCellValue('E1', 'DATE DEBUT');
                $phpExcel->getActiveSheet()->SetCellValue('F1', 'DATE FIN');
                $phpExcel->getActiveSheet()->SetCellValue('G1', 'HEURE DEBUT');
                $phpExcel->getActiveSheet()->SetCellValue('H1', 'HEURE FIN');
                $phpExcel->getActiveSheet()->SetCellValue('I1', 'DUREE');
                $phpExcel->getActiveSheet()->SetCellValue('J1', 'EN MINUTE');
                $phpExcel->getActiveSheet()->SetCellValue('K1', 'VITESSE/HEURE');
                $phpExcel->getActiveSheet()->SetCellValue('L1', 'OBJECTIF');
                $phpExcel->getActiveSheet()->SetCellValue('M1', 'ATTEINTE OBJ');
                $phpExcel->getActiveSheet()->SetCellValue('N1', 'FICHIER CLIENT');

                $i = 2;
                foreach($commands as $comm)
                {
                    $suivi_fic = $this->relever_model->get_suivi_fic_aucun_date($comm,$etape);
                    if($suivi_fic)
                    {
                        $rapport =2;
                        foreach($suivi_fic as $fic)
                        {
                            $etape_tableau = $this->relever_model->get_objectif($comm,$etape);
                            if($etape_tableau)
                            {
                                foreach($etape_tableau as $et)
                                {
                                    $objectif = $et->OBJECTIF;
                                }
                            }
                            $debut = "$fic->DATEDEBUT".' '."$fic->ORADEBUT";
                            $fin = "$fic->DATEFIN".' '."$fic->ORAFIN";
                            $date_debu = new DateTime($debut);
                            $date_fi = new DateTime($fin);
                            $duree = $date_debu->diff($date_fi);
                            $annee =  $duree->format("%Y");
                            $moi =  $duree->format("%m");
                            $j =  $duree->format("%d");
                            $heurre =  $duree->format("%H");
                            $min =  $duree->format("%I");
                            $sec =  $duree->format("%S");

                            $durre_en_sec = $this->changer_en_sec($annee,$moi,$j,$heurre,$min,$sec);
                            $ora_tsiasana = "17:56";
                            if($debut != $fin)
                            {
                                $oratsiasana_en_sec = $this->changer_en_sec2($ora_tsiasana);
                                $durre_en_sec = $durre_en_sec - ($oratsiasana_en_sec*$j);
                            }
                            $duree_en_heurre = $this->changer_en_heurre($durre_en_sec);
                            $duree_en_min = $this->changer_en_minute($durre_en_sec);

                            $valeur_heurre = $this->valeur_heurre($durre_en_sec);
                            $vitess_par_heurre = 60/($duree_en_min/$fic->NOMBRECARACTERE);


                            $fich_client = $this->relever_model->get_fic_cliern($comm);
                            if($fich_client)
                            {
                                foreach($fich_client as $fic_cli)
                                {
                                    $fichier_client = $fic_cli->FICHIER_CLIENT;
                                }
                            }
                            $boj_atteint = ($vitess_par_heurre/$objectif)*100;

                            $phpExcel->getActiveSheet()->SetCellValue("A$i", "$fic->LOT");
                            $phpExcel->getActiveSheet()->SetCellValue("B$i", "$fic->COMMANDE");
                            $phpExcel->getActiveSheet()->setCellValueExplicit("C$i" ,"$fic->MATRICULE", PHPExcel_Cell_DataType::TYPE_STRING);
                            $phpExcel->getActiveSheet()->SetCellValue("D$i", "$fic->NOMBRECARACTERE");
                            $phpExcel->getActiveSheet()->SetCellValue("E$i", "$fic->DATEDEBUT");

                            $phpExcel->getActiveSheet()->SetCellValue("F$i", "$fic->DATEFIN");
                            $phpExcel->getActiveSheet()->SetCellValue("G$i", "$fic->ORADEBUT");
                            $phpExcel->getActiveSheet()->SetCellValue("H$i", "$fic->ORAFIN");
                            $phpExcel->getActiveSheet()->SetCellValue("I$i", "$duree_en_heurre");
                            $phpExcel->getActiveSheet()->SetCellValue("J$i", "$duree_en_min");//en minute
                            $phpExcel->getActiveSheet()->SetCellValue("K$i", "$vitess_par_heurre");//vitesse par heurre
                            $phpExcel->getActiveSheet()->SetCellValue("L$i", "$objectif");//objectif
                            $phpExcel->getActiveSheet()->SetCellValue("M$i", "$boj_atteint%");//objectif atteint
                            $phpExcel->getActiveSheet()->SetCellValue("N$i", "$fichier_client");//fichier client
                            $i++;
                        }
                    }
                }


                if($rapport ==2)
                {
                    $verifier = @opendir("C:\\Releve");
                    if(!$verifier)
                    {
                        mkdir("C:\\Releve");
                    }
                    $writer = new PHPExcel_Writer_Excel5($phpExcel);
                    $writer->save("C:\\Releve\\releve.xls");
                    $data['alerte'] = "Traitement terminé le fichier excel se trouve dans C:'.\. Presence'";
                    echo json_encode($data);
                }
                else
                {
                    $data['alerte'] = "Aucun traitement fait";
                    echo json_encode($data);
                }
            }
        }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////LINUX LINUX LINUX LINUX LINUX LINUX LINUX ///////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        else if(PHP_OS == 'Linux')
        {
            if($date_debut != 'tsisy_daty_debut'  && $date_fin!= 'tsisy_daty_fin' )
            {

                $commandes = $_POST['commandes'];
                $commands = (explode(',', $commandes));

               $verifier = @opendir("/Releve");
                if(!$verifier)
                {
                    mkdir("/Releve");
                }
                $dir = fopen("/Releve/releve.txt", "w+");

                //$i = 2;
                $lot ="LOT";
                $commande = "COMMANDE";
                $matr = "MATRICULE";
                $nombrecaractere = "NOMBRECARACTERE";
                $datdebut = "DATE DEBUT";
                $datdefin = "DATE FIN";
                $h_debut = "HEURE DEBUT";
                $h_fin = "HEURE FIN";
                $dur = "DUREE";
                $enminute = "EN MINUTE";
                $vit_par_heurre = "VITESSE PAR HEURE";
                $obj = "OBJECTIF";
                $atteint_obj = "ATTEINT OBJ";
                $fic_c = "FICHIER CLIENT";

                fprintf($dir,"%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t \r\n",$lot,$commande,$matr,$nombrecaractere,$datdebut,$datdefin,$h_debut,$h_fin,$dur,$enminute,$vit_par_heurre,$obj,$atteint_obj,$fic_c);
                foreach($commands as $comm)
                {
                    $suivi_fic = $this->relever_model->get_suivi_fic($comm,$date_debut,$date_fin,$etape);
                    if($suivi_fic)
                    {
                        $rapport =2;
                        foreach($suivi_fic as $fic)
                        {
                            $etape_tableau = $this->relever_model->get_objectif($comm,$etape);
                            if($etape_tableau)
                            {
                                foreach($etape_tableau as $et)
                                {
                                    $objectif = $et->OBJECTIF;
                                }
                            }
                            $debut = "$fic->DATEDEBUT".' '."$fic->ORADEBUT";
                            $fin = "$fic->DATEFIN".' '."$fic->ORAFIN";
                            $date_debu = new DateTime($debut);
                            $date_fi = new DateTime($fin);
                            $duree = $date_debu->diff($date_fi);
                            $annee =  $duree->format("%Y");
                            $moi =  $duree->format("%m");
                            $j =  $duree->format("%d");
                            $heurre =  $duree->format("%H");
                            $min =  $duree->format("%I");
                            $sec =  $duree->format("%S");

                            $durre_en_sec = $this->changer_en_sec($annee,$moi,$j,$heurre,$min,$sec);
                            $ora_tsiasana = "17:56";
                            if($debut != $fin)
                            {
                                $oratsiasana_en_sec = $this->changer_en_sec2($ora_tsiasana);
                                $durre_en_sec = $durre_en_sec - ($oratsiasana_en_sec*$j);
                            }
                            $duree_en_heurre = $this->changer_en_heurre($durre_en_sec);
                            $duree_en_min = $this->changer_en_minute($durre_en_sec);

                            $valeur_heurre = $this->valeur_heurre($durre_en_sec);
                            $vitess_par_heurre = $objectif/$valeur_heurre;

                            $fich_client = $this->relever_model->get_fic_cliern($comm);
                            if($fich_client)
                            {
                                foreach($fich_client as $fic_cli)
                                {
                                    $fichier_client = $fic_cli->FICHIER_CLIENT;
                                }
                            }
                            $boj_atteint = ($vitess_par_heurre/$objectif)*100;


                            fprintf($dir,"%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t \r\n",$fic->LOT,$fic->COMMANDE,$fic->MATRICULE,$fic->NOMBRECARACTERE,$fic->DATEDEBUT,$fic->ORAFIN,$duree_en_heurre,$duree_en_min,$vitess_par_heurre,$enminute,$vit_par_heurre,$objectif,$boj_atteint."%",$fichier_client);

                        }
                    }
                }


                if($rapport ==2)
                {
                    $data['alerte'] = "Traitement terminé le fichier excel se trouve dans C:'.\. Relever'";
                    echo json_encode($data);
                }
                else
                {
                    $data['alerte'] = "Aucun traitemen fait";
                    echo json_encode($data);
                }
            }
            else if($date_debut == 'tsisy_daty_debut' && $date_fin == 'tsisy_daty_fin')
            {


                $commandes = $_POST['commandes'];
                $commands = (explode(',', $commandes));

                $verifier = @opendir("/Releve");
                if(!$verifier)
                {
                    mkdir("/Releve");
                }
                $dir = fopen("/Releve/releve.txt", "w+");

                //$i = 2;
                $lot ="LOT";
                $commande = "COMMANDE";
                $matr = "MATRICULE";
                $nombrecaractere = "NOMBRECARACTERE";
                $datdebut = "DATE DEBUT";
                $datdefin = "DATE FIN";
                $h_debut = "HEURE DEBUT";
                $h_fin = "HEURE FIN";
                $dur = "DUREE";
                $enminute = "EN MINUTE";
                $vit_par_heurre = "VITESSE PAR HEURE";
                $obj = "OBJECTIF";
                $atteint_obj = "ATTEINT OBJ";
                $fic_c = "FICHIER CLIENT";

                fprintf($dir,"%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t \r\n",$lot,$commande,$matr,$nombrecaractere,$datdebut,$datdefin,$h_debut,$h_fin,$dur,$enminute,$vit_par_heurre,$obj,$atteint_obj,$fic_c);
                foreach($commands as $comm)
                {
                    $suivi_fic = $this->relever_model->get_suivi_fic_aucun_date($comm,$etape);
                    if($suivi_fic)
                    {
                        $rapport =2;
                        foreach($suivi_fic as $fic)
                        {
                            $etape_tableau = $this->relever_model->get_objectif($comm,$etape);
                            if($etape_tableau)
                            {
                                foreach($etape_tableau as $et)
                                {
                                    $objectif = $et->OBJECTIF;
                                }
                            }
                            $debut = "$fic->DATEDEBUT".' '."$fic->ORADEBUT";
                            $fin = "$fic->DATEFIN".' '."$fic->ORAFIN";
                            $date_debu = new DateTime($debut);
                            $date_fi = new DateTime($fin);
                            $duree = $date_debu->diff($date_fi);
                            $annee =  $duree->format("%Y");
                            $moi =  $duree->format("%m");
                            $j =  $duree->format("%d");
                            $heurre =  $duree->format("%H");
                            $min =  $duree->format("%I");
                            $sec =  $duree->format("%S");

                            $durre_en_sec = $this->changer_en_sec($annee,$moi,$j,$heurre,$min,$sec);
                            $ora_tsiasana = "17:56";
                            if($debut != $fin)
                            {
                                $oratsiasana_en_sec = $this->changer_en_sec2($ora_tsiasana);
                                $durre_en_sec = $durre_en_sec - ($oratsiasana_en_sec*$j);
                            }
                            $duree_en_heurre = $this->changer_en_heurre($durre_en_sec);
                            $duree_en_min = $this->changer_en_minute($durre_en_sec);

                            $valeur_heurre = $this->valeur_heurre($durre_en_sec);
                            $vitess_par_heurre = $objectif/$valeur_heurre;

                            $fich_client = $this->relever_model->get_fic_cliern($comm);
                            if($fich_client)
                            {
                                foreach($fich_client as $fic_cli)
                                {
                                    $fichier_client = $fic_cli->FICHIER_CLIENT;
                                }
                            }
                            $boj_atteint = ($vitess_par_heurre/$objectif)*100;


                            fprintf($dir,"%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t \r\n",$fic->LOT,$fic->COMMANDE,$fic->MATRICULE,$fic->NOMBRECARACTERE,$fic->DATEDEBUT,$fic->ORAFIN,$duree_en_heurre,$duree_en_min,$vitess_par_heurre,$enminute,$vit_par_heurre,$objectif,$boj_atteint."%",$fichier_client);

                        }
                    }
                }


                if($rapport ==2)
                {
                    $data['alerte'] = "Traitement terminé le fichier excel se trouve dans C:'.\. Relever'";
                    echo json_encode($data);
                }
                else
                {
                    $data['alerte'] = "Aucun traitemen fait";
                    echo json_encode($data);
                }
            }
        }

    }

    public function changer_en_sec($annee,$moi,$j,$heurre,$min,$sec)
    {
        $j_d_s = $j*86400;
        $H_d_s = $heurre*3600;
        $M_d_s = $min*60;

        $result = $H_d_s + $M_d_s + $sec +$j_d_s;
        return $result;
    }
    public function changer_en_sec2($date)
    {
        $date = new DateTime($date);
        $H_d = $date->format("H");
        $M_d = $date->format("i");
        $S_d = $date->format("s");

        $H_d_s = $H_d*3600;
        $M_d_s = $M_d*60;

        $result = $H_d_s + $M_d_s + $S_d;
        return $result;

    }
    public function changer_en_heurre($somme)
    {
        $heurre = $somme % 3600;
        $h = floor($somme/3600);

        $s = $heurre % 60;
        $m = floor($heurre/60);

        $result = "$h:$m:$s";
        return $result;
    }
    public function changer_en_minute($date_ensec)
    {
        $m = floor($date_ensec/60);
        $result = "$m";
        return $result;
    }
    public function valeur_heurre($somme)
    {

        $heurre = $somme % 3600;
        $h = floor($somme/3600);

        $s = $heurre % 60;
        $m = floor($heurre/60);

        $result = "$h"."."."$m"."$s" ;
        return $result;
    }
    public function a()
    {
    }
}