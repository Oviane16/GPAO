<?php
include "connection.php";
$pass= $_POST["pass"];
$matricule= $_POST["matricule"] ;
$nombrePersonne=0;
$qr = "SELECT * FROM \"PERSONNEL\" where \"MATRICULE\"='$matricule' and \"MDP\"='$pass'" or die('Erreur');
$con = new connection_base();
$resu = $con->getresult($qr);
//$resu = pg_query($qr) or die('échec de la requête : ' . pg_last_error());
$line = pg_fetch_array($resu);
if (pg_affected_rows($resu)==1) {
    if ($line["FONCTION"] != "OS" && $line["FONCTION"] != "CTRL" && $line["FONCTION"] != "PERS") {
        echo("<script>alert('Programme destiné pour les OS et CTRL');window.open(enregist_travail.php",\"menubar=no, status=no, width=100px\");</script>");
    } else {
        //MIJERY RAHA MANANA ASA
        $prenom = $line["PRENOM"];
        $nom = $line["NOM"];
        $fonction = $line["FONCTION"];
        $pseudo = $line["PSEUDO"];
        $suivifichier = $con->getResult("SELECT * FROM \"SUIVI_FICHIER\" WHERE \"MATRICULE\"='$matricule' and  \"DATEFIN\" is null ORDER BY \"COMMANDE\" ASC") or die('Erreur suivi fichier');
        $suivi = pg_fetch_array($suivifichier);
        $nahavitaAsa = 0;
        if (pg_affected_rows($suivifichier) == 1) {
            $lot = $suivi["LOT"];
            $etape = $suivi["ETAPE"];
            ?>
            <html>
            <head>
                <title>Mikiry</title>
                <meta charset="utf-8">
                <link rel="stylesheet" href="style.css"/>
                <script type="text/javascript">
                    var signe = -1;
                    var clignotementFading = function () {
                        var obj = document.getElementById('LblClignotant');
                        if (obj.style.opacity >= 0.96) {
                            signe = -1;
                        }
                        if (obj.style.opacity <= 0.04) {
                            signe = 1;
                        }
                        obj.style.opacity = (obj.style.opacity * 1) + (signe * 0.04);
                    };

                    // mise en place de l appel de la fonction toutes les 0.085 secondes
                    // Pour arr�ter le clignotement : clearInterval(periode);
                    periode = setInterval(clignotementFading, 5);
                </script>
            </head>
        <body style="margin-left:260px; margin-right:260px; margin-top:100px;">
        <div style="background-image:url('image/foote.PNG');">
            <h1 style="color:violet;background-image:url('image/t.PNG');">Enregistrement de travail</h1>
            <form name="insertion" action="enregist_travail.php" method="post">
            <table border="0" align="center" cellspacing="2" cellpadding="2">
            <tr align="center">
                <td style="color:BLUE;">Matricule:</td>
                <td>
                    <input type="text" name="matricule"
                           value="<?php echo $matricule; ?>" style="background-color:#fff;
                                            color:#696969;
                                            -moz-border-radius:30px;
                                            -webkit-border-radius:30px;
                                            border-radius:5px;
                                            width:186px;
                                            height:29px;
                                            border:1px solid #DCDCDC;
                                            box-shadow:inset 0 1px 3px #DCDCDC;
                                            cursor:pointer;
                                            padding-left: 5px;
                                            font-size: 18px;">
                </td>
            </tr>
            <tr align="center">
                <td style="color:blue;">PSEUDO:</td>
                <td><input name="speudo" type="text" value="<?php echo $pseudo; ?>"
                                            style="background-color:#fff;
                                            color:#696969;
                                            -moz-border-radius:30px;
                                            -webkit-border-radius:30px;
                                            border-radius:5px;
                                            width:186px;
                                            height:29px;
                                            border:1px solid #DCDCDC;
                                            box-shadow:inset 0 1px 3px #DCDCDC;
                                            cursor:pointer;
                                            padding-left: 5px;
                                            font-size: 18px;">
                </td>
            <tr>
                <td style="color:blue;">FONCTION:</td>
                <td><input name="fonction" type="text" value="<?php echo $fonction; ?>"
                                            style="background-color:#fff;
                                            color:#696969;
                                            -moz-border-radius:30px;
                                            -webkit-border-radius:30px;
                                            border-radius:5px;
                                            width:186px;
                                            height:29px;
                                            border:1px solid #DCDCDC;
                                            box-shadow:inset 0 1px 3px #DCDCDC;
                                            cursor:pointer;
                                            padding-left: 5px;
                                            font-size: 18px;">
                </td>
            </tr>
            <tr align="center">
                <td style="color:blue;">PRENOM:</td>
                <td><input name="prenom" type="text" value="<?php echo $prenom; ?>"
                                            style="background-color:#fff;
                                            color:#696969;
                                            -moz-border-radius:30px;
                                            -webkit-border-radius:30px;
                                            border-radius:5px;
                                            width:186px;
                                            height:29px;
                                            border:1px solid #DCDCDC;
                                            box-shadow:inset 0 1px 3px #DCDCDC;
                                            cursor:pointer;
                                            padding-left: 5px;
                                            font-size: 18px;">
                </td>
            </tr>
            <tr align="center">
                    <td colspan="2"><strong style="color:red"><label id="LblClignotant">Vous avez encore de travail</label></strong></td>
           </tr>
           <tr>
                    <td><a style="color:red">ETAT:&nbsp;<?php echo $etape; ?>
                            &nbsp;&nbsp;LOT:&nbsp;<?php echo $lot; ?></a></td>
           </tr>
                <tr align="center">
                    <td colspan="2">
                        <input name="ENTRE" type="submit" value="OK">
                    </td>
                    <td></td>
                </tr>
                </table>
                </form>
                </div>
                </body>
                </html>
            <?php



        } else {

            if (($tabloMDP[$i] == $pass) && ($trouver == 1) && ($tabloMATRICULE[$i] == $matricule) && ($nahavitaAsa == 1)) {
                //entre  si le mots de pass est vrais
                $dbconn = pg_connect("host=localhost dbname=saisie user=postgres password=server");
                $sql = "SELECT \"PRENOM\",\"FONCTION\",\"PSEUDO\" FROM \"PERSONNEL\" WHERE \"MATRICULE\" ='$matricule' and \"MDP\"='$pass'" or die('Erreur');
                $result = pg_query($sql) or die('échec de la requête : ' . pg_last_error());
                while ($row = pg_fetch_assoc($result)) {
                    ?>
                    <html>
                    <head>
                        <title>Mikiry</title>
                        <script type='text/javascript'>
                            function getXhr() {
                                var xhr = null;
                                if (window.XMLHttpRequest) { // Firefox et autres
                                    xhr = new XMLHttpRequest();
                                }
                                else if (window.ActiveXObject) { // Internet Explorer
                                    try {
                                        xhr = new ActiveXObject("Msxml2.XMLHTTP");
                                    } catch (e) {
                                        xhr = new ActiveXObject("Microsoft.XMLHTTP");
                                    }
                                }
                                else { // XMLHttpRequest non support� par le navigateur
                                    alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
                                    xhr = false;
                                }
                                return xhr;
                            }

                            /**
                             * M�thode qui sera appel�e sur le click du bouton
                             */
                            function change() {
                                var xhr = getXhr();
                                // On d�fini ce qu'on va faire quand on aura la r�ponse
                                xhr.onreadystatechange = function () {
                                    //alert(xhr.readyState);
                                    // On ne fait quelque chose que si on a tout re�u et que le serveur est ok
                                    if (xhr.readyState == 4 && xhr.status == 200) {
                                        di = document.getElementById('etape');
                                        di.innerHTML = xhr.responseText;
                                    }
                                }
                                // Ici on va voir comment faire du post
                                xhr.open("POST", "etapes.php", true);
                                // ne pas oublier �a pour le post
                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                // ne pas oublier de poster les arguments  ici, l'id de commande
                                //idcommande = document.getElementById('commande').options[document.getElementById('commande').selectedIndex].value;
                                idcommande = document.getElementById('commande').options[document.getElementById('commande').selectedIndex].text;
                                //alert(idcommande);
                                xhr.send("idCommande=" + idcommande);
                                //xhr.send("idcom"=+idCom);
                            }
                        </script>
                        <meta charset="utf-8">
                        <link rel="stylesheet" href="style.css"/>
                        <script src="jquery.js"></script>
                    </head>
                    <body style="margin-left:260px; margin-right:260px; margin-top:110px;">
                    <div style="background-image:url('image/foote.PNG');">
                        <h1 style="color:violet;background-image:url('image/t.PNG');">Enregistrement de travail</h1>

                        <form name="insertion" action="enregistrementTr.php" method="post">
                            <table border="0" align="center" cellspacing="2" cellpadding="2">
                                <tr align="center">
                                    <td style="color:blue;">Matricule:</td>
                                    <td><input type="text" name="matricule" value="<?php echo $matricule; ?>"
                                        onchange="" style="background-color:#fff;
                                        color:#696969;
                                        -moz-border-radius:30px;
                                        -webkit-border-radius:30px;
                                        border-radius:5px;
                                        width:186px;
                                        height:29px;
                                        border:1px solid #DCDCDC;
                                        box-shadow:inset 0 1px 3px #DCDCDC;
                                        cursor:pointer;
                                        padding-left: 5px;
                                        font-size: 18px;">
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td style="color:blue;">Speudo:</td>
                                    <td><input name="pseudo" type="text" value="<?php echo $row['PSEUDO']; ?>"
                                               style="background-color:#fff;
                                        color:#696969;
                                        -moz-border-radius:30px;
                                        -webkit-border-radius:30px;
                                        border-radius:5px;
                                        width:186px;
                                        height:29px;
                                        border:1px solid #DCDCDC;
                                        box-shadow:inset 0 1px 3px #DCDCDC;
                                        cursor:pointer;
                                        padding-left: 5px;
                                        font-size: 18px;">
                                    </td>
                                    <td style="color:blue;">Fonction:<input name="fonction" type="text"
                                                                            value="<?php echo $row['FONCTION']; ?>"
                                                                            style="background-color:#fff;
                                        color:#696969;
                                        -moz-border-radius:30px;
                                        -webkit-border-radius:30px;
                                        border-radius:5px;
                                        width:186px;
                                        height:29px;
                                        border:1px solid #DCDCDC;
                                        box-shadow:inset 0 1px 3px #DCDCDC;
                                        cursor:pointer;
                                        padding-left: 5px;
                                        font-size: 18px;">
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td style="color:blue;">Prenom:</td>
                                    <td><input name="prenom" type="text" value="<?php echo $row['PRENOM']; ?>"
                                               style="background-color:#fff;
                                        color:#696969;
                                        -moz-border-radius:30px;
                                        -webkit-border-radius:30px;
                                        border-radius:5px;
                                        width:186px;
                                        height:29px;
                                        border:1px solid #DCDCDC;
                                        box-shadow:inset 0 1px 3px #DCDCDC;
                                        cursor:pointer;
                                        padding-left: 5px;
                                        font-size: 18px;">
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td style="color:blue;">Commande:</td>
                                    <td><select name='commande' id='commande' onchange='change()' style="background-color:#fff;
                                        color:#696969;
                                        -moz-border-radius:30px;
                                        -webkit-border-radius:30px;
                                        border-radius:5px;
                                        width:186px;
                                        height:29px;
                                        border:1px solid #DCDCDC;
                                        box-shadow:inset 0 1px 3px #DCDCDC;
                                        cursor:pointer;
                                        padding-left: 5px;
                                        font-size: 18px;">
                                            <option>Choisir commande</option>
                                            <?php
                                            //Algoritheme de commande pour regarde la travaille existant la travaille
                                            //CONTER LE NOmbre de commande existant
                                            //$dbconn = pg_connect("host=localhost dbname=saisie user=postgres password=server");
                                            $quernbCommande = "SELECT DISTINCT \"COMMANDE\" FROM \"FICHIER\" where \"POSITION_FINALE\" <> 'fini' ORDER BY \"COMMANDE\"" or die('Erreur');
                                            $resnbCommande = pg_query($quernbCommande) or die('échec de la requête : ' . pg_last_error());
                                            $nbCommande = 0;
                                            while ($line = pg_fetch_array($resnbCommande, null, PGSQL_ASSOC)) {
                                                foreach ($line as $col_value) {
                                                }
                                                $nbCommande++;
                                            }
                                            pg_free_result($resnbCommande);
                                            //fin de conter
                                            //liste de commande existant
                                            //$dbconn = pg_connect("host=localhost dbname=saisie user=postgres password=server");
                                            $querCommande = "SELECT DISTINCT \"COMMANDE\" FROM \"FICHIER\" where \"POSITION_FINALE\" <> 'fini' ORDER BY \"COMMANDE\"" or die('Erreur');
                                            $resCommande = pg_query($querCommande) or die('échec de la requête : ' . pg_last_error());
                                            $tabloCommande[$nbCommande];
                                            $i = 1;
                                            while ($line = pg_fetch_array($resCommande, null, PGSQL_ASSOC)) {
                                                foreach ($line as $col_value) {
                                                    $tabloCommande[$i] = $col_value;
                                                }
                                                $i++;
                                            }
                                            pg_free_result($resCommande);
                                            // fin de liste de commande existant
                                            //fin algoritheme de de commande pour regarde la travaille existant la travaille existant
                                            $i = 1;
                                            while ($i <= $nbCommande) {
                                                ?>
                                                <option><?php echo $tabloCommande[$i]; ?></option>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr align="center">
                                    <td style="color:blue;"><label>ETAPE</label></td>
                                    <td style="color:blue;">
                                        <div id='etape' style='display:inline'>
                                            <select name='etape' style="background-color:#fff;
                                                    color:#696969;
                                                    -moz-border-radius:30px;
                                                    -webkit-border-radius:30px;
                                                    border-radius:5px;
                                                    width:186px;
                                                    height:29px;
                                                    border:1px solid #DCDCDC;
                                                    box-shadow:inset 0 1px 3px #DCDCDC;
                                                    cursor:pointer;
                                                    padding-left: 5px;
                                                    font-size: 18px;">
                                                <option value='-1'>Choisir l'étape</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <image src="image/foote.PNG" height=36px; width=36px/>
                                    <tr align="center">
                                        <td>
                                            <image src="image/foote.PNG" height=36px; width=36px/>
                                        </td>
                                    </tr>
                                    <tr align="center">
                                        <td colspan="2"><input name="enregistre" type="submit" value="OK"></td>
                                    </tr>
                                    <tr align="center">
                                    </tr>
                            </table>
                        </form>
                    </div>
                    </body>
                    </html>
                <?php
                }
            }
        }
    }

}
    ?>