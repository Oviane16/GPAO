<?php
class AdminEnPouce extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('assets_helper');
        $this->load->model('adminEnPouce_model');
    }
    public function index()
    {

        $data['commande'] = $this->adminEnPouce_model->get_commande();
        $this->load->view('adminEnPouce', $data);

    }
    public function erreur()
    {
        $data['commande'] = $this->adminEnPouce_model->get_commande();
        $data['erreur'] = '<label style="color:red" > Login ou Mot de passe incorrecte </label>';
        $this->load->view('adminEnPouce', $data);
    }
    public function erreurDeA()
    {
        $data['commande'] = $this->adminEnPouce_model->get_commande();
        $data['erreurDeA'] = '<label style="color:red" > valeur non valide </label>';
        $this->load->view('adminEnPouce', $data);
    }
    public function erreurEt()
    {
        $data['commande'] = $this->adminEnPouce_model->get_commande();
        $data['erreurEt'] = '<label style="color:red" > Veuiller choisir un etape </label>';
        $this->load->view('adminEnPouce', $data);
    }

    public function affichage_fichier()
    {
        $this->load->library('session');
        $nom_fichierF = NULL;
        $nom_fichierD = NULL;
        $matricule = $_POST['mat'];
        $mdp = $_POST['mdp'];
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
        $id = $this->adminEnPouce_model->get_personnel($matricule,$mdp);
        $valeur_form = array(
            "matricule" => $matricule,
            "mdp" => $mdp,
            "commande" => $commande,
            "etape"=>$etape,
            "option"=>$option,
            "de"=>$de,
            "a"=>$a
        );
        $data['valeur_form'] = $valeur_form;

        if($id == 1 || $this->session->userdata('matricule') == $matricule && $matricule !=NULL)
        {
            if($etape != NULL)
            {
                if($de < $a || $a == null && $de == null)
                {
                    $this->session->set_userdata('matricule', $matricule);
                    $this->session->set_userdata('mdp', $mdp);
                    if($etape == 'SAISIE 1' || $etape == 'IMAGE' || $etape == 'SAISIE ' || $etape == 'TRANSFORMATION '  )
                    {
                        $data['commande'] = $this->adminEnPouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierS_aucun($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option == 'En cours')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierS_encours($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option == 'Non traité')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierS_nontraite($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option == 'Fini')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierS_fini($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option == 'Rejeté')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierS_rejete($commande,$nom_fichierD,$nom_fichierF);
                        }
                    }
                    if($etape == 'CONTROLE WEB' || $etape == 'CONTROLE' || $etape =='FORMATAGE'  )
                    {
                        $data['commande'] = $this->adminEnPouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierC_aucun($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='En cours')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierC_encours($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Non traité')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierC_nontraite($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Fini')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierC_fini($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Rejeté')
                        {
                            //tsi misy
                        }

                    }
                    if($etape == 'LIVRAISON')
                    {
                        $data['commande'] = $this->adminEnPouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierLi_aucun($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='En cours')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierLi_encours($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Non traité')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierLi_nontraite($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Rejeté')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierLi_fini($commande,$nom_fichierD,$nom_fichierF);
                        }
                    }
                    if($etape =='LECTURE' || $etape == 'RECHERCHE')
                    {
                        $data['commande'] = $this->adminEnPouce_model->get_commande();
                        if($option =='Aucun')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierLec_aucun($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='En cours')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierLec_encours($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Non traité')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierLec_nontraite($commande,$nom_fichierD,$nom_fichierF);
                        }
                        if($option =='Rejeté')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierLec_fini($commande,$nom_fichierD,$nom_fichierF);
                        }
                    }
                    $this->load->view('adminEnPouce', $data);
                }

                if($de > $a)
                {
                    $this->erreurDeA();
                }
                if($de != NULL || $a == NULL)
                {
                    if($id == 1 || $this->session->userdata('matricule') == $matricule)
                    {
                        $this->session->set_userdata('matricule', $matricule);
                        $this->session->set_userdata('mdp', $mdp);
                        if($etape == 'SAISIE 1' || $etape == 'IMAGE' || $etape == 'SAISIE ' || $etape == 'TRANSFORMATION '  )
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierS_unique($nom_fichierD);
                        }
                        if($etape == 'CONTROLE WEB' || $etape == 'CONTROLE' || $etape =='FORMATAGE'  )
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierC_unique($nom_fichierD);

                        }
                        if($etape == 'LIVRAISON')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierLi_unique($nom_fichierD);
                        }
                        if($etape =='LECTURE' || $etape == 'RECHERCHE')
                        {
                            $data['fichier']= $this->adminEnPouce_model->get_fichierLec_unique($nom_fichierD);
                        }
                    }
                }$this->load->view('adminEnPouce', $data);

            }else $this->erreurEt();
        }else $this->erreur();



    }

    public function etape($commande='')
    {
        $data['etape'] = $this->adminEnPouce_model->get_etape($commande);
        $this->load->view('etape', $data);
    }
    public function initialiser_multiple($et)
    {
        $values = array_map('intval',$_POST['changer_etat']);
        if($et == 'SAISIE%201' || $et == 'TRANSFORMATION' || $et == 'SAISIE'|| $et == 'IMAGE')
        {
            foreach($values as $oid)
            {
                $data = array( 'etat_saisie' => '0' );
                $this->adminEnPouce_model->initialiser_multiple( $oid, $data );
            }
        }
        if($et == 'LECTURE' || $et == 'RECHERCHE' )
        {
            foreach($values as $oid)
            {
                $data = array( 'etat_lecture' => '0' );
                $this->adminEnPouce_model->initialiser_multiple( $oid, $data );
            }
        }
        if($et == 'CONTROLE' || $et == 'CONTROLE%20WEB' || $et == 'FORMATAGE')
        {
            foreach($values as $oid)
            {
                $data = array( 'etat_controle' => '0' );
                $this->adminEnPouce_model->initialiser_multiple( $oid, $data );
            }
        }
        if($et == 'LIVRAISON'  )
        {
            foreach($values as $oid)
            {
                $data = array( 'etat_livraison' => '0' );
                $this->adminEnPouce_model->initialiser_multiple( $oid, $data );
            }
        }
    }
    public function marquerfini_multiple($et)
    {
        $values = array_map('intval',$_POST['changer_etat']);
        if($et == 'SAISIE%201' || $et == 'TRANSFORMATION' || $et == 'SAISIE'|| $et == 'IMAGE')
        {
            foreach($values as $oid)
            {
                $data = array( 'etat_saisie' => '2' );
                $this->adminEnPouce_model->marquerfini_multiple( $oid, $data );
            }
        }
        if($et == 'LECTURE' || $et == 'RECHERCHE' )
        {
            foreach($values as $oid)
            {
                $data = array( 'etat_lecture' => '2' );
                $this->adminEnPouce_model->marquerfini_multiple( $oid, $data );
            }
        }
        if($et == 'CONTROLE' || $et == 'CONTROLE%20WEB' || $et == 'FORMATAGE')
        {
            foreach($values as $oid)
            {
                $data = array( 'etat_controle' => '2' );
                $this->adminEnPouce_model->marquerfini_multiple( $oid, $data );
            }
        }
        if($et == 'LIVRAISON'  )
        {
            foreach($values as $oid)
            {
                $data = array( 'etat_livraison' => '2' );
                $this->adminEnPouce_model->marquerfini_multiple( $oid, $data );
            }
        }
    }
    public function attribuer_fichier($et)
    {
        $nouveau_mat = $_POST['nouveau_mat'];
        $values = array_map('intval',$_POST['changer_etat']);
        if($et == 'SAISIE%201' || $et == 'TRANSFORMATION' || $et == 'SAISIE'|| $et == 'IMAGE')
        {
            foreach($values as $oid)
            {
                $data = array( 'matricule_saisie' => $nouveau_mat  );
                $this->adminEnPouce_model->attribuer_multiple( $oid, $data );
            }
        }
        if($et == 'CONTROLE' || $et == 'CONTROLE%20WEB' || $et == 'FORMATAGE')
        {
            foreach($values as $oid)
            {
                $data = array( 'matricule_controle' => $nouveau_mat  );
                $this->adminEnPouce_model->attribuer_multiple( $oid, $data );
            }

        }
        if($et == 'LECTURE' || $et == 'RECHERCHE' )
        {
            foreach($values as $oid)
            {
                $data = array( 'matricule_lecture' => $nouveau_mat  );
                $this->adminEnPouce_model->attribuer_multiple( $oid, $data );
            }
        }
        if($et == 'LIVRAISON'  )
        {
            foreach($values as $oid)
            {
                $data = array('matricule_livraison' => $nouveau_mat  );
                $this->adminEnPouce_model->attribuer_multiple( $oid, $data );
            }
        }
    }
    public function ecoute_boutton($et='')
    {
        if(isset($_POST['initialiser']))
        {
            $this->initialiser_multiple($et);
            $this->affichage_fichier();
        }
        if(isset($_POST['marquerfini']))
        {
            $this->marquerfini_multiple($et);
            $this->affichage_fichier();
        }
        if(isset($_POST['attribuer']))
        {
            $this->attribuer_fichier($et);
            $this->affichage_fichier();
        }
        if(isset($_POST['afficher']))
        {
            $this->affichage_fichier();
        }
    }
    public function option($etape='')
    {

    }
}