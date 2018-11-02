<script>
    $("document").ready(function () {
        $("#traitement").click(function () {
            if( $('#date_debut').val() != '' &&  $('#date_fin').val() != '')
            {
                var form_data =
                {
                    date_debut : $('#date_debut').val(),
                    date_fin : $('#date_fin').val()
                };
                $.ajax({
                    dataType: 'json',
                    type: 'post',
                    url: 'http://localhost/mikiry/index.php/presence_contrl/traitement',
                    data: form_data,
                    beforeSend :function()
                    {
                        if($("#loaging_message").length == 0 )
                        {
                            $("#traitement").parent().append('<td id="loading_message">Veuiller patienter svp,cela peux prendre quelques secondes <div id="loading_affiche"></div></td>');
                        }
                    },
                    success: function (data) {
                        $("#loading_message").remove();
                        if(data.alerte)
                        {
                            alert(data.alerte);
                        }
                        if(data.erreur)
                        {
                            alert(data.erreur);
                        }
                    }
                });
            }
            else
            {
                alert("Tous les champs sont oblogatoire");
            }

        });
    });
</script>
<fieldset>
    <legend >Presence</legend>
    <form method="POST">
        <table >
            <td>
                <label>Date debut:</label>
                <script>
                    $(function (){
                        $('#date_debut').datepicker();
                    });
                </script>
                <input id="date_debut" type="text"name="date_debut" data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy" class="input-medium">
            </td>
            <td>
                <label>Date Fin:</label>
                <script>
                    $(function (){
                        $('#date_fin').datepicker();
                    });
                </script>
                <input id="date_fin" type="text" name="date_fin"  data-date-format="dd/mm/yyyy" placeholder="dd/mm/yyyy"  class="input-medium">
            </td>

        </table>

        <table>
            <tr>
                <td>
         <button type="button" id="traitement" name="traitement" class="btn btn-info">Traitement</button>
                </td>
            </tr>
        </table>
    </form>
</fieldset>