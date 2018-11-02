<?php
class Routeur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('assets_helper');
        $this->load->library('session');
        $this->view_data = array();
    }
    function a()
    {
        $this->load->helper('download');
        $data = file_get_contents("\\192.168.10.122\\consignes\\Ass.xls");
        $name = "a.xls";
        force_download($name, $data);
    }
    function suppression_lot()
    {
        $this->load->view('suppression_lot');
    }
    function pointage()
    {
        $this->load->view('pointage');
    }
    function suppressionlot ()
    {
        $this->load->view('suppressionlot');
    }
    function enregist_travail()
    {
        $this->load->view('enregist_travail');
    }
    function enregistrement()
    {
        $this->load->view('enregistrement');
    }
    function choix()
    {
        $this->load->view('choix');
    }
    function authentification()
    {
        $this->load->view('authentification');
    }
    function importfichier()
    {
        $this->load->view('importfichier');
    }

}
?>