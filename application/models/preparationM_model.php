<?php

class PreparationM_model extends CI_Model
{
    protected $table = 'PREPARATION';
    protected $tabl='FICHIER';
    protected $listimage='LISTEIMAGE';
    function get_personnel($matricule,$pass)
    {
        $sql = "SELECT * FROM \"PERSONNEL\" where \"MATRICULE\" = '".$matricule."' AND \"MDP\" = '".$pass."'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
        {   $daty=date('Y-m-d');
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
        else
        {
            return 3 ;
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
public function get_insertionPre($command,$matricule,$lien,$TotalFichier,$traitement,$export,$idcommande,$fic)
{
    $Nombre=0;
    $daty=date('Y-m-d');
    $Ora=date("H:i:s");
    $this->db->set('COMMANDE', $command);
    $this->db->set('TOTAL_FICHIER',   $TotalFichier);
    $this->db->set('SEQUENCE', $Nombre);
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
  public function get_insertionFICHIER($command,$izl,$RepertoireACreer,$SousRepert,$id_preparation,$traitement,$export,$idcommande,$fic)
{
    $this->db->set('NOM_FICHIER', $SousRepert);
    $this->db->set('COMMANDE',   $command);
    $this->db->set('DEBUT_IMAGE',$izl);
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
    public function get_insertionLISTAGE($izyl,$command,$rep,$id_preparation,$RepertoireACreer,$export,$idcommande,$fic)
    {

    $this->db->set('NAMEIMAGE',$izyl);
    $this->db->set('COMMANDE', $command);
    $this->db->set('NOM_FICHIER',$rep);
    $this->db->set('ID_PREPARATION', $id_preparation);
    $this->db->set('LIEN',$RepertoireACreer);
    $this->db->set('EXTENSION',$export);
    $this->db->set('ID_COMMANDE',   $idcommande);
    $this->db->set('FICHIER_CLIENT',   $fic);
    return $this->db->insert($this->listimage);
    }
    public function get_updatePREPARATION($TotalFichier,$command)
    {

        $this->db->set('TOTAL_FICHIER',$TotalFichier);
        $this->db->where('COMMANDE', $command);
        return $this->db->update($this->table);

    }
}