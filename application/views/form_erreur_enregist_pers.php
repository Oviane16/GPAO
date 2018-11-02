
<script>
    $("document").ready(function () {
        $("#enregistrer").click(function () {
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
                url: 'http://192.168.10.122/mikiry/index.php/enregist_pers/enregistrer/' ,
               // url: 'http://localhost/mikiry/index.php/enregist_pers/enregistrer/' ,
                type: 'POST',
                data: form_data,
                success: function(data) {
                    $("#form_enregistpers").empty().hide();
                    $("#form_enregistpers").append(data);
                    $('#form_enregistpers').fadeIn(500);
                }
            });
        });
        $("#nav_misajour_personnel li a").click(function(){
            var req = $(this).attr("name");
            $.ajax({
                type: "GET",
                url: "http://192.168.10.122/mikiry/index.php/" + req,
               // url: "http://localhost/mikiry/index.php/" + req,
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

        });
</script>
<script>

</script>

<div id="form_enregistpers">

    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <form method="post" id="form" >
                <fieldset>
                    <table>
                        <tr>
                            <td>
                                <label>Nom: <?php echo form_error('nom') ?></label>
                                <input id="nom" style="text-transform: uppercase" type="text" class="span4" name="nom" value="<?php echo set_value('nom'); ?>" placeholder="Nom">
                            </td>
                            <td>

                                <label>&nbsp;Prenoms:<?php echo form_error('prenom') ?></label>
                                &nbsp;<input id="prenom" style="text-transform: capitalize;" type="text" name="prenom" value="<?php echo set_value('prenom'); ?>" placeholder="prenom">
                            </td>
                            <td>
                                <label>&nbsp;Sexe:</label>
                                &nbsp; <select class="span1" id="sexe" value="<?php echo set_value('sexe'); ?>"  name="sexe" id="option">
                                    <option>F</option>
                                    <option>M</option>
                                </select>
                            </td>

                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <label>Date de naissance: <?php echo form_error('date_naiss') ?>
                                </label>
                                <script>
                                    $(function (){
                                        $('#date_naiss').datepicker();
                                    });
                                </script>
                                <input id="date_naiss" type="text"name=date_naiss"" value="<?php echo set_value('date_naiss'); ?>"  data-dateformat="dd/mm/yy" class="input-medium">
                            </td>
                            <td>
                                <label>&nbsp;Lieu de naissance: <?php echo form_error('lieu_naiss') ?></label>
                                &nbsp;<input style="text-transform: capitalize;" id="lieu_naiss" type="text" name="lieu_naiss"  value="<?php echo set_value('lieu_naiss'); ?>"   placeholder="EX: Fianarantsoa">
                            </td>
                        </tr>
                        <table>
                            <tr>
                                <td>
                                    <label>Nom du père: <?php echo form_error('nom_pere') ?></label>
                                    <input id="nom_pere" type="text" name="nom_pere" class="span5" value="<?php echo set_value('nom_pere'); ?>" placeholder="EX: RAN.......">
                                </td>
                                <td>
                                    <label>Nom du Mère: <?php echo form_error('nom_mere') ?></label>
                                    <input id="nom_mere" type="text" class="span5" name="nom_mere" value="<?php echo set_value('nom_mere'); ?>" placeholder="EX: RAN.....">
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>
                                    <label>CIN: <?php echo form_error('cin') ?></label>
                                    <input maxlength="15" id="cin" type="text" class="input-medium" name="cin" value="<?php echo set_value('cin'); ?>" placeholder="EX: 201091543458">
                                </td>
                                <td>
                                    <label>&nbsp;&nbsp;Date CIN: <?php echo form_error('date_cin') ?></label>
                                    <script>
                                        $(function (){
                                            $('#date_cin').datepicker();
                                        });
                                    </script>
                                    &nbsp;&nbsp;<input id="date_cin" type="text" name="date_cin" data-dateformat="dd/mm/yy" value="<?php echo set_value('date_cin'); ?>" class="input-medium">
                                </td>
                                <td>
                                    <label>&nbsp;&nbsp;Lieu: <?php echo form_error('lieu_cin') ?></label>
                                    &nbsp;&nbsp;<input id="lieu_cin" type="text" class="input-medium" name="lieu_cin" value="<?php echo set_value('lieu_cin'); ?>" placeholder="EX: Tsiadana">
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>
                                    <label>Situation: <?php echo form_error('situation') ?></label>
                                    <select class="span1" id="situation" value="<?php echo set_value('situation'); ?>" name="situation" id="option">
                                        <option>C</option>
                                        <option>M</option>
                                    </select>
                                </td>
                                <td>
                                    <label>&nbsp;&nbsp;Nbre Enfant: <?php echo form_error('nb_enfant') ?></label>
                                    &nbsp;&nbsp;<input class="span1" id="nb_enfant" type="text" name="nb_enfant" value="<?php echo set_value('nb_enfant'); ?>" placeholder="EX: 4">
                                </td>
                                <td>
                                    <label>&nbsp;&nbsp;&nbsp;Conjoint: <?php echo form_error('conjoint') ?></label>
                                    &nbsp;&nbsp;&nbsp;<input  id="conjoint" class="span4" type="text" name="conjoint" value="<?php echo set_value('conjoint'); ?>" placeholder="EX: RAN....">
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>
                                    <label>Adresse: <?php echo form_error('adresse') ?></label>
                                    <input  id="adresse" class="span4" type="text" name="adresse" value="<?php echo set_value('adresse'); ?>" placeholder="EX: AT12/3304 Tsiadana">
                                </td>
                                <td>
                                    <label>&nbsp;&nbsp;CP: <?php echo form_error('cp') ?></label>
                                    &nbsp;&nbsp; <input  id="cp" class="span2" type="text" value="<?php echo set_value('cp'); ?>" name="cp" placeholder="EX: 00101">
                                </td>
                                <td>
                                    <label>&nbsp;&nbsp;Ville: <?php echo form_error('ville') ?></label>
                                    &nbsp;&nbsp;<input  id="ville" class="span3" type="text" name="ville" value="<?php echo set_value('ville'); ?>"  placeholder="EX: Antananrivo">
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>
                                    <label>Tel fixe: <?php echo form_error('tel_fixe') ?></label>
                                    <input  id="tel_fixe" class="span3" type="text" name="tel_fixe" value="<?php echo set_value('tel_fixe'); ?>"  placeholder="EX: 22 001 45">
                                </td>
                                <td>
                                    <label>&nbsp;&nbsp;Portable: <?php echo form_error('tel_portable') ?></label>
                                    &nbsp;&nbsp; <input  id="tel_portable" class="span3" type="text" name="tel_portable" value="<?php echo set_value('tel_portable'); ?>"  placeholder="EX: 033 01 123 12">
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>
                                    <label>Email: <?php echo form_error('email') ?></label>
                                    <input  id="email" class="span4" type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="EX: randr@gmail.com">
                                </td>
                                <td>
                                    <label>&nbsp;&nbsp;CNAPS: <?php echo form_error('cnaps') ?></label>
                                    &nbsp;&nbsp;<input  id="cnaps" class="span3" type="text" name="cnaps" value="<?php echo set_value('cnaps'); ?>" placeholder="850811001739">
                                </td>
                                <td>
                                    <label>&nbsp;&nbsp;OSTIE: <?php echo form_error('ostie') ?></label>
                                    &nbsp;&nbsp;<input  id="ostie" class="span3" type="text" name="ostie" value="<?php echo set_value('ostie'); ?>" placeholder="EX: 850811001739">
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>
                                    <label>Catégorie: <?php echo form_error('categorie') ?></label>
                                    <input  id="categorie" style="text-transform: uppercase" class="span1" type="text" value="<?php echo set_value('categorie'); ?>" name="categorie">
                                </td>
                                <td>
                                    <label>&nbsp;&nbsp;Pseudo: <?php echo form_error('pseudo') ?></label>
                                    &nbsp;&nbsp;<input  id="pseudo" class="span3" type="text" name="pseudo" value="<?php echo set_value('pseudo'); ?>" placeholder="EX: Tity" >
                                </td>
                                <td>
                                    <label>&nbsp;&nbsp;Mot de passe: <?php echo form_error('mdp') ?></label>
                                    &nbsp;&nbsp;<input  id="mdp" class="span3" type="password" value="<?php echo set_value('mdp'); ?>" name="mdp">
                                </td>
                                <td>
                                    <label>&nbsp;&nbsp;Confirmer mot de passe: </label>
                                    &nbsp;&nbsp;<input  id="confirm_mdp" class="span3" type="password" value="<?php echo set_value('cofirm_mdp'); ?>" name="cofirm_mdp">
                                </td>
                                <td id="message"></td>
                                <td>

                                    <label>&nbsp;&nbsp;Fonction: <?php echo form_error('fonction') ?></label>
                                    &nbsp;&nbsp;<input style="text-transform: uppercase"  id="fonction" class="span3" type="text" name="fonction" value="<?php echo set_value('fonction'); ?>" placeholder="EX: PERS">
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>
                                    <label>Date d'embauche: <?php echo form_error('date_embch') ?></label>
                                    <script>
                                        $(function (){
                                            $('#date_embch').datepicker();
                                        });
                                    </script>
                                    <input id="date_embch" type="text" name="date_embch" data-dateformat="dd/mm/yy" value="<?php echo set_value('date_embch'); ?>" class="input-medium">
                                </td>
                                <td>
                                    <label>&nbsp;&nbsp;Contrat: <?php echo form_error('contrat') ?></label>
                                    &nbsp;&nbsp;<input style="text-transform: uppercase" id="contrat" type="text" name="contrat" value="<?php echo set_value('contrat'); ?>" class="span1">
                                </td>

                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>
                                    <span class="help-block"></span>
                                    <label class="checkbox">
                                    </label>
                                    <button type="button" id="enregistrer" class="btn btn-success">Enregistrer</button>
                                </td>
                            </tr>
                        </table>

                </fieldset>
            </form>
        </div>

    </div>

