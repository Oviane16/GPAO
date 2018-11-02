<?php
public function initialiser_multiple($etape='')
{
    $ids = ( explode( ',', $this->input->get_post('ids') ));
    $et = urldecode($etape);
    $nom_fichier = NULL;
   $i = 0;
    if($et  == 'RECHERCHE' )
    {
        foreach($ids as $id)
        {
            $mat_modificateur = $this->session->userdata('matricule');
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $ext = $fic->EXTENSION;
                $matricule = $fic->MATRICULE_LECTURE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_formatage = $fic->ETAT_FORMATAGE;
                $etat_livraison = $fic->ETAT_LIVRAISON;
                $etat_lecture = $fic->ETAT_LECTURE;
                $etat_controle = $fic->ETAT_CONTROLE;
            }
            if($etat_lecture != '0')
            {
                if($etat_livraison == 0 && $etat_controle == 0 )
                {
                    $sai = 'LEC';
                    $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                    $rep_commande = ("C:\\reserve\\$commande");
                    $MyName =("C:\\reserve\\$commande\\$nom" );
                    if (file_exists($MyName))
                    {
                        chmod($rep_commande, 777);
                        unlink($MyName);
                    }
                    $data = array( 'ETAT_LECTURE' => '0','MATRICULE_LECTURE'=>NULL );
                    $this->adminEnPouce_model->initialiser_multiple( $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                    $this->load->view('list_fic',$data);
                    $i++;
                }
                else
                {
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                    $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: livraison(non traité), controle(non traité) ');</script>";
                    $this->load->view('list_fic',$data);
                }
            }
            else
            {
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }

            /* else if($etat_lecture == '0')
             {
                 echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
             }*/
        }
    }
    if($et == 'CONTROLE WEB')
    {
        foreach($ids as $id)
        {
            $mat_modificateur = $this->session->userdata('matricule');
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $ext = $fic->EXTENSION;
                $matricule = $fic->MATRICULE_LECTURE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_lecture = $fic->ETAT_LECTURE;
                $etat_formatage = $fic->ETAT_FORMATAGE;
                $etat_livraison = $fic->ETAT_LIVRAISON;
                $etat_controle = $fic->ETAT_CONTROLE;
            }
            if($etat_controle !='0')
            {
                if($etat_livraison == '0' &&  $etat_lecture == '2' )
                {
                    $sai = 'CTL';
                    $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                    $rep_commande = ("C:\\reserve\\$commande");
                    $MyName =("C:\\reserve\\$commande\\$nom" );
                    if (file_exists($MyName))
                    {
                        chmod($rep_commande, 777);
                        unlink($MyName);
                    }
                    $data = array( 'ETAT_CONTROLE'=>'0','MATRICULE_CONTROLE'=>NULL );
                    $this->adminEnPouce_model->initialiser_multiple(  $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                    $this->load->view('list_fic',$data);
                    $i++;
                }
                else
                {
                    $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: lecture(fini),livraison(non traité)  ');</script>";
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                }
            }
            else
            {
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }
            /* else if($etat_controle == '0')
             {
                 echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
             } */
        }
    }
    if($et == 'RELECTURE')
    {
        foreach($ids as $id)
        {
            $mat_modificateur = $this->session->userdata('matricule');
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $ext = $fic->EXTENSION;
                $matricule = $fic->MATRICULE_LECTURE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_formatage = $fic->ETAT_FORMATAGE;
                $etat_livraison = $fic->ETAT_LIVRAISON;
                $etat_lecture = $fic->ETAT_LECTURE;
                $etat_controle = $fic->ETAT_CONTROLE;
            }
            if($etat_lecture != '0')
            {
                if($etat_lecture == '2' && $etat_livraison == '0' && $etat_controle ='0' )
                {
                    $sai = 'LEC';
                    $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                    $rep_commande = ("C:\\reserve\\$commande");
                    $MyName =("C:\\reserve\\$commande\\$nom" );
                    if (file_exists($MyName))
                    {
                        chmod($rep_commande, 777);
                        unlink($MyName);
                    }
                    $data = array( 'ETAT_LECTURE' => '0','MATRICULE_CONTROLE'=>NULL );
                    $this->adminEnPouce_model->initialiser_multiple( $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                    $this->load->view('list_fic',$data);
                    $i++;
                }
                else
                {
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                    $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: lecture(fini),livraison(non traité),controle(non traité)  ');</script>";
                    $this->load->view('list_fic',$data);
                }
            }
            else
            {
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }
            /*
            else if($etat_lecture == '0')
            {
                echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
            }*/
        }
    }

    if($et == 'CONTROLE' || $et == 'CONTROLE ECH' )
    {
        foreach($ids as $id)
        {
            $mat_modificateur = $this->session->userdata('matricule');
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $ext = $fic->EXTENSION;
                $matricule = $fic->MATRICULE_LECTURE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_lecture = $fic->ETAT_LECTURE;
                $etat_formatage = $fic->ETAT_FORMATAGE;
                $etat_livraison = $fic->ETAT_LIVRAISON;
                $etat_controle = $fic->ETAT_CONTROLE;
            }
            if($etat_controle !='0')
            {
                if($etat_livraison == '0' && $etat_lecture == '0' )
                {
                    $sai = 'CTL';
                    $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                    $rep_commande = ("C:\\reserve\\$commande");
                    $MyName =("C:\\reserve\\$commande\\$nom" );
                    if (file_exists($MyName))
                    {
                        chmod($rep_commande, 777);
                        unlink($MyName);
                    }
                    $data = array( 'ETAT_CONTROLE'=>'0','MATRICULE_CONTROLE'=>NULL );
                    $this->adminEnPouce_model->initialiser_multiple(  $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                    $this->load->view('list_fic',$data);
                    $i++;
                }
                else
                {
                    $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: livraison(non traité),lecture(non traité)');</script>";
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierC( $id );
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                }
            }
            else
            {
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }
            /*
            else if($etat_controle == '0')
            {
                echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
            }*/
        }

    }

    if($et == 'FORMATAGE'  )
    {
        foreach($ids as $id)
        {
            $mat_modificateur = $this->session->userdata('matricule');
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $ext = $fic->EXTENSION;
                $matricule = $fic->MATRICULE_LECTURE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_livraison = $fic->ETAT_LIVRAISON;
                $etat_formatage = $fic->ETAT_FORMATAGE;
                $etat_controle = $fic->ETAT_CONTROLE;
            }

            if($etat_formatage != '0')
            {
                if($etat_livraison == '0' || $etat_controle =='2'  )
                {
                    $sai = 'FO';
                    $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                    $rep_commande = ("C:\\reserve\\$commande");
                    $MyName =("C:\\reserve\\$commande\\$nom" );
                    if (file_exists($MyName))
                    {
                        chmod($rep_commande, 777);
                        unlink($MyName);
                    }
                    $data = array( 'ETAT_FORMATAGE' => '0','MATRICULE_FORMATAGE'=>NULL );
                    $this->adminEnPouce_model->initialiser_multiple( $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                    $this->load->view('list_fic',$data);
                    $i++;
                }
                else
                {
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierF($id);
                    $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: livraison(non traité),controle(fini)');</script>";
                    $data['et'] = $et;
                    $this->load->view('list_fic',$data);
                }
            }
            else
            {
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }/*
                else if($etat_formatage == '0')
                {
                    echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
                }*/
        }
    }


    if($et == 'LIVRAISON' )
    {
        foreach($ids as $id)
        {
            $mat_modificateur = $this->session->userdata('matricule');
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $ext = $fic->EXTENSION;
                $matricule = $fic->MATRICULE_LIVRAISON;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_livraison = $fic->ETAT_LIVRAISON;
            }
            if($etat_livraison != '0')
            {
                $data = array( 'ETAT_LIVRAISON' => '0','MATRICULE_LIVRAISON'=>NULL );
                $this->adminEnPouce_model->initialiser_multiple(  $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext );
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLi( $id );
                $data['et'] = $et;
                $this->load->view('list_fic',$data);
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                $this->load->view('list_fic',$data);
                $i++;
            }
            else
            {
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }
            /*
            else if($etat_livraison == '0')
            {
                echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
            }*/
        }

    }

    if($et == 'IMAGE')
    {
        foreach($ids as $id)
        {
            $mat_modificateur = $this->session->userdata('matricule');
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $ext = $fic->EXTENSION;
                $matricule = $fic->MATRICULE_SAISIE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_controle = $fic->ETAT_CONTROLE;
                $etat_lecture = $fic->ETAT_LECTURE;
                $etat_formatage = $fic->ETAT_FORMATAGE;
                $etat_livraison = $fic->ETAT_LIVRAISON;
                $etat_saisie = $fic->ETAT_SAISIE;

            }
            if($etat_saisie != '0')
            {

                    $sai = 'SAI';
                    $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                    $rep_commande = ("C:\\reserve\\$commande");
                    $MyName =("C:\\reserve\\$commande\\$nom" );
                    if (file_exists($MyName))
                    {
                        chmod($rep_commande, 777);
                        unlink($MyName);
                    }
                    $data = array( 'ETAT_SAISIE' => '0'/*, 'MATRICULE_SAISIE'=>NULL*/ );
                    $this->adminEnPouce_model->initialiser_multiple( $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                    $this->load->view('list_fic',$data);
                    $i++;
            }
            else
            {
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }
            /*
            else if($etat_saisie == '0')
            {
                $nom_fichier_array[] = $nom_fichier;
                echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
            }*/
        }

    }
    if($et == 'OCR' || $et == 'SAISIE 1' || $et == 'TRANSFORMATION')
    {
        foreach($ids as $id)
        {
            $mat_modificateur = $this->session->userdata('matricule');
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $ext = $fic->EXTENSION;
                $matricule = $fic->MATRICULE_SAISIE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_controle = $fic->ETAT_CONTROLE;
                $etat_lecture = $fic->ETAT_LECTURE;
                $etat_formatage = $fic->ETAT_FORMATAGE;
                $etat_livraison = $fic->ETAT_LIVRAISON;
                $etat_saisie = $fic->ETAT_SAISIE;

            }
            if($etat_saisie != '0')
            {
                if( $etat_controle == '0'  )
                {
                    $sai = 'SAI';
                    $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                    $rep_commande = ("C:\\reserve\\$commande");
                    $MyName =("C:\\reserve\\$commande\\$nom" );
                    if (file_exists($MyName))
                    {
                        chmod($rep_commande, 777);
                        unlink($MyName);
                    }
                    $data = array( 'ETAT_SAISIE' => '0', 'MATRICULE_SAISIE'=>NULL );
                    $this->adminEnPouce_model->initialiser_multiple( $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                    $this->load->view('list_fic',$data);
                    $i++;
                }
                else
                {
                    $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: controle(non traité)');</script>";
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                    $this->load->view('list_fic',$data);
                }
            }
            else
            {
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }
            /*
            else if($etat_saisie == '0')
            {
                $nom_fichier_array[] = $nom_fichier;
                echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }*/
        }

    }


    if($et == 'LECTURE' )
    {
        foreach($ids as $id)
        {
            $mat_modificateur = $this->session->userdata('matricule');
            $fichier = $this->adminEnPouce_model->get_fichier($id);
            foreach($fichier as $fic)
            {
                $ext = $fic->EXTENSION;
                $matricule = $fic->MATRICULE_LECTURE;
                $commande = $fic->COMMANDE;
                $nom_fichier = $fic->NOM_FICHIER;
                $etat_formatage = $fic->ETAT_FORMATAGE;
                $etat_livraison = $fic->ETAT_LIVRAISON;
                $etat_lecture = $fic->ETAT_LECTURE;
            }
            if($etat_lecture != '0')
            {
                if($etat_livraison == '0' && $etat_formatage == '0' )
                {
                    $sai = 'LEC';
                    $nom = "$nom_fichier"."{$sai}"."$matricule"."."."$ext";

                    $rep_commande = ("C:\\reserve\\$commande");
                    $MyName =("C:\\reserve\\$commande\\$nom" );
                    if (file_exists($MyName))
                    {
                        chmod($rep_commande, 777);
                        unlink($MyName);
                    }
                    $data = array( 'ETAT_LECTURE' => '0','MATRICULE_LECTURE'=>NULL );
                    $this->adminEnPouce_model->initialiser_multiple( $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext);
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                    $this->load->view('list_fic',$data);
                    $i++;
                }
                else
                {
                    $data['et'] = $et;
                    $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierLec( $id );
                    $data['erreur_et_sup'] = "<script language=\"javascript\">alert('Pour $nom_fichier, verifier ses etats: livraison(non traité),formatage(non traité)');</script>";
                    $this->load->view('list_fic',$data);
                }

            }
            else
            {
                $data['et'] = $et;
                $data['fichier'] = $this->adminEnPouce_model->get_fichier_modifierS( $id );
                $this->load->view('list_fic',$data);
            }/*
                else if($etat_lecture == '0')
                {
                    echo  "<script language=\"javascript\">alert('$nom_fichier Fichier déja non traité');</script>";
                }*/
        }
    }



    ///alert echec ou reussi
    /*if($i != '0')
    {
        echo  "<script language=\"javascript\">alert('$i Fichier(s) initialisé(s)');</script>";
    }
    if($i == '0')
    {
        echo  "<script language=\"javascript\">alert('Aucun fichier initialisé');</script>";
    }*/

}

?>