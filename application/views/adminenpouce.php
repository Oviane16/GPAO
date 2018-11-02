
<script>
    $(document).ready(function() {

    });
</script>

<script>
    $("document").ready(function () {
        $("#commande").change(function () {
            if($(this).val() != null){
                $.ajax({
                    type: 'post',
                    url: 'http://localhost/mikiry/index.php/adminenpouce/etape/' + $("#commande option:selected" ).text(),
                    //url: 'http://192.169.10.122/mikiry/index.php/adminenpouce/etape/' + $("#commande option:selected" ).text(),
                    beforeSend :function()
                    {
                        if($(".loading").length == 0 )
                        {
                            $("#etape").parent().append('<div class="loading"></div>');
                        }
                    },
                    success: function (data) {
                        $(".loading").remove();
                        $('#etape').empty();
                        $('#list_fichier').empty();
                        $('#etape').html(data);
                    }
                });
            }
            else alert('tsy tafa');
        });

        $("#etape").change(function ()
        {
            $('#list_fichier').empty();
        });



    });
</script>

<script>
    $(document).ready(function() {

        $('#afficher').click(function() {
            var form_data = {
                commande : $('#commande').val(),
                etape : $('#etape').val(),
                de :$('#de').val(),
                a :$('#a').val(),
                option :$('#option').val()
            };
            $.ajax({
                url: 'http://localhost/mikiry/index.php/adminenpouce/affichage_fichier/' ,
                //url: 'http://192.168.10.122/mikiry/index.php/adminenpouce/affichage_fichier/' ,
                type: 'POST',
                data: form_data,
                beforeSend :function()
                {
                    if($("#loading_affiche").length == 0 )
                    {
                        $("#afficher").parent().append('<div id="loading_affiche"></div>');
                    }
                },

                success: function(data) {
                    $("#loading_affiche").remove();
                    $("#list_fichier").empty().hide();
                    $("#list_fichier").append(data);
                    $('#list_fichier').fadeIn(500);
                }
            });
            return false;
        });

        resetcheckbox();
        $('#checkAll').click(function(event) {  //on click
            if (this.checked) { // check select status
                $('.checkbox1').each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"
                });
            } else {
                $('.checkbox1').each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"
                });
            }
        });


        $("#initialiser").on('click', function(e) {
            var form_data = {
                commande : $('#commande').val(),
                etape : $('#etape').val(),
                de :$('#de').val(),
                a :$('#a').val(),
                option :$('#option').val()
            };
            e.preventDefault();
            var checkValues = $('.checkbox1:checked').map(function()
            {
				return $(this).val();
            }).get();
            console.log(checkValues);

            $.each( checkValues, function( i, val ) {
                $("#"+val).remove();
            });
//                    return  false;
            $.ajax({
                url: 'http://localhost/mikiry/index.php/adminenpouce/initialiser_multiple/'+ $('#etape').val(),
            //  url: 'http://192.169.10.122/mikiry/index.php/adminenpouce/initialiser_multiple/'+ $('#etape').val(),
                type: 'post',
                data: 'ids=' + checkValues
            }).done(function(data) {

                    $("#list_fichier").empty().hide();
                    $("#list_fichier").append(data);
                    $('#list_fichier').fadeIn(500);
                });
        });

        $("#marquerfini").on('click', function(e) {
            var form_data = {
                commande : $('#commande').val(),
                etape : $('#etape').val(),
                de :$('#de').val(),
                a :$('#a').val(),
                option :$('#option').val()
            };
            e.preventDefault();
            var checkValues = $('.checkbox1:checked').map(function()
            {
                return $(this).val();
            }).get();
            console.log(checkValues);

            $.each( checkValues, function( i, val ) {
                $("#"+val).remove();
            });
//                    return  false;
            $.ajax({
                url: 'http://localhost/mikiry/index.php/adminenpouce/marquerfini_multiple/'+ $('#etape').val(),
                //url: 'http://192.169.10.122/mikiry/index.php/adminenpouce/marquerfini_multiple/'+ $('#etape').val(),
                type: 'post',
                data: 'ids=' + checkValues,
                success: function(data) {
                    $("#list_fichier").empty().hide();
                    $("#list_fichier").append(data);
                    $('#list_fichier').fadeIn(500);
                }

        });
        });

        $("#attribuer").on('click', function(e) {
            e.preventDefault();
            var checkValues = $('.checkbox1:checked').map(function()
            {
                return $(this).val();
            }).get();

            $.ajax({
                url: 'http://localhost/mikiry/index.php/adminenpouce/attribuer_fichier/'+ $('#etape').val() +'/'+ $('#nouveau_mat').val(),
                //url: 'http://192.168.10.122/mikiry/adminenpouce/attribuer_fichier/'+ $('#etape').val() +'/'+ $('#nouveau_mat').val(),
                type: 'post',
                data: 'ids=' + checkValues
            }).done(function(data) {
                    $('#list_fichier').empty().hide();
                    $("#list_fichier").append(data);
                    $('#list_fichier').fadeIn(500);
                });
        });

        function  resetcheckbox(){
            $('input:checkbox').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"
            });
        }
    });
