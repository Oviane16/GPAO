<?php
public function attribuer_fichier($etape='',$nouveau_mat='')
{
    $ids = ( explode( ',', $this->input->get_post('ids') ));
    $et = urldecode($etape);
    if($et == 'SAISIE 1' || $et == 'OCR')
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $matricule = $fic->MATRICULE_SAISIE;
                $etat_controle = $fic->ETAT_COTROLE;
                $nom_fichier = $fic->NOM_FICHIER;
                $commande = $fic->COMMANDE;
            }
            $fonction = $this->adminEnPouce_model->get_fonction($matricule);
            if($fonction == 'OS' && $etat_controle == '0' )
            {
                $data = array( 'MATRICULE_SAISIE' => $nouveau_mat, 'ETAT_SAISIE' =>'1'  );
                $this->adminEnPouce_model->attribuer_multiple($id,$data,$commande,$nom_fichier,$matricule,$et );
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }
            else if($fonction != 'OS')
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,la fonction du matricule traiteur doit etre OS ');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
            }
            else
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,Veuillez reinitialiser son étape contrôle ');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
            }

        }
    }
    if( $et == 'TRANSFORMATION')
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $matricule = $fic->MATRICULE_SAISIE;
                $etat_saisie = $fic->ETAT_SAISIE;
                $etat_controle = $fic->ETAT_COTROLE;
                $nom_fichier = $fic->NOM_FICHIER;
                $commande = $fic->COMMANDE;
            }
            $fonction = $this->adminEnPouce_model->get_fonction($matricule);
            if($fonction == 'PERS' && $etat_controle == '0' && $etat_saisie == '0' )
            {
                $data = array( 'MATRICULE_SAISIE' => $nouveau_mat, 'ETAT_SAISIE' =>'1'  );
                $this->adminEnPouce_model->attribuer_multiple($id,$data,$commande,$nom_fichier,$matricule,$et);
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }
            else if($fonction != 'PERS')
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,la fonction du matricule traiteur doit etre PERS ');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
            }
            else
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier ses etats: controle(non traité), saisie(non traité) ');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
            }

        }
    }
    if($et == 'RECHERCHE')
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $matricule = $fic->MATRICULE_SAISIE;
                $etat_controle = $fic->ETAT_COTROLE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_saisie = $fic->ETAT_SAISIE;
                $commande = $fic->COMMANDE;
            }
            $fonction = $this->adminEnPouce_model->get_fonction($matricule);
            if($fonction == 'PERS' && $etat_controle == '0' && $etat_saisie == '2' )
            {
                $data = array( 'MATRICULE_LECTURE' => $nouveau_mat,'ETAT_LECTURE' =>'1' );
                $this->adminEnPouce_model->attribuer_multiple( $id,$data,$commande,$nom_fichier,$matricule,$et );
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                $this->load->view('list_fic',$data);
            }
            else if($fonction != 'PERS')
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,la fonction du matricule traiteur doit etre PERS ');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
            }
            else
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier ses etats: controle(non traité), saisie(fini)');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
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
                $matricule = $fic->MATRICULE_SAISIE;
                $etat_controle = $fic->ETAT_COTROLE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_saisie = $fic->ETAT_SAISIE;
                $commande = $fic->COMMANDE;
            }
            $fonction = $this->adminEnPouce_model->get_fonction($matricule);
            if($fonction == 'PERS' && $etat_controle == '2')
            {
                $data = array( 'MATRICULE_LECTURE' => $nouveau_mat,'ETAT_LECTURE' =>'1' );
                $this->adminEnPouce_model->attribuer_multiple( $id,$data,$commande,$nom_fichier,$matricule,$et);
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                $this->load->view('list_fic',$data);
            }
            else if($fonction != 'PERS')
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,la fonction du matricule traiteur doit etre PERS ');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
            }
            else
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier ses etats: saisie(fini)');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
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
                $matricule = $fic->MATRICULE_SAISIE;
                $etat_controle = $fic->ETAT_COTROLE;
                $nom_fichier = $fic->NOM_FICHIER;
                $commande = $fic->COMMANDE;
            }
            $fonction = $this->adminEnPouce_model->get_fonction($matricule);
            if($fonction == 'PERS')
            {
                $data = array( 'MATRICULE_SAISIE' => $nouveau_mat ,'ETAT_SAISIE'=>'1' );
                $this->adminEnPouce_model->attribuer_multiple( $id,$data,$commande,$nom_fichier,$matricule,$et );
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }
            else if($fonction != 'PERS')
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,la fonction du matricule traiteur doit etre OS ');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
            }

        }
    }
    if( $et == 'CONTROLE WEB' )
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $matricule = $fic->MATRICULE_SAISIE;
                $etat_controle = $fic->ETAT_COTROLE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_saisie = $fic->ETAT_SAISIE;
                $etat_lecture = $fic->ETAT_LECTURE;
                $etat_formatage = $fic->ETAT_FORMATAGE;
                $etat_livraison = $fic->ETAT_LIVRAISON;
                $commande = $fic->COMMANDE;
            }
            $fonction = $this->adminEnPouce_model->get_fonction($matricule);
            if( $etat_saisie == '2' && $etat_lecture == '2' && $fonction == 'PERS' && $etat_controle == '0' && $etat_formatage == '0' && $etat_livraison == '0' )
            {
                $data = array( 'MATRICULE_CONTROLE' => $nouveau_mat,'ETAT_CONTROLE' =>'1' );
                $this->adminEnPouce_model->attribuer_multiple( $id,$data,$commande,$nom_fichier,$matricule,$et );
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                $this->load->view('list_fic',$data);
            }
            else if($fonction != 'PERS')
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,la fonction du matricule traiteur doit etre PERS ');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
            }
            else
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier ses etats: saisie(fini), lecture(fini), controle(non traité), formatage(non traité),livraison(non traité)');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
            }

        }

    }
    if($et =='CONTROLE ECH' )
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $matricule = $fic->MATRICULE_SAISIE;
                $etat_controle = $fic->ETAT_COTROLE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_saisie = $fic->ETAT_SAISIE;
                $etat_lecture = $fic->ETAT_LECTURE;
                $etat_formatage = $fic->ETAT_FORMATAGE;
                $etat_livraison = $fic->ETAT_LIVRAISON;
                $commande = $fic->COMMANDE;
            }
            $fonction = $this->adminEnPouce_model->get_fonction($matricule);
            if( $etat_saisie == '2' && $etat_lecture == '0' && $fonction == 'PERS' && $etat_controle == '0' && $etat_formatage == '0' && $etat_livraison == '0' )
            {
                $data = array( 'MATRICULE_CONTROLE' => $nouveau_mat,'ETAT_CONTROLE' =>'1' );
                $this->adminEnPouce_model->attribuer_multiple($id,$data,$commande,$nom_fichier,$matricule,$et );
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                $this->load->view('list_fic',$data);
            }
            else if($fonction != 'PERS')
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,la fonction du matricule traiteur doit etre PERS ');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
            }
            else
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier ses etats: saisie(fini), lecture(non traité), controle(non traité), formatage(non traité),livraison(non traité)');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
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
                $matricule = $fic->MATRICULE_SAISIE;
                $etat_controle = $fic->ETAT_COTROLE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_saisie = $fic->ETAT_SAISIE;
                $etat_lecture = $fic->ETAT_LECTURE;
                $etat_formatage = $fic->ETAT_FORMATAGE;
                $etat_livraison = $fic->ETAT_LIVRAISON;
                $commande = $fic->COMMANDE;
            }
            $fonction = $this->adminEnPouce_model->get_fonction($matricule);
            if( $etat_saisie == '2' && $fonction == 'PERS' && $etat_controle == '2' )
            {
                $data = array( 'MATRICULE_LIVRAISON' => $nouveau_mat,'ETAT_LIVRAISON' =>'1' );
                $this->adminEnPouce_model->attribuer_multiple( $id,$data,$commande,$nom_fichier,$matricule,$et);
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }
            else if($fonction != 'PERS')
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,la fonction du matricule traiteur doit etre PERS ');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLi( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
            }
            else
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier ses etats: saisie(fini), controle(fini)');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLi( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
            }

        }
    }
    if($et == 'FORMATAGE'  )
    {
        foreach($ids as $id)
        {
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $matricule = $fic->MATRICULE_SAISIE;
                $etat_controle = $fic->ETAT_COTROLE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_saisie = $fic->ETAT_SAISIE;
                $etat_lecture = $fic->ETAT_LECTURE;
                $etat_formatage = $fic->ETAT_FORMATAGE;
                $etat_livraison = $fic->ETAT_LIVRAISON;
                $commande = $fic->COMMANDE;
            }
            if($etat_controle != '2')
            {
                $data = array( 'MATRICULE_FORMATAGE' => $nouveau_mat, 'ETAT_FORMATAGE'=>'1'  );
                $this->adminEnPouce_model->attribuer_multiple( $id,$data,$commande,$nom_fichier,$matricule,$et );
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierF( $id );
                $this->load->view('list_fic',$data);
            }
            else
            {
                $data['rapp_auc_fic_mfini'] = "<script language=\"javascript\">alert('Pour $nom_fichier,verifier son etat: controle(fini)');</script>";
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierF( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
            }

        }
    }

}
?>