<button type="button" id="afficher" class="btn btn-info">Afficher</button>

<script>
    $(document).ready(function() {
            $('#afficher').click(function()
                {
                    $.ajax({
                        type:'POST',
                        url: "http://localhost/mikiry/index.php/tab_bord_recap/afficher/" ,
                        success: function(data) {
                            $("#graph").empty().hide();
                            $("#graph").append(data);
                            $('#graph').fadeIn(500);
                            }
                     });

                 });
    });
</script>
<div id="graph">


</div>


