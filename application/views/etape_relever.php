<option>Choisir une etape</option>
<?php
if(isset($etape))
{
    foreach($etape as $eta)
    {
        ?>
        <option><?php echo $eta->ETAPE; ?></option>
    <?php
    }
}
else
{
    echo $erreur;
}

?>