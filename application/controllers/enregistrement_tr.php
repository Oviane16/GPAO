<?php
class Enregistrement_tr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('assets_helper');
        $this->load->library('session');
       // $this->load->model('enregistrement_model');
// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
    }
    /////////////////
    function index()
    {
        $this->load->view('enregistrement_views');
    }
}
    ?>
