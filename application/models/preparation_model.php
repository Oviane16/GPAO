<?php

class Preparation_model extends CI_Model
{
    protected $table = 'PREPARATION';
    protected $tabl='FICHIER';
    protected $listimage='LISTEIMAGE';
    public function get_personnel($matricule)
    {


        $daty=date('Y-m-d');
        $sq="SELECT * FROM \"POINTAGE\" WHERE \"MATRICULE\"='".$matricule."'and \"DATE_ENTREE\"='".$daty."' and \"DATE_SORTIE\" is null ORDER BY \"idpointage\" DESC";
        $que = $this->db->query($sq);
        if ($que->num_rows() > 0)
        {
            return 1;
        }
        else
        {
            return 2;
        }

    }
    public function get_verrification($command)
    {
        $sq = "SELECT * FROM \"PREPARATION\" WHERE \"COMMANDE\"='" .$command. "'";
        $que = $this->db->query($sq);
        if ($que->num_rows() > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    public function get_insertionPre($command,$Total,$nombre,$lien,$matricule,$traitement,$export,$idcommande,$fic)
    {
        $daty=date('Y-m-d');
        $Ora=date("H:i:s");
        $this->db->set('COMMANDE', $command);
        $this->db->set('TOTAL_FICHIER',   $Total);
        $this->db->set('SEQUENCE', $nombre);
// Ces données ne seront pas échappées
        $this->db->set('LIEN',  $lien);
        $this->db->set('DATE_PREPARATION',   $daty);
        $this->db->set('MATRICULE', $matricule);
        $this->db->set('HEURE_PREPARATION',  $Ora);
        $this->db->set('ETAT_PREPARATION',   2);
        $this->db->set('TYPE_TRAITEMENT', $traitement);
        $this->db->set('EXTENSION', $export);
        $this->db->set('ID_COMMANDE',  $idcommande);
        $this->db->set('FICHIER_CLIENT',   $fic);
// Une fois que tous les champs ont bien été définis, on "insert"
        return $this->db->insert($this->table);
    }
    public function get_selectPre($command)
    {
        $sql = "SELECT * FROM \"PREPARATION\" WHERE \"COMMANDE\"='" .$command. "'";
        $preparation = array();
        $query = $this->db->query($sql);
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $preparation[] = $row;
            }
            return $preparation;
        }
    }
    public function get_insertionFICHIER($SousRepert,$command,$rep,$RepertoireACreer,$id_preparation,$traitement,$export,$idcommande,$fic)
    {
        $this->db->set('NOM_FICHIER', $SousRepert);
        $this->db->set('COMMANDE',   $command);
        $this->db->set('DEBUT_IMAGE',$rep);
        $this->db->set('ID_PREPARATION',  $id_preparation);
        $this->db->set('REPERTOIRE',$RepertoireACreer);
        $this->db->set('ETAT_SAISIE',0);
        $this->db->set('ETAT_CONTROLE', 0);
        $this->db->set('ETAT_LECTURE',0);
        $this->db->set('ETAT_LIVRAISON',0);
        $this->db->set('POSITION_FINALE',0);
        $this->db->set('TYPE_TRAITEMENT', $traitement);
        $this->db->set('EXTENSION',  $export);
        $this->db->set('ETAT_FORMATAGE',0);
        $this->db->set('ID_COMMANDE',$idcommande);
        $this->db->set('FICHIER_CLIENT',$fic);
        return $this->db->insert($this->tabl);
    }
    public function get_insertionLISTAGE($rep,$command,$SousRepert,$id_preparation,$RepertoireACreer,$export,$idcommande,$fic)
    {

        $this->db->set('NAMEIMAGE',$rep);
        $this->db->set('COMMANDE', $command);
        $this->db->set('NOM_FICHIER',$SousRepert);
        $this->db->set('ID_PREPARATION', $id_preparation);
        $this->db->set('LIEN',$RepertoireACreer);
        $this->db->set('EXTENSION',$export);
        $this->db->set('ID_COMMANDE',$idcommande);
        $this->db->set('FICHIER_CLIENT',$fic);
        return $this->db->insert($this->listimage);
    }
}