<script>
    $("document").ready(function (){
        $("#commande").change(function()
        {
            if($(this).val() != 'Choisisser un commande')
            {
                $.ajax({
                    type: 'post',
                    url: 'http://localhost/mikiry/index.php/affiche_table_contrl/list_nom_fic/' + $("#commande option:selected" ).text(),
                    //url: 'http://192.168.10.122/mikiry/index.php/adminEnPouce/etape/' + $("#commande option:selected" ).text(),
                    beforeSend :function()
                    {
                        if($(".loading").length == 0 )
                        {
                            $("#etape").parent().append('<div class="loading"></div>');
                        }
                    },
                    success: function (data) {
                        $(".loading").remove();
                        $('#list_result').empty();
                        $('#list_fic').empty();
                        $('#etap').empty();
                        $('#list_fic').html(data);
                        $('#list_fic').fadeIn(500);
                    }
                });
            }
        });




    });
</script>


    <legend>Affichage et suppression table</legend>
    <form method="post">
        <div style="float: left;" >
            <select  id="commande">
                <option>Choisisser un commande</option>
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

    <div  id="list_fic" style="width:450px; height:170px; top: -20px; float:left; left: 1%;  overflow:auto;position: relative;">

    </div>

    <div  style="  float:left; left: 2%; position: relative; top: -20px; " >
        <select  id="etap">
        </select>

    </div>
    <div  id="list_result" style="width:97%; min-height: 55px; max-height: 200px; height: auto; top: 10px; bottom : auto; float:left; left: 1%; border: solid rgba(0, 0, 0, 0.08) 1px;  overflow:auto;position: relative;">

    </div>

    <div style=" float:left; left: 2%; position: relative; top: 20px; ">
        <input id="checkAll" type="checkbox"> Tout cocher/Tout decocher</br></br></br>

        <button type="button" id="supprimer" class="btn btn-danger">Supprimer</button>
    </div>
    </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>