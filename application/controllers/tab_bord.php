<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tab_bord extends CI_Controller {
    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('assets_helper');

        $this->view_data = array();
        $this->load->model('adminenpouce_model');
    }
    function index()
    {
        $this->view_data['commande'] = $this->adminenpouce_model->get_commande();
        $this->load->view('tab_bord',$this->view_data);
    }
    function get_data($commande='')
    {

        $this->load->model('tab_bord_model','tab_bord');
        $etape = $this->tab_bord->get_etape($commande);
        $nb_etape =0;
        $tab_etape = array();$tab_fic_nontraiteS = array();$tab_fic_encoursS = array();$tab_fic_finiS= array();$tab_fic_encoursC = array();
        $tab_fic_finiC = array();$tab_fic_nontraiteC = array();$tab_fic_nontraiteLec = array();$tab_fic_encoursLec = array();$tab_fic_finiLec = array();$tab_fic_nontraiteLi = array();
        $tab_fic_encoursLi = array(); $tab_fic_finiLi = array(); $tab_fic_nontraiteF = array(); $tab_fic_encoursF= array(); $tab_fic_finiF = array();
        $tab_fic_total = array();
        foreach($etape as $et)
        {
            $etap = $et->ETAPE;
            $tab_etape[]['etape'] = $etap;
            $nb_fic_nontraiteS = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_SAISIE'=>'0'));
            $tab_fic_nontraiteS[]['nb_fic_nontraiteS'] = $nb_fic_nontraiteS;

            $nb_fic_encoursS = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_SAISIE'=>'1'));
            $tab_fic_encoursS[]['nb_fic_encoursS'] = $nb_fic_encoursS;

            $nb_fic_finiS = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_SAISIE'=>'2'));
            $tab_fic_finiS[]['nb_fic_finiS'] = $nb_fic_finiS;

            $nb_fic_nontraiteC = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_CONTROLE'=>'0'));
            $tab_fic_nontraiteC[]['nb_fic_nontraiteC'] = $nb_fic_nontraiteC;

            $nb_fic_encoursC = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_CONTROLE'=>'1'));
            $tab_fic_encoursC[]['nb_fic_encoursC'] = $nb_fic_encoursC;

            $nb_fic_finiC = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_CONTROLE'=>'2'));
            $tab_fic_finiC[]['nb_fic_finiC'] = $nb_fic_finiC;

            $nb_fic_nontraiteLec = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_LECTURE'=>'0'));
            $tab_fic_nontraiteLec[]['nb_fic_nontraiteLec'] = $nb_fic_nontraiteLec;

            $nb_fic_encoursLec = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_LECTURE'=>'1'));
            $tab_fic_encoursLec[]['nb_fic_encoursLec'] = $nb_fic_encoursLec;

            $nb_fic_finiLec = $this->tab_bord->count(array('COMMANDE'=>$commande,'ETAT_LECTURE'=>'2'));
            $tab_fic_finiLec[]['nb_fic_finiLec'] = $nb_fic_finiLec;

            $nb_fic_nontraiteLi = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_LIVRAISON'=>'0'));
            $tab_fic_nontraiteLi[]['nb_fic_nontraiteLi'] = $nb_fic_nontraiteLi;

            $nb_fic_encoursLi = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_LIVRAISON'=>'1'));
            $tab_fic_encoursLi[]['nb_fic_encoursLi'] = $nb_fic_encoursLi;

            $nb_fic_finiLi = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_LIVRAISON'=>'2'));
            $tab_fic_finiLi[]['nb_fic_finiLi'] = $nb_fic_finiLi;

            $nb_fic_nontraiteF = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_FORMATAGE'=>'0'));
            $tab_fic_nontraiteF[]['nb_fic_nontraiteF'] = $nb_fic_nontraiteF;

            $nb_fic_encoursF = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_FORMATAGE'=>'1'));
            $tab_fic_encoursF[]['nb_fic_encoursF'] = $nb_fic_encoursF;

            $nb_fic_finiF = $this->tab_bord->count(array('COMMANDE' =>$commande,'ETAT_FORMATAGE'=>'2'));
            $tab_fic_finiF[]['nb_fic_finiF'] = $nb_fic_finiF;

            $nb_fic_total= $this->tab_bord->count(array('COMMANDE' =>$commande));
            $tab_fic_total[]['nb_fic_total'] = $nb_fic_total;
            $data['fichier'] = $this->tab_bord->get_fichier($commande);

            $Total_fic_S = $nb_fic_nontraiteS + $nb_fic_encoursS + $nb_fic_finiS;
            $Total_fic_C = $nb_fic_nontraiteC + $nb_fic_encoursC + $nb_fic_finiC;
            $Total_fic_Lec = $nb_fic_nontraiteLec + $nb_fic_encoursLec + $nb_fic_finiLec;
            $Total_fic_Li = $nb_fic_nontraiteLi + $nb_fic_encoursLi + $nb_fic_finiLi;
            $Total_fic_F = $nb_fic_nontraiteF + $nb_fic_encoursF + $nb_fic_finiF;

            $P_fic_finiS = ($nb_fic_finiS/$Total_fic_S)*100;
            $P_fic_encoursS = ($nb_fic_encoursS/$Total_fic_S)*100;
            $P_fic_nontraiteS = ($nb_fic_nontraiteS/$Total_fic_S)*100;

            $P_fic_finiC = ($nb_fic_finiC/$Total_fic_C)*100;
            $P_fic_encoursC = ($nb_fic_encoursC/$Total_fic_C)*100;
            $P_fic_nontraiteC = ($nb_fic_nontraiteC/$Total_fic_C)*100;

            $P_fic_finiLec = ($nb_fic_finiLec/$Total_fic_Lec)*100;
            $P_fic_encoursLec = ($nb_fic_encoursLec/$Total_fic_Lec)*100;
            $P_fic_nontraiteLec = ($nb_fic_nontraiteLec/$Total_fic_Lec)*100;


            $P_fic_finiLi = ($nb_fic_finiLi/$Total_fic_Li)*100;
            $P_fic_encoursLi = ($nb_fic_encoursLi/$Total_fic_Li)*100;
            $P_fic_nontraiteLi = ($nb_fic_nontraiteLi/$Total_fic_Li)*100;


            $nb_etape++;
        }

        $data['tab_etape'] = $tab_etape; $data['tab_fic_nontraiteS']= $tab_fic_nontraiteS; $data['tab_fic_encoursS'] =$tab_fic_encoursS;
        $data['tab_fic_finiS'] = $tab_fic_finiS;$data['tab_fic_nontraiteC']=$tab_fic_nontraiteC; $data['tab_fic_encoursC']=$tab_fic_encoursC; $data['tab_fic_finiC'] =$tab_fic_finiC;
        $data['tab_fic_nontraiteLec'] = $tab_fic_nontraiteLec;$data['tab_fic_encoursLec']=$tab_fic_encoursLec;$data['tab_fic_finiLec'] =$tab_fic_finiLec;
        $data['tab_fic_nontraiteLi'] =$tab_fic_nontraiteLi;$data['tab_fic_encoursLi'] =$tab_fic_encoursLi;$data['tab_fic_finiLi']=$tab_fic_finiLi;
        $data['tab_fic_nontraiteF']=$tab_fic_nontraiteF;$data['tab_fic_encoursF']=$tab_fic_encoursF;$data['tab_fic_finiF']=$tab_fic_finiF;
        $data['tab_fic_total'] =$tab_fic_total; $data['nb_etape'] = $nb_etape;

        $this->load->view('tab_graphe',$data);
    }
    function get_personnel($mat='',$mdp='')
    {
         $this->load->model('tab_bord_model');
         $data['fonction'] = $this->tab_bord_model->get_personnel($mat,$mdp);
    }
}
