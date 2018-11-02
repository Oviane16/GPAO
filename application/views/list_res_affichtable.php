<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th></th>
            <th>N_ENR</th>
            <th>N_IMA</th>
            <th>MATRICULE</th>
            <th>COMMANDE</th>
            <th>ID_COMMANDE</th>
            <th>ETAPE</th>
            <th>N_LOT</th>
            <th>NOM</th>

        </tr>
    </thead>
    <tbody>
        <?php
        if(isset($fichier))
        {
            foreach($fichier as $fic)
            {
                ?>
               <tr>
                   <td><input name="checkbox[]" id="check" value="misy" class="checkbox1" n_lot="<?php echo $fic->N_LOT; ?>" etape="<?php echo $fic->ETAPE; ?>" n_enr="<?php echo $fic->N_ENR; ?>" commande="<?php echo $fic->COMMANDE; ?>" type="checkbox" id="checkbox[]"></td>
                <td>
                    <?php echo $fic->N_ENR; ?>
                </td>
                   <td>
                       <?php echo $fic->N_IMA ;?>
                   </td>
                   <td>
                       <?php echo $fic->MATRICULE ?>
                   </td>
                   <td>
                       <?php echo $fic->COMMANDE;?>
                   </td>
                   <td>
                       <?php echo $fic->ID_COMMANDE ;?>
                   </td>
                   <td>
                       <?php echo $fic->ETAPE;?>
                   </td>
                   <td>
                       <?php echo $fic->N_LOT;?>
                   </td>
                   <td>
                       <?php echo $fic->NOM;?>
                   </td>
               </tr>
        <?php
            }
        }
        else
        {
            echo $auc_fic;
        }
        ?>
    </tbody>
</table>
<?php

?>