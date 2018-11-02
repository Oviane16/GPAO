<?php
class Accueil extends CI_Controller
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
        if($this->session->userdata('matricule'))
        {
            $this->load->model('authent_model');
            $id_pers = $this->session->userdata('id');
            $personnel = $this->authent_model->get_pressonnel($id_pers);
            foreach($personnel as $pers)
            {
               $fonction = $pers->FONCTION;
               $pseudo = $pers->PSEUDO;
               $matricule = $pers->MATRICULE;
               $id_pers = $pers->idpersonnel;
            }
            $this->session->set_userdata('fonction',$fonction);
            $this->session->set_userdata('matricule',$matricule);
            $this->session->set_userdata('id',$id_pers);
            $this->session->set_userdata('login',TRUE);
            $data['commande'] = $this->adminEnPouce_model->get_commande();
            $data['pseudo'] = $pseudo;
            $this->load->view('accueil',$data);
        }
        else redirect(array('controller'=>'authent'));

    }
    public function accueil2()
    {
        $this->load->view("accueil2");

    }
}
?>