<?php
class  Sansfic extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('assets_helper');
        $this->load->library('session');
        $this->load->model('sansfic_model');//made miload any @ models sansfic_model izay mitovy @ include ny asany
        $this->view_data = array();
    }
    function index()
    {
        $this->load->view('sansficview');//made miload any @ models sansficview izay mapiseho ny interface
    }
    public function Annuler()//bouton annuler
    {
        $data['Annuler'] ='<script>alert("ANNULER!")</script>';
        $this->load->view('sansficview',$data);
    }
    public function affichage()//fonction ity d miasa in fois vao manidry bouton preparation d miasa izy
    {
        $matricule = $this->session->userdata('matricule');//manalaka ny matricule izay napidirina voaloany
        //maka ny zavatra nifenoana
        $chemin= $_POST['chemin'];
        $chemin_fichier_vakina=$chemin;
        $traitement = $_POST['traitement'];
        $export = $_POST['export'];
        $idcommande= $_POST['idcommande'];
        $fic= $_POST['fic'];
        $dossier=$_POST['dossier'];
        $idcommande=strtoupper($idcommande);
        $fic=strtolower($fic);//for post requests, q is the key
        //fin ny fangalana ny zavatra nifenoana
        //verrifier sao misy champ vide
        /*$pers = $this->sansfic_model->get_personnel($matricule);
        if($pers==1)
        {*/
            if($chemin==null||$traitement==null||$export==null ||$idcommande==null||$fic==null)
            {
                //mapiseho alert raha misy zavatra hadino eo @ zavatra fenoana any @ interface
                echo ("<script language=\"javascript\">alert('Tous les champs sont obligatoire');</script>");
            }
            else
            {
                //miditra raha toa ka feno aby ny zafatra tokony fenoana

                // sady miditra ato raha tsy vide
                $nbr = 12;
                $chemin=substr($chemin,0,-$nbr);
                $repertoire_misy_fic=$chemin;
                $verification_fichier_existe=$chemin;
                $a=@opendir($chemin);
                if(!$a)
                {//mapiseho alert raha toa ka tsy Upload fichier
                    echo ("<script language=\"javascript\">alert('Le nom de fichier doit etre 4 letres, 3 chiffre et verifier votre chemin!');</script>");
                }
                else
                {
                    $izy=false;
                    $commande=substr($chemin_fichier_vakina,-11,11);
                    $nom_de_fichier=$commande;
                    $commande=substr($commande,0,7);
                    $iterator = new DirectoryIterator($repertoire_misy_fic);
                    if ($dir = @opendir($iterator))
                    {
                        while(false !== ($file = readdir($dir)))
                        {
                            if($file != ".." && $file != ".")
                            {
                                $izy=true;
                            }
                        }
                    }
                    if($izy==true)
                    {
                    $command=strtoupper($commande);
                    //verrifier si la command est déja existe
                    $ver=$this->sansfic_model->get_verrification($command);//fonction makany @ model; verrifier azy
                    if( $ver==1)
                    {
                        //alert raha command efa ao
                        echo ("<script language=\"javascript\">alert('Commande dejat existé');</script>");

                    }
                    else
                    {
                        //tsy ao ny  command de ataony ty
                        $Total = 0;
                        $Izy=array();
                        $fichier_ao=false;
                        $MyNam= "$chemin_fichier_vakina";//ato ny chemin misy ny fichier izay vakina
                        ////
                        $iterator = new DirectoryIterator($verification_fichier_existe);
                        foreach($iterator as $commande){
                            // La fonction isDot retourne TRUE si l'élement courant est "." ou ".."
                            if(!$commande->isDot()){
                                $file_name=$commande->getFilename();
                                if($file_name==$nom_de_fichier)
                                {
                                    $fichier_ao=true;
                                }
                            }

                        }
                        /////////
                        if($fichier_ao==true)
                        {
                        $handle = fopen("$MyNam", "r");//mamaky ny fichier
                        //verriffier si le fichier sont vide
                        $s_file = "$MyNam";
                        $s_fileData = file_get_contents($s_file);
                        if (!$s_fileData || strlen($s_fileData) == 0)
                        {
                            echo ("<script language=\"javascript\">alert('Fichier vide');</script>");
                        }
                        ///fin de verrification
                        else
                        {
                            //miditra raha toa ka tsy vide ny contenue ny fichier
                            if ($handle)
                            {
                                //mamaky ny contenue de fichier par ligne
                                while (($line = fgets($handle)) !== false)
                                {

                                    $Izy[]=$line;
                                    $Total++;
                                }
                            }
                             fclose($handle);
                            //vita ny famakina ny fichier par ligne ary enregistre ao @ tableau izy[] io ny contenue ny fichier
                            //maka ny trois letre voaloany ao amin'ny nom de fichier
                            $TroisLetre=substr($command, 0, 4);
                            //fin ny fakana ny trois letre voaloany ao amin'ny nom de fichier
                             //tafiditra raha toa ka misy lé chemin de destination

                            $this->sansfic_model->get_insertionPre($command,$Total,$traitement,$export,$idcommande,$fic);
                            $preparation = $this->sansfic_model->get_selectPre($command);
                            foreach($preparation as $pre)
                            {
                                $id_preparation = $pre->ID_PREPARATION;
                            }
                            $Seq = 10000;
                            for($i= 0;$i<$Total;$i++)
                            {
                                $Seq = $Seq + 1;
                                $sequen="$Seq";
                                $Sequence= substr($sequen,-4,4);
                                $sequen=null;
                                $izy=$Izy[$i];
                                $this->sansfic_model->get_insertionFICHIER($command,$izy,$Sequence,$id_preparation,$traitement,$export,$idcommande,$fic,$dossier);
                                $this->sansfic_model->get_insertionLISTAGE($izy,$command,$Sequence,$id_preparation,$export,$idcommande,$fic);
                            }
                            ///@copy("$chemin_fichier_vakina","$destination\\$TroisLetre\\$command\\$nom_de_fichier");
                                //mamafa ny repertoire C:/fichier izay nifironina automatique
                                //fin ny famafana ny chemin C:fichier izay niforonina automatique
                            echo "<script language=\"javascript\">alert(' mise en lot terminé');</script>";

                        }

                    }
                    else
                    {
                        echo ("<script language=\"javascript\">alert('Il y a pas de fichier $nom_de_fichier dams ce repertoire!');</script>");
                    }
                    }
                    }
                    else
                    {
                        echo ("<script language=\"javascript\">alert('Il y a pas de fichier dams votre chemin');</script>");
                    }

                }

            }
       /*}
        elseif($pers==2)
        {
            echo"<script language=\"javascript\">alert('Vous n avez pas encore fait le pointage')</script>";
        }*/

    }
}