<?php
ini_set("memory_limit","360M");
class Preparation_s_m_conctr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('assets_helper');
        $this->load->library('session');
        $this->load->model('preparation_s_m_model');
        $this->load->helper(array('form', 'url'));
// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
    }
    /////////////////
    function index()
    {
        $this->load->view('preparation_semie_manuelle');
    }
    function lien($phot)
    {
        $data['lien']='<label style="color:red" ><?php echo($phot); ?></label >';
        $this->load->view('preparation_semie_manuelle', $data);
    }
    ///////////////
    public function Annuler()
    {
        $data['Annuler'] ='<script>alert("ANNULER!")</script>';
        $this->load->view('preparation_semie_manuelle',$data);
    }
    public function affichage()
    {

            $matricule = $this->session->userdata('matricule');
            $extension = $_POST['extension'];
            $traitement = $_POST['traitement'];
            $export = $_POST['export'];
            $chemin= $_POST['chemin'];
            $idcommande= $_POST['idcommande'];
            $fic= $_POST['fic'];
            $dossier=$_POST['dossier'];
            $idcommande=strtoupper($idcommande);
            $fic=strtolower($fic);
            $extension=strtolower($extension);
        if((PHP_OS=='WIN32')||(PHP_OS=='WINNT')||(PHP_OS=='Windows'))
        {
             /*$pers = $this->preparation_s_m_model->get_personnel($matricule);
             if($pers==1)
             {*/
            if($extension==null||$chemin==null||$traitement==null||$export==null ||$idcommande==null ||$fic==null)
            {
                echo  "<script language=\"javascript\">alert('Tous les champs sont obligatoire');</script>" ;
            }
            else
            {
                //mot de pass correct, present
                $vrais=null;
                $command= substr($chemin,-7,7);
                $vef=@opendir("$chemin");
                if($vef)
                {
                    $nbr =8;
                    $ch=substr($chemin,0,-$nbr);
                    $a=@opendir($ch);
                    if(!$a)
                    {//mapiseho alert raha toa ka tsy Upload fichier
                        echo ("<script language=\"javascript\">alert('Le nom de répértoire doit etre 4 letres et 3 chiffre!');</script>");
                    }
                    else
                    {
                        $ver=$this->preparation_s_m_model->get_verrification($command);
                        if($ver==1)
                        {
                            echo  "<script language=\"javascript\">alert('Commande déjà existée');</script>";
                        }
                        else
                        {/////
                            $MyNam="$chemin";
                            //////////////
                            $misy_sous_repert=false;
                            $nom_repertoire=$MyNam;
                            //on ouvre un pointeur sur le repertoire
                            $pointeur = opendir($nom_repertoire);
                            //pour chaque fichier et dossier
                            while ($sous_dossier = readdir($pointeur))
                            {
                                //on ne traite pas les . et ..
                                if(($sous_dossier != '.') && ($sous_dossier != '..'))
                                {
                                    //si c'est un dossier, on le lit
                                    if (is_dir($nom_repertoire.'/'.$sous_dossier))
                                    {

                                        $misy_sous_repert=true;
                                    }
                                }
                            }
                            if( $misy_sous_repert==true)
                            {
                            ///
                            ///mot de pass est correct et personne preen
                            $destination="C:/images/traitement";
                            $vr=@opendir("$destination");
                            if($vr)
                            {
                                $TroisLetre=substr($command, 0,4);//quatre letre eo aloan'ny comande
                                $verfie=@opendir("$destination\\$TroisLetre");
                                if(!$verfie)
                                {
                                    @mkdir("$destination\\$TroisLetre");
                                }
                                @mkdir("$destination\\$TroisLetre\\$command");
                                $lien="$destination\\$TroisLetre\\$command";
                                $MyNam="$chemin";
                                // dossier listé (pour lister le répertoir courant : $dir_nom = '.' --> ('point')
                                $SousRepertoire=array(); // on déclare le tableau contenant le nom des dossiers
                                $NombreSousRepertoire=0;
                                $nombretsymisyextation=0;
                                $nbimage=0;
                                $misy=0;
                                //////////////
                                $nom_repertoire=$MyNam;
                                //on ouvre un pointeur sur le repertoire
                                $pointeur = opendir($nom_repertoire);
                                //pour chaque fichier et dossier
                                while ($sous_dossier = readdir($pointeur))
                                {
                                    //on ne traite pas les . et ..
                                    if(($sous_dossier != '.') && ($sous_dossier != '..'))
                                    {
                                        //si c'est un dossier, on le lit
                                        if (is_dir($nom_repertoire.'/'.$sous_dossier))
                                        {
                                            $SousRepertoire[]=$sous_dossier;
                                            $NombreSousRepertoire++;
                                        }
                                    }
                                }
                                ////////////////////
                                for($Isa=0;$Isa<$NombreSousRepertoire;$Isa++)
                                {
                                    $Total= 0;
                                    $image=array();
                                    ///////////
                                    $mydir ="$chemin/$SousRepertoire[$Isa]";
                                    if ($dir = @opendir($mydir))
                                    {
                                        while(false !== ($file = readdir($dir)))
                                        {
                                            if(($file != ".." )&& ($file != ".") && (preg_match("/.$extension$/",$file)))
                                            {
                                                $image[] = $file;
                                                $Total++;
                                            }
                                        }
                                    }
                                    if($Total==0)
                                    {
                                        $nbimage++;
                                    }
                                    else
                                    {
                                        $misy++;
                                    }
                                }
                                if($misy!=0)
                                {
                                    $TotalFichier = 0;
                                    $this->preparation_s_m_model->get_insertionPre($command,$matricule,$lien,$TotalFichier,$traitement,$export,$idcommande,$fic);
                                    $preparation = $this->preparation_s_m_model->get_selectPre($command);

                                    foreach($preparation as $pre)
                                    {
                                        $id_preparation = $pre->ID_PREPARATION;
                                    }
                                }
                                $Seq = 10000;
                                for($Isa=0;$Isa<$NombreSousRepertoire;$Isa++)
                                {
                                    $Total= 0;
                                    $izy=array();

                                    ///////////
                                    $mydir ="$chemin/$SousRepertoire[$Isa]";
                                    if ($dir = @opendir($mydir))
                                    {
                                        while(false !== ($file = readdir($dir)))
                                        {
                                            if(($file != ".." )&& ($file != ".") && (preg_match("/.$extension$/",$file)))
                                            {
                                                $izy[] = $file;
                                                $Total++;
                                                $TotalFichier++;

                                            }
                                        }
                                    }
                                    if($Total==0)
                                    {
                                        $r=$SousRepertoire[$Isa];
                                        $nombretsymisyextation++;
                                        echo  "<script language=\"javascript\">alert('Il y a pas de type extension:$extension dans un répértoire $r!');</script>";
                                    }
                                    else
                                    {
                                        /////////////
                                        $Manomboka =0;
                                        $Seq = $Seq + 1;
                                        $sequen="$Seq";
                                        $Sequence= substr($sequen,-4,4);
                                        $sequen=null;
                                        $rep=$SousRepertoire[$Isa];
                                        @mkdir("$destination\\$TroisLetre\\$command\\$rep");
                                        @rename("$destination\\$TroisLetre\\$command\\$rep","$destination\\$TroisLetre\\$command\\$command$Sequence");
                                        $Depart=0;
                                        while($Depart<$Total)
                                        {
                                            $Manomboka++;
                                            $izyl=$izy[$Depart];
                                            if ($Manomboka ==1)
                                            {
                                                $SousRepert="$command$Sequence";
                                                $RepertoireACreer="$destination\\$TroisLetre\\$command\\$command$Sequence";
                                                $this->preparation_s_m_model->get_insertionFICHIER($command,$izyl,$RepertoireACreer,$SousRepert,$id_preparation,$traitement,$export,$idcommande,$fic,$dossier);
                                            }
                                            $rep="$command$Sequence";
                                            $RepertoireACreer="$destination\\$TroisLetre\\$command\\$command$Sequence";
                                            $this->preparation_s_m_model->get_insertionLISTAGE($izyl,$command,$rep,$id_preparation,$RepertoireACreer,$export,$idcommande,$fic);
                                            $Depart++;
                                        }
                                        //////////////////////
                                        $origine = "$chemin/$SousRepertoire[$Isa]";
                                        $destinat ="$destination\\$TroisLetre\\$command\\$command$Sequence";
                                        $doss=@opendir("$origine");
                                        while ($file =readdir($doss))
                                        {
                                            if(($file != ".." )&& ($file != ".") && (preg_match("/.$extension$/",$file)))
                                            {

                                                @copy("$origine/$file", "$destinat\\$file"); //on les déplace tous
                                            }
                                        }

                                    }
                                }
                                if($nombretsymisyextation==$NombreSousRepertoire)
                                {

                                    echo  "<script language=\"javascript\">alert('Verifier votre extension car il y a pas de type extension:$extension dans tout les sous répértoires');</script>";
                                }
                                else
                                {
                                    $this->preparation_s_m_model->get_updatePREPARATION($TotalFichier,$command);
                                    echo  "<script language=\"javascript\">alert('Mise en lot terminé');</script>";
                                }
                            }
                            else
                            {
                                echo  "<script language=\"javascript\">alert('Crier un dossier de déstination');</script>";
                            }
                        }
                            else
                            {
                                echo  "<script language=\"javascript\">alert('Il n y a pas de sous dossier dans cette repertoire!');</script>";
                            }
                        }
                    }
                }
                ////
                else
                {
                    echo  "<script language=\"javascript\">alert('Verriffer votre chemin');</script>";
                }
            }
            /*}

                    elseif($pers==2)
                    {
                        echo"<script language=\"javascript\">alert('Vous n avez pas encore fait le pointage')</script>";
                    }*/


        }
        else//linux
        {

            /* $pers = $this->preparation_s_m_model->get_personnel($matricule);
             if($pers==1)
             {*/
            if($extension==null||$chemin==null||$traitement==null||$export==null ||$idcommande==null ||$fic==null)
            {
                echo  "<script language=\"javascript\">alert('Tous les champs sont obligatoire');</script>" ;
            }
            else
            {
                //mot de pass correct, present
                $vrais=null;
                $command= substr($chemin,-7,7);
                $vef=@opendir("$chemin");
                if($vef)
                {
                    $nbr =8;
                    $ch=substr($chemin,0,-$nbr);
                    $a=@opendir($ch);
                    if(!$a)
                    {//mapiseho alert raha toa ka tsy Upload fichier
                        echo ("<script language=\"javascript\">alert('Le nom de répértoire doit etre 4 letres et 3 chiffre!');</script>");
                    }
                    else
                    {
                        $ver=$this->preparation_s_m_model->get_verrification($command);
                        if($ver==1)
                        {
                            echo  "<script language=\"javascript\">alert('Commande déjà existée');</script>";
                        }
                        else
                        {
                            ///mot de pass est correct et personne preen
                            $MyNam="$chemin";
                            //////////////
                            $misy_sous_repert=false;
                            $nom_repertoire=$MyNam;
                            //on ouvre un pointeur sur le repertoire
                            $pointeur = opendir($nom_repertoire);
                            //pour chaque fichier et dossier
                            while ($sous_dossier = readdir($pointeur))
                            {
                                //on ne traite pas les . et ..
                                if(($sous_dossier != '.') && ($sous_dossier != '..'))
                                {
                                    //si c'est un dossier, on le lit
                                    if (is_dir($nom_repertoire.'/'.$sous_dossier))
                                    {

                                        $misy_sous_repert=true;
                                    }
                                }
                            }
                            if( $misy_sous_repert==true)
                            {
                            /////////
                            $destination="C:\images\traitement";
                            $vr=@opendir("$destination");
                            if($vr)
                            {
                                $TroisLetre=substr($command, 0,4);//quatre letre eo aloan'ny comande
                                $verfie=@opendir("$destination\\$TroisLetre");
                                if(!$verfie)
                                {
                                    @mkdir("$destination\\$TroisLetre");
                                }
                                @mkdir("$destination\\$TroisLetre\\$command");
                                $lien="$destination\\$TroisLetre\\$command";
                                $MyNam="$chemin";
                                // dossier listé (pour lister le répertoir courant : $dir_nom = '.' --> ('point')
                                $SousRepertoire=array(); // on déclare le tableau contenant le nom des dossiers
                                $NombreSousRepertoire=0;
                                $nombretsymisyextation=0;
                                $nbimage=0;
                                $misy=0;
                                //////////////
                                $nom_repertoire=$MyNam;
                                //on ouvre un pointeur sur le repertoire
                                $pointeur = opendir($nom_repertoire);
                                //pour chaque fichier et dossier
                                while ($sous_dossier = readdir($pointeur))
                                {
                                    //on ne traite pas les . et ..
                                    if(($sous_dossier != '.') && ($sous_dossier != '..'))
                                    {
                                        //si c'est un dossier, on le lit
                                        if (is_dir($nom_repertoire.'/'.$sous_dossier))
                                        {
                                            $SousRepertoire[]=$sous_dossier;
                                            $NombreSousRepertoire++;
                                        }
                                    }
                                }
                                ////////////////////
                                for($Isa=0;$Isa<$NombreSousRepertoire;$Isa++)
                                {
                                    $Total= 0;
                                    $image=array();
                                    ///////////
                                    $mydir ="$chemin\\$SousRepertoire[$Isa]";
                                    if ($dir = @opendir($mydir))
                                    {
                                        while(false !== ($file = readdir($dir)))
                                        {
                                            if(($file != ".." )&& ($file != ".") && (preg_match("/.$extension$/",$file)))
                                            {
                                                $image[] = $file;
                                                $Total++;
                                            }
                                        }
                                    }
                                    if($Total==0)
                                    {
                                        $nbimage++;
                                    }
                                    else
                                    {
                                        $misy++;
                                    }
                                }
                                if($misy!=0)
                                {
                                    $TotalFichier = 0;
                                    $this->preparation_s_m_model->get_insertionPre($command,$matricule,$lien,$TotalFichier,$traitement,$export,$idcommande,$fic);
                                    $preparation = $this->preparation_s_m_model->get_selectPre($command);

                                    foreach($preparation as $pre)
                                    {
                                        $id_preparation = $pre->ID_PREPARATION;
                                    }
                                }

                                $Seq = 10000;
                                for($Isa=0;$Isa<$NombreSousRepertoire;$Isa++)
                                {
                                    $Total= 0;
                                    $izy=array();

                                    ///////////
                                    $mydir ="$chemin\\$SousRepertoire[$Isa]";
                                    if ($dir = @opendir($mydir))
                                    {
                                        while(false !== ($file = readdir($dir)))
                                        {
                                            if(($file != ".." )&& ($file != ".") && (preg_match("/.$extension$/",$file)))
                                            {
                                                $izy[] = $file;
                                                $Total++;
                                                $TotalFichier++;

                                            }
                                        }
                                    }
                                    if($Total==0)
                                    {
                                        $r=$SousRepertoire[$Isa];
                                        $nombretsymisyextation++;
                                        echo  "<script language=\"javascript\">alert('Il y a pas de type extension:$extension dans un répértoire $r!');</script>";
                                    }
                                    else
                                    {
                                        /////////////
                                        $Manomboka =0;
                                        $Seq = $Seq + 1;
                                        $sequen="$Seq";
                                        $Sequence= substr($sequen,-4,4);
                                        $sequen=null;
                                        $rep=$SousRepertoire[$Isa];
                                        @mkdir("$destination\\$TroisLetre\\$command\\$rep");
                                        @rename("$destination\\$TroisLetre\\$command\\$rep","$destination\\$TroisLetre\\$command\\$command$Sequence");
                                        $Depart=0;
                                        while($Depart<$Total)
                                        {
                                            $Manomboka++;
                                            $izyl=$izy[$Depart];
                                            if ($Manomboka ==1)
                                            {
                                                $SousRepert="$command$Sequence";
                                                $RepertoireACreer="$destination\\$TroisLetre\\$command\\$command$Sequence";
                                                $this->preparation_s_m_model->get_insertionFICHIER($command,$izyl,$RepertoireACreer,$SousRepert,$id_preparation,$traitement,$export,$idcommande,$fic,$dossier);
                                            }
                                            $rep="$command$Sequence";
                                            $RepertoireACreer="$destination\\$TroisLetre\\$command\\$command$Sequence";
                                            $this->preparation_s_m_model->get_insertionLISTAGE($izyl,$command,$rep,$id_preparation,$RepertoireACreer,$export,$idcommande,$fic);
                                            $Depart++;
                                        }
                                        //////////////////////
                                        $origine = "$chemin\\$SousRepertoire[$Isa]";
                                        $destinat ="$destination\\$TroisLetre\\$command\\$command$Sequence";
                                        $doss=@opendir("$origine");
                                        while ($file =readdir($doss))
                                        {
                                            if(($file != ".." )&& ($file != ".") && (preg_match("/.$extension$/",$file)))
                                            {

                                                @copy("$origine\\$file", "$destinat\\$file"); //on les déplace tous
                                            }
                                        }

                                    }
                                }
                                if($nombretsymisyextation==$NombreSousRepertoire)
                                {

                                    echo  "<script language=\"javascript\">alert('Verifier votre extension car il y a pas de type extension:$extension dans tout les sous répértoires');</script>";
                                }
                                else
                                {
                                    $this->preparation_s_m_model->get_updatePREPARATION($TotalFichier,$command);
                                    echo  "<script language=\"javascript\">alert('Mise en lot terminé');</script>";
                                }
                            }
                            else
                            {
                                echo  "<script language=\"javascript\">alert('Crier un dossier de déstination');</script>";
                            }
                        }
                            else
                            {
                                echo  "<script language=\"javascript\">alert('Il n y a pas de sous dossier dans cette repertoire!');</script>";
                            }
                        }

                    }
                }
                ////
                else
                {
                    echo  "<script language=\"javascript\">alert('Verriffer votre chemin');</script>";
                }
            }
            /*}

                    elseif($pers==2)
                    {
                        echo"<script language=\"javascript\">alert('Vous n avez pas encore fait le pointage')</script>";
                    }*/

        }
           }
    }