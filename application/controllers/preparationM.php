<?php
ini_set("memory_limit","360M");
class PreparationM extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('assets_helper');
        $this->load->library('session');
        $this->load->model('preparationM_model');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('directory');
        $this->load->library('upload');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|foldres';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);

// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
        $this->upload->initialize($config);
    }
    /////////////////
   function index()
    {
        $this->load->view('preparation');
    }
    function lien($phot)
    {
        $data['lien']='<label style="color:red" ><?php echo($phot); ?></label >';
        $this->load->view('preparation', $data);
    }


    function do_upload()
    {
        //Configure uploa
          $photo= $this->upload->initialize(array(
            "file_name"     => array("file_1.ext", "file_2.ext", "file_3.ext"),
            "upload_path"   => "/path/to/upload/to/"
        ));
        $phot=$photo['full_path'];
        $this->lien($phot);
        //Perform upload.
        if($this->upload->do_multi_upload("files")) {
        //Code to run upon successful upload.
        }
    }
    /////////////////
    public function erreurLog($matricule,$pass,$extation,$traitement,$export,$chemin,$idcommande,$fic)
    {
        $data['erreurLog'] =' <label style="color:red" > Login ou Mot de passe incorrecte </label>';
        $data['matricule'] =$matricule;
        $data['pass'] =$pass;
        $data['extation'] =$extation;
        $data['traitement'] =$traitement;
        $data['export'] =$export;
        $data['chemin'] =$chemin;
        $data['idcommande'] =$idcommande;
        $data['fic'] =$fic;
        $this->load->view('preparation', $data);
    }
    public function erreurAbs()
    {
        $data['erreurAbs'] =' <script>alert("Vous n avez pas encore fait le pointage")</script>';
    }
  public function commandeAo($matricule,$pass,$extation,$traitement,$export,$chemin,$idcommande,$fic)
  {
      $data['commandeAo'] ='<script>alert("Commande déjà existée");</script>';
      $data['matricule'] =$matricule;
      $data['pass'] =$pass;
      $data['extation'] =$extation;
      $data['traitement'] =$traitement;
      $data['export'] =$export;
      $data['chemin'] =$chemin;
      $data['idcommande'] =$idcommande;
      $data['fic'] =$fic;
      $this->load->view('preparation',$data);
  }
    public function oublier($extation,$traitement,$export,$chemin,$idcommande,$fic)
    {
        $data['oublier'] ='<script>alert("Tout les champs sont obligatoire");</script>';
        $data['extation'] =$extation;
        $data['traitement'] =$traitement;
        $data['export'] =$export;
        $data['chemin'] =$chemin;
        $data['idcommande'] =$idcommande;
        $data['fic'] =$fic;
        $this->load->view('preparation',$data);
    }
    public function lotTermine()
    {
        $data['lotTermine'] ='<script>alert("Mise en lot terminé");</script>';
        $this->load->view('preparation',$data);
    }
    public function lotErreur()
    {
        $data['lotErreur'] ='<script>alert("Erreur");</script>';
        $this->load->view('preparation',$data);
    }
    public function insertionNety()
    {
        $data['insertionNety'] ='<script>alert("insertion bien effectuer");</script>';
        $this->load->view('preparation',$data);
    }
    public function insertiontsyNety()
    {
        $data['insertiontsyNety'] ='<script>alert(" Erreur insertion");</script>';
        $this->load->view('preparation',$data);
    }
    public function tsisyfich()
    {
        $data['tsisyfich'] ='<script>alert("PAS DE FICHIER");</script>';
        $this->load->view('preparation',$data);
    }
