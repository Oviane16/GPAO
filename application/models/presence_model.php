<?php

class Presence_model extends CI_Model
{
    public function get_pers_actif()
    {
        $sql ="SELECT DISTINCT \"MATRICULE\", \"FONCTION\",\"NOM\" FROM \"PERSONNEL\" WHERE \"DATE_DEBAUCHE\" IS NULL ORDER BY \"MATRICULE\" DESC";
        $query = $this->db->query($sql);
        $pers = array();
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $pers[] = $row;
            }
            return $pers;
        }
    }
    public function get_presence_pers($date_debut,$date_fin,$mat)
    {
        $sql ="SELECT DISTINCT \"DATE_ENTREE\",\"DATE_SORTIE\" ,\"HEURE_ENTREE\" ,\"HEURE_FIN\" ,\"DUREE\" FROM \"POINTAGE\" where \"DATE_ENTREE\" BETWEEN '".$date_debut."' and '".$date_fin."'
        and  \"MATRICULE\" = '".$mat."' ORDER BY \"DATE_ENTREE\" ASC ";
        $query = $this->db->query($sql);
        $resence_pers = array();
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $resence_pers[] = $row;
            }
            return $resence_pers;
        }
    }
    function get_fonction($matricule )
    {
        $sql = "SELECT \"FONCTION\"  FROM \"PERSONNEL\" where \"MATRICULE\" = '".$matricule."' ";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $fonction = $row->FONCTION;
            }
            return $fonction;
        }
    }

}
?>