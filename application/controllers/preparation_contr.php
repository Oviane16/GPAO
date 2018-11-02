<?php
class Preparation_contr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('assets_helper');
        $this->load->library('session');
        $this->load->model('preparation_model');
// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
    }
    /////////////////
    function index()
    {
        $this->load->view('preparation_views');
    }
    //////////////
    public function affichage()
    {

        $matricule = $this->session->userdata('matricule');
        $extension = $_POST['extension'];
        $export = $_POST['export'];
        $chemin= $_POST['chemin'];
        $nombre= $_POST['nombre'];
        $traitement = $_POST['traitement'];
        $idcommande= $_POST['idcommande'];
        $fic= $_POST['fic'];
        $idcommande=strtoupper($idcommande);

        $pers = $this->insertion_auto_model->get_personnel($matricule);
        if($pers==1)
        {

            if($chemin==null||$extension==null||$nombre==null||$traitement==null||$export==null ||$idcommande==null ||$fic==null)
            {
                echo  "<script language=\"javascript\">alert('Tous les champs sont obligatoire');</script>" ;
            }
            else
            {
                if($nombre>0)
                {
                   //////////////////////////////
                    $nbr = 12;
                    $ch=substr($chemin,0,-$nbr);
                    $a=@opendir($ch);
                    if(!$a)
                    {//mapiseho alert raha toa ka tsy Upload fichier
                        echo ("<script language=\"javascript\">alert('Le nom de fichier doit etre 4 letres, 3 chiffre!');</script>");
                    }
                    else
                    {
                    /////////////////////////
                //mot de pass correct, present///////////////////////////
                $dossier =$chemin;
                $vrais=null;
                $vef=@opendir("$chemin");
                if($vef)
                {
                       $command= substr($chemin,-7,7);
                        $ver= $this->preparation_model->get_verrification($command);
                        if($ver==1)
                        {
                            echo  "<script language=\"javascript\">alert('Commande déjà existée');</script>";
                        }
                        else
                        {
                            ///mot de pass est correct et personne preen
                            $destination="C:/img/fic";//asiana ny image dy destination(lien)
                            $TroisLetre=substr($command, 0,4);
                            $verfie=@opendir("$destination\\$TroisLetre");
                            if(!$verfie)
                            {
                                mkdir("$destination\\$TroisLetre");
                            }
                            $verfi=@opendir("$destination\\$TroisLetre\\$command");
                            if(!$verfi)
                            {
                                mkdir("$destination\\$TroisLetre\\$command");
                            }
                            $lien="$destination/$TroisLetre/$command";
                            // dossier listé (pour lister le répertoir courant : $dir_nom = '.' --> ('point')
                            $Izy=array(); // on déclare le tableau contenant le nom des dossiers
                            $Total=0;
                            ////////////
                            //on ouvre un pointeur sur le repertoire
                            $mydir ="$chemin";
                            if ($dir = @opendir($mydir))
                            {
                                while(false !== ($file = readdir($dir)))
                                {
                                    if(($file != ".." )&& ($file != ".") && (preg_match("/.$extension$/",$file)))
                                    {
                                        $Izy[] = $file;
                                        $Total++;
                                    }
                                }
                            }
                            if($Total==0)
                            {
                                echo  "<script language=\"javascript\">alert('Il y a pas de type $extension dans cette répértoire !');</script>";
                            }
                            else
                            {
                            $this->preparation_model->get_insertionPre($command,$Total,$nombre,$lien,$matricule,$traitement,$export,$idcommande,$fic);
                            $preparation = $this->preparation_model->get_selectPre($command);
                            foreach($preparation as $pre)
                            {
                                $id_preparation = $pre->ID_PREPARATION;
                            }

                           $Manomboka = 0;
                           $Seq=10000;
                                for($Isa=0;$Isa<$Total;$Isa++)
                                {
                                 $Manomboka=$Manomboka+1;

                                 if($nombre== 1)
                                 {
                                     $Seq=$Seq+1;
                                     $sequen="$Seq";
                                     $Sequence= substr($sequen,-4,4);
                                     $sequen=null;
                                     $name=@opendir("$destination\\$TroisLetre\\$command\\$command$Sequence");
                                     $SousRepert="$command$Sequence";
                                     $RepertoireACreer="$destination/$TroisLetre/$command/$command$Sequence";
                                     $rep=$Izy[$Isa];
                                     if(!$name)
                                     {
                                         @mkdir("$destination\\$TroisLetre\\$command\\$command$Sequence");
                                     }

                                     $this->preparation_model->get_insertionFICHIER($SousRepert,$command,$rep,$RepertoireACreer,$id_preparation,$traitement,$export,$idcommande,$fic);
                                     $this->preparation_model->get_insertionLISTAGE($rep,$command,$SousRepert,$id_preparation,$RepertoireACreer,$export,$idcommande,$fic);
                                 }
                                 else
                                 {
                         if($Manomboka==1)
                         {
                           $Seq=$Seq+1;
                           $sequen="$Seq";
                           $Sequence= substr($sequen,-4,4);
                           $sequen=null;
                           $name=@opendir("$destination\\$TroisLetre\\$command\\$command$Sequence");
                           $SousRepert="$command$Sequence";
                           $RepertoireACreer="$destination\\$TroisLetre\\$command\\$command$Sequence";
                           $rep=$Izy[$Isa];
                          if(!$name)
                           {
                           @mkdir("$destination\\$TroisLetre\\$command\\$command$Sequence");
                           }
                           $this->preparation_model->get_insertionFICHIER($SousRepert,$command,$rep,$RepertoireACreer,$id_preparation,$traitement,$export,$idcommande,$fic);
                           $this->preparation_model->get_insertionLISTAGE($rep,$command,$SousRepert,$id_preparation,$RepertoireACreer,$export,$idcommande,$fic);

                         }
                         else
                         {
                          $rep=$Izy[$Isa];
                          $this->preparation_model->get_insertionLISTAGE($rep,$command,$SousRepert,$id_preparation,$RepertoireACreer,$export,$idcommande,$fic);
                          if($Manomboka==$nombre)
                           {
                            $Manomboka =0;
                           }
                          }
                       }
                         @copy("$chemin/$rep","$destination\\$TroisLetre\\$command\\$command$Sequence\\$rep");
                          }
                         echo "<script language=\"javascript\">alert('Mise en lot terminé');</script>";
                        }

                    }

                }
                else
                {
                    echo  "<script language=\"javascript\">alert('Verriffer votre chemin');</script>";
                }

                }
                }
                else
                {
                    echo  "<script language=\"javascript\">alert('Nombre fichier par lot est supperieur à 0!');</script>";
                }
        }
          }
        elseif($pers==2)
         {
             echo"<script language=\"javascript\">alert('Vous n avez pas encore fait le pointage')</script>";
         }
    }
}