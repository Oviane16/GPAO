
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>GPAO</title>
    <link href="<?php echo css_url('bootstrap-responsive.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('bootstrap.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('prettify.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('datepicker.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('bootstrap-dialog.css');?>" rel="stylesheet" type="text/css">

    <script src="<?php echo js_url('bootstrap.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('bootstrap.min.js');?>" type="text/javascript"> </script>
    <script src="<?php echo js_url('jquery.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('bootstrap-modal.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('bootstrap-transition.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('bootstrap-tab.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('jquery-1.11.3.min.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('highcharts.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('grid.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('exporting.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('bootstrap-datepicker.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('bootstrap-scrollspy.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('bootstrap-dialog.js');?> " type="text/javascript"> </script>

    <script>

        $(document).ready(function() {
            $("#nav li a").click(function(){
                var req=$(this).attr("name");


                    $.ajax({
                        type: "GET",
                      url: "http://192.168.10.122/mikiry/index.php/" +req,
                      //url: "http://localhost/mikiry/index.php/" +req,
                        dataType : "html",
                        error:function(msg, string){
                            if (msg.status == 401)
                                location.href = 'authent.gpao';
                            alert( "Error !: " + string );
                        },
                        success:function(data){
                            $("#accueil").empty().hide();
                            $("#accueil").append(data);
                            $('#accueil').fadeIn(500);
                        }
                    });


            });

        })
    </script>

    <script>
        $(document).ready(function(){
            $('#checkAll').click(function() {
                var magazines = $("#fichier").find(':checkbox');
                if(this.checked){
                    magazines.prop('checked', true);
                }else{
                    magazines.prop('checked', false);
                }
            });
        });

    </script>



    <script>
        $("document").ready(function () {
            $("#deconnexion").click(function () {
                $.ajax({
                    type: "POST",
                   // url: "http://localhost/mikiry/index.php/deconnexion_contrl/deconnexion/",
                    url: "http://192.168.10.122/mikiry/index.php/deconnexion_contrl/deconnexion",
                    success:function(data)
                    {
                        $("#body").empty().hide();
                        $("#body").append(data);
                        $('#body').fadeIn(500);
                    }
                });
            });

        });
    </script>


</head>
<?php
if($this->session->userdata('login') == 'TRUE')
{

}
?>
<body id="body">
<!-- Bar ambony indrindra -->
<div class="navbar  navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">

            <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar">a</span>
                <span class="icon-bar">b</span>
                <span class="icon-bar">c</span>
            </a>

            <!-- Be sure to leave the brand out there if you want it shown -->
            <a class="brand" href="#">GPAO</a>

            <!-- Everything you want hidden at 940px or less, place within here -->
            <div class="nav-collapse collapse">

                <!-- .nav, .navbar-search, .navbar-form, etc -->
            </div>
            <ul class="nav pull-right">
                <li>
                    <a href="#" id="deconnexion">Deconnexion</a>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
