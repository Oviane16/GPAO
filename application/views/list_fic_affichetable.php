
<script>
    $("document").ready(function (){
        $(".table tr td #selectionner").click(function(){
             var idfichier = $('#selectionner').val();
             $.ajax({
             url: 'http://localhost/mikiry/index.php/affiche_table_contrl/get_etape/' + idfichier ,
            // url: 'http://192.168.10.122/mikiry/index.php/affiche_table_contrl/get_etape/' + idfichier ,
             type: 'POST',
             success: function(data)
             {
                 $("#etap_affiche").empty();
                 $('#etap_affiche').html(data);
             }
             });
        });

        $("#supprimer").click(function()
        {
            var idfichier = $("input[name='optradio']:checked").val();
            var command = $('#commande_affiche').val();
            var etap_affiche = $('#etap_affiche').val();
            var n_enr = $('.checkbox1:checked').map(function()
            {
                return $(this).attr("n_enr");
            }).get();
            var commande = $('.checkbox1:checked').map(function()
            {
                return $(this).attr("commande");
            }).get();
            var n_lot = $('.checkbox1:checked').map(function()
            {
                return $(this).attr("n_lot");
            }).get();
            var etape = $('.checkbox1:checked').map(function()
            {
                return $(this).attr("etape");
            }).get();
            var a = $("#check").val();
            if(a !='misy')
            {
                alert('Auccun fichier choisit');
            }
            else
            {
            $.ajax({
                //url: 'http://192.168.10.122/mikiry/index.php/affiche_table_contrl/supprimer/' ,
               dataType:'json',
                url: 'http://localhost/mikiry/index.php/affiche_table_contrl/supprimer/' ,
                type: 'POST',
                data : 'n_enr=' + n_enr + 'commande=' + commande + 'n_lot=' + n_lot + 'etape='+ etape,
                success: function(dat)
                {
                    if(dat.alerte)
                    {
                        alert(dat.alerte);
                    }
                    $.ajax({
                        url: 'http://localhost/mikiry/index.php/affiche_table_contrl/get_list_result/' + etap_affiche +'/' + command +'/' + idfichier,
                        //url: 'http://192.168.10.122/mikiry/index.php/affiche_table_contrl/get_list_result/' + etap_affiche +'/' + command +'/' + idfichier,
                        type: 'GET',
                        success: function(data){
                            if(data)
                            {
                                $('#list_result').empty().hide();
                                $("#list_result").append(data);
                                $('#list_result').fadeIn(500);
                            }
                        }
                    });
                }
            });
            }

        });
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

    });
</script>

<?php
if(isset($fichier))
{
    foreach($fichier as $fic)
    {
        ?>
        <table class="table table-spired"  >
            <thead>
            <tr>

            </tr>
            </thead>
            <tbody class="list-group test" >
            <tr><td ><label class="radio-inline"><input type="radio" id="selectionner" value="<?php echo $fic->idfichier; ?>" name="optradio">  <?php echo $fic->NOM_FICHIER ?> </label></td></tr>
            </tbody>
        </table>
    <?php
    }
}
else
{

}

?>





