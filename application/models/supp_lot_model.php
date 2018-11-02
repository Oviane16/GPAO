<?php
Class Supp_lot_model extends CI_Model
{
    public function supprimer($commande)
    {
        $this->db->where('COMMANDE',$commande );
        $this->db->delete('LISTEIMAGE');

        $this->db->where('COMMANDE',$commande );
        $this->db->delete('FICHIER');

        $this->db->where('COMMANDE',$commande );
        $this->db->delete('PREPARATION');

        $this->db->where('COMMANDE',$commande );
        $this->db->delete('ETAPE');
        return $this->db->trans_complete();

    }
}
?>