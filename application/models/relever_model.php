<?php
class Relever_model extends CI_Model
{
    public function get_suivi_fic($comm,$date_debut,$date_fin,$etape)
    {
        $sql= "SELECT * FROM \"SUIVI_FICHIER\" where \"DATEDEBUT\" between '".$date_debut."' and '".$date_fin."' and \"COMMANDE\" = '".$comm."' and \"ETAPE\" ='".$etape."'  ";
        $query = $this->db->query($sql);
        $suivi_fic = array();
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
                $suivi_fic[] = $row;
            }
            return $suivi_fic;
        }
    }
    public function get_suivi_fic_aucun_date($comm,$etape)
    {
        $sql= "SELECT * FROM \"SUIVI_FICHIER\" where \"COMMANDE\" = '".$comm."' and \"ETAPE\" ='".$etape."'  ";
        $query = $this->db->query($sql);
        $suivi_fic = array();
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
                $suivi_fic[] = $row;
            }
            return $suivi_fic;
        }
    }
    public function get_objectif($comm,$etape)
    {
        $sql= "SELECT DISTINCT \"OBJECTIF\" FROM \"ETAPE\" where \"COMMANDE\" = '".$comm."' and \"ETAPE\" ='".$etape."'  ";
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
    public function get_fic_cliern($comm)
    {
        $sql= "SELECT distinct \"FICHIER_CLIENT\" FROM \"FICHIER\" where \"COMMANDE\" = '".$comm."'  ";
        $query = $this->db->query($sql);
        $fichier_client = array();
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
                $fichier_client[] = $row;
            }
            return $fichier_client;
        }
    }

}
?>
