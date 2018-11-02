<?php
class Table extends CI_Controller
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
        $this->load->view('table');
    }
}
?>