public function Annuler()
    {
        $data['Annuler'] ='<script>alert("ANNULER!")</script>';
        $this->load->view('preparation',$data);
    }
 public function verfrep($matricule,$pass,$extation,$traitement,$export,$chemin,$idcommande,$fic)
    {
        $data['verfrep'] ='<script>alert("verrifier votre repertoire");</script>';
        $data['matricule'] =$matricule;
        $data['pass'] =$pass;
        $data['extation'] =$extation;
        $data['traitement'] =$traitement;
        $data['export'] =$export;
        $data['chemin'] =$chemin;
        $data['idcommande'] =$idcommande;
        $data['fic'] =$fic;
        $this->load->view('preparation',$data);
    }
  public function verh($matricule,$pass,$extation,$traitement,$export,$chemin,$idcommande,$fic)
    {
        $data['verh'] ='<script>alert("verrifier votre chemin");</script>';
        $data['matricule'] =$matricule;
        $data['pass'] =$pass;
        $data['extation'] =$extation;
        $data['traitement'] =$traitement;
        $data['export'] =$export;
        $data['chemin'] =$chemin;
        $data['idcommande'] =$idcommande;
        $data['fic'] =$fic;
        $this->load->view('preparation',$data);
    }
    public function reperttsymisy($matricule,$pass,$extation,$traitement,$export,$chemin,$idcommande,$fic)
    {
        $data['reperttsymisy'] ='<script>alert("Cette repertoire n existe pas!");</script>';
        $data['matricule'] =$matricule;
        $data['pass'] =$pass;
        $data['extation'] =$extation;
        $data['traitement'] =$traitement;
        $data['export'] =$export;
        $data['chemin'] =$chemin;
        $data['idcommande'] =$idcommande;
        $data['fic'] =$fic;
        $this->load->view('preparation',$data);
    }
    public function affichage()
    {
        $pass = $this->session->userdata('mdp');
        $matricule = $this->session->userdata('matricule');
        $extation = $_POST['extension'];
        $traitement = $_POST['traitement'];
        $export = $_POST['export'];
        $chemin= $_POST['chemin'];
        $idcommande= $_POST['idcommande'];
        $fic= $_POST['fic'];

            if($extation==null||$chemin==null||$traitement==null||$export==null ||$idcommande==null ||$fic==null)
            {
                echo  "<script language=\"javascript\">alert('Tous les champs sont obligatoire');</script>" ;
            }
            else
            {
                $pers = $this->preparationM_model->get_personnel($matricule,$pass);
                if($pers==1)
                {     //mot de pass correct, present
                    $dossier =$chemin;
                    $vrais=null;
                    $vef=@opendir("$chemin");
                    if($vef)
                    {
                        $iterator = new DirectoryIterator($dossier);
                        foreach($iterator as $commande)
                        {
                            // La fonction isDot retourne TRUE si l'élement courant est "." ou ".."
                            if(!$commande->isDot()){
                                $command=$commande->getFilename();
                                $vrais=true;
                            }
                            else
                            {
                                $vrais=false;
                            }

                        }
                        if($vrais==true)
                        {
                            $ver=$this->preparationM_model->get_verrification($command);
                            if($ver==1)
                            {
                                echo  "<script language=\"javascript\">alert('Commande déjà existée');</script>";
                            }
                            else
                            {
                                ///mot de pass est correct et personne preen
                                $destination="C:/chemin/image";//asiana ny image dy destination(lien)
                                $TroisLetre=substr($command, 0, 3);
                                $verfie=@opendir("$destination/$TroisLetre");
                                if(!$verfie)
                                {
                                    mkdir("$destination/$TroisLetre");
                                }
                                mkdir("$destination/$TroisLetre/$command");
                                $lien="$destination/$TroisLetre/$command";
                                $MyNam="$chemin/$command";
                                // dossier listé (pour lister le répertoir courant : $dir_nom = '.' --> ('point')
                                $SousRepertoire=array(); // on déclare le tableau contenant le nom des dossiers
                                $NombreSousRepertoire=0;
                                //////////////
                                $nom_repertoire = $MyNam;
                                //on ouvre un pointeur sur le repertoire
                                $pointeur = opendir($nom_repertoire);
                                //pour chaque fichier et dossier
                                while ($fichier = readdir($pointeur))
                                {
                                    //on ne traite pas les . et ..
                                    if(($fichier != '.') && ($fichier != '..'))
                                    {
                                        //si c'est un dossier, on le lit
                                        if (is_dir($nom_repertoire.'/'.$fichier))
                                        {
                                            $SousRepertoire[]=$fichier;
                                            $NombreSousRepertoire++;
                                        }
                                    }
                                }
                                $TotalFichier = 0;
                                $this->preparationM_model->get_insertionPre($command,$matricule,$lien,$TotalFichier,$traitement,$export,$idcommande,$fic);
                                $preparation = $this->preparationM_model->get_selectPre($command);

                                foreach($preparation as $pre)
                                {
                                    $id_preparation = $pre->ID_PREPARATION;
                                }
                                $Seq = 10000;
                                for($Isa=0;$Isa<$NombreSousRepertoire;$Isa++)
                                {
                                    $Total= 0;
                                    $izy=array();
                                    ///////////
                                    $mydir ="$chemin/$command/$SousRepertoire[$Isa]";
                                    if ($dir = @opendir($mydir))
                                    {
                                        while(false !== ($file = readdir($dir)))
                                        {
                                            if($file != ".." && $file != ".")
                                            {
                                                $izy[] = $file;
                                                $Total++;
                                                $TotalFichier++;
                                            }
                                        }
                                    }
                                    /////////////
                                    $Manomboka =0;
                                    $Seq = $Seq + 1;
                                    $sequen="$Seq";
                                    $Sequence= substr($sequen,-4,4);
                                    $sequen=null;
                                    $rep=$SousRepertoire[$Isa];
                                    mkdir("$destination/$TroisLetre/$command/$rep");
                                    @rename("$destination/$TroisLetre/$command/$rep","$destination/$TroisLetre/$command/$command$Sequence");
                                    $Depart=0;
                                    while($Depart<$Total)
                                    {
                                        $Manomboka++;
                                        $izyl=$izy[$Depart];
                                        ////////////////
                                        ///////////
                                        if ($Manomboka ==1)
                                        {
                                            $SousRepert="$command$Sequence";
                                            $RepertoireACreer="$destination/$TroisLetre/$command/$command$Sequence";
                                            $this->preparationM_model->get_insertionFICHIER($command,$izyl,$RepertoireACreer,$SousRepert,$id_preparation,$traitement,$export,$idcommande,$fic);
                                        }
                                        $rep="$command$Sequence";
                                        $RepertoireACreer="$destination/$TroisLetre/$command/$command$Sequence";
                                        $this->preparationM_model->get_insertionLISTAGE($izyl,$command,$rep,$id_preparation,$RepertoireACreer,$export,$idcommande,$fic);
                                        $Depart++;
                                    }
                                    //////////////////////
                                    $origine = "$chemin/$command/$SousRepertoire[$Isa]";
                                    $destinat ="$destination/$TroisLetre/$command/$command$Sequence";
                                    $doss=@opendir("$origine");
                                    while ($fil =readdir($doss))
                                    {
                                        if($fil != ".." && $fil != ".")
                                        {

                                            @copy("$origine/$fil", "$destinat/$fil"); //on les déplace tous
                                        }
                                    }


                                    ////////////////////
                                }
                                $this->preparationM_model->get_updatePREPARATION($TotalFichier,$command);
                                echo  "<script language=\"javascript\">alert('Mise en lot terminé');</script>";
                            }
                        }
                    }
                    else
                    {
                        $this->verh($matricule,$pass,$extation,$traitement,$export,$chemin,$idcommande,$fic);
                    }

                }
                elseif($pers==2)
                {
                    //pers abs
                  echo"<script language=\"javascript\">alert('Vous n avez pas encore fait le pointage')</script>";
                }
                elseif($pers==3)
                {
                    //mot de pass incorrect
                    $this->erreurLog($matricule,$pass,$extation,$traitement,$export,$chemin,$idcommande,$fic);
                }
            }


    }
    public function verrifier($matricule='',$pass='')
    {
       $ids=$this->preparationM_model->get_verrification($matricule='',$pass='');
        if($ids==0)
        {

          echo json_encode(array( 'connection' => false,));
        }
        elseif($ids==1)
        {
           exit;
        }
    }

}