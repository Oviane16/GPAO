<?php

class Enregist_pers_model extends CI_Model
{
    protected $table = 'PERSONNEL';
    public function enregistrer($nom,$prenom,$sexe,$date_naiss,$lieu_naiss,$nom_pere,$nom_mere,
                                $cin,$date_cin,$lieu_cin,$situation,$nb_enfant,$conjoint,$adresse,$cp,$ville,$tel_fixe,$tel_portable,$email,$cnaps,$ostie,
                                $categorie,$pseudo,$mdp,$fonction,$date_embch,$contrat,$matricule)
    {
        $this->db->set('NOM', $nom);
        $this->db->set('PRENOM', $prenom);
        $this->db->set('MATRICULE', $matricule);
        $this->db->set('ADRESSE', $adresse);
        $this->db->set('SEXE', $sexe);
        $this->db->set('DATE_EMBAUCHE',$date_embch );
        $this->db->set('DATE_DE_NAISSANCE',$date_naiss );
        $this->db->set('LIEU_DE_NAISSANCE',$lieu_naiss );
        $this->db->set('PERE',$nom_pere );
        $this->db->set('MERE',$nom_mere );
        $this->db->set('CIN',$cin );
        $this->db->set('DATE_CIN',$date_cin );
        $this->db->set('LIEU_CIN',$lieu_cin );
        $this->db->set('FONCTION',$fonction );
        $this->db->set('PSEUDO',$pseudo );
        $this->db->set('MDP', $mdp);
        $this->db->set('SITUATION',$situation );
        $this->db->set('NOMBRE_ENFANT',$nb_enfant );
        $this->db->set('CP',$cp );
        $this->db->set('VILLE',$ville );
        $this->db->set('TELEPHONE',$tel_fixe );
        $this->db->set('PORTABLE',$tel_portable );
        $this->db->set('EMAIL',$email );
        $this->db->set('CNAPS',$cnaps );
        $this->db->set('ACTION','' );
        $this->db->set('NIVEAU','' );
        $this->db->set('CONTRAT',$contrat );
        $this->db->set('CONJOINT', $conjoint);
        $this->db->set('OSTIE',$ostie );
        $this->db->set('CATEGORIE',$categorie );
        return $this->db->insert($this->table);
    }
    public function list_pers()
    {
        return  $this->db->select('*')
            ->from($this->table)
            ->order_by('MATRICULE')
            ->get()
            ->result();
    }
    public function recherche($matricule)
    {
        return $this->db->select('*')
            ->from($this->table)
            ->where('MATRICULE',$matricule)
            ->get()
            ->result();
    }
    public function sauver_modif($nom,$prenom,$sexe,$date_naiss,$lieu_naiss,$nom_pere,$nom_mere,
                                 $cin,$date_cin,$lieu_cin,$situation,$nb_enfant,$conjoint,$adresse,$cp,$ville,$tel_fixe,$tel_portable,$email,$cnaps,$ostie,
                                 $categorie,$pseudo,$mdp,$fonction,$date_embch,$contrat,$matricule,$action)
    {
        $this->db->set('NOM', $nom)
            ->set('PRENOM', $prenom)
            ->set('MATRICULE', $matricule)
            ->set('ADRESSE', $adresse)
            ->set('SEXE', $sexe)
            ->set('DATE_EMBAUCHE',$date_embch )
            ->set('DATE_DE_NAISSANCE',$date_naiss )
            ->set('LIEU_DE_NAISSANCE',$lieu_naiss )
            ->set('PERE',$nom_pere )
            ->set('MERE',$nom_mere )
            ->set('CIN',$cin )
            ->set('DATE_CIN',$date_cin )
            ->set('LIEU_CIN',$lieu_cin )
            ->set('FONCTION',$fonction )
            ->set('PSEUDO',$pseudo )
            ->set('MDP', $mdp)
            ->set('SITUATION',$situation )
            ->set('NOMBRE_ENFANT',$nb_enfant )
            ->set('CP',$cp )
            ->set('VILLE',$ville )
            ->set('TELEPHONE',$tel_fixe )
            ->set('PORTABLE',$tel_portable )
            ->set('EMAIL',$email )
            ->set('CNAPS',$cnaps )
            ->set('ACTION','' )
            ->set('NIVEAU','' )
            ->set('CONTRAT',$contrat )
            ->set('CONJOINT', $conjoint)
            ->set('OSTIE',$ostie )
            ->set('CATEGORIE',$categorie )
            ->set('ACTION',$action )
            ->where('MATRICULE',$matricule)
            ->update($this->table);
        $this->db->trans_complete();
        return $this->db->trans_complete();
    }
    public function recherche_id($id)
    {
        return $this->db->select('*')
            ->from($this->table)
            ->where('idpersonnel',$id)
            ->get()
            ->result();
    }
    public function count_pers()
    {
        return (int)  $this->db->select('*')
            ->from($this->table)
            ->count_all_results();
    }
    public function get_dernier_mat()
    {
        $sql = "SELECT \"MATRICULE\" FROM \"PERSONNEL\"   order by \"MATRICULE\" desc ";
        $query = $this->db->query($sql);
        $dernier_mat = array();
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $dernier_mat[] = $row->MATRICULE;
            }
            return $dernier_mat[0];

        }
    }
}
?>
   