<?php
Class Affiche_table_model extends CI_Model
{
    public function get_commande_encours()
    {
        $sql = "SELECT DISTINCT \"COMMANDE\" FROM \"FICHIER\" where \"POSITION_FINALE\"='0' ORDER BY \"COMMANDE\"  ";
        $query = $this->db->query($sql);
        $commande_encours = array();
        if($query->num_rows()>0)
        {
            foreach($query->result() as $row)
            $commande_encours[] = $row;
        }
        return $commande_encours;

    }
    public function get_fic($commande)
    {
        $sql = "SELECT * FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."' ORDER BY \"NOM_FICHIER\" ";
        $query = $this->db->query($sql);
        $fic = array();
        if($query->num_rows()>0)
        {
            foreach($query->result() as $row)
                $fic[] = $row;
        }
        return $fic;
    }
    public function get_etape($commande)
    {
        $sql = "SELECT \"ETAPE\" FROM \"ETAPE\" where \"COMMANDE\" = '".$commande."' ORDER BY \"ETAPE\" ";
        $query = $this->db->query($sql);
        $etape = array();
        if($query->num_rows()>0)
        {
            foreach($query->result() as $row)
                $etape[] = $row;
        }
        return $etape;
    }
    public function get_list_result($table_miasa,$commande,$nom_fichier,$et)
    {
        $sql = "SELECT * FROM \"$table_miasa\" where \"COMMANDE\" = '".$commande."' and \"N_LOT\" = '".$nom_fichier."' and \"ETAPE\"='".$et."' ";
        $second_db= $this->load->database('db2', TRUE);
        $query = $second_db->query($sql);
        $list_resul = array();
        if($query->num_rows()>0)
        {
            foreach($query->result() as $row)
                $list_resul[] = $row;
        }
        return $list_resul;
    }
    public function get_fichier($idfichier)
    {
        $sql = "SELECT * FROM \"FICHIER\" where idfichier = '".$idfichier."' ";
        $query = $this->db->query($sql);
        $fichier = array();
        if($query->num_rows()>0)
        {
            foreach($query->result() as $row)
                $fichier[] = $row;
        }
        return $fichier;
    }
    public function supprimmer($n_enr,$commande,$nlot,$etape,$table_miasa)
    {
        $sql = "DELETE FROM \"$table_miasa\" where \"COMMANDE\" = '".$commande."' and \"N_LOT\" = '".$nlot."' and  \"ETAPE\" = '".$etape."' and  \"N_ENR\" = '".$n_enr."' ";
        $second_db= $this->load->database('db2', TRUE);
        $query = $second_db->query($sql);
        return $second_db->trans_complete();

    }
    public function verifier_exist_table($table_miasa)
    {
        $second_db= $this->load->database('db2', TRUE);
        if($second_db->table_exists($table_miasa))
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }

}

?>