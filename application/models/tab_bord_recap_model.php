<?php
Class Tab_bord_recap_model extends CI_Model
{
    protected $table = 'FICHIER';
    protected $table2 = 'PERSONNEL';
    public function count($where = array())
    {
        return (int) $this->db->where($where)
            ->count_all_results($this->table);
    }
    public function getcommande_encours()
    {
        $sql = "SELECT DISTINCT \"COMMANDE\", \"DOSSIER\" FROM \"FICHIER\" where  \"POSITION_FINALE\" ='0' ORDER BY \"COMMANDE\" ";
        $query = $this->db->query($sql);
        $commande_encours = array();
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
                $commande_encours[] = $row;
            }
            return $commande_encours;
        }
    }
    public function get_mat_actif()
    {
        $daty_androany = date('Y-m-d');
        $sql = "SELECT \"MATRICULE\" FROM \"POINTAGE\" where \"DATE_ENTREE\" = '".$daty_androany."' and \"DATE_SORTIE\" is null   ";
        $query = $this->db->query($sql);
        $matricule_actif = array();
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
                $matricule_actif[] = $row;
            }
            return $matricule_actif;
        }
    }
    public function get_personnel($matricule)
    {
        $sql = "SELECT * FROM \"PERSONNEL\" where \"MATRICULE\" = '".$matricule."'";
        $query = $this->db->query($sql);
        $personnel = array();
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
                $personnel[] = $row;
            }
            return $personnel;
        }
    }
    public function count_persactif($where = array())
    {
        return (int) $this->db->where($where)
            ->count_all_results($this->table2);
    }
    public function get_etape($commande)
    {
        $sql = "SELECT DISTINCT \"ETAPE\", \"RANG\" FROM \"ETAPE\" where \"COMMANDE\" = '".$commande."' ORDER BY \"RANG\"  ";
        $query = $this->db->query($sql);
        $etape = array();
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
                $etape[] = $row;
            }
            return $etape;
        }
    }
    public function get_fonction($matricule)
    {
        $sql = "SELECT \"FONCTION\" FROM \"PERSONNEL\" where \"MATRICULE\" = '".$matricule."' ";
        $query = $this->db->query($sql);
        $fonction = array();
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
                $fonction[] = $row;
            }
            return $fonction;
        }
    }
    public function get_fonction2($matricule)
    {
        $sql = "SELECT \"FONCTION\" FROM \"PERSONNEL\" where \"MATRICULE\" = '".$matricule."' ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
                $fonction = $row->FONCTION;
            }
            return $fonction;
        }
    }
    public function get_fic_saisie_encours($commande)
    {
        $sql = "SELECT * FROM \"FICHIER\" where \"COMMANDE\"= '".$commande."' and \"POSITION_FINALE\"='0' and \"ETAT_SAISIE\" ='1' ";
        $query = $this->db->query($sql);
        $fichier = array();
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $fichier[] = $row;
            }
            return $fichier;
        }
    }
    public function get_fic_controle_encours($commande)
    {
        $sql = "SELECT * FROM \"FICHIER\" where \"COMMANDE\"= '".$commande."' and \"POSITION_FINALE\"='0' and \"ETAT_CONTROLE\" ='1' ";
        $query = $this->db->query($sql);
        $fichier = array();
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $fichier[] = $row;
            }
            return $fichier;
        }
    }
    public function get_fic_formatage_encours($commande)
    {
        $sql = "SELECT * FROM \"FICHIER\" where \"COMMANDE\"= '".$commande."' and \"POSITION_FINALE\"='0' and \"ETAT_FORMATAGE\" ='1' ";
        $query = $this->db->query($sql);
        $fichier = array();
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $fichier[] = $row;
            }
            return $fichier;
        }
    }
    public function get_fic_lecture_encours($commande)
    {
        $sql = "SELECT * FROM \"FICHIER\" where \"COMMANDE\"= '".$commande."' and \"POSITION_FINALE\"='0' and \"ETAT_LECTURE\" ='1' ";
        $query = $this->db->query($sql);
        $fichier = array();
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $fichier[] = $row;
            }
            return $fichier;
        }
    }
    public function get_fic_livraison_encours($commande)
    {
        $sql = "SELECT * FROM \"FICHIER\" where \"COMMANDE\"= '".$commande."' and \"POSITION_FINALE\"='0' and \"ETAT_LIVRAISON\" ='1' ";
        $query = $this->db->query($sql);
        $fichier = array();
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $fichier[] = $row;
            }
            return $fichier;
        }
    }

}