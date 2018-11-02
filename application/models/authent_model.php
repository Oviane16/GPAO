<?php

class Authent_model extends CI_Model
{
    protected $table = 'FICHIER';
    function get_fonction($matricule, $motdepasse )
    {
        $sql = "SELECT \"FONCTION\"  FROM \"PERSONNEL\" where \"MATRICULE\" = '".$matricule."' AND \"MDP\" = '".$motdepasse."'";
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
    public function get_prenom($matricule,$motdepasse)
    {
        $sql = "SELECT \"PRENOM\"  FROM \"PERSONNEL\" where \"MATRICULE\" = '".$matricule."' AND \"MDP\" = '".$motdepasse."'";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $prenom = $row->PRENOM;
            }
            return $prenom;
        }
    }
    public function get_id($matricule,$motdepasse)
    {
        $sql = "SELECT idpersonnel FROM \"PERSONNEL\" where \"MATRICULE\" = '".$matricule."' AND \"MDP\" = '".$motdepasse."'";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $id_pers = $row->idpersonnel;
            }
            return $id_pers;
        }
    }
    public function get_pressonnel($id_pers)
    {
        $sql = "SELECT * FROM \"PERSONNEL\" where idpersonnel = '".$id_pers."' ";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $personnel[] = $row;
            }
            return $personnel;
        }
    }

}