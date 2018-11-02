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
                fic :$('#fic').val()
            };
            $.ajax({
                type: "POST",
                url: "http://localhost/Mikiry/index.php/preparationM/affichage" ,
                data: form_data,
                dataType : "html",
                error:function(msg, string){
                    alert( "Error !: " + string );
                },
                success:function(data)
                {
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
                <input name="extension" id="extension" class="input-mini" type="text" placeholder="Ex :ipeg" value="<?php if(isset($extation)){
                    echo $extation;
                }?>"></td></tr>
            <tr>

                <td>
                    Chemin de dossier:&nbsp;
                    <input name="chemin" id="chemin" class="input-xlarge" type="text"placeholder="C:\image"value="<?php if(isset($chemin)){
                        echo $chemin;
                    }?>"></td>
                <td>
            </tr>
            <div id="LblClignotant"></div><?php
                if(isset($erreurLog)){
                    echo $erreurLog;
                }
            elseif(isset($erreurAbs))
            {
                echo $erreurAbs ;

            }

                ?>

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
        </tr> <?php
if(isset($commandeAo)){
            echo $commandeAo;
            }
            if(isset($verh)){
                echo $verh;
            }
            if(isset($commandeAo)){
                echo $commandeAo;
            }
            if(isset($verifierch)){
                echo $verifierch;
            }
            if(isset($reperttsymisy)){
                echo $reperttsymisy;
            }
            if(isset($verfrep)){
                echo $verfrep;
            }
            if(isset($oublier)){
                echo $oublier;
            }
            if(isset($listing)){
                echo $listing;
            }
            if(isset($tsisyfich)){
                echo $tsisyfich;
            }
            if(isset($lotTermine)){
                echo $lotTermine;
            }
            if(isset($lotErreur)){
                echo $lotErreur;
            }
            if(isset($Annuler)){
                echo $Annuler;
            }
            ?>
            <tr> <td>
            ID COMMANDE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="idcommande" id="idcommande" class="input-mini" type="text" value="<?php if(isset($idcommande)){
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
<button type="submit" class="btn btn-info" name="annuler" id="annuler">Annuler</button>
 &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="preparation" class="btn btn-info" name="afficher">Preparation</button>
</fieldset>
    </form>

    </div>