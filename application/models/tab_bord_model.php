<?php

class Tab_bord_model extends CI_Model {
    protected $table = 'FICHIER';
    public function count($where = array())
    {
        return (int) $this->db->where($where)
            ->count_all_results($this->table);
    }
    public function get_fichier( $commande )
    {
        return  $this->db->select('*')
            ->from($this->table)
            ->where('COMMANDE', $commande)
            ->get()
            ->result();
    }
    public function get_personnel($mat,$mdp)
    {
        $sql = "SELECT * FROM \"PERSONNEL\" where \"MATRICULE\" = '".$mat."' AND \"MDP\" = '".$mdp."'";
        $query = $this->db->query($sql);
        $fonction = array();
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $fonction[] = $row->FONCTION;
            }
            return $fonction;
        }
    }
    public function get_etape($commande)
    {
        $sql = "SELECT DISTINCT \"ETAPE\",\"RANG\" FROM \"ETAPE\" where \"COMMANDE\" = '".$commande."' ORDER BY \"RANG\" ";
        $query = $this->db->query($sql);
        $etape = array();
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $etape[] = $row;
            }
            return $etape;
        }
    }

}
?>