</br></br></br></br>
<div class="tabbable tabs-left" id="nav" style="margin-bottom: 18px;">
    <?php
    if($this->session->userdata('fonction') == 'PERS')
    {
        ?>
        <ul id="nav" class="nav nav-tabs">
            <li class="active"><a href="" name="accueil/accueil2" data-toggle="tab">Accueil</a></li>
            <li><a href="" name="image_en_n_controllers" data-toggle="tab">Image_N</a></li>
            <li><a href="#"  name="routeur/pointage"  data-toggle="tab">Pointage</a></li>
            <li><a href="#"  name="adminenpouce" data-toggle="tab" >Administration push</a></li>
            <li><a href="#"  name="supp_lot_contrl"  data-toggle="tab">Suppression lot</a></li>
            <li><a href="#"  name="visualisation_faute_controllers"  data-toggle="tab">Visualisation des fautes</a></li>
            <li><a href="#"  name="tab_bord" data-toggle="tab">Tableau de bord</a></li>
            <li><a href="#"  name="tab_bord_recap" data-toggle="tab">Tableau de bord Recap</a></li>
            <li><a href="#" name="insertion_auto_contr" data-toggle="tab">Preparation auto</a></li>
            <li><a href="#" name="insertion_auto_contr" data-toggle="tab">Preparation semi-auto</a></li>
            <li><a href="#"  name="sansfic" data-toggle="tab">Preparation sans fichier</a></li>
            <li><a href="#"  name="preparation_s_m_conctr" data-toggle="tab">Preparation semi-auto</a></li>
            <li><a href="#"  name="routeur/enregist_travail"  data-toggle="tab">Enregistrement de travail</a></li>
            <li><a href="#" name="routeur/importfichier" data-toggle="tab">Import fichier</a></li>
            <li><a href="#" name="enregist_pers" data-toggle="tab">Enregistrement personnel</a></li>
            <li><a href="#" name="presence_contrl" data-toggle="tab">Presence</a></li>
            <li><a href="#" name="affiche_table_contrl" data-toggle="tab">Affiche et suppression table </a></li>
            <li><a href="#" name="enregistre_etape_contr" data-toggle="tab">Enregistrement etape</a></li>
            <li><a href="#"name="maj_commande_contr" data-toggle="tab">MAJ commande standard</a></li>
            <li><a href="#"name="maj_commande_export_contr" data-toggle="tab">MAJ commande export</a></li>
            <li><a href="#"name="ouverture_fermeture_cmd_contr" data-toggle="tab">Ouverture ou fermeture d'une ommande</a></li>
            <li><a href="#" data-toggle="tab">Relevé</a></li>
            <li><a href="#raz" data-toggle="tab">Reinitialisation des images</a></li>
            <li><a href="#"name="standard_o_contr" data-toggle="tab">Remise en O table standard</a></li>
            <li><a href="#"  name="copier"  data-toggle="tab">copie</a></li>
            <li><a href="#"  name="test_copie"  data-toggle="tab">test copie</a></li>
        </ul>
    <?php
    }
    else if($this->session->userdata('fonction') == 'OS')
    {
        ?>
        <ul id="nav" class="nav nav-tabs">
            <li class="active"><a href="" name="accueil/accueil2" data-toggle="tab">Accueil</a></li>
            <li><a href="#"  name="routeur/pointage"  data-toggle="tab">Pointage</a></li>
            <li><a href="#" name="routeur/importfichier" data-toggle="tab">Import fichier</a></li>
            <li><a href="#"  name="routeur/enregist_travail"  data-toggle="tab">Enregistrement de travail</a></li>
            <li><a href="#" data-toggle="tab">Transfert fichier</a></li>
            <li><a href="#"  name="visualisation_faute_controllers"  data-toggle="tab">Visualisation</a></li>
        </ul>
    <?php
    }
    else if($this->session->userdata('fonction') == 'DG')
    {
        ?>
        <ul id="nav" class="nav nav-tabs">
            <li class="active"><a href="" name="accueil/accueil2" data-toggle="tab">Accueil</a></li>
            <li><a href="#"  name="tab_bord" data-toggle="tab">Tableau de bord</a></li>
            <li><a href="#"  name="tab_bord_recap" data-toggle="tab">Tableau de bord Recap</a></li>
        </ul>
    <?php
    }
    else if($this->session->userdata('fonction') == 'CTRL')
    {
    ?>
    <ul id="nav" class="nav nav-tabs">
        <li class="active"><a href="" name="accueil/accueil2" data-toggle="tab">Accueil</a></li>
        <li><a href="#"  name="routeur/pointage"  data-toggle="tab">Pointage</a></li>
        <li><a href="#"  name="routeur/enregist_travail"  data-toggle="tab">Enregistrement de travail</a></li>
        <li><a href="#" name="routeur/importfichier" data-toggle="tab">Import fichier</a></li>
        <li><a href="#" data-toggle="tab">Transfert fichier</a></li>
        <li><a href="#"  name="visualisation_faute_controllers"  data-toggle="tab">Visualisation</a></li>

    </ul>
    <?php
    }
    else if($this->session->userdata('fonction') == 'LIVR')
    {
        ?>
        <ul id="nav" class="nav nav-tabs">
            <li class="active"><a href="" name="accueil/accueil2" data-toggle="tab">Accueil</a></li>
            <li><a href="#"  name="routeur/pointage"  data-toggle="tab">Pointage</a></li>
            <li><a href="#"  name="routeur/enregist_travail"  data-toggle="tab">Enregistrement de travail</a></li>
            <li><a href="#" name="routeur/importfichier" data-toggle="tab">Import fichier</a></li>
            <li><a href="#" data-toggle="tab">Transfert fichier</a></li>
            <li><a href="#"  name="visualisation_faute_controllers"  data-toggle="tab">Visualisation</a></li>

        </ul>
    <?php
    }
    else if($this->session->userdata('fonction') == 'PREPA')
    {
        ?>
        <ul id="nav" class="nav nav-tabs">
            <li class="active"><a href="" name="accueil/accueil2" data-toggle="tab">Accueil</a></li>
            <li><a href="#"  name="routeur/pointage"  data-toggle="tab">Pointage</a></li>
            <li><a href="#"  name="routeur/enregist_travail"  data-toggle="tab">Enregistrement de travail</a></li>
            <li><a href="#"  name="preparationM" data-toggle="tab">Preparation semi-auto</a></li>
            <li><a href="#"  name="sansfic" data-toggle="tab">Preparation sans fichier</a></li>
            <li><a href="#insertionAuto" data-toggle="tab">Preparaztion auto</a></li>
        </ul>
    <?php
    }
    else if($this->session->userdata('fonction') == 'CP')
    {
        ?>
        <ul id="nav" class="nav nav-tabs">
            <li class="active"><a href="" name="accueil/accueil2" data-toggle="tab">Accueil</a></li>
            <li><a href="#"  name="routeur/pointage"  data-toggle="tab">Pointage</a></li>
            <li><a href="#"  name="routeur/enregist_travail"  data-toggle="tab">Enregistrement de travail</a></li>
            <li><a href="#"  name="adminenpouce" data-toggle="tab" >Admin</a></li>
            <li><a href="#"  name="routeur/suppression_lot"  data-toggle="tab">Suppression lot</a></li>
            <li><a href="#"  name="tab_bord" data-toggle="tab">Tableau de bord</a></li>
            <li><a href="#afficheTable" data-toggle="tab">Affiche et Suppression Table </a></li>
            <li><a href="#ouvertureFermetureCommande" data-toggle="tab">Ouverture et Fermeture d'une Commande</a></li>
            <li><a href="#"  name="visualisation_faute_controllers"  data-toggle="tab">Visualisation</a></li>


        </ul>
    <?php
    }
    ?>



    <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
        <div class="active" id="accueil">
            <?php if(isset($pseudo)) ?> <marquee style="color:#00c3ff"  behavior="alternate" direction="right">Bonjour <b><?php echo $pseudo; ?></b> </marquee>
            <img src="<?php echo img_url('logo.png');?>">
        </div>
    </div>
</body>
</html>

