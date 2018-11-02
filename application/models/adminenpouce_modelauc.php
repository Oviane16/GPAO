<?php

class Adminenpouce_modelauc extends CI_Model
{
    protected $table = 'VISU';
    public function issert_a_visu($commande)
    {
        $this->db->select('NOM_FICHIER,MATRICULE_SAISIE,ETAT_SAISIE,
                            MATRICULE_CONTROLE,ETAT_CONTROLE,
                            MATRICULE_LECTURE,ETAT_LECTURE,
                            MATRICULE_FORMATAGE,ETAT_FORMATAGE,
                            MATRICULE_LIVRAISON,ETAT_LIVRAISON');
        $this->db->distinct();
        $this->db->from('FICHIER');
        $this->db->where('COMMANDE',$commande);
        $this->db->order_by('NOM_FICHIER');
        $queryFic = $this->db->get();

        $this->db->select('ETAPE');
        $this->db->distinct();
        $this->db->from('ETAPE');
        $this->db->where('COMMANDE',$commande);
        $queryEt = $this->db->get();

        $etape = array();
        $fichier = array();

        if($queryEt->num_rows() > 0 && $queryFic->num_rows() > 0 )
        {
            foreach($queryEt->result() as $rowEt )
            {
                $etape[] = $rowEt;
                if( $rowEt->ETAPE == 'SAISIE 1' )
                {
                    foreach($queryFic->result() as $rowFic)
                    {
                        $NOM_FIC = $rowFic->NOM_FICHIER;
                        $MATRICULE = $rowFic->MATRICULE_SAISIE;
                        $ETAT = $rowFic->ETAT_SAISIE;
                        $ETATPE = $rowEt->ETAPE;
                        $COMMANDE = $commande;
                        $this->db->query("INSERT INTO \"VISU\" VALUES('$NOM_FIC','$COMMANDE','$MATRICULE','$ETATPE','$ETAT')");
                    }
                }
                if($rowEt->ETAPE == 'IMAGE')
                {
                    foreach($queryFic->result() as $rowFic)
                    {

                        $NOM_FIC = $rowFic->NOM_FICHIER;
                        $MATRICULE = $rowFic->MATRICULE_SAISIE;
                        $ETAT = $rowFic->ETAT_SAISIE;
                        $ETATPE = $rowEt->ETAPE;
                        $COMMANDE = $commande;

                        $this->db->query("INSERT INTO \"VISU\" VALUES('$NOM_FIC','$COMMANDE','$MATRICULE','$ETATPE','$ETAT')");
                    }
                }
                if($rowEt->ETAPE == 'SAISIE')
                {
                    foreach($queryFic->result() as $rowFic)
                    {
                        $NOM_FIC = $rowFic->NOM_FICHIER;
                        $MATRICULE = $rowFic->MATRICULE_SAISIE;
                        $ETAT = $rowFic->ETAT_SAISIE;
                        $ETATPE = $rowEt->ETAPE;
                        $COMMANDE = $commande;

                        $this->db->query("INSERT INTO \"VISU\" VALUES('$NOM_FIC','$COMMANDE','$MATRICULE','$ETATPE','$ETAT')");
                    }
                }
                if( $rowEt->ETAPE == 'TRANSFORMATION')
                {
                    foreach($queryFic->result() as $rowFic)
                    {
                        $NOM_FIC = $rowFic->NOM_FICHIER;
                        $MATRICULE = $rowFic->MATRICULE_SAISIE;
                        $ETAT = $rowFic->ETAT_SAISIE;
                        $ETATPE = $rowEt->ETAPE;
                        $COMMANDE = $commande;

                        $this->db->query("INSERT INTO \"VISU\" VALUES('$NOM_FIC','$COMMANDE','$MATRICULE','$ETATPE','$ETAT')");
                    }
                }
                // CONTROLE
                if( $rowEt->ETAPE == 'CONTROLE')
                {
                    foreach($queryFic->result() as $rowFic)
                    {
                        $NOM_FIC = $rowFic->NOM_FICHIER;
                        $MATRICULE = $rowFic->MATRICULE_CONTROLE;
                        $ETAT = $rowFic->ETAT_CONTROLE;
                        $ETATPE = $rowEt->ETAPE;
                        $COMMANDE = $commande;

                        $this->db->query("INSERT INTO \"VISU\" VALUES('$NOM_FIC','$COMMANDE','$MATRICULE','$ETATPE','$ETAT')");
                    }
                }
                if( $rowEt->ETAPE == 'CONTROLE WEB')
                {
                    foreach($queryFic->result() as $rowFic)
                    {
                        $NOM_FIC = $rowFic->NOM_FICHIER;
                        $MATRICULE = $rowFic->MATRICULE_CONTROLE;
                        $ETAT = $rowFic->ETAT_CONTROLE;
                        $ETATPE = $rowEt->ETAPE;
                        $COMMANDE = $commande;

                        $this->db->query("INSERT INTO \"VISU\" VALUES('$NOM_FIC','$COMMANDE','$MATRICULE','$ETATPE','$ETAT')");
                    }
                }
                if( $rowEt->ETAPE == 'LECTURE')
                {
                    foreach($queryFic->result() as $rowFic)
                    {
                        $NOM_FIC = $rowFic->NOM_FICHIER;
                        $MATRICULE = $rowFic->MATRICULE_LECTURE;
                        $ETAT = $rowFic->ETAT_LECTURE;
                        $ETATPE = $rowEt->ETAPE;
                        $COMMANDE = $commande;
                        $this->db->query("INSERT INTO \"VISU\" VALUES('$NOM_FIC','$COMMANDE','$MATRICULE','$ETATPE','$ETAT')");
                    }
                }
                if( $rowEt->ETAPE == 'RECHERCHE')
                {
                    foreach($queryFic->result() as $rowFic)
                    {
                        $NOM_FIC = $rowFic->NOM_FICHIER;
                        $MATRICULE = $rowFic->MATRICULE_LECTURE;
                        $ETAT = $rowFic->ETAT_LECTURE;
                        $ETATPE = $rowEt->ETAPE;
                        $COMMANDE = $commande;
                        $this->db->query("INSERT INTO \"VISU\" VALUES('$NOM_FIC','$COMMANDE','$MATRICULE','$ETATPE','$ETAT')");
                    }
                }
                if( $rowEt->ETAPE == 'FORMATAGE')
                {
                    foreach($queryFic->result() as $rowFic)
                    {
                        $NOM_FIC = $rowFic->NOM_FICHIER;
                        $MATRICULE = $rowFic->MATRICULE_FORMATAGE;
                        $ETAT = $rowFic->ETAT_FORMATAGE;
                        $ETATPE = $rowEt->ETAPE;
                        $COMMANDE = $commande;
                        $this->db->query("INSERT INTO \"VISU\" VALUES('$NOM_FIC','$COMMANDE','$MATRICULE','$ETATPE','$ETAT')");
                    }
                }
                if( $rowEt->ETAPE == 'LIVRAISON')
                {
                    foreach($queryFic->result() as $rowFic)
                    {
                        $NOM_FIC = $rowFic->NOM_FICHIER;
                        $MATRICULE = $rowFic->MATRICULE_LIVRAISON;
                        $ETAT = $rowFic->ETAT_LIVRAISON;
                        $ETATPE = $rowEt->ETAPE;
                        $COMMANDE = $commande;
                        $this->db->query("INSERT INTO \"VISU\" VALUES('$NOM_FIC','$COMMANDE','$MATRICULE','$ETATPE','$ETAT')");
                    }
                }
            }
        }
    }
    public function get_fichierAu_aucun ($commande,$nom_fichierD,$nom_fichierF)
    {
        $this->db->query("DELETE FROM \"VISU\" where \"COMMANDE\" = '".$commande."' ") ;
        $this->issert_a_visu($commande);
        return  $this->db->select('*')
            ->from($this->table)
            ->where("NOM_FICHIER BETWEEN '".$nom_fichierD."' AND '".$nom_fichierF."' ")
            ->where('COMMANDE', $commande)
            ->order_by('NOM_FICHIER')
            ->get()
            ->result();

    }
    public function get_fichierAu_aucun_dea ($commande)
    {
        $this->db->query("DELETE FROM \"VISU\" where \"COMMANDE\" = '".$commande."' ") ;
        $this->issert_a_visu($commande);
        return  $this->db->select('*')
            ->from($this->table)
            ->where('COMMANDE', $commande)
            ->order_by('NOM_FICHIER')
            ->get()
            ->result();

    }
    // $this->db->where_between('id', 100, 200);
    public function get_fichierAu_encours($commande,$nom_fichierD,$nom_fichierF)
    {
        $this->issert_a_visu($commande);
        return  $this->db->select('*')
            ->from($this->table)
            ->where("NOM_FICHIER BETWEEN '".$nom_fichierD."' AND '".$nom_fichierF."' ")
            ->where('COMMANDE', $commande)
            ->order_by('NOM_FICHIER')
            ->where('ETAT', '1')
            ->get()
            ->result();
        $this->db->query("DELETE FROM \"VISU\" where \"COMMANDE \" = '".$commande."' ") ;
    }
    public function get_fichierAu_nontraite($commande,$nom_fichierD,$nom_fichierF)
    {
        $this->issert_a_visu($commande);
        return  $this->db->select('*')
            ->from($this->table)
            ->where("NOM_FICHIER BETWEEN '".$nom_fichierD."' AND '".$nom_fichierF."' ")
            ->where('COMMANDE', $commande)
            ->where('ETAT', '0')
            ->order_by('NOM_FICHIER')
            ->get()
            ->result();
        $this->db->query("DELETE FROM \"VISU\" where \"COMMANDE \" = '".$commande."' ") ;
    }
    public function get_fichierAu_fini($commande,$nom_fichierD,$nom_fichierF)
    {
        $this->issert_a_visu($commande);
        return  $this->db->select('*')
            ->from($this->table)
            ->where("NOM_FICHIER BETWEEN '".$nom_fichierD."' AND '".$nom_fichierF."' ")
            ->where('COMMANDE', $commande)
            ->where('ETAT', '2')
            ->order_by('NOM_FICHIER')
            ->get()
            ->result();
        $this->db->query("DELETE FROM \"VISU\" where \"COMMANDE \" = '".$commande."' ") ;
    }
    public function get_fichierAu_rejete($commande,$nom_fichierD,$nom_fichierF)
    {
        $this->issert_a_visu($commande);
        return  $this->db->select('*')
            ->from($this->table)
            ->where("NOM_FICHIER BETWEEN '".$nom_fichierD."' AND '".$nom_fichierF."' ")
            ->where('COMMANDE', $commande)
            ->where('ETAT', '3')
            ->order_by('NOM_FICHIER')
            ->get()
            ->result();
        $this->db->query("DELETE FROM \"VISU\" where \"COMMANDE \" = '".$commande."' ") ;
    }
    public function get_fichierAu_encours_dea($commande)
    {
        $this->issert_a_visu($commande);
        return  $this->db->select('*')
            ->from($this->table)
            ->where('COMMANDE', $commande)
            ->where('ETAT', '1')
            ->order_by('NOM_FICHIER')
            ->get()
            ->result();
        $this->db->query("DELETE FROM \"VISU\" where \"COMMANDE \" = '".$commande."' ") ;
    }
    public function get_fichierAu_nontraite_dea($commande)
    {
        $this->issert_a_visu($commande);
        return  $this->db->select('*')
            ->from($this->table)
            ->where('COMMANDE', $commande)
            ->where('ETAT', '0')
            ->order_by('NOM_FICHIER')
            ->get()
            ->result();
        $this->db->query("DELETE FROM \"VISU\" where \"COMMANDE \" = '".$commande."' ") ;
    }
    public function get_fichierAu_fini_dea($commande)
    {
        $this->issert_a_visu($commande);
        return  $this->db->select('*')
            ->from($this->table)
            ->where('COMMANDE', $commande)
            ->where('ETAT', '2')
            ->order_by('NOM_FICHIER')
            ->get()
            ->result();
        $this->db->query("DELETE FROM \"VISU\" where \"COMMANDE \" = '".$commande."' ") ;
    }
    public function get_fichierAu_rejete_dea($commande)
    {
        $this->issert_a_visu($commande);
        return  $this->db->select('*')
            ->from($this->table)
            ->where('COMMANDE', $commande)
            ->where('ETAT', '3')
            ->order_by('NOM_FICHIER')
            ->get()
            ->result();
        $this->db->query("DELETE FROM \"VISU\" where \"COMMANDE \" = '".$commande."' ") ;
    }
}
?>