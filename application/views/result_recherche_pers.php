<script>
    $("#table tbody tr td #modifier").click(function()
    {
        var id = 0;
        var id = $(this).val();
        $.ajax({
            type: 'POST',
            url: "http://localhost/mikiry/index.php/enregist_pers/modifier/"+ id,
            success: function(data)
            {
                $("#form_modif").empty().hide();
                $("#form_modif").append(data);
                $('#form_modif').fadeIn(500);
            }
        });
    });
</script>

<script>

    $("document").ready(function () {
        $("#nav_personnel li a").click(function(){
            var req = $(this).attr("name");
            $.ajax({
                type: "GET",
                url: "http://localhost/mikiry/index.php/" +req,
                dataType : "html",
                error:function(msg, string){
                    alert( "Error !: " + string );
                },
                success:function(data){
                    $("#accueil").empty().hide();
                    $("#accueil").append(data);
                    $('#accueil').fadeIn(500);
                }
            });
        });

        /* $("#voir_list_pers").click(function()
         {
         $.ajax({
         type: "GET",
         url: "http://localhost/Mikiry/index.php/enregist_pers/list_pers",
         error:function(msg, string){
         alert( "Error !: " + string );
         },
         success:function(data){
         $("#form_modif").empty().hide();
         $("#list_pers").empty().hide();
         $("#list_pers").append(data);
         $('#list_pers').fadeIn(500);
         }
         });
         }); */
        $("#matricule_mjr").keyup(function()
        {
            var matricule = $(this).val();
            var data = 'motclef=' + matricule;
            if(matricule.length > 2)
            {
                $.ajax({
                    type: 'GET',
                    url: "http://localhost/mikiry/index.php/enregist_pers/recherche_pers",
                    data: data,
                    success: function(data)
                    {
                        $("#list_pers").empty().hide();
                        $("#list_pers").append(data);
                        $('#list_pers').fadeIn(500);
                    }
                });
            }
        })
        $("#sauver_modif").click(function()
        {
            var form_data = {
                nom : $('#nom').val(),
                prenom : $('#prenom').val(),
                sexe :$('#sexe').val(),
                date_naiss :$('#date_naiss').val(),
                lieu_naiss :$('#lieu_naiss').val(),
                nom_mere :$('#nom_mere').val(),
                nom_pere :$('#nom_pere').val(),
                cin :$('#cin').val(),
                date_cin :$('#date_cin').val(),
                lieu_cin :$('#lieu_cin').val(),
                situation :$('#situation').val(),
                nb_enfant :$('#nb_enfant').val(),
                conjoint :$('#conjoint').val(),
                adresse :$('#adresse').val(),
                cp :$('#cp').val(),
                ville :$('#ville').val(),
                tel_fixe :$('#tel_fixe').val(),
                tel_portable :$('#tel_portable').val(),
                email :$('#email').val(),
                cnaps :$('#cnaps').val(),
                ostie :$('#ostie').val(),
                categorie :$('#categorie').val(),
                pseudo :$('#pseudo').val(),
                mdp :$('#mdp').val(),
                confirm_mdp :$('#confirm_mdp').val(),
                fonction :$('#fonction').val(),
                date_embch :$('#date_embch').val(),
                contrat :$('#contrat').val(),
                matricule :$('#matricule').val()
            }
            $.ajax({
                type: 'POST',
                url: "http://localhost/mikiry/index.php/enregist_pers/sauver_modif",
                data: form_data,
                success: function()
                {
                    $.ajax({
                        type: 'GET',
                        url: "http://localhost/mikiry/index.php/enregist_pers/pers_modif",
                        success: function(data)
                        {
                            $("#pers_modif").empty().hide();
                            $("#pers_modif").append(data);
                            $('#pers_modif').fadeIn(500);
                        }
                    });
                }
            });

        });
    });
</script>

<table id="table"  class="table table-hover" >
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

    <tbody id="">
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
