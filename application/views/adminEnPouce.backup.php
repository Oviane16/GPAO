
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>GPAO</title>
    <link href="<?php echo css_url('bootstrap-responsive.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo css_url('bootstrap.css');?>" rel="stylesheet" type="text/css">

    <script src="<?php echo js_url('bootstrap.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('bootstrap.min.js');?>" type="text/javascript"> </script>
    <script src="<?php echo js_url('bootstrap-dropdown.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('jquery.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('bootstrap-modal.js');?> " type="text/javascript"> </script>
    <script src="<?php echo js_url('bootstrap-transition.js');?> " type="text/javascript"> </script>
    <div id="bip" class="display"></div>
    <script>
        var counter = 10;
        var intervalId = null;
        function action()
        {
            clearInterval(intervalId);
            document.getElementById("bip").innerHTML = "TERMINE!";
        }
        function bip()
        {
            document.getElementById("bip").innerHTML = counter + " secondes restantes";
            counter--;
        }
        function start()
        {
            intervalId = setInterval(bip, 1000);
            setTimeout(action, counter * 1000);
        }
    </script>
    <script>
        $("document").ready(function () {
            $("#commande").change(function () {
                if($(this).val() != null){
                    $.ajax({
                        type: 'post',
                        url: 'http://localhost/CodeIgniter_2.1.4/index.php/adminEnPouce/etape/' + $("#commande option:selected" ).text(),
                        beforeSend :function()
                        {
                            if($(".loading").length == 0 )
                            {
                                $("#etape").parent().append('<div class="loading"></div>');
                            }
                        },
                        success: function (data) {
                            $('.loading').remove();
                            $('#etape').empty();
                            $('#etape').html(data);
                        }
                    });
                }
                else alert('tsy tafa');
            });

        });
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
        $(document).ready(function(){
            $('#attribuer2').click(function() {
                alert('tafa');
            });
    </script>
</head>
<body onload="start()" >

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
</div><!-- /.navbar-wrapper -->
<div class="container" style="margin-top:20px;"  >

<?php if(isset($erreur_Et_Sup)) echo $erreur_Et_Sup;?>
<!-- RAHA  Nameno valeur -->
<?php
if(isset($valeur_form)){
    ?>
    <?php
    if(isset($fichier))
    { ?>
        <form method="POST" action="<?php echo site_url("adminEnPouce/ecoute_boutton/$et") ?>">
            <fieldset>
                <table>
                    <td>
                        <label>Matricule :</label>
                        <input name="mat" class="input-mini" type="text" value="<?php echo $valeur_form["matricule"]?>" placeholder=""></td>
                    <td>
                        <label>Mot de passe :</label>
                        <input name="mdp" class="input-mini"  type="password" placeholder="******"></td>
                    <td>
                        <?php
                        if(isset($erreur)){
                            echo $erreur;
                        }
                        ?>
                    </td>
                </table>

                <table>
                    <td>
                        <label>Commande :</label>
                        <select name="commande" id="commande">
                            <option><?php echo $valeur_form["commande"]?></option>
                            <?php
                            foreach($commande as $com)
                            {
                                ?>

                                <option><?php echo $com->COMMANDE; ?></option>
                            <?php
                            }
                            ?>
                        </select></td>
                    <td>
                        <label>Etape :</label>
                        <select name="etape" id="etape">
                            <option><?php echo $valeur_form["etape"]?></option></td><?php
                    if(isset($erreurEt)){
                        echo $erreurEt;
                    }
                    ?>
                    </select>
                </table>
                <label>Option :</label>
                <select name="option" id="option">
                    <option><?php echo $valeur_form["option"]?></option>
                    <option>Aucun</option>
                    <option>En cours</option>
                    <option>Fini</option>
                    <option>Non traité</option>
                    <option>Rejeté</option>
                </select>
                <table>
                    <td><label>De:</label>
                        <input value="<?php echo $valeur_form["de"] ?>" name="de" class="span1" type="text"></td>
                    <td><label>A:</label>
                        <input name="a" value="<?php echo $valeur_form["a"] ?>" class="span1" type="text"></td>
                    <?php
                    if(isset($erreurDeA)){
                        echo $erreurDeA;
                    }
                    ?>
                </table>
                <button type="submit"onclick="start()" name="afficher" id="afficher" class="btn btn-info">Afficher</button>
            </fieldset>

            <!-- Tableau de resultat -->

            <table class="table table-striped" id="fichier" >
                <thead>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Nom du fichier</th>
                    <th>Commande</th>
                    <th>Matricule</th>
                    <th>Etape</th>
                    <th>Etat</th>
                </tr>
                </thead>
                <tbody>

                <?php
                if(isset($fichier))
                {
                    foreach($fichier as $fic)
                    {

                        ?>

                        <tr>

                            <td><input  name="changer_etat[]"  type="checkbox" id="checkbox[]" value="<?php echo $fic->idfichier?>"></td>
                            <td> <?php echo $fic->idfichier; ?></td>
                            <td><?php echo $fic->NOM_FICHIER; ?></td>
                            <td><?php echo $fic->COMMANDE; ?></td>
                            <td><?php echo $fic->matricule; ?></td>
                            <td><?php echo $et;?></td>
                            <td><?php  if($fic->etat == 0)
                                    $e = 'Non traité';
                                if($fic->etat == 2)
                                    $e = 'Fini';
                                if($fic->etat == 1)
                                    $e = 'En cours';
                                if($fic->etat == 3)
                                    $e = 'Rejeté';
                                echo $e; ?></td>
                            <td>



                            </td>
                        </tr>
                    <?php
                    }

                }

                ?>

                <td>...</td><td>...</td><td>...</td><td>...</td><td>...</td><td>...</td><td>...</td><td>...</td>
                </tbody>

            </table>
            <input id="checkAll" type="checkbox"> Tout cocher/Tout decocher</br></br></br>
            <button type="submit" name="initialiser" class="btn btn-danger">Initialiser</button>
            <button type="submit" name="marquerfini" class="btn btn-warning">Marquer fini</button>
            <button data-toggle="modal"   type="submit" class="btn" data-target="#myModal">Attribuer</button>

            <!-- Modal -->
            <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Attribution</h3>
                </div>
                <div class="modal-body">
                    <p>
                        <label>Nouveau matricule :</label>
                        <input name="nouveau_mat" class="input-mini" type="text"placeholder="Ex : 001" >
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
                    <button type="submit" class="btn btn-primary" name="attribuer" >Attribuer</button>
                </div>
            </div>
            <!-- Modal -->

        </form>

    <?php   }
    ?>


    <!-- RAHA  Tsy misy ny valeur -->


<?php
}
else {
    ?>
    <?php
    if(isset($fichier))
    { ?>

        <form method="POST" action="<?php echo site_url("adminEnPouce/ecoute_boutton/$et")?>">
            <fieldset>
                <table>
                    <td>
                        <label>Matricule :</label>
                        <input name="mat" class="input-mini" type="text" placeholder="Ex : 001"></td>
                    <td>
                        <label>Mot de passe :</label>
                        <input name="mdp" class="input-mini" type="password" placeholder="******"></td>
                    <td>
                        <?php
                        if(isset($erreur)){
                            echo $erreur;
                        }
                        ?>
                    </td>
                </table>
                <table>
                    <td>
                        <label>Commande :</label>
                        <select name="commande" id="commande">
                            <option>Choisir un commande</option>
                            <?php
                            foreach($commande as $com)
                            {
                                ?>

                                <option><?php echo $com->commande; ?></option>
                            <?php
                            }
                            ?>
                        </select></td>
                    <td>
                        <label>Etape :</label>

                        <select name="etape" id="etape">
                        </select></td><?php
                    if(isset($erreurEt)){
                        echo $erreurEt;
                    }
                    ?>
                </table>
                <label>Option :</label>
                <select name="option" id="option">
                    <option>Aucun</option>
                    <option>En cours</option>
                    <option>Fini</option>
                    <option>Non traité</option>
                    <option>Rejeté</option>
                </select>
                <table>
                    <td><label>De:</label>
                        <input name="de" class="span1" type="text"></td>
                    <td><label>A:</label>
                        <input name="a" class="span1" type="text"></td>
                    <?php
                    if(isset($erreurDeA)){
                        echo $erreurDeA;
                    }
                    ?>
                </table>
                <button type="submit" id="afficher"onclick="start()" name="afficher" class="btn btn-info">Afficher</button>
            </fieldset>

            <!-- Tableau de resultat -->

            <table class="table table-striped" id="fichier" >
                <thead>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Nom du fichier</th>
                    <th>Commande</th>
                    <th>Matricule</th>
                    <th>Etape</th>
                    <th>Etat</th>
                </tr>
                </thead>
                <tbody>

                <?php
                if(isset($fichier))
                {
                    foreach($fichier as $fic)
                    {

                        ?>

                        <tr>

                            <td><input  name="changer_etat[]"  type="checkbox" id="checkbox[]" value="<?php echo $fic->idfichier?>"></td>
                            <td> <?php echo $fic->idfichier; ?></td>
                            <td><?php echo $fic->NOM_FICHIER; ?></td>
                            <td><?php echo $fic->COMMANDE; ?></td>
                            <td><?php echo $fic->MATRICULE; ?></td>
                            <td><?php echo $et;?></td>
                            <td><?php  if($fic->etat == 0)
                                    $e = 'Non traité';
                                if($fic->etat == 2)
                                    $e = 'Fini';
                                if($fic->etat == 1)
                                    $e = 'En cours';
                                if($fic->etat == 3)
                                    $e = 'Rejeté';
                                echo $e; ?></td>
                            <td>



                            </td>
                        </tr>
                    <?php
                    }

                }

                ?>

                <td>...</td><td>...</td><td>...</td><td>...</td><td>...</td><td>...</td><td>...</td><td>...</td>
                </tbody>

            </table>
            <input id="checkAll" type="checkbox"> Tout cocher/Tout decocher</br></br></br>
            <button type="submit" name="initialiser" class="btn btn-danger">Initialiser</button>
            <button type="submit" name="marquerfini" class="btn btn-warning">Marquer fini</button>
            <button data-toggle="modal"   type="submit" class="btn" data-target="#myModal">Attribuer</button>

            <!-- Modal -->
            <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Attribution</h3>
                </div>
                <div class="modal-body">
                    <p>
                        <label>Nouveau matricule :</label>
                        <input name="nouveau_mat" class="input-mini" type="text"placeholder="Ex : 001" >
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
                    <button type="submit" class="btn btn-primary" name="attribuer" >Attribuer</button>
                </div>
            </div>
            <!-- Modal -->

        </form>


    <?php   }else
    { ?>

        <form method="POST" action="<?php echo site_url("adminEnPouce/ecoute_boutton/") ?>">
    <?php }?>



    <fieldset>
        <table>
            <td>
                <label>Matricule :</label>
                <input name="mat" class="input-mini" type="text" placeholder="Ex : 001"></td>
            <td>
                <label>Mot de passe :</label>
                <input name="mdp" class="input-mini" type="password" placeholder="******"></td>
            <td>
                <?php
                if(isset($erreur)){
                    echo $erreur;
                }
                ?>
            </td>
        </table>
        <table>
            <td>
                <label>Commande :</label>
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
                </select></td>
            <td>
                <label>Etape :</label>
                <select name="etape" id="etape">
                </select></td><?php
            if(isset($erreurEt)){
                echo $erreurEt;
            }
            ?>
        </table>
        <label>Option :</label>
        <select name="option" id="option">
            <option>Aucun</option>
            <option>En cours</option>
            <option>Fini</option>
            <option>Non traité</option>
            <option>Rejeté</option>
        </select>
        <table>
            <td><label>De:</label>
                <input name="de" class="span1" type="text"></td>
            <td><label>A:</label>
                <input name="a" class="span1" type="text"></td>
            <?php
            if(isset($erreurDeA)){
                echo $erreurDeA;
            }
            ?>
        </table>
        <button type="submit" id="afficher" onclick="start()" name="afficher" class="btn btn-info">Afficher</button>
    </fieldset>

    <!-- Tableau de resultat -->

    <table class="table table-striped" id="fichier" >
        <thead>
        <tr>
            <th></th>
            <th>Id</th>
            <th>Nom du fichier</th>
            <th>Commande</th>
            <th>Matricule</th>
            <th>Etape</th>
            <th>Etat</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if(isset($fichier))
        {
            foreach($fichier as $fic)
            {

                ?>

                <tr>

                    <td><input  name="changer_etat[]"  type="checkbox" id="checkbox[]" value="<?php echo $fic->idfichier?>"></td>
                    <td> <?php echo $fic->idfichier; ?></td>
                    <td><?php echo $fic->NOM_FICHIER; ?></td>
                    <td><?php echo $fic->COMMANDE; ?></td>
                    <td><?php echo $fic->MATRICULE; ?></td>
                    <td><?php echo $et;?></td>
                    <td><?php  if($fic->ETAT == 0)
                            $e = 'Non traité';
                        if($fic->ETAT == 2)
                            $e = 'Fini';
                        if($fic->ETAT == 1)
                            $e = 'En cours';
                        if($fic->ETAT == 3)
                            $e = 'Rejeté';
                        echo $e; ?></td>
                    <td>



                    </td>
                </tr>
            <?php
            }

        }

        ?>

        <td>...</td><td>...</td><td>...</td><td>...</td><td>...</td><td>...</td><td>...</td><td>...</td>
        </tbody>

    </table>
    <input id="checkAll" type="checkbox"> Tout cocher/Tout decocher</br></br></br>
    <button type="submit" name="initialiser" class="btn btn-danger">Initialiser</button>
    <button type="submit" name="marquerfini" class="btn btn-warning">Marquer fini</button>
    <button data-toggle="modal"   type="submit" class="btn" data-target="#myModal">Attribuer</button>

    <!-- Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Attribution</h3>
        </div>
        <div class="modal-body">
            <p>
                <label>Nouveau matricule :</label>
                <input name="nouveau_mat" class="input-mini" type="text"placeholder="Ex : 001" >
            </p>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
            <button type="submit" class="btn btn-primary" name="attribuer" >Attribuer</button>
        </div>
    </div>
    <!-- Modal -->

    </form>
<?php  }
?>





</br></br></br></br></br></br></br></br></br></br></br></br></br></br>


</div>
</body>
</html>