</script>


<form method="POST" >
                        <fieldset>
                            <legend style="color: #7377db">Admin En Push</legend>
                        <table>
                        <td>
                            <label>Commande :</label>
                            <select name="commande" id="commande">
                                <option>Choisir un commande</option>
                                <?php
                                foreach($commande as $com)
                                {
                                   ?>
                                    <option><?php echo $com->COMMANDE; ?></option>
                                <?php
                                }
                                ?>
                            </select></td>
                        <td>
                            <label>Etape :</label>
                            <select name="etape" id="etape">
                                
                            </select></td><?php
                            if(isset($erreurEt)){
                                echo $erreurEt;
                            }
                            ?>
                    </table>
                    <label>Option :</label>
                    <select name="option" id="option">
                        <option>Aucun</option>
                        <option>En cours</option>
                        <option>Fini</option>
                        <option>Non traité</option>
                        <option>Rejeté</option>
                    </select>
                    <table>
                        <td><label>De:</label>
                            <input name="de" id="de" class="span1" type="number"></td>
                        <td><label>A:</label>
                            <input name="a" id="a" class="span1" type="number"></td>
                         <?php
                            if(isset($erreurDeA)){
                                echo $erreurDeA;
                            }
                            ?>
                    </table>
                            <br>
                    <table>

                         <td> <button type="button" id="afficher" name="afficher" class="btn btn-info">Afficher</button></td>



    <!-- Tableau de resultat -->
                    </table>
                            <div style=" overflow:scroll;height:auto;min-height:50px;max-height:200px;width:97%;overflow:auto; border:solid 1px rgba(0, 0, 0, 0.13);">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nom du fichier</th>
                                        <th>Commande</th>
                                        <th>Matricule</th>
                                        <th>Etape</th>
                                        <th>Etat</th>
                                    </tr>
                                </thead>
                                <tbody  id="list_fichier" >


                                </tbody>
                            </table>
                            </div>
    <input id="checkAll" type="checkbox"> Tout cocher/Tout decocher</br></br></br>
    <button type="submit" id="initialiser" class="btn btn-danger">Initialiser</button>
    <button type="submit" id="marquerfini" name="marquerfini" class="btn btn-warning">Marquer fini</button>
    <button data-toggle="modal"   type="submit" class="btn" data-target="#myModal">Attribuer</button>
                        </fieldset>


    <!-- Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Attribution</h3>
        </div>
        <div class="modal-body">
            <p>
                <label>Nouveau matricule :</label>
                <input name="nouveau_mat" id="nouveau_mat" class="input-mini" type="text"placeholder="Ex : 001" >
            </p>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
            <button data-dismiss="modal" aria-hidden="true" id="attribuer" class="btn btn-success" name="attribuer" >Attribuer</button>
        </div>
    </div>

</form>




