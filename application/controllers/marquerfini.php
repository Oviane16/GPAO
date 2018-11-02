<?php

public function marquerfini_multiple($etape='')
{
    $ids = ( explode( ',', $this->input->get_post('ids') ));
    $et =urldecode($etape);
    $i= 0; $k=0;
    $matricule_modif = $this->session->userdata('matricule');
    if($et == 'SAISIE 1' || $et == 'OCR' || $et == 'TRANSFORMATION')
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $etat_saisie = $fic->ETAT_SAISIE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $matricule = $fic->MATRICULE_SAISIE;
                $etat_controle = $fic->ETAT_CONTROLE;
            }
            if($etat_saisie != '2')
            {
                if($etat_controle == '0')
                {
                    $data = array( 'ETAT_SAISIE' => '2');
                    $this->adminEnPouce_model->marquerfini_multiple( $id, $data,$commande,$nom_fichier,$matricule ,$et);
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                    $i++;
                }
                else
                {
                    $data['rapp_et_cntrl_nonfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier etat controle(fini)');</script>";
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                    $k++;
                }

            }
            else
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('$nom_fichier Fichier déja fini');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
                $k++;
            }

        }

    }
    if($et == 'IMAGE')
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $etat_saisie = $fic->ETAT_SAISIE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $matricule = $fic->MATRICULE_SAISIE;
            }
            if($etat_saisie != '2')
            {
                $data = array( 'ETAT_SAISIE' => '2');
                $this->adminEnPouce_model->marquerfini_multiple( $id, $data,$commande,$nom_fichier,$matricule ,$et);
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
                $i++;
            }
            else
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('$nom_fichier Fichier déja fini');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
                $k++;
            }
        }
    }
    if($et == 'RECHERCHE' )
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $etat_lecture = $fic->ETAT_LECTURE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $matricule = $fic->MATRICULE_LECTURE;
                if($etat_lecture != '2')
                {
                    if($etat_controle =='0' && $etat_saisie == '2')
                    {
                        $data = array( 'ETAT_LECTURE' => '2' );
                        $this->adminEnPouce_model->marquerfini_multiple(  $id, $data,$commande,$nom_fichier,$matricule ,$et );
                        $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                        $data['et'] = $et;
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                    else
                    {
                        $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier verifier son etat: controle(non traité),saisie(fini)');</script>";
                        $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                        $data['et'] = $et;
                        $this->load->view('list_fic',$data);
                    }
                }
                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('$nom_fichier Fichier déja fini');</script>";
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                    $k++;
                }
            }
        }
    }
    if($et == 'LECTURE')
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $etat_lecture = $fic->ETAT_LECTURE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $matricule = $fic->MATRICULE_LECTURE;
                if($etat_lecture != '2')
                {
                    if($etat_lecture == '1')
                    {
                        $data = array( 'ETAT_LECTURE' => '2' );
                        $this->adminEnPouce_model->marquerfini_multiple(  $id, $data,$commande,$nom_fichier,$matricule ,$et );
                        $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                        $data['et'] = $et;
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                    else
                    {
                        $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier son etat lecture(en cours) ');</script>";
                        $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                        $data['et'] = $et;
                        $this->load->view('list_fic',$data);
                    }

                }
                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('$nom_fichier Fichier déja fini');</script>";
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                    $k++;
                }
            }
        }
    }
    ///////////////////////
    if($et == 'CONTROLE WEB')
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $etat_controle = $fic->ETAT_CONTROLE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $matricule = $fic->MATRICULE_CONTROLE;
                if($etat_controle != 2)
                {
                    if($etat_saisie == '2' && $etat_lecture == '2' && $etat_livaraison ='0')
                    {
                        $data = array( 'ETAT_CONTROLE' => '2' ,'MATRICULE_CONTROLE' =>$matricule_modif );
                        $this->adminEnPouce_model->marquerfini_multiple( $id, $data,$commande,$nom_fichier,$matricule ,$et );
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                    else
                    {
                        $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier verifier son etat: saisie(fini),lecture(fini),livraison(non traité)');</script>";
                        $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                        $data['et'] = $et;
                        $this->load->view('list_fic',$data);
                    }

                }
                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('$nom_fichier Fichier déja fini');</script>";
                    $data['et'] = $et;
                    $fichier_echec_array[] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                    $k++;
                }
            }
        }
    }
    if($et == 'CONTROLE' || $et == 'CONTROLE ECH')
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $etat_controle = $fic->ETAT_CONTROLE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $matricule = $fic->MATRICULE_CONTROLE;
                $etat_saisie = $fic->ETAT_SAISIE;
                $etat_formatage = $fic->ETAT_FORMATAGE;
                $etat_livaraison = $fic->ETAT_LIVRAISON;
                if($etat_controle != 2)
                {
                    if($etat_saisie == '2' && $etat_controle == '1' && $etat_lecture == '0' && $etat_formatage == '0' && $etat_livaraison == '0' )
                    {
                        $data = array( 'ETAT_CONTROLE' => '2' );
                        $this->adminEnPouce_model->marquerfini_multiple( $id, $data,$commande,$nom_fichier,$matricule ,$et );
                        $data['et'] = $et;
                        $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                        $this->load->view('list_fic',$data);
                        $i++;
                    }
                    else
                    {
                        $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier verifier son etat: saisie(fini),controle(en cours),lecture(non traité),formatage(non traité),livraison(non traité)');</script>";
                        $data['et'] = $et;
                        $fichier_echec_array[] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                        $i++;
                    }
                }
                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('$nom_fichier Fichier déja fini');</script>";
                    $data['et'] = $et;
                    $fichier_echec_array[] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                    $k++;
                }
            }
        }
    }
    if($et == 'LIVRAISON'  )
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $etat_livaraison = $fic->ETAT_LIVRAISON;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $matricule = $fic->MATRICULE_LIVRAISON;
                if( $etat_livaraison != '2' )
                {
                    $data = array( 'ETAT_LIVRAISON' => '2','MATRICULE_LIVRAISON' => $matricule_modif );
                    $this->adminEnPouce_model->marquerfini_multiple( $id, $data,$commande,$nom_fichier,$matricule ,$et );
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLi( $id );
                    $this->load->view('list_fic',$data);
                    $i++;
                }
            }
        }
    }
    if( $et == 'FORMATAGE')
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $etat_livaraison = $fic->ETAT_LIVRAISON;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $matricule = $fic->MATRICULE_LIVRAISON;
                $etat_saisie = $fic->ETAT_SAISIE;
                $etat_controle = $fic->ETAT_CONTROLE;
                $etat_lecture = $fic->ETAT_LECTURE;
                if( ($etat_saisie == '2' && $etat_controle == '2' && $etat_livaraison == '0')&& $etat_lecture == '0' || $etat_lecture == '2')
                {
                    $data = array( 'ETAT_LIVRAISON' => '2' ,'MATRICULE_FORMATAGE' =>$matricule_modif);
                    $this->adminEnPouce_model->marquerfini_multiple( $id, $data,$commande,$nom_fichier,$matricule ,$et );
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLi( $id );
                    $this->load->view('list_fic',$data);
                    $i++;
                }
                else
                {
                    $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier verifier son etat: saisie(fini),controle(2),livraison(non traité),lecture(non traité ou fini)');</script>";
                    $data['et'] = $et;
                    $fichier_echec_array[] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                    $i++;
                }
            }
        }
    }


}
?>