<script>
    $("document").ready(function (){
        $("#commande_affiche").change(function()
        {
            if($(this).val() != 'Choisir une commande')
            {
                $.ajax({
                    type: 'post',
                   // url: 'http://192.168.10.122/mikiry/index.php/affiche_table_contrl/list_nom_fic/' + $("#commande option:selected" ).text(),
                    url: 'http://198.168.10.122/index.php/affiche_table_contrl/list_nom_fic/' + $("#commande_affiche option:selected" ).text(),
                    success: function (data) {
                        $(".loading").remove();
                        $('#list_result').empty();
                        $('#list_fic').empty();
                        $('#etap_affiche').empty();
                        $('#list_fic').html(data);
                        $('#list_fic').fadeIn(500);
                    }
                });
            }
        });

        $("#etap_affiche").change(function()
        {
            var idfichier = $("input[name='optradio']:checked").val();
            var command = $('#commande_affiche').val();
            var etape = $('#etap_affiche').val();

            $.ajax({
                url: 'http://198.168.10.122/index.php/affiche_table_contrl/get_list_result/' + etape +'/' + command +'/' + idfichier,
                //url: 'http://192.168.10.122/mikiry/index.php/affiche_table_contrl/get_list_result/' + etape +'/' + command +'/' + idfichier,
                type: 'POST',
                success: function(data) {
                    if(data)
                    {
                        $('#list_result').empty().hide();
                        $("#list_result").append(data);
                        $('#list_result').fadeIn(500);
                    }
                }
            });

        });

    });

</script>


<fieldset>
    <legend>Affichage et suppression table</legend>
<form method="post">
    <div style="float: left;" >
        <select  id="commande_affiche">
            <option>Choisir une commande</option>
            <?php
            if(isset($commande_encours))
            {
                foreach($commande_encours as $com)
                {
                    ?>
                    <option><?php echo $com->COMMANDE;?></option>
                <?php
                }
            }
            ?>
        </select>

</form>
</div>

<div  id="list_fic" style="width:450px; height:170px; top: -20px; border: 1px solid rgba(2, 4, 3, 0.11); float:left; left: 1%;  overflow:auto;position: relative;">

</div>

<div  style="  float:left; left: 2%; position: relative; top: -20px; " >
    <select  id="etap_affiche">
    </select>

</div>
<div  id="list_result" style="width:97%; min-height: 55px; max-height: 200px; height: auto; top: 10px; bottom : auto; float:left; left: 1%; border: solid rgba(0, 0, 0, 0.08) 1px; bottom: auto; overflow:auto;position: relative;">

</div>
</br></br></br>
<div style=" float:left; left: 2%; position: relative; top: 10px; ">
    <input id="checkAll" type="checkbox"> Tout cocher/Tout decocher</br></br>

    <button type="button" id="supprimer" class="btn btn-danger">Supprimer</button>
</div>
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></brr
</fieldset>


</fieldset>