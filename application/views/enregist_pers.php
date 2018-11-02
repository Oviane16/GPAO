
<script>
    $("document").ready(function () {
        $("#enregistrer_pers").click(function () {

            var mdp = $('#mdp').val();
            var confirm_mdp =$('#confirm_mdp').val();
        if(mdp == confirm_mdp )
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
            };
            $.ajax({
               url: 'http://localhost/mikiry/index.php/enregist_pers/enregistrer/' ,
                //  url: 'http://192.168.10.122/mikiry/index.php/enregist_pers/enregistrer/' ,
                type: 'POST',
                data: form_data,
                success: function(data) {
                    $("#form_enregistpers").empty().hide();
                    $("#form_enregistpers").append(data);
                    $('#form_enregistpers').fadeIn(500);
                }
            });
        }
        else
        {
            alert('Mot de passe non confirmé');
        }
        });
        $("#nav_misajour_personnel li a").click(function(){
                var req = $(this).attr("name");
            $.ajax({
                type: "GET",
               url: "http://localhost/mikiry/index.php/" + req,
              // url: "http://192.168.10.122/mikiry/index.php/" + req,
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
        $('#confirm_mdp').on('keyup', function () {
            if ($(this).val() == $('#mdp').val()) {
                $('#message').html('Confirmé').css('color', 'green');
            } else $('#message').html('Non Cofirmé').css('color', 'red');
        });

        document.getElementById('cin').addEventListener('input', function (e) {
            var target = e.target, position = target.selectionEnd, length = target.value.length;
            target.value = target.value.replace(/\s/g, '').replace(/(\d{3})/g, '$1 ').trim();
            target.selectionEnd = position += ((target.value.charAt(position - 1) === ' ' && target.value.charAt(length - 1) === ' ' && length !== target.value.length) ? 1 : 0);
        });
        document.getElementById('tel_fixe').addEventListener('input', function (e) {
            var target = e.target, position = target.selectionEnd, length = target.value.length;
            target.value = target.value.replace(/\s/g, '').replace(/(\d{2})/g, '$1 ').trim();
            target.selectionEnd = position += ((target.value.charAt(position - 1) === ' ' && target.value.charAt(length - 1) === ' ' && length !== target.value.length) ? 1 : 0);
        });
        document.getElementById('tel_portable').addEventListener('input', function (e) {
            var target = e.target, position = target.selectionEnd, length = target.value.length;
            target.value = target.value.replace(/\s/g, '').replace(/(\d{2})/g, '$1 ').trim();
            target.selectionEnd = position += ((target.value.charAt(position - 1) === ' ' && target.value.charAt(length - 1) === ' ' && length !== target.value.length) ? 1 : 0);
        });

    });
</script>

<div  class="tabbable"> <!-- Only required for left/right tabs -->
    <ul  class="nav nav-tabs" id="nav_misajour_personnel">
        <li  class="active"><a href="#" name="enregist_pers" data-toggle="tab">Enregistrement personnel</a></li>
        <li><a href="#" name="enregist_pers/miseajour_pers" data-toggle="tab">Mise à jour personnel</a></li>
    </ul>

<div id="form_enregistpers">

    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
        <form method="post" id="form" >
            <fieldset>
                <table>
                    <tr>
                        <td>
                            <label>Nom:</label>
                            <input id="nom" style="text-transform: uppercase" type="text"  class="span4" name="nom" value="" placeholder="Nom">
                        </td>
                        <td>
                            <label>&nbsp;Prenoms:</label>
                            &nbsp;<input id="prenom" style="text-transform: capitalize;"  type="text" name="prenom" placeholder="prenom">
                        </td>
                        <td>
                            <label>&nbsp;Sexe:</label>
                            &nbsp; <select class="span1" id="sexe" name="sexe" id="option">
                                <option>F</option>
                                <option>M</option>
                            </select>
                        </td>

                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                            <label>Date de naissance:</label>
                            <script>
                                $(function (){
                                    $('#date_naiss').datepicker();
                                });
                            </script>
                            <input id="date_naiss" type="text"name=date_naiss"" data-date class="input-medium">
                        </td>
                        <td>
                            <label>&nbsp;Lieu de naissance:</label>
                            &nbsp;<input id="lieu_naiss" style="text-transform: capitalize;" type="text" name="lieu_naiss" placeholder="EX: Fianarantsoa">
                        </td>
                    </tr>
                    <table>
                        <tr>
                            <td>
                                <label>Nom du père:</label>
                                <input id="nom_pere" type="text" name="nom_pere" class="span5"placeholder="EX: RAN.......">
                            </td>
                            <td>
                                <label>Nom du Mère:</label>
                                <input id="nom_mere" type="text" class="span5" name="nom_mere" placeholder="EX: RAN.....">
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <label>CIN:</label>
                                <input maxlength="15" id="cin" type="text" class="input-medium" name="cin" placeholder="EX: 201091543458">
                            </td>
                            <td>
                                <label>&nbsp;&nbsp;Date CIN:</label>
                                <script>
                                    $(function (){
                                        $('#date_cin').datepicker();
                                    });

                                </script>
                                &nbsp;&nbsp;<input id="date_cin" type="text" name="date_cin"  class="input-medium">
                            </td>
                            <td>
                                <label>&nbsp;&nbsp;Lieu:</label>
                                &nbsp;&nbsp;<input id="lieu_cin" type="text" class="input-medium" name="lieu_cin" placeholder="EX: Tsiadana">
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <label>Situation:</label>
                                <select class="span1" id="situation" name="situation" id="option">
                                    <option>C</option>
                                    <option>M</option>
                                </select>
                            </td>
                            <td>
                                <label>&nbsp;&nbsp;Nbre Enfant:</label>
                                &nbsp;&nbsp;<input class="span1" id="nb_enfant" type="text" value="0" name="nb_enfant" placeholder="EX: 4">
                            </td>
                            <td>
                                <label>&nbsp;&nbsp;&nbsp;Conjoint:</label>
                                &nbsp;&nbsp;&nbsp;<input  id="conjoint" class="span4" type="text" name="conjoint" placeholder="EX: RAN....">
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <label>Adresse:</label>
                                <input  id="adresse" class="span4" type="text" name="adresse" placeholder="EX: AT12/3304 Tsiadana">
                            </td>
                            <td>
                                <label>&nbsp;&nbsp;CP:</label>
                                &nbsp;&nbsp; <input  id="cp" class="span2" type="text" name="cp" placeholder="EX: 00101">
                            </td>
                            <td>
                                <label>&nbsp;&nbsp;Ville:</label>
                                &nbsp;&nbsp;<input  id="ville" class="span3" type="text" name="ville"  placeholder="EX: Antananrivo">
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <label>Tel fixe:</label>
                                <input  id="tel_fixe" class="span3" type="text" name="tel_fixe"  placeholder="EX: 22 001 45">
                            </td>
                            <td>
                                <label>&nbsp;&nbsp;Portable:</label>
                                &nbsp;&nbsp; <input  id="tel_portable" class="span3" type="text" name="tel_portable"  placeholder="EX: 033 01 123 12">
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <label>Email:</label>
                                <input  id="email" class="span4" type="email" name="email"  placeholder="EX: randr@gmail.com">
                            </td>
                            <td>
                                <label>&nbsp;&nbsp;CNAPS:</label>
                                &nbsp;&nbsp;<input  id="cnaps" class="span3" type="text" name="cnaps" placeholder="850811001739">
                            </td>
                            <td>
                                <label>&nbsp;&nbsp;OSTIE:</label>
                                &nbsp;&nbsp;<input  id="ostie" class="span3" type="text" name="ostie" placeholder="EX: 850811001739">
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <label>Catégorie:</label>
                                <input style="text-transform: uppercase"  id="categorie" class="span1" type="text" name="categorie">
                            </td>
                            <td>
                                <label>&nbsp;&nbsp;Pseudo:</label>
                                &nbsp;&nbsp;<input id="pseudo" class="span3" type="text" name="pseudo" placeholder="EX: Tity" >
                            </td>
                            <td>
                                <label>&nbsp;&nbsp;Mot de passe:</label>
                                &nbsp;&nbsp;<input  id="mdp" class="span3" type="password" name="mdp">
                            </td>
                            <td>
                                <label>&nbsp;&nbsp;Confirmer mot de passe:</label>
                                &nbsp;&nbsp;<input  id="confirm_mdp" class="span3" type="password" name="cofirm_mdp">
                            </td>
                            <td id="message"></td>
                            <td>
                                <label>&nbsp;&nbsp;Fonction:</label>
                                &nbsp;&nbsp;<input style="text-transform: uppercase"  id="fonction" class="span3" type="text" name="fonction" placeholder="EX: PERS">
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <label>Date d'embauche:</label>
                                <script>
                                    $(function (){
                                        $('#date_embch').datepicker();
                                    });
                                </script>
                                <input id="date_embch" type="text" name="date_embch" class="input-medium">
                            </td>
                            <td>
                                <label>&nbsp;&nbsp;Contrat:</label>
                                &nbsp;&nbsp;<input style="text-transform: uppercase" id="contrat" type="text" name="contrat" class="span1">
                            </td>

                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <span class="help-block"></span>
                                <label class="checkbox">
                                </label>
                                <button type="button" id="enregistrer_pers" class="btn btn-success">Enregistrer</button>
                            </td>
                        </tr>
                    </table>

            </fieldset>
        </form>
        </div>
</div>
    </div>

