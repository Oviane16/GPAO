<?php

 class Adminenpouce_model extends CI_Model
 {
     protected $table = 'FICHIER';
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
     function get_personnel($matricule, $motdepasse )
     {
            $sql = "SELECT * FROM \"PERSONNEL\" where \"MATRICULE\" = '".$matricule."' AND \"MDP\" = '".$motdepasse."'";
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
     public function get_commande()
     {
         $sql = "SELECT DISTINCT \"COMMANDE\" FROM \"FICHIER\" where \"POSITION_FINALE\" = '0' ORDER BY \"COMMANDE\" ";
         $query = $this->db->query($sql);
         $commande = array();
         if($query->num_rows() > 0)
         {
             foreach ($query->result() as $row)
             {
                 $commande[] = $row;
             }
             return $commande;
         }
     }

     public function get_fichierS_aucun($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_SAISIE\" as MATRICULE ,\"ETAT_SAISIE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."'   and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierS_aucun_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_SAISIE\" as MATRICULE ,\"ETAT_SAISIE\" as ETAT FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierC_aucun($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_CONTROLE\" as MATRICULE ,\"ETAT_CONTROLE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."'   and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierC_aucun_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_CONTROLE\" as MATRICULE ,\"ETAT_CONTROLE\" as ETAT FROM \"FICHIER\" where  \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLi_aucun($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LIVRAISON\" as MATRICULE ,\"ETAT_LIVRAISON\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."'   and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLi_aucun_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LIVRAISON\" as MATRICULE ,\"ETAT_LIVRAISON\" as ETAT FROM \"FICHIER\" where  \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLec_aucun($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LECTURE\" as MATRICULE ,\"ETAT_LECTURE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."'   and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLec_aucun_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LECTURE\" as MATRICULE ,\"ETAT_LECTURE\" as ETAT FROM \"FICHIER\" where  \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_etape($commande)
     {
         $sql = "select \"ETAPE\" from \"ETAPE\" where \"COMMANDE\" = '".$commande."'";
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
     public function get_fichierS_encours($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_SAISIE\" as MATRICULE ,\"ETAT_SAISIE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_SAISIE\"='1'  and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierS_encours_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_SAISIE\" as MATRICULE ,\"ETAT_SAISIE\" as ETAT FROM \"FICHIER\" where  \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' and \"ETAT_SAISIE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierS_nontraite($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_SAISIE\" as MATRICULE ,\"ETAT_SAISIE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."'  and \"ETAT_SAISIE\"='0' and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierS_nontraite_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_SAISIE\" as MATRICULE ,\"ETAT_SAISIE\" as ETAT FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."' and \"ETAT_SAISIE\"='0' and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }

     public function get_fichierS_rejete($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_SAISIE\" as MATRICULE ,\"ETAT_SAISIE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_SAISIE\" ='3'  and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0'  ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierS_rejete_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_SAISIE\" as MATRICULE ,\"ETAT_SAISIE\" as ETAT FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."' and \"ETAT_SAISIE\"='3'   and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierS_fini($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_SAISIE\" as MATRICULE ,\"ETAT_SAISIE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_SAISIE\"='2'   and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0'  ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierS_fini_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_SAISIE\" as MATRICULE ,\"ETAT_SAISIE\" as ETAT FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."' and \"ETAT_SAISIE\"='2' and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierC_nontraite($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_CONTROLE\" as MATRICULE ,\"ETAT_CONTROLE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_CONTROLE\"='0'  and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierC_nontraite_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_CONTROLE\" as MATRICULE ,\"ETAT_CONTROLE\" as ETAT FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."' and \"ETAT_CONTROLE\"='0'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierC_encours($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_CONTROLE\" as MATRICULE ,\"ETAT_CONTROLE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_CONTROLE\"='1'  and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierC_encours_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_CONTROLE\" as MATRICULE ,\"ETAT_CONTROLE\" as ETAT FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' and \"ETAT_CONTROLE\" = '1' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierC_fini($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_CONTROLE\" as MATRICULE ,\"ETAT_CONTROLE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_CONTROLE\"='2'   and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0'  ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierC_fini_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_CONTROLE\" as MATRICULE ,\"ETAT_CONTROLE\" as ETAT FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."' and \"ETAT_CONTROLE\"='2' and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLi_encours($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LIVRAISON\" as MATRICULE ,\"ETAT_LIVRAISON\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_LIVRAISON\"='1'   and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLi_encours_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LIVRAISON\" as MATRICULE ,\"ETAT_LIVRAISON\" as ETAT FROM \"FICHIER\" where  \"COMMANDE\" = '".$commande."' and \"ETAT_LIVRAISON\" = '1'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLi_fini($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LIVRAISON\" as MATRICULE ,\"ETAT_LIVRAISON\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_LIVRAISON\"='2'  and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLi_nontraite($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LIVRAISON\" as MATRICULE ,\"ETAT_LIVRAISON\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_LIVRAISON\"='0'  and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLi_nontraite_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LIVRAISON\" as MATRICULE ,\"ETAT_LIVRAISON\" as ETAT FROM \"FICHIER\" where  \"COMMANDE\" = '".$commande."' and \"ETAT_LIVRAISON\"='0' and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLi_fini_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LIVRAISON\" as MATRICULE ,\"ETAT_LIVRAISON\" as ETAT FROM \"FICHIER\" where  \"COMMANDE\" = '".$commande."' and \"ETAT_LIVRAISON\"='2' and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }


     public function get_fichierLec_nontraite($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LECTURE\" as MATRICULE ,\"ETAT_LECTURE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_LECTURE\"='0'  and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }

     public function get_fichierLec_nontraite_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LECTURE\" as MATRICULE ,\"ETAT_LECTURE\" as ETAT FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."' and \"ETAT_LECTURE\"='0' and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLec_encours($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LECTURE\" as MATRICULE ,\"ETAT_LECTURE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_LECTURE\"='1'  and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLec_encours_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LECTURE\" as MATRICULE ,\"ETAT_LECTURE\" as ETAT FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."' and \"ETAT_LECTURE\" = '1'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLec_fini($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LECTURE\" as MATRICULE ,\"ETAT_LECTURE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_LECTURE\"='2'   and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLec_fini_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LECTURE\" as MATRICULE ,\"ETAT_LECTURE\" as ETAT FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."' and \"ETAT_LECTURE\"='2'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierF_aucun($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LECTURE\" as MATRICULE ,\"ETAT_FORMATAGE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."'   and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierF_aucun_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_FORMATAGE\" as MATRICULE ,\"ETAT_FORMATAGE\" as ETAT FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierF_encours($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_FORMATAGE\" as MATRICULE ,\"ETAT_FORMATAGE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_FORMATAGE\"='1'   and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierF_encours_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_FORMATAGE\" as MATRICULE ,\"ETAT_FORMATAGE\" as ETAT FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."' and \"ETAT_FORMATAGE\"='1'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function  get_fichierF_nontraite($commande,$nom_fichierD
         ,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LECTURE\" as MATRICULE ,\"ETAT_LECTURE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_FORMATAGE\"='0'   and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\"  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function  get_fichierF_nontraite_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_FORMATAGE\" as MATRICULE ,\"ETAT_FORMATAGE\" as ETAT FROM \"FICHIER\" where \"COMMANDE\" = '".$commande."' and \"ETAT_FORMATAGE\"='0'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }

     public function get_fichierF_fini($commande,$nom_fichierD,$nom_fichierF)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LECTURE\" as MATRICULE ,\"ETAT_LECTURE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" BETWEEN '".$nom_fichierD."' and   '".$nom_fichierF."' and \"ETAT_FORMATAGE\"='2'   and \"COMMANDE\" = '".$commande."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierF_fini_dea($commande)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_FORMATAGE\" as MATRICULE ,\"ETAT_FORMATAGE\" as ETAT FROM \"FICHIER\" where  \"COMMANDE\" = '".$commande."' and \"ETAT_FORMATAGE\"='2' and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }


     function marquerfini_multiple($id, $data,$commande,$nom_fichier,$matricule ,$et,$nom_fic_complet )
     {
         $date= date('Y-m-d');
         $heurre = date('Y-m-d');
        // var_dump($date);
         $this->db->set('DATEFIN',$date);
         $this->db->set('HEUREFIN',$heurre);
         $this->db->where('COMMANDE',$commande);
         $this->db->where('NOM_FICHIER',$nom_fic_complet);
         $this->db->where('MATRICULE',$matricule);
         $this->db->where('ETAPE',$et);
         $this->db->set('ID_COMMANDE',$commande);
         $this->db->update( 'FICHIER_UN_A_UN');


         $this->db->set('DATEFIN',$date);
         $this->db->set('ORAFIN',$heurre);
         $this->db->where('COMMANDE',$commande);;
         $this->db->where('LOT',$nom_fichier);
        // $this->db->where('MATRICULE',$matricule);
         $this->db->where('ETAT_SAISIE','2');
         $this->db->update( 'SUIVI_FICHIER');


         $this->db->where( 'idfichier', $id );
         $this->db->update( 'FICHIER', $data );

         $report = array();
         $report['error'] = $this->db->_error_number();
         $report['message'] = $this->db->_error_message();
         return $report;
     }
     public function verfier_etat_modifier( $id )
     {
       return  $this->db->select('*')
             ->from($this->table)
            ->where('idfichier', $id)
             ->get()
             ->result();
     }
     public function attribuer_multiple($id,$data,$commande,$nom_fichier,$nouveau_mat,$et,$nom_fic_complet)
     {
         $id_commande = $commande;
         $date= date('Y-m-d');
         $heurre = date('H:i:s');
         // var_dump($date);
        if($et =='SAISIE 1' || $et == 'OCR' || $et == 'SAISIE' || $et == 'IMAGE' || $et == 'TRANSFORMATION')
        {
            $this->db->set('DATEDEBUT',$date);
            $this->db->set('HEUREDEBUT',$heurre);
            $this->db->set('COMMANDE',$commande);
            $this->db->set('NOM_FICHIER',$nom_fic_complet);
            $this->db->set('MATRICULE',$nouveau_mat);
            $this->db->set('ETAPE',$et);
            $this->db->set('LOT',$nom_fichier);
            $this->db->set('ETAT','1');
            $this->db->set('ID_COMMANDE',$id_commande);
            $this->db->insert( 'FICHIER_UN_A_UN');

            $this->db->where('LOT',$nom_fichier );
            $this->db->where('ETAPE',$et );
            $this->db->delete('SUIVI_FICHIER');

            $this->db->set('DATEDEBUT',$date);
            $this->db->set('ORADEBUT',$heurre);
            $this->db->set('COMMANDE',$commande);
            $this->db->set('LOT',$nom_fichier);
            $this->db->set('NOM_FICHIER',$nom_fic_complet);
            $this->db->set('MATRICULE',$nouveau_mat);
            $this->db->set('MACHINE','');
            $this->db->set('ETAPE',$et);
            $this->db->set('ETAT_SAISIE','1');
            $this->db->insert( 'SUIVI_FICHIER');

            $this->db->where( 'idfichier', $id );
            $this->db->update( 'FICHIER', $data );
        }
         if($et == 'CONTROLE WEB' || $et == 'CONTROLE ECH' || $et == 'CONTROLE'  )
         {
             $this->db->set('DATEDEBUT',$date);
             $this->db->set('HEUREDEBUT',$heurre);
             $this->db->set('COMMANDE',$commande);
             $this->db->set('NOM_FICHIER',$nom_fic_complet);
             $this->db->set('MATRICULE',$nouveau_mat);
             $this->db->set('ETAPE',$et);
             $this->db->set('LOT',$nom_fichier);
             $this->db->set('ETAT','1');
             $this->db->set('ID_COMMANDE',$id_commande);
             $this->db->insert( 'FICHIER_UN_A_UN');

             $this->db->where('LOT',$nom_fichier );
             $this->db->where('ETAPE',$et );
             $this->db->delete('SUIVI_FICHIER');

             $this->db->set('DATEDEBUT',$date);
             $this->db->set('ORADEBUT',$heurre);
             $this->db->set('COMMANDE',$commande);
             $this->db->set('LOT',$nom_fichier);
             $this->db->set('NOM_FICHIER',$nom_fic_complet);
             $this->db->set('MATRICULE',$nouveau_mat);
             $this->db->set('MACHINE','');
             $this->db->set('ETAPE',$et);
             $this->db->set('ETAT_SAISIE','1');
             $this->db->insert( 'SUIVI_FICHIER');

             $this->db->where( 'idfichier', $id );
             $this->db->update( 'FICHIER', $data );
         }
         if( $et == 'LECTURE' || $et == 'RECHERCHE')
         {
             $this->db->set('DATEDEBUT',$date);
             $this->db->set('HEUREDEBUT',$heurre);
             $this->db->set('COMMANDE',$commande);
             $this->db->set('NOM_FICHIER',$nom_fic_complet);
             $this->db->set('MATRICULE',$nouveau_mat);
             $this->db->set('ETAPE',$et);
             $this->db->set('LOT',$nom_fichier);
             $this->db->set('ETAT','1');
             $this->db->set('ID_COMMANDE',$id_commande);
             $this->db->insert( 'FICHIER_UN_A_UN');

             $this->db->where('LOT',$nom_fichier );
             $this->db->where('ETAPE',$et );
             $this->db->delete('SUIVI_FICHIER');

             $this->db->set('DATEDEBUT',$date);
             $this->db->set('ORADEBUT',$heurre);
             $this->db->set('COMMANDE',$commande);
             $this->db->set('LOT',$nom_fichier);
             $this->db->set('NOM_FICHIER',$nom_fic_complet);
             $this->db->set('MATRICULE',$nouveau_mat);
             $this->db->set('MACHINE','');
             $this->db->set('ETAPE',$et);
             $this->db->set('ETAT_SAISIE','1');
             $this->db->insert( 'SUIVI_FICHIER');

             $this->db->where( 'idfichier', $id );
             $this->db->update( 'FICHIER', $data );
         }
         if( $et == 'FORMATAGE' )
         {
             $this->db->set('DATEDEBUT',$date);
             $this->db->set('HEUREDEBUT',$heurre);
             $this->db->set('COMMANDE',$commande);
             $this->db->set('NOM_FICHIER',$nom_fic_complet);
             $this->db->set('MATRICULE',$nouveau_mat);
             $this->db->set('ETAPE',$et);
             $this->db->set('LOT',$nom_fichier);
             $this->db->set('ETAT','1');
             $this->db->set('ID_COMMANDE',$id_commande);
             $this->db->insert( 'FICHIER_UN_A_UN');

             $this->db->where('LOT',$nom_fichier );
             $this->db->where('ETAPE',$et );
             $this->db->delete('SUIVI_FICHIER');

             $this->db->set('DATEDEBUT',$date);
             $this->db->set('ORADEBUT',$heurre);
             $this->db->set('COMMANDE',$commande);
             $this->db->set('LOT',$nom_fichier);
             $this->db->set('NOM_FICHIER',$nom_fic_complet);
             $this->db->set('MATRICULE',$nouveau_mat);
             $this->db->set('MACHINE','');
             $this->db->set('ETAPE',$et);
             $this->db->set('ETAT_SAISIE','1');
             $this->db->insert( 'SUIVI_FICHIER');

             $this->db->where( 'idfichier', $id );
             $this->db->update( 'FICHIER', $data );
         }
         if( $et == 'LIVRAISON' )
         {
             $this->db->set('DATEDEBUT',$date);
             $this->db->set('HEUREDEBUT',$heurre);
             $this->db->set('COMMANDE',$commande);
             $this->db->set('NOM_FICHIER',$nom_fic_complet);
             $this->db->set('MATRICULE',$nouveau_mat);
             $this->db->set('ETAPE',$et);
             $this->db->set('LOT',$nom_fichier);
             $this->db->set('ETAT','1');
             $this->db->set('ID_COMMANDE',$id_commande);
             $this->db->insert( 'FICHIER_UN_A_UN');

             $this->db->where('LOT',$nom_fichier );
             $this->db->where('ETAPE',$et );
             $this->db->delete('SUIVI_FICHIER');

             $this->db->set('DATEDEBUT',$date);
             $this->db->set('ORADEBUT',$heurre);
             $this->db->set('COMMANDE',$commande);
             $this->db->set('LOT',$nom_fichier);
             $this->db->set('NOM_FICHIER',$nom_fic_complet);
             $this->db->set('MATRICULE',$nouveau_mat);
             $this->db->set('MACHINE','');
             $this->db->set('ETAPE',$et);
             $this->db->set('ETAT_SAISIE','1');
             $this->db->insert( 'SUIVI_FICHIER');

             $this->db->where( 'idfichier', $id );
             $this->db->update( 'FICHIER', $data );
         }
     }
     public function get_fichierS_unique($nom_fichierD)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_SAISIE\" as MATRICULE ,\"ETAT_SAISIE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\"='".$nom_fichierD."'   and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierC_unique($nom_fichierD)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_CONTROLE\" as MATRICULE ,\"ETAT_CONTROLE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\"='".$nom_fichierD."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierF_unique($nom_fichierD)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_FORMATAGE\" as MATRICULE ,\"ETAT_FORMATAGE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\"='".$nom_fichierD."'  and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLi_unique($nom_fichierD)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LIVRAISON\" as MATRICULE ,\"ETAT_LIVRAISON\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\" ='".$nom_fichierD."'   and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichierLec_unique($nom_fichierD)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LECTURE\" as MATRICULE ,\"ETAT_LECTURE\" as ETAT FROM \"FICHIER\" where \"NOM_FICHIER\"= '".$nom_fichierD."' and \"POSITION_FINALE\" = '0' ORDER BY \"NOM_FICHIER\" ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichier($id)
     {
         $sql = "SELECT * FROM \"FICHIER\" where idfichier= '".$id."'  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }

     function initialiser_multiple( $id, $data,$commande,$nom_fichier,$mat_modificateur,$et,$matricule,$ext)
     {
         $date= date('Y-m-d');
         $heurre = date('H:i:s');
         $this->db->where('COMMANDE',$commande);
         $this->db->where('LOT',$nom_fichier);
         $this->db->set('DATE_MODIF',$date);
         $this->db->set('OBSERVATIONS','Reinitialiser');
         $this->db->set('MATRICULE_MODIFICATEUR',$mat_modificateur);
         $this->db->set('OBSERVATIONS','Reinitialiser');
         $this->db->set('HEURE_MODIFICATEUR',$heurre);
         $this->db->set('HEUREFIN',$heurre);
         $this->db->set('ID_COMMANDE',$commande);
         $this->db->update( 'FICHIER_UN_A_UN');




          $nombrecaractere =  $this->get_nombre_caractere($nom_fichier,$commande,$commande,$et,$matricule);


         $this->db->set('NOM_FICHIER',$nom_fichier );
         $this->db->set('COMMANDE',$commande );
         $this->db->set('ETAPE',$et );
         $this->db->set('MATRICULE_TRAITEUR',$matricule );
         $this->db->set('MATRICULE_EFFACEUR', $mat_modificateur);
         $this->db->set('DATE_SUPPRESSION',$date );
         $this->db->set('HEURE_SUPPRESSION',$heurre );
         $this->db->set('NOMBRECARACTERE',$nombrecaractere);
         $this->db->insert('SUIVI_SUPPRESSION');

         $this->db->where('LOT',$nom_fichier );
         $this->db->where('ETAPE',$et );
         $this->db->delete('SUIVI_FICHIER');

         $this->db->where( 'idfichier', $id );
         $this->db->update( 'FICHIER', $data );

         $report = array();
         $report['error'] = $this->db->_error_number();
         $report['message'] = $this->db->_error_message();
         return $report;

     }
     public function get_nombre_caractere($nom_fichier,$commande,$commande,$et,$matricule)
     {
         $sql = "SELECT DISTINCT \"NOMBRECARACTERE\" FROM \"FICHIER_UN_A_UN\" where \"LOT\" ='".$nom_fichier."' and \"COMMANDE\"= '".$commande."' and \"ETAPE\" = '".$et."' and \"MATRICULE\" = '".$matricule."' ORDER BY  \"NOMBRECARACTERE\" desc ";
         $query = $this->db->query($sql);
         $nombrecaractere = array();
        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $nombrecaractere = $row->NOMBRECARACTERE;
            }
            return $nombrecaractere[0];
        }
     }
     public function get_fichier_modifierS($id)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_SAISIE\" as MATRICULE ,\"ETAT_SAISIE\" as ETAT FROM \"FICHIER\" where idfichier= '".$id."'  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }


     }
     public function get_fichier_modifierC($id)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_CONTROLE\" as MATRICULE ,\"ETAT_CONTROLE\" as ETAT FROM \"FICHIER\" where idfichier= '".$id."'  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichier_modifierLi($id)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LIVRAISON\" as MATRICULE ,\"ETAT_LIVRAISON\" as ETAT FROM \"FICHIER\" where idfichier= '".$id."'  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichier_modifierLec($id)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_LECTURE\" as MATRICULE ,\"ETAT_LECTURE\" as ETAT FROM \"FICHIER\" where idfichier= '".$id."'  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }
     }
     public function get_fichier_modifierF($id)
     {
         $sql = "SELECT idfichier,\"COMMANDE\",\"NOM_FICHIER\",\"MATRICULE_FORMATAGE\" as MATRICULE,\"ETAT_FORMATAGE\" as ETAT FROM \"FICHIER\" where idfichier= '".$id."'  ";
         $query = $this->db->query($sql);
         $fichier = array();
         if($query->num_rows() > 0)
         {
             foreach($query->result() as $row)
             {
                 $fichier[] = $row;
             }
             return $fichier;
         }

     }

 }

