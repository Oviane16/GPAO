<?php
class Authent extends CI_Controller
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
        $this->load->view('authent');
    }
    public function authentification()
    {
        $this->load->library('session');
        $matricule = $_POST['matricule'];
        $mdp = $_POST['mdp'];
        $this->load->model('authent_model');
        $id_pers = $this->authent_model->get_id($matricule,$mdp);
        $fonction = $this->authent_model->get_fonction($matricule,$mdp);

        if(isset($fonction) )
        {
            $personnel = $this->authent_model->get_pressonnel($id_pers);
            foreach($personnel as $pers)
            {
                $fonction = $pers->FONCTION;
                $id_pers = $pers->idpersonnel;
            }
            $this->session->set_userdata('fonction',$fonction);
            $this->session->set_userdata('matricule',$matricule);
            $this->session->set_userdata('id',$id_pers);
            $this->session->set_userdata('login',TRUE);
            redirect(array('controller'=>'accueil','action'=>'index'));
        }
        else
        {
            $this->erreurLog();
        }
    }
    public function erreurLog()
    {
        $data = array();
        $data["erreurLog"] =  '<label style="color:red" > Login ou mot de passe incorrecte </label>';
        $this->load->view("authent",$data);
    }
    public function a ()
    {
        redirect(array('controller'=>'accueil','action'=>'index','prenom'=>$prenom));
    }

}