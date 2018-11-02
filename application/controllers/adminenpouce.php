<?php
class Adminenpouce extends CI_Controller
{
	public function __construct()
	{
	parent::__construct();
    $this->load->library('session');
	$this->load->helper('assets_helper');
    $this->load->model('adminenpouce_model');
    $this->load->model('adminenpouce_modelauc');
        $this->view_data = array();
	}
	public function index()
	{
		$data['commande'] = $this->adminenpouce_model->get_commande();
        $this->load->view('adminenpouce', $data);
	}
    public function erreur_Et_Sup()
    {
        $data['commande'] = $this->adminenpouce_model->get_commande();
        $data['erreur_Et_Sup'] = '<label style="color:red" > <script> alert("Il y a encore de(s) etape(s) supérieur non initialisé");</script></label>';
        $this->load->view('adminenpouce', $data);
    }
    public function erreurFonction()
    {
        $data['commande'] = $this->adminenpouce_model->get_commande();
        $data['erreur'] = '<label style="color:red" > Compte non admin </label>';
        $this->load->view('adminenpouce', $data);
    }
    public function erreurDeA()
    {
        $data['commande'] = $this->adminenpouce_model->get_commande();
        $data['erreurDeA'] = '<label style="color:red" > valeur non valide </label>';
        $this->load->view('adminenpouce', $data);
    }
    public function erreurEt()
    {
        $data['commande'] = $this->adminenpouce_model->get_commande();
        $data['erreurEt'] = '<label style="color:red" > Apres de choisir un commande,vous devez choisir un etape </label>';
        $this->load->view('adminenpouce', $data);
    }
	public function affichage_fichier()
	{
        $this->load->library('session');
        $nom_fichierF = NULL;
        $nom_fichierD = NULL;
        $commande = $_POST['commande'];
        $etape = $_POST['etape'];
        $option = $_POST['option'];
        $de = $_POST['de'];
        $a = $_POST['a'];
        $data = array();
        $data['et'] = $etape;
        $count_de = strlen($de);
        $count_a = strlen($a);
        $zero3 = '000';$zero2 = '00';$zero1 = '0';
        if($count_de == 1) {$nom_fichierD = "$commande"."{$zero3}"."$de";}
        if($count_de == 2) {$nom_fichierD = "$commande"."{$zero2}"."$de";}
        if($count_de == 3) {$nom_fichierD = "$commande"."{$zero1}"."$de";}
        if($count_de == 4) {$nom_fichierD = "$commande"."$de";}
        if($count_a == 1) {$nom_fichierF = "$commande"."{$zero3}"."$a";}
        if($count_a == 2) {$nom_fichierF = "$commande"."{$zero2}"."$a";}
        if($count_a == 3) {$nom_fichierF = "$commande"."{$zero1}"."$a";}
        if($count_a == 4) {$nom_fichierF = "$commande"."$a";}
        $valeur_form = array(
            "commande" => $commande,
            "etape"=>$etape,
            "option"=>$option,
            "de"=>$de,
            "a"=>$a
        );
        $data['valeur_form'] = $valeur_form;

            if($etape != NULL)
            {
                if($de < $a )
                {
                    if($etape == 'Aucun')
                    {
                        $data['commande'] = $this->adminenpouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichierAuc']= $this->adminenpouce_modelauc->get_fichierAu_aucun($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option == 'En cours')
                        {
                            $data['fichierAuc']= $this->adminenpouce_modelauc->get_fichierAu_encours($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option == 'Non traité')
                        {
                            $data['fichierAuc']= $this->adminenpouce_modelauc->get_fichierAu_nontraite($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option == 'Fini')
                        {
                            $data['fichierAuc']= $this->adminenpouce_modelauc->get_fichierAu_fini($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option == 'Rejeté')
                        {
                            $data['fichierAuc']= $this->adminenpouce_modelauc->get_fichierAu_rejete($commande,$nom_fichierD,$nom_fichierF);
                        }
                    }
                    if($etape == 'SAISIE 1' || $etape == 'IMAGE' || $etape == 'SAISIE' || $etape == 'TRANSFORMATION'  )
                    {
                        $data['commande'] = $this->adminenpouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierS_aucun($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option == 'En cours')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierS_encours($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option == 'Non traité')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierS_nontraite($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option == 'Fini')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierS_fini($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option == 'Rejeté')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierS_rejete($commande,$nom_fichierD,$nom_fichierF);
                        }
                    }
                    if($etape == 'CONTROLE WEB' || $etape == 'CONTROLE'  )
                    {
                        $data['commande'] = $this->adminenpouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierC_aucun($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='En cours')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierC_encours($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Non traité')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierC_nontraite($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Fini')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierC_fini($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Rejeté')
                        {
                            echo '<script language=\"javascript\">alert("L\'etape CONTROLE n\'a aucun fichier rejeté ");</script>';
                        }

                    }
                    if( $etape =='FORMATAGE' )
                    {
                        $data['commande'] = $this->adminenpouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierF_aucun($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='En cours')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierF_encours($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Non traité')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierF_nontraite($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Fini')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierF_fini($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Rejeté')
                        {
                            echo '<script language=\"javascript\">alert("L\'etape FORMATAGE n\'a aucun fichier rejeté ");</script>';
                        }
                    }
                    if($etape == 'LIVRAISON')
                    {
                        $data['commande'] = $this->adminenpouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLi_aucun($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='En cours')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLi_encours($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Non traité')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLi_nontraite($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Rejeté')
                        {
                              echo '<script language=\"javascript\">alert("L\'etape LIVRAISON n\'a aucun fichier rejeté ");</script>';
                        }
                    }
                    if($etape =='LECTURE' || $etape == 'RECHERCHE')
                    {
                        $data['commande'] = $this->adminenpouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLec_aucun($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='En cours')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLec_encours($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Non traité')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLec_nontraite($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Rejeté')
                        {
                            echo '<script language=\"javascript\">alert("L\'etape LIVRAISON n\'a aucun fichier rejeté ");</script>';
                        }
                    }

                }
                if( $de !=NULL && $a!=NULL && $de > $a)
                {
                    echo "<script language=\"javascript\">alert('La valeur de a doit être superieur à de');</script>";
                }
                // rah tsisy ny valeur $de sy $a
                if( $de == NULL && $de == NULL)
                {
                    if($etape == 'Aucun')
                    {
                        $data['commande'] = $this->adminenpouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichierAuc']= $this->adminenpouce_modelauc->get_fichierAu_aucun_dea($commande);
                        }
                        if($option == 'En cours')
                        {
                            $data['fichierAuc']= $this->adminenpouce_modelauc->get_fichierAu_encours_dea($commande);
                        }
                        if($option == 'Non traité')
                        {
                            $data['fichierAuc']= $this->adminenpouce_modelauc->get_fichierAu_nontraite_dea($commande);
                        }
                        if($option == 'Fini')
                        {
                            $data['fichierAuc']= $this->adminenpouce_modelauc->get_fichierAu_fini_dea($commande);
                        }
                        if($option == 'Rejeté')
                        {
                            $data['fichierAuc']= $this->adminenpouce_modelauc->get_fichierAu_rejete_dea($commande);
                        }
                    }
                    if($etape == 'SAISIE 1' || $etape == 'IMAGE' || $etape == 'SAISIE' || $etape == 'TRANSFORMATION'  )
                    {
                        $data['commande'] = $this->adminenpouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierS_aucun_dea($commande);
                        }
                        if($option == 'En cours')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierS_encours_dea($commande);
                        }
                        if($option == 'Non traité')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierS_nontraite_dea($commande);
                        }
                        if($option == 'Fini')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierS_fini_dea($commande);
                        }
                        if($option == 'Rejeté')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierS_rejete_dea($commande);
                        }
                    }
                    if($etape == 'CONTROLE WEB' || $etape == 'CONTROLE'  )
                    {
                        $data['commande'] = $this->adminenpouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierC_aucun_dea($commande);
                        }
                        if($option =='En cours')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierC_encours_dea($commande);
                        }
                        if($option =='Non traité')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierC_nontraite_dea($commande);
                        }
                        if($option =='Fini')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierC_fini_dea($commande);
                        }
                        if($option =='Rejeté')
                        {

                        }

                    }
                    if( $etape =='FORMATAGE' )
                    {
                        $data['commande'] = $this->adminenpouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierF_aucun_dea($commande);
                        }
                        if($option =='En cours')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierF_encours_dea($commande);
                        }
                        if($option =='Non traité')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierF_nontraite_dea($commande);
                        }
                        if($option =='Fini')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierF_fini_dea($commande);
                        }
                    }
                    if($etape == 'LIVRAISON')
                    {
                        $data['commande'] = $this->adminenpouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLi_aucun_dea($commande);
                        }
                        if($option =='En cours')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLi_encours_dea($commande);
                        }
                        if($option =='Non traité')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLi_nontraite_dea($commande);
                        }
                        if($option =='Fini')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLi_fini_dea($commande);
                        }
                        if($option =='Rejeté')
                        {
                            echo '<script language=\"javascript\">alert("L\'etape LIVRAISON n\'a aucun fichier rejeté ");</script>';
                        }
                    }
                    if($etape =='LECTURE' || $etape == 'RECHERCHE')
                    {
                        $data['commande'] = $this->adminenpouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLec_aucun_dea($commande);
                        }
                        if($option =='En cours')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLec_encours_dea($commande);
                        }
                        if($option =='Non traité')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLec_nontraite_dea($commande);
                        }
                        if($option =='Fini')
                        {
                            $data['fichier']= $this->adminenpouce_model->get_fichierLec_fini_dea($commande);
                        }
                        if($option =='Rejeté')
                        {
                            echo '<script language=\"javascript\">alert("L\'etape RECHERCHE n\'a aucun fichier rejeté ");</script>';
                        }
                    }
                }
                if($de != NULL && $a == NULL)
                {
                    if($etape == 'SAISIE 1' || $etape == 'IMAGE' || $etape == 'SAISIE' || $etape == 'TRANSFORMATION '  )
                    {
                        $data['fichier']= $this->adminenpouce_model->get_fichierS_unique($nom_fichierD);
                    }
                    if($etape == 'CONTROLE WEB' || $etape == 'CONTROLE'  )
                    {
                        $data['fichier']= $this->adminenpouce_model->get_fichierC_unique($nom_fichierD);
                    }
                    if($etape == 'FORMATAGE')
                    {
                        $data['fichier']= $this->adminenpouce_model->get_fichierF_unique($nom_fichierD);
                    }
                    if($etape == 'LIVRAISON')
                    {
                        $data['fichier']= $this->adminenpouce_model->get_fichierLi_unique($nom_fichierD);
                    }
                    if($etape =='LECTURE' || $etape == 'RECHERCHE')
                    {
                        $data['fichier']= $this->adminenpouce_model->get_fichierLec_unique($nom_fichierD);
                    }
                }
                $this->load->view('list_fic',$data);
            }else echo "<script language=\"javascript\">alert('Veuiller choisir un etape');</script>";
    }

    public function etape($commande='')
    {
        $data['etape'] = $this->adminenpouce_model->get_etape($commande);
        $this->load->view('etape', $data);
    }




    public function marquerfini_multiple($etape='')
    {
        $ids = ( explode( ',', $this->input->get_post('ids') ));
        $et =urldecode($etape);
        $i= 0; $k=0;
        $matricule_modif = $this->session->userdata('matricule');
        if($et == 'SAISIE 1' || $et == 'OCR' || $et == 'TRANSFORMATION')
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $etat_saisie = $fic->ETAT_SAISIE;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $matricule = $fic->MATRICULE_SAISIE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $extension = $fic->EXTENSION;
                }
                $a ='SAI';
                 $nom_fic_complet = "$nom_fichier"."{$a}"."{$matricule}"."."."$extension";

                if($etat_saisie != '2')
                {
                    if($etat_controle == '0')
                    {
                        $data = array( 'ETAT_SAISIE' => '2','MATRICULE_SAISIE'=>$matricule_modif );
                        $this->adminenpouce_model->marquerfini_multiple( $id, $data,$commande,$nom_fichier,$matricule ,$et,$nom_fic_complet);
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                        $data['et'] = $et;
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                    else
                    {
                        $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier etat controle(fini)');</script>";
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                        $data['et'] = $et;
                        $this->load->view('list_fic',$data);
                        $k++;
                    }

                }
                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('$nom_fichier Fichier déja fini');</script>";
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                    $k++;
                }

            }

        }
        if($et == 'IMAGE')
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic) {
                    $etat_saisie = $fic->ETAT_SAISIE;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $matricule = $fic->MATRICULE_SAISIE;
                    $extension = $fic->EXTENSION;

                }
                $a ='SAI';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$matricule}"."."."$extension";
                if($etat_saisie != '2')
                {
                    $data = array( 'ETAT_SAISIE' => '2' ,'MATRICULE_SAISIE'=>$matricule_modif);
                    $this->adminenpouce_model->marquerfini_multiple( $id, $data,$commande,$nom_fichier,$matricule ,$et,$nom_fic_complet);
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                    $i++;
                }
                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('$nom_fichier Fichier déja fini');</script>";
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                    $k++;
                }
            }
        }
        if($et == 'RECHERCHE' )
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic) {
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $matricule = $fic->MATRICULE_LECTURE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $etat_saisie = $fic->ETAT_SAISIE;
                    $extension = $fic->EXTENSION;

                }
                $a ='LEC';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$matricule}"."."."$extension";
                    if($etat_lecture != '2')
                    {
                        if($etat_controle =='0' && $etat_saisie == '2')
                        {
                            $data = array( 'ETAT_LECTURE' => '2','MATRICULE_LECTURE'=>$matricule_modif );
                            $this->adminenpouce_model->marquerfini_multiple(  $id, $data,$commande,$nom_fichier,$matricule ,$et,$nom_fic_complet );
                            $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                            $data['et'] = $et;
                            $this->load->view('list_fic',$data);
                            $i++;
                        }
                        else
                        {
                            $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier verifier son etat: controle(non traité),saisie(fini)');</script>";
                            $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                            $data['et'] = $et;
                            $this->load->view('list_fic',$data);
                        }
                    }
                    else
                    {
                        $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('$nom_fichier Fichier déja fini');</script>";
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                        $data['et'] = $et;
                        $this->load->view('list_fic',$data);
                        $k++;
                    }
                }
            }

        if($et == 'LECTURE')
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                $etat_lecture = $fic->ETAT_LECTURE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $matricule = $fic->MATRICULE_LECTURE;
                    $extension = $fic->EXTENSION;

                }
                $a ='LEC';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$matricule}"."."."$extension";
                    if($etat_lecture != '2')
                    {
                        if($etat_lecture == '1')
                        {
                            $data = array( 'ETAT_LECTURE' => '2', 'MATRICULE_LECTURE'=>$matricule_modif );
                            $this->adminenpouce_model->marquerfini_multiple(  $id, $data,$commande,$nom_fichier,$matricule ,$et,$nom_fic_complet );
                            $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                            $data['et'] = $et;
                            $this->load->view('list_fic',$data);
                            $i++;
                        }
                        else
                        {
                            $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier son etat lecture(en cours) ');</script>";
                            $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                            $data['et'] = $et;
                            $this->load->view('list_fic',$data);
                        }

                    }
                    else
                    {
                        $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('$nom_fichier Fichier déja fini');</script>";
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                        $data['et'] = $et;
                        $this->load->view('list_fic',$data);
                        $k++;
                    }
                }
            }

        ///////////////////////
        if($et == 'CONTROLE WEB')
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic) {
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $matricule = $fic->MATRICULE_CONTROLE;
                    $etat_saisie = $fic->ETAT_SAISIE;
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $extension = $fic->EXTENSION;

                }
                $a ='CTL';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$matricule}"."."."$extension";
                    if($etat_controle != 2)
                    {
                        if($etat_saisie == '2' && $etat_lecture == '2' && $etat_livraison =='0')
                        {
                            $data = array( 'ETAT_CONTROLE' => '2' ,'MATRICULE_CONTROLE' =>$matricule_modif );
                            $this->adminenpouce_model->marquerfini_multiple( $id, $data,$commande,$nom_fichier,$matricule ,$et,$nom_fic_complet );
                            $data['et'] = $et;
                            $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierC( $id );
                            $this->load->view('list_fic',$data);
                            $i++;
                        }
                        else
                        {
                            $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier verifier son etat: saisie(fini),lecture(fini),livraison(non traité)');</script>";
                            $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                            $data['et'] = $et;
                            $this->load->view('list_fic',$data);
                        }

                    }
                    else
                    {
                        $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('$nom_fichier Fichier déja fini');</script>";
                        $data['et'] = $et;
                        $fichier_echec_array[] = $this->adminenpouce_model->get_fichier_modifierC( $id );
                        $k++;
                    }

            }
        }
        if($et == 'CONTROLE' || $et == 'CONTROLE ECH')
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic) {
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $commande = $fic->COMMANDE;
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $matricule = $fic->MATRICULE_CONTROLE;
                    $etat_saisie = $fic->ETAT_SAISIE;
                    $etat_formatage = $fic->ETAT_FORMATAGE;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $extension = $fic->EXTENSION;

                }
                $a ='CTL';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$matricule}"."."."$extension";
                    if($etat_controle != 2)
                    {
                        if($etat_saisie == '2' && $etat_controle == '1' && $etat_lecture == '0' && $etat_formatage == '0' && $etat_livraison == '0' )
                        {
                            $data = array( 'ETAT_CONTROLE' => '2','MATRICULE_CONTROLE' =>$matricule_modif );
                            $this->adminenpouce_model->marquerfini_multiple( $id, $data,$commande,$nom_fichier,$matricule ,$et,$nom_fic_complet );
                            $data['et'] = $et;
                            $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierC( $id );
                            $this->load->view('list_fic',$data);
                            $i++;
                        }
                        else
                        {
                            $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier verifier son etat: saisie(fini),controle(en cours),lecture(non traité),formatage(non traité),livraison(non traité)');</script>";
                            $data['et'] = $et;
                            $fichier_echec_array[] = $this->adminenpouce_model->get_fichier_modifierC( $id );
                            $i++;
                        }
                    }
                    else
                    {
                        $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('$nom_fichier Fichier déja fini');</script>";
                        $data['et'] = $et;
                        $fichier_echec_array[] = $this->adminenpouce_model->get_fichier_modifierC( $id );
                        $k++;
                    }
                }
            }
        if($et == 'LIVRAISON'  )
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $matricule = $fic->MATRICULE_LIVRAISON;
                    $extension = $fic->EXTENSION;

                    if( $etat_livraison != '2' )
                    {
                        $data = array( 'ETAT_LIVRAISON' => '2','MATRICULE_LIVRAISON' => $matricule_modif );
                        $this->adminenpouce_model->marquerfini_multiple( $id, $data,$commande,$nom_fichier,$matricule ,$et );
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLi( $id );
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                }
            }
        }
        if( $et == 'FORMATAGE')
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic) {
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $matricule = $fic->MATRICULE_LIVRAISON;
                    $etat_saisie = $fic->ETAT_SAISIE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $extension = $fic->EXTENSION;

                }
                $a ='FO';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$matricule}"."."."$extension";
                    if( ($etat_saisie == '2' && $etat_controle == '2' && $etat_livraison == '0')&& $etat_lecture == '0' || $etat_lecture == '2')
                    {
                        $data = array( 'ETAT_LIVRAISON' => '2' ,'MATRICULE_FORMATAGE' =>$matricule_modif);
                        $this->adminenpouce_model->marquerfini_multiple( $id, $data,$commande,$nom_fichier,$matricule ,$et,$nom_fic_complet );
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLi( $id );
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                    else
                    {
                        $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier verifier son etat: saisie(fini),controle(2),livraison(non traité),lecture(non traité ou fini)');</script>";
                        $data['et'] = $et;
                        $fichier_echec_array[] = $this->adminenpouce_model->get_fichier_modifierC( $id );
                        $i++;
                    }
                }
            }



    }
    public function initialiser_multiple($etape='')
    {
        $ids = ( explode( ',', $this->input->get_post('ids') ));
        $et = urldecode($etape);
        $nom_fichier = NULL;
        $i = 0;
        if($et  == 'RECHERCHE' )
        {
            foreach($ids as $id)
            {
                $mat_modificateur = $this->session->userdata('matricule');
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $ext = $fic->EXTENSION;
                    $matricule = $fic->MATRICULE_LECTURE;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_formatage = $fic->ETAT_FORMATAGE;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                }
                if($etat_lecture != '0')
                {
                    if($etat_livraison == 0 && $etat_controle == 0 )
                    {
                        $sai = 'LEC';
                        $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                        $rep_commande = ("C:\\reserve\\$commande");
                        $MyName =("C:\\reserve\\$commande\\$nom" );
                        $MyName =("\\\\192.15555\\$commande\\$nom" );
                        if (file_exists($MyName))
                        {
                            chmod($rep_commande, 777);
                            unlink($MyName);
                        }
                        $data = array( 'ETAT_LECTURE' => '0','MATRICULE_LECTURE'=>NULL );
                        $this->adminenpouce_model->initialiser_multiple( $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                    else
                    {
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                        $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: livraison(non traité), controle(non traité) ');</script>";
                        $this->load->view('list_fic',$data);
                    }
                }
                else
                {
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);
                }

                /* else if($etat_lecture == '0')
                 {
                     echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
                 }*/
            }
        }
        if($et == 'CONTROLE WEB')
        {
            foreach($ids as $id)
            {
                $mat_modificateur = $this->session->userdata('matricule');
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $ext = $fic->EXTENSION;
                    $matricule = $fic->MATRICULE_LECTURE;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $etat_formatage = $fic->ETAT_FORMATAGE;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $etat_controle = $fic->ETAT_CONTROLE;
                }
                if($etat_controle !='0')
                {
                    if($etat_livraison == '0' &&  $etat_lecture == '2' )
                    {
                        $sai = 'CTL';
                        $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                        $rep_commande = ("C:\\reserve\\$commande");
                        $MyName =("C:\\reserve\\$commande\\$nom" );
                        if (file_exists($MyName))
                        {
                            chmod($rep_commande, 777);
                            unlink($MyName);
                        }
                        $data = array( 'ETAT_CONTROLE'=>'0','MATRICULE_CONTROLE'=>NULL );
                        $this->adminenpouce_model->initialiser_multiple(  $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                    else
                    {
                        $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: lecture(fini),livraison(non traité)  ');</script>";
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierC( $id );
                        $data['et'] = $et;
                        $this->load->view('list_fic',$data);
                    }
                }
                else
                {
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);
                }
                /* else if($etat_controle == '0')
                 {
                     echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
                 } */
            }
        }
        if($et == 'RELECTURE')
        {
            foreach($ids as $id)
            {
                $mat_modificateur = $this->session->userdata('matricule');
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $ext = $fic->EXTENSION;
                    $matricule = $fic->MATRICULE_LECTURE;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_formatage = $fic->ETAT_FORMATAGE;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                }
                if($etat_lecture != '0')
                {
                    if($etat_lecture == '2' && $etat_livraison == '0' && $etat_controle ='0' )
                    {
                        $sai = 'LEC';
                        $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                        $rep_commande = ("C:\\reserve\\$commande");
                        $MyName =("C:\\reserve\\$commande\\$nom" );
                        if (file_exists($MyName))
                        {
                            chmod($rep_commande, 777);
                            unlink($MyName);
                        }
                        $data = array( 'ETAT_LECTURE' => '0','MATRICULE_CONTROLE'=>NULL );
                        $this->adminenpouce_model->initialiser_multiple( $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                    else
                    {
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                        $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: lecture(fini),livraison(non traité),controle(non traité)  ');</script>";
                        $this->load->view('list_fic',$data);
                    }
                }
                else
                {
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);
                }
                /*
                else if($etat_lecture == '0')
                {
                    echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
                }*/
            }
        }

        if($et == 'CONTROLE' || $et == 'CONTROLE ECH' )
        {
            foreach($ids as $id)
            {
                $mat_modificateur = $this->session->userdata('matricule');
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $ext = $fic->EXTENSION;
                    $matricule = $fic->MATRICULE_LECTURE;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $etat_formatage = $fic->ETAT_FORMATAGE;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $etat_controle = $fic->ETAT_CONTROLE;
                }
                if($etat_controle !='0')
                {
                    if($etat_livraison == '0' && $etat_lecture == '0' )
                    {
                        $sai = 'CTL';
                        $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                        $rep_commande = ("C:\\reserve\\$commande");
                        $MyName =("C:\\reserve\\$commande\\$nom" );
                        if (file_exists($MyName))
                        {
                            chmod($rep_commande, 777);
                            unlink($MyName);
                        }
                        $data = array( 'ETAT_CONTROLE'=>'0','MATRICULE_CONTROLE'=>NULL );
                        $this->adminenpouce_model->initialiser_multiple(  $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                    else
                    {
                        $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: livraison(non traité),lecture(non traité)');</script>";
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierC( $id );
                        $data['et'] = $et;
                        $this->load->view('list_fic',$data);
                    }
                }
                else
                {
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);
                }
                /*
                else if($etat_controle == '0')
                {
                    echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
                }*/
            }

        }

        if($et == 'FORMATAGE'  )
        {
            foreach($ids as $id)
            {
                $mat_modificateur = $this->session->userdata('matricule');
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $ext = $fic->EXTENSION;
                    $matricule = $fic->MATRICULE_LECTURE;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $etat_formatage = $fic->ETAT_FORMATAGE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                }

                if($etat_formatage != '0')
                {
                    if($etat_livraison == '0' || $etat_controle =='2'  )
                    {
                        $sai = 'FO';
                        $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                        $rep_commande = ("C:\\reserve\\$commande");
                        $MyName =("C:\\reserve\\$commande\\$nom" );
                        if (file_exists($MyName))
                        {
                            chmod($rep_commande, 777);
                            unlink($MyName);
                        }
                        $data = array( 'ETAT_FORMATAGE' => '0','MATRICULE_FORMATAGE'=>NULL );
                        $this->adminenpouce_model->initialiser_multiple( $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                    else
                    {
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierF($id);
                        $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: livraison(non traité),controle(fini)');</script>";
                        $data['et'] = $et;
                        $this->load->view('list_fic',$data);
                    }
                }
                else
                {
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);
                }/*
                else if($etat_formatage == '0')
                {
                    echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
                }*/
            }
        }


        if($et == 'LIVRAISON' )
        {
            foreach($ids as $id)
            {
                $mat_modificateur = $this->session->userdata('matricule');
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $ext = $fic->EXTENSION;
                    $matricule = $fic->MATRICULE_LIVRAISON;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                }
                if($etat_livraison != '0')
                {
                    $data = array( 'ETAT_LIVRAISON' => '0','MATRICULE_LIVRAISON'=>NULL );
                    $this->adminenpouce_model->initialiser_multiple(  $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext );
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLi( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                    $i++;
                }
                else
                {
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLi( $id );
                    $this->load->view('list_fic',$data);
                }
                /*
                else if($etat_livraison == '0')
                {
                    echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
                }*/
            }

        }

        if($et == 'IMAGE')
        {
            foreach($ids as $id)
            {
                $mat_modificateur = $this->session->userdata('matricule');
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $ext = $fic->EXTENSION;
                    $matricule = $fic->MATRICULE_SAISIE;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $etat_formatage = $fic->ETAT_FORMATAGE;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $etat_saisie = $fic->ETAT_SAISIE;

                }
                if($etat_saisie != '0')
                {

                    $sai = 'SAI';
                    $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                    $rep_commande = ("C:\\reserve\\$commande");
                    $MyName =("C:\\reserve\\$commande\\$nom" );
                    if (file_exists($MyName))
                    {
                        chmod($rep_commande, 777);
                        unlink($MyName);
                    }
                    $data = array( 'ETAT_SAISIE' => '0'/*, 'MATRICULE_SAISIE'=>NULL*/ );
                    $this->adminenpouce_model->initialiser_multiple( $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                    $this->load->view('list_fic',$data);
                    $i++;
                }
                else
                {
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);
                }
                /*
                else if($etat_saisie == '0')
                {
                    $nom_fichier_array[] = $nom_fichier;
                    echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
                }*/
            }

        }
        if($et == 'OCR' || $et == 'SAISIE 1' || $et == 'TRANSFORMATION')
        {
            foreach($ids as $id)
            {
                $mat_modificateur = $this->session->userdata('matricule');
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $ext = $fic->EXTENSION;
                    $matricule = $fic->MATRICULE_SAISIE;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $etat_formatage = $fic->ETAT_FORMATAGE;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $etat_saisie = $fic->ETAT_SAISIE;

                }
                if($etat_saisie != '0')
                {
                    if( $etat_controle == '0'  )
                    {
                        $sai = 'SAI';
                        $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                        $rep_commande = ("C:\\reserve\\$commande");
                        $MyName =("C:\\reserve\\$commande\\$nom" );
                        if (file_exists($MyName))
                        {
                            chmod($rep_commande, 777);
                            unlink($MyName);
                        }
                        $data = array( 'ETAT_SAISIE' => '0', 'MATRICULE_SAISIE'=>NULL );
                        $this->adminenpouce_model->initialiser_multiple( $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                    else
                    {
                        $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: controle(non traité)');</script>";
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                        $this->load->view('list_fic',$data);
                    }
                }
                else
                {
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);
                }
                /*
                else if($etat_saisie == '0')
                {
                    $nom_fichier_array[] = $nom_fichier;
                    echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);
                }*/
            }

        }


        if($et == 'LECTURE' )
        {
            foreach($ids as $id)
            {
                $mat_modificateur = $this->session->userdata('matricule');
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $ext = $fic->EXTENSION;
                    $matricule = $fic->MATRICULE_LECTURE;
                    $commande = $fic->COMMANDE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_formatage = $fic->ETAT_FORMATAGE;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $etat_lecture = $fic->ETAT_LECTURE;
                }
                if($etat_lecture != '0')
                {
                    if($etat_livraison == '0' && $etat_formatage == '0' )
                    {
                        $sai = 'LEC';
                        $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                        $rep_commande = ("C:\\reserve\\$commande");
                        $MyName =("C:\\reserve\\$commande\\$nom" );
                        if (file_exists($MyName))
                        {
                            chmod($rep_commande, 777);
                            unlink($MyName);
                        }
                        $data = array( 'ETAT_LECTURE' => '0','MATRICULE_LECTURE'=>NULL );
                        $this->adminenpouce_model->initialiser_multiple( $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                    else
                    {
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                        $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: livraison(non traité),formatage(non traité)');</script>";
                        $this->load->view('list_fic',$data);
                    }

                }
                else
                {
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);
                }/*
                else if($etat_lecture == '0')
                {
                    echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
                }*/
            }
        }



        ///alert echec ou reussi
        /*if($i != '0')
        {
            echo  "<script language=\"javascript\">alert('$i Fichier(s) initialisé(s)');</script>";
        }
        if($i == '0')
        {
            echo  "<script language=\"javascript\">alert('Aucun fichier initialisé');</script>";
        }*/

    }
    public function a()
    {
        echo ("<script language=\"javascript\">alert('La valeur de a doit être superieur à de');</script>");
    }

    public function attribuer_fichier($etape='',$nouveau_mat='')
    {
        $ids = ( explode( ',', $this->input->get_post('ids') ));
        $et = urldecode($etape);
        if($et == 'SAISIE 1' || $et == 'OCR')
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $matricule = $fic->MATRICULE_SAISIE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $commande = $fic->COMMANDE;
                    $extension = $fic->EXTENSION;
                }
                $a = 'SAI';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$nouveau_mat}"."."."$extension";
                if( $etat_controle == '0' )
                {
                    $data = array( 'MATRICULE_SAISIE' => $nouveau_mat, 'ETAT_SAISIE'=>'1'  );
                    $this->adminenpouce_model->attribuer_multiple($id,$data,$commande,$nom_fichier,$nouveau_mat,$et,$nom_fic_complet );
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);
                }
                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,Veuillez reinitialiser son étape contrôle ');</script>";
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                }

            }
        }
        if( $et == 'TRANSFORMATION')
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $matricule = $fic->MATRICULE_SAISIE;
                    $etat_saisie = $fic->ETAT_SAISIE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $commande = $fic->COMMANDE;
                    $extension = $fic->EXTENSION;
                }
                $a ='SAI';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$nouveau_mat}"."."."$extension";
                if( $etat_controle == '0' && $etat_saisie == '0' )
                {
                    $data = array( 'MATRICULE_SAISIE' => $nouveau_mat, 'ETAT_SAISIE' =>'1'  );
                    $this->adminenpouce_model->attribuer_multiple($id,$data,$commande,$nom_fichier,$nouveau_mat,$et,$nom_fic_complet);
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);
                }

                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier ses etats: controle(non traité), saisie(non traité) ');</script>";
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                }

            }
        }
        if($et == 'RECHERCHE')
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $matricule = $fic->MATRICULE_LECTURE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_saisie = $fic->ETAT_SAISIE;
                    $commande = $fic->COMMANDE;
                    $extension = $fic->EXTENSION;
                }
                $a ='LEC';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$nouveau_mat}"."."."$extension";
                if( $etat_controle == '0' && $etat_saisie == '2' )
                {
                    $data = array( 'MATRICULE_LECTURE' => $nouveau_mat,'ETAT_LECTURE' =>'1' );
                    $this->adminenpouce_model->attribuer_multiple( $id,$data,$commande,$nom_fichier,$nouveau_mat,$et,$nom_fic_complet );
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                    $this->load->view('list_fic',$data);
                }

                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier ses etats: controle(non traité), saisie(fini)');</script>";
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                }

            }
        }
        if($et == 'LECTURE')
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $matricule = $fic->MATRICULE_LECTURE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_saisie = $fic->ETAT_SAISIE;
                    $commande = $fic->COMMANDE;
                    $extension = $fic->EXTENSION;
                }
                $a ='LEC';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$nouveau_mat}"."."."$extension";
                if( $etat_controle == '2')
                {
                    $data = array( 'MATRICULE_LECTURE' => $nouveau_mat,'ETAT_LECTURE' =>'1' );
                    $this->adminenpouce_model->attribuer_multiple( $id,$data,$commande,$nom_fichier,$nouveau_mat,$et,$nom_fic_complet);
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                    $this->load->view('list_fic',$data);
                }
                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier ses etats: saisie(fini)');</script>";
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLec( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                }

            }
        }
        if($et == 'IMAGE')
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {

                    $matricule = $fic->MATRICULE_SAISIE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $commande = $fic->COMMANDE;
                    $extension = $fic->EXTENSION;
                }
                $a ='SAI';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$nouveau_mat}"."."."$extension";
                $data = array( 'MATRICULE_SAISIE' => $nouveau_mat ,'ETAT_SAISIE'=>'1' );
                    $this->adminenpouce_model->attribuer_multiple( $id,$data,$commande,$nom_fichier,$nouveau_mat,$et,$nom_fic_complet );
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);

                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,la fonction du matricule traiteur doit etre OS ');</script>";
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);


            }
        }
        if( $et == 'CONTROLE WEB' )
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $matricule = $fic->MATRICULE_CONTROLE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_saisie = $fic->ETAT_SAISIE;
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $etat_formatage = $fic->ETAT_FORMATAGE;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $commande = $fic->COMMANDE;
                    $extension = $fic->EXTENSION;

                }
                $a ='CTL';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$nouveau_mat}"."."."$extension";
                if( $etat_saisie == '2' && $etat_lecture == '2'  && $etat_controle == '0' && $etat_formatage == '0' && $etat_livraison == '0' )
                {
                    $data = array( 'MATRICULE_CONTROLE' => $nouveau_mat,'ETAT_CONTROLE' =>'1' );
                    $this->adminenpouce_model->attribuer_multiple( $id,$data,$commande,$nom_fichier,$nouveau_mat,$et,$nom_fic_complet );
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierC( $id );
                    $this->load->view('list_fic',$data);
                }
                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier ses etats: saisie(fini), lecture(fini), controle(non traité), formatage(non traité),livraison(non traité)');</script>";
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierC( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                }

            }

        }
        if($et =='CONTROLE ECH' )
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $matricule = $fic->MATRICULE_CONTROLE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_saisie = $fic->ETAT_SAISIE;
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $etat_formatage = $fic->ETAT_FORMATAGE;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $commande = $fic->COMMANDE;
                    $extension = $fic->EXTENSION;
                }
                $a ='CTL';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$nouveau_mat}"."."."$extension";
                if( $etat_saisie == '2' && $etat_lecture == '0' && $etat_controle == '0' && $etat_formatage == '0' && $etat_livraison == '0' )
                {
                    $data = array( 'MATRICULE_CONTROLE' => $nouveau_mat,'ETAT_CONTROLE' =>'1' );
                    $this->adminenpouce_model->attribuer_multiple($id,$data,$commande,$nom_fichier,$nouveau_mat,$et,$nom_fic_complet );
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierC( $id );
                    $this->load->view('list_fic',$data);
                }
                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier ses etats: saisie(fini), lecture(non traité), controle(non traité), formatage(non traité),livraison(non traité)');</script>";
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierC( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                }

            }
        }
        if($et == 'LIVRAISON'  )
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $matricule = $fic->MATRICULE_LIVRAISON;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_saisie = $fic->ETAT_SAISIE;
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $etat_formatage = $fic->ETAT_FORMATAGE;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $commande = $fic->COMMANDE;
                }
                if( $etat_saisie == '2'  && $etat_controle == '2' )
                {
                    $data = array( 'MATRICULE_LIVRAISON' => $nouveau_mat,'ETAT_LIVRAISON' =>'1' );
                    $this->adminenpouce_model->attribuer_multiple( $id,$data,$commande,$nom_fichier,$nouveau_mat,$et);
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);
                }
                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier ses etats: saisie(fini), controle(fini)');</script>";
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierLi( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                }

            }
        }
        if($et == 'FORMATAGE'  )
        {
            foreach($ids as $id)
            {
                $fichier = $this->adminenpouce_model->get_fichier($id);
                foreach($fichier as $fic)
                {
                    $matricule = $fic->MATRICULE_FORMATAGE;
                    $etat_controle = $fic->ETAT_CONTROLE;
                    $nom_fichier = $fic->NOM_FICHIER;
                    $etat_saisie = $fic->ETAT_SAISIE;
                    $etat_lecture = $fic->ETAT_LECTURE;
                    $etat_formatage = $fic->ETAT_FORMATAGE;
                    $etat_livraison = $fic->ETAT_LIVRAISON;
                    $commande = $fic->COMMANDE;
                    $extension = $fic->FORMATAGE;
                }
                $a ='FO';
                $nom_fic_complet = "$nom_fichier"."{$a}"."{$nouveau_mat}"."."."$extension";
                if($etat_controle != '2')
                {
                    $data = array( 'MATRICULE_FORMATAGE' => $nouveau_mat, 'ETAT_FORMATAGE'=>'1'  );
                    $this->adminenpouce_model->attribuer_multiple( $id,$data,$commande,$nom_fichier,$nouveau_mat,$et,$nom_fic_complet );
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierF( $id );
                    $this->load->view('list_fic',$data);
                }
                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier son etat: controle(fini)');</script>";
                    $data['fichier'] = $this->adminenpouce_model->get_fichier_modifierF( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                }

            }
        }

    }


}