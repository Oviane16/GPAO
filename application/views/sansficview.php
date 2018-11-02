<script>
    $(document).ready(function() {
       $("#preparation").click(function(){
            var form_data = {
                chemin : $('#chemin').val(),
                traitement : $('#image').val(),
                export :$('#ext_export').val(),
                idcommande :$('#idcommande').val(),
                fic:$('#fic').val(),
                dossier:$('#dossier').val()
            };
            $.ajax({
                url: "http://localhost/mikiry/index.php/sansfic/affichage/",
               // url: "http://localhost/mikiry_local/index.php/sansfic/affichage/",
                beforeSend :function()
                {
                    if($(".loading").length == 0 )
                    {
                        $("#preparation").parent().append('<div class="loading"></div>');
                    }
                },
                type: 'POST',
                data: form_data,
                success:function(data)
                {
                    $('.loading').remove();
                    $("#sanfic").append(data);
                }
            });
            return false;
        });
    });
</script>
<div id="sanfic">
    <div style="background-color:;">
        <fieldset>
            <form enctype="multipart/form-data" action="" class="myForm"   method="post">
                    <table>

                        <tr>
                            <td>
                                Chemin d'un fichier:
                                <input name="chemin" id="chemin" class="input-control" type="text"placeholder="C:\image\CGEU001" value="">
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <div id="LblClignotant">

                                </div>

                        <tr>
                            <td>
                                Type de traitement :
                                <select name="traitement" id="image"value="<?php if(isset($traitement)){
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
                                <input name="export" id="ext_export" class="input-mini" type="text" placeholder="xls"value="<?php if(isset($export)){
                                    echo $export;
                                }?>"></td>
                        </tr>
                        <div id="LblClignotant">

                        </div>
                        <tr> <td>
                                ID COMMANDE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input name="idcommande"id="idcommande"style="text-transform:uppercase;" class="input-mini" type="text"value="<?php if(isset($idcommande)){
                                    echo $idcommande;
                                }?>" ></td>
                        </tr>
                        <tr>
                            <td>
                                Fichier client:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input name="fic" id="fic" style="text-transform: lowercase;" class="input-mini" type="text"value="<?php if(isset($fichier)){
                                    echo $fichier;
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
                    <button type="button" id="annuler" class="btn btn-info" name="annuler">Annuler</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="preparation" class="btn btn-info" name="preparation">Preparation</button>
        </fieldset>
        <div id="LblClignotant">

        </div>
        </form>
    </div>
</div>
</div>
