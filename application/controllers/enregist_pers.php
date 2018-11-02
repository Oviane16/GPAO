<?php
class Enregist_pers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('assets_helper');
        $this->load->model('enregist_pers_model');
    }
    public function index()
    {
        $this->load->view('enregist_pers');
    }
    public function enregistrer()
    {

            $mdp = $_POST['mdp'];
            $confirm_mdp = $_POST['confirm_mdp'];

            $no = $_POST['nom'];
            $nom = strtoupper($no);

            $preno = $_POST['prenom'];
            $prenom = ucwords($preno);

            $sexe = $_POST['sexe'];
            $date_naiss = $_POST['date_naiss'];
            $lieu_naiss = $_POST['lieu_naiss'];
            $nom_pere = $_POST['nom_pere'];
            $nom_mere = $_POST['nom_mere'];
            $cin = $_POST['cin'];
            $date_cin = $_POST['date_cin'];
            $lieu_cin = $_POST['lieu_cin'];
            $situation = $_POST['situation'];
            $nb_enfant = $_POST['nb_enfant'];
            $conjoint = $_POST['conjoint'];
            $adresse = $_POST['adresse'];
            $cp = $_POST['cp'];
            $ville = $_POST['ville'];
            $tel_fixe = $_POST['tel_fixe'];
            $tel_portable = $_POST['tel_portable'];
            $email = $_POST['email'];
            $cnaps = $_POST['cnaps'];
            $ostie = $_POST['ostie'];

            $categ = $_POST['categorie'];
            $categorie = strtoupper($categ);

            $pseudo = $_POST['pseudo'];
            $mdp = $_POST['mdp'];

            $fonct = $_POST['fonction'];
            $fonction = strtoupper($fonct);

            $date_embch = $_POST['date_embch'];
            $contra = $_POST['contrat'];
            $contrat = strtoupper($contra);

        $zero = '0';
                $dernier_mat = $this->enregist_pers_model->get_dernier_mat();
                $mat = $dernier_mat + 1;
                $matricule = "{$zero}".$mat;

             $rapport = $this->enregist_pers_model->enregistrer($nom,$prenom,$sexe,$date_naiss,$lieu_naiss,$nom_pere,$nom_mere,
                $cin,$date_cin,$lieu_cin,$situation,$nb_enfant,$conjoint,$adresse,$cp,$ville,$tel_fixe,$tel_portable,$email,$cnaps,$ostie,
                $categorie,$pseudo,$mdp,$fonction,$date_embch,$contrat,$matricule);
                if($rapport)
                {
                    echo ("<script language=\"javascript\"> alert('$prenom est enregistré avec succés, sa matricule est $matricule');</script>") ;
                }



    }
    public function miseajour_pers()
    {
        $data['personnel'] = $this->enregist_pers_model->list_pers();
        $this->load->view('miseajour_pers',$data);
    }
    public function list_pers()
    {
        $data['personnel'] = $this->enregist_pers_model->list_pers();
        $this->load->view('list_pers',$data);
    }
    public function pers_modif()
    {
        $data['personnel'] = $this->enregist_pers_model->list_pers();
        $this->load->view('pers_modif',$data);
    }
    public function recherche_pers()
    {
        $matricule = $_GET['motclef'];
        $data['personnel'] = $this->enregist_pers_model->recherche($matricule);
        $this->load->view('result_recherche_pers',$data);
    }
    public function modifier($id='')
    {
        $data['personnel'] = $this->enregist_pers_model->recherche_id($id);
        $this->load->view('form_modif_pers',$data);
    }
    public function sauver_modif()
    {
        $no = $_POST['nom'];
        $nom = strtoupper($no);
        $preno = $_POST['prenom'];
        $prenom = ucwords($preno);
        $sexe = $_POST['sexe'];
        $date_naiss = $_POST['date_naiss'];
        $lieu_naiss = $_POST['lieu_naiss'];
        $nom_pere = $_POST['nom_pere'];
        $nom_mere = $_POST['nom_mere'];
        $cin = $_POST['cin'];
        $date_cin = $_POST['date_cin'];
        $lieu_cin = $_POST['lieu_cin'];
        $situation = $_POST['situation'];
        $nb_enfant = $_POST['nb_enfant'];
        $conjoint = $_POST['conjoint'];
        $adresse = $_POST['adresse'];
        $cp = $_POST['cp'];
        $ville = $_POST['ville'];
        $tel_fixe = $_POST['tel_fixe'];
        $tel_portable = $_POST['tel_portable'];
        $email = $_POST['email'];
        $cnaps = $_POST['cnaps'];
        $ostie = $_POST['ostie'];

        $categ = $_POST['categorie'];
        $categorie = strtoupper($categ);


        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];

        $fonct = $_POST['fonction'];
        $fonction = strtoupper($fonct);

        $date_embch = $_POST['date_embch'];
        $contra = $_POST['contrat'];
        $contrat = strtoupper($contra);

        $action = $_POST['action'];

        $matricule = $_POST['matricule'];

         $rapport = $this->enregist_pers_model->sauver_modif($nom,$prenom,$sexe,$date_naiss,$lieu_naiss,$nom_pere,$nom_mere,
            $cin,$date_cin,$lieu_cin,$situation,$nb_enfant,$conjoint,$adresse,$cp,$ville,$tel_fixe,$tel_portable,$email,$cnaps,$ostie,
            $categorie,$pseudo,$mdp,$fonction,$date_embch,$contrat,$matricule,$action);
        if($rapport == true)
        {
            $data['alerte'] = "Modification bien enregistré";
        }
        else
        {
            $data['alerte'] = "Aucune modification faite";
        }
        echo json_encode($data);
    }
    public function enregist_reussi()
    {
        $prenom = $_POST['prenom'];
        $data['prenom'] = $prenom;
        $this->load->view('enregist_reussi',$data);

    }
public function a()
{

}

}