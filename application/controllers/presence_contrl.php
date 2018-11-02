<?php
class Presence_contrl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('PHPExcel');
        $this->load->helper('assets_helper');
        $this->load->model('presence_model');
    }
    public function index()
    {
         $this->load->view('presence_view');
    }
    public function traitement()
    {
        $date_debut = $_POST["date_debut"];
        $date_fin = $_POST["date_fin"];
        $daty_androany = date('d/m/Y');
        $valeur_d_a = explode("/",$daty_androany);
        $valeur_daty_androany = $valeur_d_a[2].$valeur_d_a[1].$valeur_d_a[0];
        $valeur_d_d = explode("/",$date_debut);
        $valeur_date_debut = $valeur_d_d[2].$valeur_d_d[1].$valeur_d_d[0];
        $valeur_d_f = explode("/",$date_fin);
        $valeur_date_fin = $valeur_d_f[2].$valeur_d_f[1].$valeur_d_f[0];
        if($valeur_daty_androany >= $valeur_date_debut )
        {
            if($valeur_daty_androany >= $valeur_date_fin)
            {
                if($valeur_date_debut != $valeur_date_fin)
                {
                    if(PHP_OS == 'WIN32' || PHP_OS == 'WINNT' || PHP_OS == 'Windows')
                    {
                        $phpExcel = new PHPExcel();
                        $pers_actif = $this->presence_model->get_pers_actif();
                        $l = 0;
                        $rapport = 2;
                        $styleArrayvert = array(
                            'font'  => array(
                                'color' => array('rgb' => '0f4720'),
                            ));
                        foreach($pers_actif as $pers)
                        {
                            $nom = $pers->NOM ;
                            $mat = $pers->MATRICULE;
                            $fonction = $pers->FONCTION;
                            $nom_sheet = "$nom"."$mat";
                            if($l == 0)
                            {
                                $phpExcel->getActiveSheet()->setTitle("$nom_sheet");
                                $phpExcel->setActiveSheetIndex(0);
                            }
                            else if($l !=0)
                            {
                                $worksheet = $phpExcel->createSheet();
                                $phpExcel->setActiveSheetIndex($l);
                                $phpExcel->getActiveSheet()->setTitle("$nom_sheet");
                            }
                            if($fonction == 'PERS')
                            {
                                $heurre_tavail = '8:30:00';
                            }
                            else if($fonction == 'OS')
                            {
                                $heurre_tavail = '6:20:00';
                            }
                            else if($fonction == 'CTRL')
                            {
                                $heurre_tavail = '9:00:00';
                            }
                            $i=0;
                            $j=0;
                            $x=0;
                            $ec_positif = array();
                            $ec_negatif = array();

                            $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                            $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                            $phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                            $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                            $phpExcel -> getActiveSheet() -> getStyle('D') -> getNumberFormat() -> setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME6 );
                            $phpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                            $phpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
                            $phpExcel->getActiveSheet()->SetCellValue('A1', 'DATE');
                            $phpExcel->getActiveSheet()->SetCellValue('B1', 'HEURRE ENTREE');
                            $phpExcel->getActiveSheet()->SetCellValue('C1', 'HEURRE SORTIE');
                            $phpExcel->getActiveSheet()->SetCellValue('D1', 'DUREE');
                            $phpExcel->getActiveSheet()->SetCellValue('E1', 'ECART NEGATIF');
                            $phpExcel->getActiveSheet()->SetCellValue('F1', 'ECART POSITIF');
                            $presence_pers = $this->presence_model->get_presence_pers($date_debut,$date_fin,$mat);
                            if($presence_pers)
                            {
                                $a=0;
                                $m =2;
                                foreach($presence_pers as $presence)
                                {
                                    $date_entree = $presence->DATE_ENTREE;
                                    $heurre_entree = $presence->HEURE_ENTREE;
                                    $heurre_sortie = $presence->HEURE_FIN;
                                    $dur = $presence->DUREE;
                                    $heurre_t = new DateTime($heurre_tavail);
                                    $duree = new DateTime($dur);
                                    $res = $heurre_t->diff($duree);
                                    $ecart =  $res->format("%H:%I:%S");

                                    $styleArray = array(
                                        'font'  => array(
                                            'color' => array('rgb' => 'FF0000'),
                                        ));

                                    if( $duree > $heurre_t)
                                    {
                                        //FORMAT_DATE_TIME6
                                        $ecart_positif = "$ecart";
                                        $ecart_negatif ='';
                                        $phpExcel->getActiveSheet()->SetCellValue("A$m", "$date_entree");
                                        $phpExcel->getActiveSheet()->SetCellValue("B$m", "$heurre_entree");
                                        $phpExcel->getActiveSheet()->SetCellValue("C$m", "$heurre_sortie");
                                        $phpExcel->getActiveSheet()->SetCellValue("D$m", ('=' ."C$m" . "-" ."B$m"));
                                        $phpExcel->getActiveSheet()->SetCellValue("E$m", $ecart_negatif);
                                        $phpExcel->getActiveSheet()->getStyle("E$m")->applyFromArray($styleArray);
                                        $phpExcel->getActiveSheet()->SetCellValue("F$m", $ecart_positif);
                                        $phpExcel->getActiveSheet()->getStyle("F$m")->applyFromArray($styleArrayvert);


                                        $ec_positif[] = $this->changer_en_sec($ecart_positif);
                                        $i++;
                                    }
                                    else if($heurre_t > $duree)
                                    {
                                        $ecart_positif = '';
                                        $ecart_negatif = "$ecart";
                                        $phpExcel->getActiveSheet()->SetCellValue("A$m", "$date_entree");
                                        $phpExcel->getActiveSheet()->SetCellValue("B$m", "$heurre_entree");
                                        $phpExcel->getActiveSheet()->SetCellValue("C$m", "$heurre_sortie");
                                        $phpExcel->getActiveSheet()->SetCellValue("D$m", "$dur");
                                        $phpExcel->getActiveSheet()->SetCellValue("E$m", $ecart_negatif);
                                        $phpExcel->getActiveSheet()->getStyle("E$m")->applyFromArray($styleArray);
                                        $phpExcel->getActiveSheet()->SetCellValue("F$m", $ecart_positif);
                                        $phpExcel->getActiveSheet()->getStyle("F$m")->applyFromArray($styleArrayvert);
                                        $ec_negatif[] = $this->changer_en_sec($ecart_negatif);
                                        $j++;
                                    }
                                    else if($duree == $heurre_t)
                                    {
                                        $ecart_positif = '';
                                        $ecart_negatif = '';
                                        $phpExcel->getActiveSheet()->SetCellValue("A$m", "$date_entree");
                                        $phpExcel->getActiveSheet()->SetCellValue("B$m", "$heurre_entree");
                                        $phpExcel->getActiveSheet()->SetCellValue("C$m", "$heurre_sortie");
                                        $phpExcel->getActiveSheet()->SetCellValue("D$m", "$dur");
                                        $x++;
                                    }

                                    $m ++; $a++;
                                }
                                //fprintf($dir,"\t\t%s","$heurre_tavail");
                              //  $phpExcel->getActiveSheet()->SetCellValue("C$m", "=B*$i");
                                $heurre_tavail_ensec = $this->changer_en_sec($heurre_tavail);
                                $produit_h_t_ensec = $heurre_tavail_ensec*($i+$j+$x);

                                $produit_heurre_t = $this->changer_en_heurre($produit_h_t_ensec);
                                //fprintf($dir,"\t%s",$produit_heurre_t);
                              //  $phpExcel->getActiveSheet()->SetCellValue("D$m", "=SOMME(D2:D$i)");
                                if($j!=0)
                                {
                                    $t=0;
                                    $somme_ecart_negatif="00:00:00";
                                    $somme_ecart_negatif = $this->changer_en_sec($somme_ecart_negatif);
                                    while($t<$j)
                                    {
                                        $somme_ecart_negatif = $somme_ecart_negatif + $ec_negatif[$t];
                                        $t++;
                                    }
                                    $styleArray = array(
                                        'font'  => array(
                                            'color' => array('rgb' => 'FF0000'),
                                        ));
                                    $somme_ecart_negatif = $this->changer_en_heurre($somme_ecart_negatif);
                                 //   $phpExcel->getActiveSheet()->SetCellValue("E$m", "=SOMME(E2:E$i)");
                                    $phpExcel->getActiveSheet()->getStyle("E$m")->applyFromArray($styleArray);

                                }
                                if($i!=0)
                                {
                                    $somme_ecart_positif="00:00:00";
                                    $somme_ecart_positif = $this->changer_en_sec($somme_ecart_positif);
                                    $k=0;
                                    while($k<$i)
                                    {
                                        $somme_ecart_positif= $somme_ecart_positif + $ec_positif[$k];
                                        $k++;
                                    }
                                    $somme_ecart_positif = $this->changer_en_heurre($somme_ecart_positif);
                                    //('=' ."C$m" . "-" ."B$m"));
                                    $phpExcel->getActiveSheet()->SetCellValue("F$m", ('=SOMME(F2:'."F$a" ));

                                    $phpExcel->getActiveSheet()->getStyle("F$m")->applyFromArray($styleArrayvert);



                                }
                            }
                            $l++;

                        }
                        $verifier = @opendir("C:\\Presence");
                        if(!$verifier)
                        {
                            mkdir("C:\\Presence");
                        }
                        $writer = new PHPExcel_Writer_Excel5($phpExcel);
                        $rapport = $writer->save("C:\\Presence\\presence.xls");
                        if($rapport !=2)
                        {
                            $data['alerte'] = 'Traitement terminé, le fichier se trouve dans C:"\Presence ';
                        }
                        else
                        {
                            $data['erreur'] = 'Erreur de traitement';
                        }
                    }

 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////LINUX  LINUX  LINUX  LINUX  LINUX  LINUX  LINUX  LINUX  LINUX  //////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    else if(PHP_OS == 'Linux')
                    {
                        $rapport = 1;
                        $pers_actif = $this->presence_model->get_pers_actif();
                        foreach($pers_actif as $pers)
                        {
                            $nom = $pers->NOM ;
                            $mat = $pers->MATRICULE;
                            $fonction = $pers->FONCTION;
                            if($fonction == 'PERS')
                            {
                                $heurre_tavail = '8:30:00';
                            }
                            else if($fonction == 'OS')
                            {
                                $heurre_tavail = '6:20:00';
                            }
                            else if($fonction == 'CTRL')
                            {
                                $heurre_tavail = '9:00:00';
                            }
                            $i=0;
                            $j=0;
                            $x =0;
                            $ec_positif = array();
                            $ec_negatif = array();

                               $verifier = @opendir("/Presence");
                            if(!$verifier)
                            {
                                mkdir("/Presence/presence.txt");
                            }
                            $dir = fopen("/Presence/presence.txt", "w+");

                            //$dir = fopen("C:\\presence\\$nom_fic.docx", "w+");
                            $dat ="DATE";
                            $h_entree = "HEURRE ENTREE";
                            $h_sortie = "HEURRE SORTIE";
                            $ecart_neg = "ECART NEGATIF";
                            $ecart_pos = "ECART POSITIF";
                            $durr = "DUREE";

                            fprintf($dir,"%s\t%s\t%s\t%s\t%s\t%s \r\n",$dat,$h_entree,$h_sortie,$durr,$ecart_neg,$ecart_pos);
                            $presence_pers = $this->presence_model->get_presence_pers($date_debut,$date_fin,$mat);
                            if($presence_pers)
                            {
                                foreach($presence_pers as $presence)
                                {
                                    $date_entree = $presence->DATE_ENTREE;
                                    $heurre_entree = $presence->HEURE_ENTREE;
                                    $heurre_sortie = $presence->HEURE_FIN;
                                    $dur = $presence->DUREE;
                                    $heurre_t = new DateTime($heurre_tavail);
                                    $duree = new DateTime($dur);
                                    $res = $heurre_t->diff($duree);
                                    $ecart =  $res->format("%H:%I:%S");

                                    if( $duree > $heurre_t)
                                    {
                                        $ecart_positif = "$ecart";
                                        $ecart_negatif ='';
                                        fprintf($dir,"%s\t%s\t%s\t%s\t%s\t%s \r\n",$date_entree,$heurre_entree,$heurre_sortie,$dur,$ecart_negatif,$ecart_positif);
                                        $ec_positif[] = $this->changer_en_sec($ecart_positif);
                                        $i++;
                                    }
                                    else if($heurre_t > $duree)
                                    {
                                        $ecart_positif = '';
                                        $ecart_negatif = "$ecart";
                                        fprintf($dir,"%s\t%s\t%s\t%s\t%s\t%s \r\n",$date_entree,$heurre_entree,$heurre_sortie,$dur,$ecart_negatif,$ecart_positif);
                                        $ec_negatif[] = $this->changer_en_sec($ecart_negatif);
                                        $j++;
                                    }
                                    else if($duree == $heurre_t)
                                    {
                                        $ecart_positif = '';
                                        $ecart_negatif = '';
                                        fprintf($dir,"%s\t%s\t%s\t%s\t%s\t%s \r\n",$date_entree,$heurre_entree,$heurre_sortie,$dur,$ecart_negatif,$ecart_positif);
                                        $x++;
                                    }
                                    fprintf($dir,"\t\t%s","$heurre_tavail");
                                }
                                fprintf($dir,"\t\t%s","$heurre_tavail");
                                $heurre_tavail_ensec = $this->changer_en_sec($heurre_tavail);
                                $produit_h_t_ensec = $heurre_tavail_ensec*($i+$j+$x);

                                $produit_heurre_t = $this->changer_en_heurre($produit_h_t_ensec);
                                fprintf($dir,"\t%s",$produit_heurre_t);


                                if($j!=0)
                                {
                                    $t=0;
                                    $somme_ecart_negatif="00:00:00";
                                    $somme_ecart_negatif = $this->changer_en_sec($somme_ecart_negatif);
                                    while($t<$j)
                                    {
                                        $somme_ecart_negatif = $somme_ecart_negatif + $ec_negatif[$t];
                                        $t++;
                                    }
                                    $somme_ecart_negatif = $this->changer_en_heurre($somme_ecart_negatif);
                                    fprintf($dir,"\t%s ",$somme_ecart_negatif);
                                }
                                if($i!=0)
                                {
                                    $somme_ecart_positif="00:00:00";
                                    $somme_ecart_positif = $this->changer_en_sec($somme_ecart_positif);
                                    $k=0;
                                    while($k<$i)
                                    {
                                        $somme_ecart_positif= $somme_ecart_positif + $ec_positif[$k];

                                        $k++;
                                    }
                                    $somme_ecart_positif = $this->changer_en_heurre($somme_ecart_positif);
                                    if($ecart_negatif =='')
                                    {
                                        $rapport = fprintf($dir,"\t\t%s \r\n",$somme_ecart_positif);
                                    }
                                    if($ecart_negatif !='')
                                    {
                                        $rapport = fprintf($dir,"\t%s \r\n",$somme_ecart_positif);
                                    }

                                    fprintf($dir,"%s \r\n","////////////////////////////////////////////////////////////////////////////////////////////////////");
                                    if($rapport)
                                    {
                                        $rapport =0;
                                    }

                                }
                            }

                        }

                        if($rapport  == 0)
                        {
                            $data['alerte'] = "Traitement terminé, les fichiers se trouvent dans C:\presence ";
                        }
                        else if($rapport != 0)
                        {
                            $data['erreur'] = "Erreur de traitement";
                        }

                    }
                }


                else if($valeur_date_debut==$valeur_date_fin)
                {
                    $data['alerte'] = "la date debut ne doit pas etre égal à la date fin ";
                }
            }
            else if($valeur_date_fin > $valeur_daty_androany)
            {
                $data['alerte'] = "La date fin ne doit pas depasser la date d'aujourduit ";
            }
        }
        else if($valeur_daty_androany < $valeur_date_debut)
        {
            $data['alerte'] = "La date debut ne doit pas depasser la date d'aujourduit";
        }
        echo json_encode($data);
    }

    public function changer_en_sec($date)
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
    public function  a()
    {
       /* CYGWIN_NT-5.1
Darwin
FreeBSD
HP-UX
IRIX64
Linux
NetBSD
OpenBSD
SunOS
Unix
WIN32
WINNT
Windows */
         var_dump(PHP_OS);

    }


}
?>