<?php
Class Deconnexion_contrl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('assets_helper');
    }
    public function deconnexion()
    {
        $matricle= $this->session->userdata('matricule');
        $id_pers= $this->session->userdata('id');
        $array = array('matricule' =>$matricle , 'id' => $id_pers);
        $this->session->unset_userdata($array);
        redirect(array('controller'=>'authent','action'=>'index'));

    }
}
?>