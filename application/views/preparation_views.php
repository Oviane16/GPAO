<script>
$(document).ready(function() {
        $("#preparation").click(function(){
            var form_data = {
                extension : $('#extension').val(),
                chemin : $('#chemin').val(),
                nombre : $('#nombre').val(),
                traitement :$('#traitement').val(),
                export :$('#export').val(),
                idcommande :$('#idcommande').val(),
                fic :$('#fic').val()
                           };
                   $.ajax({
                type: "POST",
                //url: "http://localhost/Mikiry/index.php/preparation_contr/affichage" ,
                       beforeSend :function()
                       {
                           if($(".loading").length == 0 )
                           {
                               $("#preparation").parent().append('<div class="loading"></div>');
                           }
                       },
                data: form_data,
                dataType : "html",
                success:function(data)
                {
                    $('.loading').remove();
                    $("#form_lot").append(data);
                }
            });
        });
    });
</script>

<div id="form_lot">
    <form method="POST" action="">
        <fieldset>
            <table>
                <tr>
                    Donner Extension:&nbsp;&nbsp;&nbsp;
                    <input name="extension" id="extension" class="input-mini" type="text" placeholder="png" value="<?php if(isset($extation)){
                        echo $extation;
                    }?>"></td>
                </tr>
                <tr>

                    <td>
                        Chemin de dossier:&nbsp;
                        <input name="chemin" id="chemin" class="input-xlarge" type="text"placeholder="C:\image\UEDN001"value="<?php if(isset($chemin)){
                            echo $chemin;
                        }?>"></td>
                    <td>
                <tr>

                    <td>
                       Nombre fichier par lot:
                        <input name="nombre" id="nombre" class="input-mini" type="number"></td>
                    <td>
                </tr>
                <tr>
                    <td>
                        Type de traitement :
                        <select name="traitement"  id="traitement"value="<?php if(isset($traitement)){
                            echo $traitement;
                        }?>">
                            <option>IMAGE</option>
                            <option>TEXTE</option>
                            <option>COUPON</option>
                            <option >ANNUAIRE</option>
                            <option >WEB</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Extension export:&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="export" id="export" class="input-mini" type="text" placeholder="xls" value="<?php if(isset($export)){
                            echo $export;
                        }?>"></td>
                </tr>

                <tr>
                    <td>
                        ID COMMANDE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="idcommande" id="idcommande" style="text-transform:uppercase;" class="input-mini" type="text" value="<?php if(isset($idcommande)){
                            echo $idcommande;
                        }?>"></td>
                </tr>
                <tr>
                    <td>
                        Fichier clien:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="fic" id="fic" class="input-mini" type="text" value="<?php if(isset($fic)){
                            echo $fic;
                        }?>"></td>
                </tr>
            </table>
            <br />
            <button type="button" class="btn btn-info" name="annuler" id="annuler">Annuler</button>
            &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="preparation" class="btn btn-info" name="afficher">Preparation</button>
        </fieldset>
    </form>

</div>