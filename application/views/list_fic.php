<?php
if(isset($fichier))
{
    foreach($fichier as $fic)
    {
        ?>
        <tr>
            <td><input  name="checkbox[]" class="checkbox1"  type="checkbox" id="checkbox[]" value="<?php echo $fic->idfichier?>"></td>
            <td><?php echo $fic->NOM_FICHIER; ?></td>
            <td><?php echo $fic->COMMANDE; ?></td>
            <td><?php echo $fic->matricule; ?></td>
            <td><?php echo $et;?></td>
            <td><?php  if($fic->etat == 0)
                    $e = 'Non traité';
                if($fic->etat == 2)
                    $e = 'Fini';
                if($fic->etat == 1)
                    $e = 'En cours';
                if($fic->etat == 3)
                    $e = 'Rejeté';
                echo $e; ?></td>
            <td>
            </td>
        </tr>
    <?php
    }

}?>


<?php if(!isset($fichier) && !isset($fichierAuc) ){
?>       <script> alert('Auccun fichier trouver')</script>
<?php } ?>

<?php
if(isset($fichierAuc))
{
    foreach($fichierAuc as $fic)
    {
        ?>
        <tr>
            <td></td>
            <td> </td>
            <td><?php echo $fic->NOM_FICHIER; ?></td>
            <td><?php echo $fic->COMMANDE; ?></td>
            <td><?php echo $fic->MATRICULE; ?></td>
            <td><?php echo $fic->ETAPE;?></td>
            <td><?php  if($fic->ETAT == 0)
                    $e = 'Non traité';
                if($fic->ETAT == 2)
                    $e = 'Fini';
                if($fic->ETAT == 1)
                    $e = 'En cours';
                if($fic->ETAT == 3)
                    $e = 'Rejeté';
                echo $e; ?></td>
            <td>
            </td>
        </tr>
    <?php
    }

}?>
<?php
if(isset($erreur_et_sup))
{
    echo $erreur_et_sup;
}
if(isset($rapp_auc_fic_mfini))
{
    echo $rapp_auc_fic_mfini;
}
if(isset($auc_fic_fini))
{
    echo $auc_fic_fini;
}
if(isset($erreur_et_controle))
{
    echo $erreur_et_controle;
}
if(isset($erreur_et_lect))
{
    echo $erreur_et_lect;
}
if(isset($rapp_et_cntrl_nonfini))
{
    echo $rapp_et_cntrl_nonfini;
}
?>

