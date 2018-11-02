<?php
Class tab_bord_recap extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('assets_helper');
        $this->load->model('tab_bord_recap_model');
        $this->view_data = array();

    }

    public function index()
    {
        $commande_encours = $this->tab_bord_recap_model->getcommande_encours();
        $data_fic_s = array();
        $data_fic_c = array();
        $data_fic_lec = array();
        $data_fic_fo = array();
        $data_fic_li = array();
        $data_commande = array();
        $data_nb_fic = array();

        $data_nb_notraite_s = array();
        $data_nb_encours_s = array();
        $data_nb_fini_s = array();

        $data_nb_rejete_s = array();

        $data_nb_notraite_c = array();
        $data_nb_encours_c = array();
        $data_nb_fini_c = array();

        $data_nb_notraite_fo = array();
        $data_nb_encours_fo = array();
        $data_nb_fini_fo = array();

        $data_nb_notraite_lec = array();
        $data_nb_encours_lec = array();
        $data_nb_fini_lec = array();

        $data_nb_notraite_li = array();
        $data_nb_encours_li = array();
        $data_nb_fini_li = array();
        $data_nb_os = array();
        $data_nb_ctl = array();
        $data_nb_pers = array();

        $data_dossier = array();
        $data_etape = array();

        $j=0;
        if($commande_encours)
        {
            foreach($commande_encours as $com)
            {
                $commande = $com->COMMANDE;

                $nb_s_nontraite = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_SAISIE'=>'0','POSITION_FINALE'=>'0'));
                $nb_s_encours = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_SAISIE'=>'1','POSITION_FINALE'=>'0'));
                $nb_s_fini = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_SAISIE'=>'2','POSITION_FINALE'=>'0'));
                $nb_s_rejete = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_SAISIE'=>'3','POSITION_FINALE'=>'0'));
                $total_saisie = $nb_s_nontraite + $nb_s_encours + $nb_s_fini + $nb_s_rejete;

                $nb_c_nontraite = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_CONTROLE'=>'0','POSITION_FINALE'=>'0'));
                $nb_c_encours = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_CONTROLE'=>'1','POSITION_FINALE'=>'0'));
                $nb_c_fini = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_CONTROLE'=>'2','POSITION_FINALE'=>'0'));
                $total_controle = $nb_c_nontraite + $nb_c_encours + $nb_c_fini ;


                $nb_lec_nontraite = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_LECTURE'=>'0','POSITION_FINALE'=>'0'));
                $nb_lec_encours = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_LECTURE'=>'1','POSITION_FINALE'=>'0'));
                $nb_lec_fini = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_LECTURE'=>'2','POSITION_FINALE'=>'0'));
                $total_lecture = $nb_lec_nontraite + $nb_lec_encours + $nb_lec_fini;


                $nb_fo_nontraite = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_LECTURE'=>'0','POSITION_FINALE'=>'0'));
                $nb_fo_encours = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_LECTURE'=>'1','POSITION_FINALE'=>'0'));
                $nb_fo_fini = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_LECTURE'=>'2','POSITION_FINALE'=>'0'));
                $total_formatage = $nb_fo_nontraite + $nb_fo_encours + $nb_fo_fini ;


                $nb_li_nontraite = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_LIVRAISON'=>'0','POSITION_FINALE'=>'0'));
                $nb_li_encours = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_LIVRAISON'=>'1','POSITION_FINALE'=>'0'));
                $nb_li_fini = $this->tab_bord_recap_model->count(array('COMMANDE' =>$commande,'ETAT_LIVRAISON'=>'2','POSITION_FINALE'=>'0'));
                $total_livraison = $nb_li_nontraite + $nb_li_encours + $nb_li_fini ;


                $total_fichier = $total_saisie+ $total_controle +$total_lecture + $total_formatage + $total_livraison;
                $P_saisie_fini = ($nb_s_fini/$total_saisie)*100;
                $P_controle_fini = ($nb_c_fini/$total_controle)*100;
                $P_lecture_fini = ($nb_lec_fini/$total_lecture)*100;
                $P_formatage_fini =($nb_fo_fini/$total_formatage)*100;
                $P_livraison_fini = ($nb_li_fini/$total_livraison)*100;


                $data_fic_s[]['saisie_fini'] = $P_saisie_fini;
                $data_fic_c[]['controle_fini'] = $P_controle_fini;
                $data_fic_lec[]['lecture_fini'] = $P_lecture_fini;
                $data_fic_fo[]['formatage_fini'] = $P_formatage_fini;
                $data_fic_li[]['livraison_fini'] = $P_livraison_fini;
                $data_nb_fic[]['nb_fichier'] = $total_fichier;
                $data_commande[]['commande'] = $commande;


                $data_nb_notraite_s[]['nb_notraite_s'] =$nb_s_nontraite;
                $data_nb_encours_s[]['nb_encours_s'] =$nb_s_encours;
                $data_nb_fini_s[]['nb_fini_s'] =$nb_s_fini;
                $data_nb_rejete_s[]['nb_rejete_s'] = $nb_s_rejete;

                $data_nb_notraite_c[]['nb_notraite_c'] =$nb_c_nontraite;
                $data_nb_encours_c[]['nb_encours_c'] =$nb_c_encours;
                $data_nb_fini_c[]['nb_fini_c'] =$nb_c_fini;

                $data_nb_notraite_lec[]['nb_notraite_lec'] =$nb_lec_nontraite;
                $data_nb_encours_lec[]['nb_encours_lec'] =$nb_lec_encours;
                $data_nb_fini_lec[]['nb_fini_lec'] =$nb_lec_fini;

                $data_nb_notraite_fo[]['nb_notraite_fo'] =$nb_fo_nontraite;
                $data_nb_encours_fo[]['nb_encours_fo'] =$nb_fo_encours;
                $data_nb_fini_fo[]['nb_fini_fo'] =$nb_fo_fini;

                $data_nb_notraite_li[]['nb_notraite_li'] =$nb_li_nontraite;
                $data_nb_encours_li[]['nb_encours_li'] =$nb_li_encours;
                $data_nb_fini_li[]['nb_fini_li'] =$nb_li_fini;

                $dossier = $com->DOSSIER;
                $data_dossier[]['dossier'] = $dossier;

                $os = 0;
                $pers = 0;
                $ctl =0;
                $fic_s = $this->tab_bord_recap_model->get_fic_saisie_encours($commande);
                $fich_c = $this->tab_bord_recap_model->get_fic_controle_encours($commande);
                $fich_fo = $this->tab_bord_recap_model->get_fic_formatage_encours($commande);
                $fich_lec = $this->tab_bord_recap_model->get_fic_lecture_encours($commande);
                $fich_li = $this->tab_bord_recap_model->get_fic_livraison_encours($commande);
                if($fic_s)
                {
                    foreach($fic_s as $fi)
                    {
                        $mat_sasie = $fi->MATRICULE_SAISIE;

                        $fonct_s = $this->tab_bord_recap_model->get_fonction2($mat_sasie);

                        if($fonct_s == 'OS')
                        {
                            $os++;
                        }
                        if($fonct_s == 'PERS')
                        {
                            $pers++;
                        }
                        if($fonct_s == 'CTL')
                        {
                            $ctl++;
                        }
                    }
                }
                if($fich_c)
                {
                    foreach($fich_c as $fi)
                    {


                        $mat_controle = $fi->MATRICULE_CONTROLE;

                        $fonct_c = $this->tab_bord_recap_model->get_fonction2($mat_controle);

                        if( $fonct_c== 'OS' )
                        {
                            $os++;
                        }
                        if( $fonct_c== 'PERS' )
                        {
                            $pers++;
                        }
                        if( $fonct_c== 'CTL' )
                        {
                            $ctl++;
                        }
                    }
                }
                if($fich_fo)
                {
                    foreach($fich_fo as $fi)
                    {


                        $mat_formatage = $fi->MATRICULE_FORMATAGE;

                        $fonct_fo = $this->tab_bord_recap_model->get_fonction2($mat_formatage);

                        if( $fonct_fo== 'OS' )
                        {
                            $os++;
                        }
                        if( $fonct_fo== 'PERS' )
                        {
                            $pers++;
                        }
                        if( $fonct_fo== 'CTL' )
                        {
                            $ctl++;
                        }
                    }
                }
                if($fich_lec)
                {
                    foreach($fich_lec as $fi)
                    {


                        $mat_lecture = $fi->MATRICULE_LECTURE;

                        $fonct_lec = $this->tab_bord_recap_model->get_fonction2($mat_lecture);

                        if( $fonct_lec== 'OS' )
                        {
                            $os++;
                        }
                        if( $fonct_lec== 'PERS' )
                        {
                            $pers++;
                        }
                        if( $fonct_lec== 'CTL' )
                        {
                            $ctl++;
                        }
                    }
                }
                if($fich_li)
                {
                    foreach($fich_li as $fi)
                    {


                        $mat_livraison = $fi->MATRICULE_LIVRAISON;

                        $fonct_li = $this->tab_bord_recap_model->get_fonction2($mat_livraison);

                        if( $fonct_li== 'OS' )
                        {
                            $os++;
                        }
                        if( $fonct_li== 'PERS' )
                        {
                            $pers++;
                        }
                        if( $fonct_li== 'CTL' )
                        {
                            $ctl++;
                        }
                    }
                }
                $data_nb_os[]['os'] = $os;
                $data_nb_ctl[]['ctl'] = $ctl;
                $data_nb_pers[]['pers'] = $pers;
                $data_etape[]['data_etape'] = $this->tab_bord_recap_model->get_etape($commande);

                $j++;

            }
        }

        $data['data_fic_s'] =$data_fic_s;
        $data['data_fic_c'] =$data_fic_c;
        $data['data_fic_lec'] =$data_fic_lec;
        $data['data_fic_fo'] =$data_fic_fo;
        $data['data_fic_li'] =$data_fic_li;
        $data['data_commande'] = $data_commande;
        $data['data_nb_fic'] = $data_nb_fic;

        $data['data_nb_notraite_s'] = $data_nb_notraite_s;
        $data['data_nb_encours_s'] = $data_nb_encours_s;
        $data['data_nb_fini_s'] = $data_nb_fini_s;
        $data['data_nb_rejete_s'] =$data_nb_rejete_s ;

        $data['data_nb_notraite_c'] = $data_nb_notraite_c;
        $data['data_nb_encours_c'] = $data_nb_encours_c;
        $data['data_nb_fini_c'] = $data_nb_fini_c;

        $data['data_nb_notraite_lec'] = $data_nb_notraite_lec;
        $data['data_nb_encours_lec'] = $data_nb_encours_lec;
        $data['data_nb_fini_lec'] = $data_nb_fini_lec;

        $data['data_nb_notraite_fo'] = $data_nb_notraite_fo;
        $data['data_nb_encours_fo'] = $data_nb_encours_fo;
        $data['data_nb_fini_fo'] =$data_nb_fini_fo ;
        
        $data['data_nb_notraite_li'] =$data_nb_notraite_li ;
        $data['data_nb_encours_li'] =$data_nb_encours_li ;
        $data['data_nb_fini_li'] =$data_nb_fini_li ;
        $data['data_dossier'] = $data_dossier;
        $data['j'] = $j;

        $mat_actif = $this->tab_bord_recap_model->get_mat_actif();
        $nb_pers=0;
        $nb_ctl=0;
        $nb_os=0;
        if(isset($mat_actif))
        {
            foreach($mat_actif as $mat)
            {
                $matricule = $mat->MATRICULE;
                $fonct = $this->tab_bord_recap_model->get_fonction($matricule);
                if(isset($fonct))
                {
                    foreach($fonct as $fon )
                    {
                        $fonction = $fon->FONCTION;
                    }
                    if($fonction == 'PERS')
                    {
                        $nb_pers++;
                    }
                    else if($fonction == 'OS')
                    {
                        $nb_os++;
                    }
                    else if($fonction == 'CTRL')
                    {
                        $nb_ctl++;
                    }
                }

            }

        }
        $data['pers_actif'] = $nb_pers;
        $data['os_actif'] = $nb_os;
        $data['ctl_actif'] = $nb_ctl;
        $data['total_actif'] = $nb_pers+$nb_os+$nb_ctl;

        $data['nb_os'] = $data_nb_os;
        $data['nb_ctl'] = $data_nb_ctl;
        $data['nb_pers'] = $data_nb_pers;

        $data['data_etape'] = $data_etape;
        $this->load->view('tab_bord_recap_view',$data);

    }

}
?>