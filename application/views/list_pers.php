<?php if(isset($personnel))
{
    foreach($personnel as $pers)
    {
        ?><tr>
        <td><?php echo $pers->NOM; ?></td>
        <td><?php echo $pers->PRENOM; ?></td>
        <td><?php echo $pers->MATRICULE ?></td>
        <td><?php echo $pers->FONCTION ?></td>
        <td><?php echo $pers->ACTION ?></td>
        <td><?php echo $pers->PORTABLE ?></td>
        <td><button data-target="#myModal" id="modifier" value="<?php echo $pers->idpersonnel?>" data-toggle="modal" class="btn btn-mini btn-info" type="button">Modifier</button></td>
        </tr>
    <?php
    }
}?>