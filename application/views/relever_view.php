<script>
    $(document).ready(function() {
        $('#commande_relever option').click(function()
        {
            var commande = $(this).attr("name");
                $.ajax({
                    url: 'http://localhost/mikiry/index.php/relever_contrl/get_etape/' + commande,
                    //url: 'http://192.168.10.122/mikiry/index.php/supp_lot_contrl/supprimer/' + commande,
                    type:'POST',
                    success:function(data)
                    {
                        $('#etape_relever').empty();
                        $('#etape_relever').html(data);
                    }
                });
        });
        $('#traitement').click(function()
        {
            var date_debut = $('#date_debut').val();
            var date_fin = $('#date_fin').val();
            if(date_debut !='' && date_fin !='')
            {
                var commande = $('#commande_relever option:selected').map(
                    function()
                    {
                        return $(this).val();
                    }
                ).get();
                var etape_relever = $('#etape_relever option:selected').text();
                if(commande)
                {
                    if($('#etape_relever').val() != 'Choisir une etape')
                    {
                        var date_debut = $('#date_debut').val();
                        var date_fin = $('#date_fin').val();
                        $.ajax({
                            dataType: 'json',
                            url: 'http://localhost/mikiry/index.php/relever_contrl/traitement/' + date_debut +'/'+date_fin +'/' + etape_relever,
                            //url: 'http://192.168.10.122/mikiry/index.php/supp_lot_contrl/supprimer/' + commande,
                            type:'POST',
                            data: 'commandes='+ commande,
                            beforeSend :function()
                            {
                                if($("#loading_message_relever").length == 0 )
                                {
                                    $("#traitement").parent().append('<div id="loading_message_relever"><div style="float: left;" >Veuiller patienter svp,cela peux prendre quelques secondes</div> <div style="float:left;" id="loading_affiche"></div></div>');
                                }
                            },
                            success:function(data)
                            {
                                $("#loading_message_relever").remove();
                                if(data.alerte)
                                {
                                    alert(data.alerte);
                                }

                            }
                        });
                    }
                    else
                    {
                        alert('Veuiller coisir une etape');
                    }
                }
                else
                {
                    alert('Veuiller choisir une commande');
                }
            }
            else if(date_debut =='' && date_fin == '')
            {
                var commande = $('#commande_relever option:selected').map(
                    function()
                    {
                        return $(this).val();
                    }
                ).get();
                var etape_relever = $('#etape_relever option:selected').text();
                if(commande)
                {
                    if($('#etape_relever').val() != 'Choisir une etape')
                    {
                        var date_debut = $('#date_debut').val();
                        var date_fin = $('#date_fin').val();
                        $.ajax({
                            dataType: 'json',
                            url: 'http://localhost/mikiry/index.php/relever_contrl/traitement/tsisy_daty_debut/tsisy_daty_fin/' + etape_relever,
                            //url: 'http://192.168.10.122/mikiry/index.php/supp_lot_contrl/supprimer/' + commande,
                            type:'POST',
                            data: 'commandes='+ commande,
                            beforeSend :function()
                            {
                                if($("#loading_message_relever").length == 0 )
                                {
                                    $("#traitement").parent().append('<div id="loading_message_relever"><div style="float: left;" >Veuiller patienter svp,cela peux prendre quelques secondes</div> <div style="float:left;" id="loading_affiche"></div></div>');
                                }
                            },
                            success:function(data)
                            {
                                $("#loading_message_relever").remove();
                                if(data.alerte)
                                {
                                    alert(data.alerte);
                                }

                            }
                        });
                    }
                    else
                    {
                        alert('Veuiller coisir une etape');
                    }
                }
                else
                {
                    alert('Veuiller choisir une commande');
                }
            }
            });

    });
</script>

<legend>Relever</legend>

<div style="float: left;">
    <label>Commande:</label>
    <select id="commande_relever" style="height:auto; min-height: 20px; max-height: 60px " multiple="multiple">
        <?php
        foreach($commande as $com)
        {
            ?>
            <option name="<?php echo $com->COMMANDE; ?>" value="<?php echo $com->COMMANDE; ?>"><?php echo $com->COMMANDE; ?></option>
        <?php
        }
        ?>
    </select>
</div>
<div style="float: left; margin-left: 10px;">
    <label>Etape:</label>
    <select id="etape_relever">

    </select>
</div>

<div style="clear: both;">
    <h1 style="font-size:smaller;" >Laisse vide la  <a style="font-size:12px; color: #ff2525; font-family:arial;">"Date debut"</a> el la <a style="font-size:12px;color: #ff2525; font-family:arial;">"Date fin"</a> si relevé par commande</h1>
        <table>
            <tr>
                <td>
                    <label>Date debut:</label>
                </td>
                <td>
                    <label>Date Fin:</label>
                </td>
            </tr>
            <tr>
                <td>
                    <script>
                        $(function (){
                            $('#date_debut').datepicker();
                        });
                    </script>
                    <input id="date_debut" type="text"name="date_debut" data-date-format="yyyy-mm-dd" class="input-medium" placeholder="dd/mm/yy">
                </td>
                <td>
                    <script>
                        $(function (){
                            $('#date_fin').datepicker();
                        });
                    </script>
                    <input id="date_fin" type="text" name="date_fin" data-date-format="yyyy-mm-dd"  class="input-medium" placeholder="dd/mm/yy">
                </td>
            </tr>
        </table>








            <button type="button" id="traitement" name="traitement" class="btn btn-info">Traitement</button>
</div>



