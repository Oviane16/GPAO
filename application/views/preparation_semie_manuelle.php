<script>
    $(document).ready(function() {
        $("#preparation").click(function(){
            var form_data = {
                extension : $('#extension').val(),
                chemin : $('#chemin').val(),
                traitement :$('#traitement').val(),
                export :$('#export').val(),
                traitement :$('#traitement').val(),
                idcommande :$('#idcommande').val(),
                fic :$('#fic').val(),
                dossier:$('#dossier').val()
            };
            $.ajax({
                type: "POST",
                url: "http://localhost/mikiry/index.php/preparation_s_m_conctr/affichage" ,
               // url: "http://localhost/mikiry_local/index.php/preparation_s_m_conctr/affichage" ,
                beforeSend :function()
                {
                    if($(".loading").length == 0 )
                    {
                        $("#preparation").parent().append('<div class="loading"></div>');
                    }
                },
                data: form_data,
                dataType : "html",
                error:function(msg, string){
                    alert( "Error !: " + string );
                },
                success:function(data)
                {
                    $('.loading').remove();
                    $("#form_prepa").append(data);
                }
            });
        });
    })
</script>
<div id="form_prepa">
    <form method="POST" action="">
        <fieldset>
            <table>
                <tr>
                    Donner Extension:&nbsp;&nbsp;&nbsp;
                    <input name="extension" id="extension" class="input-mini" type="text" placeholder="ipeg" value="<?php if(isset($extation)){
                        echo $extation;
                    }?>"></td></tr>
                <tr>

                    <td>
                        Chemin de dossier:&nbsp;
                        <input name="chemin" id="chemin" class="input-xlarge" type="text"placeholder="C:\image\CGEU001"value="<?php if(isset($chemin)){
                            echo $chemin;
                        }?>"></td>
                    <td>
                </tr>
                <div id="LblClignotant"></div>

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
                <tr> <td>
                        ID COMMANDE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="idcommande" id="idcommande" style="text-transform:uppercase;" class="input-mini" type="text" value="<?php if(isset($idcommande)){
                            echo $idcommande;
                        }?>"></td>
                </tr>
                <tr>
                    <td>
                        Fichier client:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="fic" id="fic" style="text-transform: lowercase;" class="input-mini" type="text" value="<?php if(isset($fic)){
                            echo $fic;
                        }?>"></td>
                </tr>
                <tr>
                    <td>
                        Dossier:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="dossier" id="dossier" class="input-control" type="text">
                    </td>
                </tr>
            </table>
            <br />
            <button type="button" class="btn btn-info" name="annuler" id="annuler">Annuler</button>
            &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="preparation" class="btn btn-info" name="afficher">Preparation</button>
        </fieldset>
    </form>
</div>