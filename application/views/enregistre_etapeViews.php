<script>
    $("document").ready(function () {
        $("#ajout_etape").click(function(){
            $.ajax({
                type: "GET",
                url: "http://localhost/mikiry/index.php/Enregistre_etapeC/affichage_form",
                error:function(msg, string){
                    alert( "Error !: " + string );
                },
                success:function(data){
                    var a = 7;
                    if(data)
                    {
                        $("#form_etape").append(data);
                         a++;
                    }
                    $("#a").append(a);
                }
            });
        });
        function a()
        {
            const a = 0;
            return a;
        }
    });
</script>
<script>
    $("document").ready(function () {
        $("#supression_etape").click(function(){
            var req = $(this).attr("name");
            $.ajax({
                type: "GET",
                url: "http://localhost/mikiry/index.php/Enregistre_etapeC/suppr_form",
                error:function(msg, string){
                    alert( "Error !: " + string );
                },
                success:function(data){
                    $('#form_sup').fadeOut(data);
                }
            });
        });
    });
</script>
<script>

    $(document).ready(function() {
        $("#OK").click(function(){
            var form_data = {
               command :$('#command').val(),
               etape :$('#etape').val(),
               taux :$('#taux').val(),
               objet:$('#objet').val()
            };
            $.ajax({
                url: "http://localhost/mikiry/index.php/Enregistre_etapeC/enregistrement",
                type: 'POST',
                data: form_data,
                success:function(data)
                {
                    $("#enregistrer").append(data);
                }
            });
            return false;
        });
    });
</script>
    <form method="POST" action="">
        <fieldset>
            <table>
                <tr>Commande:&nbsp;&nbsp;<input name="Commande" id="command" class="input-medium" type="text" placeholder="Ex:CHDI001"?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</tr>
                <tr><button type="button" id="ajout_etape" class="btn btn-info" name="afficher">Ajout étape</button></tr>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <tr><button type="button" id="OK" class="btn btn-info" name="afficher">OK</button></tr>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <tr><button type="button" id="supression_etape" class="btn btn-info" name="afficher">Suppression</button></tr>
                </table>
            <div id="enregistrer">
            <div id="form_sup">
               <div id="form_etape">
            </div>
            </div>
            </div>
    </form>
<div id="a"></div>