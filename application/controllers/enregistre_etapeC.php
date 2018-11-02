<?php
ini_set("memory_limit","360M");
class Enregistre_etapeC extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('assets_helper');
        $this->load->library('session');
        $this->load->model('enregistre_etapeModel');

    }
    function index()
    {
        $this->load->view('enregistre_etapeViews');
    }
    public function affichage_form()
    {
        $this->load->view('form_etape');
    }
    public function suppr_form()
    {
        $this->load->view('form_sup');
    }
    public function enregistrement()
    {
        $etape= $_POST['etape'];
        $taux = $_POST['taux'];
        $objet = $_POST['objet'];
        $command= $_POST['command'];
        var_dump($etape);
        var_dump($taux);
        var_dump($objet);
        var_dump($command);
    }
}