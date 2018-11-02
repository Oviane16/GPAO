<div id="table">
    <table  class="table table-hover" >
        <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Matricule</th>
            <th>Fonction</th>
            <th>Action</th>
            <th>Tel</th>
        </tr>
        </thead>
        <tbody id="list_pers">
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
        </tbody>
    </table>
</div>


<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modification du personnel</h3>
    </div>
    <div class="modal-body">
        <div id="form_modif">

        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
        <button type="button" data-dismiss="modal" id="sauver_modif" class="btn btn-success" aria-hidden="true">Sauver</button>
    </div>
</div>
</div>

