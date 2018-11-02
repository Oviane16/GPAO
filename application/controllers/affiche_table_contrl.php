<?php
Class Affiche_table_contrl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('assets_helper');
        $this->load->model('affiche_table_model');
    }
    public function index()
    {
        $data['commande_encours'] = $this->affiche_table_model->get_commande_encours();
        $this->load->view('affiche_table_view',$data);
    }
    public function list_nom_fic($commande='')
    {
        $data['fichier'] = $this->affiche_table_model->get_fic($commande);
        $this->load->view('list_fic_affichetable',$data);
    }
    public function get_etape($idfichier ='')
    {
        $fichier = $this->affiche_table_model->get_fichier($idfichier);
        foreach($fichier as $fic)
        {
            $commande = $fic->COMMANDE;
        }
        $data['etape'] = $this->affiche_table_model->get_etape($commande);
        $this->load->view('etape_affiche_table',$data);
    }
    public function get_list_result($etape='',$commande='',$idfichier='')
    {
        $fichier = $this->affiche_table_model->get_fichier($idfichier);
        $data['auc_fic'] ='<script> alert("Aucun fichier trouvé");</script></label>';
        foreach($fichier as $fic)
        {
            $nom_fichier = $fic->NOM_FICHIER;
        }
        $et = urldecode($etape);
        if($et == 'SAISIE 1')
        {
            $ext = 'S1';
            $table_miasa = "$commande"."_"."{$ext}";
            $rap = $this->affiche_table_model->verifier_exist_table($table_miasa);
            if($rap == 1)
            {
                $data['fichier'] = $this->affiche_table_model->get_list_result($table_miasa,$commande,$nom_fichier,$et);
                if($data['fichier'] != NULL)
                {
                    $this->load->view('list_res_affichtable',$data);
                }
                else
                {
                    echo  '<script> alert("Aucun resultat");</script>';
                }
            }
            else
            {
                echo  '<script> alert("Aucune table trouvé");</script>';
            }

        }
         else if($et == 'CONTROLE' || $et == 'CONTROLE ECH')
        {
            $ext = 'C';
            $table_miasa = "$commande"."_"."{$ext}";
            $rap = $this->affiche_table_model->verifier_exist_table($table_miasa);
            if($rap == 1)
            {
                $data['fichier'] = $this->affiche_table_model->get_list_result($table_miasa,$commande,$nom_fichier,$et);
                if($data['fichier'] != NULL)
                {
                    $this->load->view('list_res_affichtable',$data);
                }
                else
                {
                    echo  '<script> alert("Aucun resultat");</script>';
                }
            }
            else
            {
                echo  '<script> alert("Aucun table trouvé");</script>';
            }
        }
        else if($et == 'FORMATAGE')
        {
            $ext = 'Q';
            $table_miasa = "$commande"."_"."{$ext}";
            $rap = $this->affiche_table_model->verifier_exist_table($table_miasa);
            if($rap == 1)
            {
                $data['fichier'] = $this->affiche_table_model->get_list_result($table_miasa,$commande,$nom_fichier,$et);
                if($data['fichier'] != NULL)
                {
                    $this->load->view('list_res_affichtable',$data);
                }
                else
                {
                    echo  '<script> alert("Aucun resultat");</script>';
                }
            }
            else
            {
                echo  '<script> alert("Aucune table trouvée");</script>';
            }
        }
        else
        {
            echo  '<script> alert("Aucune table trouvée");</script>';
        }

    }

    public function supprimer()
    {
        $data_sans_commande = ( explode( 'commande=', $this->input->get_post('n_enr') ));
        $data_n_enr = ( explode(',', $data_sans_commande[0]));
        $data_rest = $data_sans_commande[1];
        $data_sans_nlot = (explode('n_lot=', $data_rest));
        $data_commande = (explode (',',$data_sans_nlot[0]));
        $data_dernier = $data_sans_nlot[1];
        $data_sans_etape = (explode('etape=',$data_dernier ));
        $data_nlot = (explode (',',$data_sans_etape[0]));
        $data_etape = (explode(',',$data_sans_etape[1]));
        $a =0;$b=0;$c=0;$d=0;
        if($data_n_enr)
        {
        foreach($data_n_enr as $n_enr)
        {
            foreach($data_commande as $commande)
            {
                foreach($data_nlot as $nlot)
                {
                    $i=0;
                    foreach($data_etape as $etape)
                    {
                        if($etape == 'SAISIE 1')
                        {
                            $ext = 'S1';
                            $table_miasa = "$commande"."_"."{$ext}";
                           $rapport = $this->affiche_table_model->supprimmer($n_enr,$commande,$nlot,$etape,$table_miasa);
                            if($rapport == true)
                            {
                                $i++;
                            }
                        }
                        if($etape == 'CONTROLE' || $etape == 'CONTROLE ECH' || $etape=='CONTROLE QUALITE')
                        {
                            $ext = 'C';
                            $table_miasa = "$commande"."_"."{$ext}";
                            $rapport = $this->affiche_table_model->supprimmer($n_enr,$commande,$nlot,$etape,$table_miasa);
                            if($rapport == true)
                            {
                                $i++;
                            }
                        }
                        if($etape == 'FORMATAGE')
                        {
                            $ext = 'Q';
                            $table_miasa = "$commande"."_"."{$ext}";
                            $rapport =  $this->affiche_table_model->supprimmer($n_enr,$commande,$nlot,$etape,$table_miasa);
                            if($rapport == true)
                            {
                                $i++;
                            }
                        }
                       $d++;
                    }
                    $c++;
                }
                $b++;
            }
            $a++;
        }


        }

        if($i ==0)
       {
           $data["alerte"] = "Auccun ligne supprimée";
       }
        else
        {
            $data["alerte"] = "$i ligne(s) supprimée(s)";
        }
        echo json_encode($data);


    }
}
?>