
<script>
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
    document.getElementById('cin').addEventListener('input', function (e) {
        var target = e.target, position = target.selectionEnd, length = target.value.length;
        target.value = target.value.replace(/\s/g, '').replace(/(\d{3})/g, '$1 ').trim();
        target.selectionEnd = position += ((target.value.charAt(position - 1) === ' ' && target.value.charAt(length - 1) === ' ' && length !== target.value.length) ? 1 : 0);
    });
</script>
<?php if(isset($personnel))
{
    foreach($personnel as $pers)
    {
?>
<form id="form" >
<style>.datepicker{z-index:1151 !important;}</style>

    <fieldset>
        <table>
            <tr>
                <td>
                    <label>Nom:</label>
                    <input id="nom" style="text-transform: uppercase"  type="text" class="span4" name="nom" value="<?php echo $pers->NOM; ?>" placeholder="Nom">
                </td>
                <td>
                    <label>&nbsp;Prenoms:</label>
                    &nbsp;<input id="prenom" style="text-transform: capitalize;"  type="text" name="prenom" value="<?php echo $pers->PRENOM; ?>" placeholder="prenom">
                </td>
                <td>
                    <label>&nbsp;Sexe:</label>
                    <?php if($pers->SEXE == "F")
                     {?>
                    &nbsp; <select class="span1" id="sexe" name="sexe" value="" id="option">
                        <option><?php echo $pers->SEXE;?></option>
                         <option>M</option>
                     </select>
                     <?php
                     }
                     else
                     {?>
                     &nbsp; <select class="span1" id="sexe" name="sexe" value="" id="option">
                        <option><?php echo $pers->SEXE;?></option>
                        <option>F</option>
                     </select>
                     <?php
                     }
                     ?>
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
                    <input id="date_naiss" type="text"name=date_naiss"" data-dateformat="dd/mm/yy" value="<?php echo $pers->DATE_DE_NAISSANCE;?>" class="input-medium">
                </td>
                <td>
                    <label>&nbsp;Lieu de naissance:</label>
                    &nbsp;<input id="lieu_naiss" type="text" name="lieu_naiss" value="<?php echo $pers->LIEU_DE_NAISSANCE;?>" placeholder="EX: Fianarantsoa">
                </td>
            </tr>
            <table>
                <tr>
                    <td>
                        <label>Nom du père:</label>
                        <input id="nom_pere" type="text" name="nom_pere" class="span5" value="<?php echo $pers->PERE;?>"placeholder="EX: RAN.......">
                    </td>
                    <td>
                        <label>Nom du Mère:</label>
                        <input id="nom_mere" type="text" class="span5" name="nom_mere"value="<?php echo $pers->MERE;?>" placeholder="EX: RAN.....">
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <label>CIN:</label>
                        <input id="cin" maxlength="15" type="text" class="input-medium" name="cin" value="<?php echo $pers->CIN;?>" placeholder="EX: 201091543458">
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;Date CIN:</label>
                        <script>
                            $(function (){
                                $('#date_cin').datepicker();
                            });
                        </script>
                        &nbsp;&nbsp;<input id="date_cin" type="text" name="date_cin" data-dateformat="dd/mm/yy" value="<?php echo $pers->DATE_CIN;?>" class="input-medium">
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;Lieu:</label>
                        &nbsp;&nbsp;<input id="lieu_cin" type="text" class="input-medium" name="lieu_cin" value="<?php echo $pers->LIEU_CIN;?>" placeholder="EX: Tsiadana">
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <label>Situation:</label>
                        <?php if($pers->SITUATION =='C')
                        {?>
                        <select class="span1" id="situation" value="" name="situation" id="option">
                            <option><?php echo $pers->SITUATION;?></option>
                            <option>M</option>
                        </select>
                        <?php }
                        else if($pers->SITUATION == NULL)
                        {?>
                        <select class="span1" id="situation" value="" name="situation" id="option">
                            <option><?php echo $pers->SITUATION;?></option>
                            <option>M</option>
                            <option>C</option>
                        </select>
                        <?php
                        }
                        else
                        {?>
                            <select class="span1" id="situation" value="" name="situation" id="option">
                                <option><?php echo $pers->SITUATION;?></option>
                                <option>C</option>
                            </select>
                        <?php
                        }?>

                    </td>
                    <td>
                        <label>&nbsp;&nbsp;Nbre Enfant:</label>
                        &nbsp;&nbsp;<input class="span1" id="nb_enfant" type="text" name="nb_enfant"value="<?php echo $pers->NOMBRE_ENFANT;?>" placeholder="EX: 4">
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;&nbsp;Conjoint:</label>
                        &nbsp;&nbsp;&nbsp;<input  id="conjoint" class="span4" type="text" name="conjoint" value="<?php echo $pers->CONJOINT;?>" placeholder="EX: RAN....">
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <label>Adresse:</label>
                        <input  id="adresse" class="span4" type="text" name="adresse" value="<?php echo $pers->ADRESSE;?>" placeholder="EX: AT12/3304 Tsiadana">
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;CP:</label>
                        &nbsp;&nbsp; <input  id="cp" class="span2" type="text" name="cp" value="<?php echo $pers->CP;?>" placeholder="EX: 00101">
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;Ville:</label>
                        &nbsp;&nbsp;<input  id="ville" class="span3" type="text" name="ville" value="<?php echo $pers->VILLE;?>" placeholder="EX: Antananrivo">
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <label>Tel fixe:</label>
                        <input  id="tel_fixe" class="span3" type="text" name="tel_fixe" value="<?php echo $pers->TELEPHONE;?>" placeholder="EX: 22 001 45">
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;Portable:</label>
                        &nbsp;&nbsp; <input  id="tel_portable" class="span3" type="text" name="tel_portable" value="<?php echo $pers->PORTABLE;?>"  placeholder="EX: 033 01 123 12">
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <label>Email:</label>
                        <input  id="email" class="span4" type="text" name="email" value="<?php echo $pers->EMAIL;?>" placeholder="EX: randr@gmail.com">
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;CNAPS:</label>
                        &nbsp;&nbsp;<input  id="cnaps" class="span3" type="text" name="cnaps" value="<?php echo $pers->EMAIL;?>" placeholder="850811001739">
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;OSTIE:</label>
                        &nbsp;&nbsp;<input  id="ostie" class="span3" type="text" name="ostie" value="<?php echo $pers->OSTIE;?>"placeholder="EX: 850811001739">
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <label>Catégorie:</label>
                        <input style="text-transform: uppercase" id="categorie" class="span1" type="text" value="<?php echo $pers->CATEGORIE;?>" name="categorie">
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;Pseudo:</label>
                        &nbsp;&nbsp;<input  id="pseudo" class="span3" type="text" name="pseudo" value="<?php echo $pers->PSEUDO;?>"placeholder="EX: Tity" >
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;Mot de passe:</label>
                        &nbsp;&nbsp;<input  id="mdp" class="span3" type="password" value="<?php echo $pers->MDP;?>" name="mdp">
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;Fonction:</label>
                        &nbsp;&nbsp;<input  id="fonction" class="span3" type="text" name="fonction"value="<?php echo $pers->FONCTION;?>" placeholder="EX: PERS">
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>
                        <label>Date de debauche:</label>
                        <script>
                            $(function (){
                                $('#date_embch').datepicker();
                            });
                        </script>
                        <input id="date_embch" type="text" name="date_embch" data-dateformat="dd/mm/yy" value="<?php echo $pers->DATE_EMBAUCHE;?>"class="input-medium">
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;Contrat:</label>
                        &nbsp;&nbsp;<input style="text-transform: uppercase" id="contrat" type="text" name="contrat" value="<?php echo $pers->CONTRAT;?>" class="span1">
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;Matricule:</label>
                        &nbsp;&nbsp;<input id="matricule" type="text" class="span2" name="matricule" value="<?php echo $pers->MATRICULE;?>" placeholder="EX: 001">
                    </td>
                    <td>
                        <label>&nbsp;&nbsp;Action:</label>
                        &nbsp;&nbsp;<input id="action" type="text" class="span2" name="action" value="<?php echo $pers->ACTION;?>" ">
                    </td>
                </tr>
            </table>


    </fieldset>
</form>
<?php }

} ?>