<?php
Class Supp_lot_contrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('assets_helper');
        $this->load->model('supp_lot_model');
    }
    public function index()
    {
        $this->load->model('adminenpouce_model');
        $data['commande'] = $this->adminenpouce_model->get_commande();
        $this->load->view('supp_lot_view',$data);
    }
    public function supprimer($commande='')
    {
        $rapport_sup = 0;
        $rapport_sql = $this->supp_lot_model->supprimer($commande);
        $doss = substr($commande,0,4);
        $rep_commande = ("C:\\reserve\\$doss\\$commande");
        $dossier = "$rep_commande";

        if (is_dir($dossier) === true)
        {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dossier), RecursiveIteratorIterator::CHILD_FIRST);

            foreach ($files as $file)
            {
                if (in_array($file->getBasename(), array('.', '..')) !== true)
                {
                    if ($file->isDir() === true)
                    {
                        rmdir($file->getPathName());
                    }

                    else if (($file->isFile() === true) || ($file->isLink() === true))
                    {
                        unlink($file->getPathname());
                    }
                }
            }
            chmod($dossier, 0777);
            if(rmdir($dossier))
            {
                $rapport_sup = 1;
            };
        }


        if($rapport_sql==true && $rapport_sup==1)
        {
            $data['alerte'] = "Lot:$commande bien supprimé depuis la base et depuis image ";
        }
        else if($rapport_sql==1 && $rapport_sup==0)
        {
            $data['alerte'] = "Lot:$commande bien supprimé depuis la base mais pas depuis l'image";
        }
        else if($rapport_sql==false && $rapport_sup==1)
        {
            $data['alerte'] = "Lot:$commande bien supprimé  depuis l'image mais pas depuis la base";
        }
        else if($rapport_sql==false && $rapport_sup==0)
        {
            $data['alerte'] = "Erreur de suppression";
        }
        echo json_encode($data);
    }
}
?>