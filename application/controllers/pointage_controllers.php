<?php
class  Pointage_controllers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('assets_helper');
        $this->load->library('session');
        //$this->load->model('pointage_model');//made miload any @ models sansfic_model izay mitovy @ include ny asany
        $this->view_data = array();
    }
    function index()
    {
        $this->load->view('pointage_views');//made miload any @ models sansficview izay mapiseho ny interface
    }
}
?>