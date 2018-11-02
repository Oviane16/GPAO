<script>
    $(document).ready(function() {
        $('#supp_lot').click(function()
        {
            var commande = $("#commande_sup_lot").val();
            if(commande !="Choisir un commande")
            {
                $.ajax({
                    dataType: 'json',
                    //url: 'http://localhost/mikiry/index.php/supp_lot_contrl/supprimer/' + commande,
                    url: 'http://192.168.10.122/mikiry/index.php/supp_lot_contrl/supprimer/' + commande,
                    type:'POST',
                    beforeSend:function()
                    {
                        if($(".loading_sup_lot").length == 0 )
                        {
                                $("#supp_lot").parent().append('<div class="loading_sup_lot"></div>');
                        }
                    },
                    success:function(data)
                    {
                        $(".loading_sup_lot").remove();
                        if(data.alerte)
                        {
                            alert(data.alerte);
                        }
                    }
                });
            }
            else
            {
                alert('Veuiller choisir un commande');
            }
        });
    });
</script>
<legend>Suppression lot</legend>

<div class="form-inline">

    <select name="commande" id="commande_sup_lot">
        <option>Choisir un commande</option>
        <?php
        foreach($commande as $com)
        {
            ?>

            <option><?php echo $com->COMMANDE; ?></option>
        <?php
        }
        ?>
    </select>
&nbsp;&nbsp;&nbsp;
    <button id="supp_lot" class="btn btn-danger">Supprimer</button>

</div>
