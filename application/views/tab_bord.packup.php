<html>
<head>
    <meta charset="utf-8">
    <title>GPAO</title>
    <link href="<?php echo css_url('bootstrap-responsive.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('bootstrap.css');?>" rel="stylesheet" type="text/css">
    <script src="<?php echo js_url('jquery.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('highcharts.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('grid.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('exporting.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('jquery-1.11.3.min.js');?> " type="text/javascript"> </script>
    <script>
        $(document).ready(function() {
            $("#commande").change(function () {
                if($(this).val() != "Choisir un commande"){
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/CodeIgniter_2.1.4/index.php/tab_bord/get_data/" + $( "#commande option:selected" ).text() ,
                        success: function(data) {
                            $('#graphe').empty();
                            $('#graphe').html(data);
                        }
                    });}
            });

        });
    </script>


</head>
<body>
<div class="navbar-wrapper" >
    <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
    <div class="container">

        <div class="navbar navbar-inverse" style="margin-top:80px;margin-bouton:10px">
            <div class="navbar-inner">
                <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="#">GPAO</a>
                <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li ><a href=""></a></li>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>


                    </ul>
                </div><!--/.nav-collapse -->
            </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

    </div> <!-- /.container -->
</div>
<div class="container" style="margin-top:0px;"  >

    <select name="commande" id="commande">
        <option>Choisir un commande</option>
        <?php
        foreach($commande as $com)
        {
            ?>
            <option><?php echo $com->COMMANDE; ?></option>
        <?php
        }
        ?>
    </select>
</div>
<div id="graphe">

</div>



</body>
</html>