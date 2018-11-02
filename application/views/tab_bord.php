
<script>
    $(document).ready(function() {
                $("#commande").change(function () {
                    if($(this).val() != "Choisir une commande"){
                    $.ajax({
                        type: "POST",
                       // url: "http://localhost/mikiry/index.php/tab_bord/get_data/" + $( "#commande option:selected" ).text() ,
                        url: "http://localhost/mikiry/index.php/tab_bord/get_data/" + $( "#commande option:selected" ).text() ,
                        success: function(data) {
                            $('#graphe').empty();
                            $('#graphe').html(data);
                        }
                    });}
                });

                $("#actualiser").click(function () {
                    var commande = $('#commande').val();
                    if(commande != "Choisir une commande"){
                        $.ajax({
                            type: "POST",
                          //  url: "http://localhost/mikiry/index.php/tab_bord/get_data/" + $( "#commande option:selected" ).text() ,
                            url: "http://localhost/mikiry/index.php/tab_bord/get_data/" + $( "#commande option:selected" ).text() ,
                            success: function(data) {
                                $('#graphe').empty().hide();
                                $('#graphe').append(data);
                            }
                        });}
                });


    });
</script>



<legend>Tableau de bord</legend>


<div class="input-append">
    <select name="commande" id="commande">
        <option>Choisir une commande</option>
        <?php
        foreach($commande as $com)
        {
            ?>
            <option><?php echo $com->COMMANDE; ?></option>
        <?php
        }
        ?>
    </select>
    <button class="btn btn-info" id="actualiser" type="button">Actualiser</button>
</div>

<div id="graphe">

</div>

