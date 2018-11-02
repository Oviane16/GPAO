<?php
include "connection.php";
?>

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
        periode = setInterval(clignotementFading, 115);

        /*

        function si_livraison(){
            $.ajax({

                    url: 'livraison.php',
                    method: 'post',
                    data: {
                        'commande': $('[name="commande"]').val(),
                        'etape': $('[name="etape"]').val(),
                        'matricule': $('[name="matricule"]').val(),
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.tache==false){
                            $('#LblClignotant').html('L\'étape ' + data.etape + ' pour la commande ' + data.commande  +  ' est terminée');
                            //alert('L\'étape ' + data.etape + ' pour la commande ' + data.commande  +  ' est terminée');
                            return;
                        }
                        if (!data.enregistrement_ok) {
                            $('#LblClignotant').html('Vous avez encore de travail');
                            return;
                        }
                            if (data.livraison==true){
                                alert(data.donneeslivraison.length);
                                html = '';
                                isa = 0;
                                alivrer = [];
                                for (isa==1; isa < data.donneeslivraison.length; isa++) {
                                    //html += '<tr><td><p>' + data.donneeslivraison[isa] + '</p></td></tr>';
                                    html += '<tr><td><p><input type="checkbox" name="alivrer[]" walue="' + isa + '">' + data.donneeslivraison[isa] + '</p></td></tr>';
                                }
                                alert('livraison');
                                $('[name="listelivraison"]').html(html);
                            }else{
                                $('#LblClignotant').html('Il n\' a plus de fichier à traiter');
                                return;

                            }



                        }

                    }
            )};

*/




        function enreg(){
            $.ajax({
                    url: "http://localhost/mikiry/index.php/routeur/enregistrement/",
                    //url: "http://192.168.10.122/mikiry/index.php/routeur/enregistrement/",
                    method: 'post',
                    data: {
                        'commande': $('[name="commande"]').val(),
                        'etape': $('[name="etape"]').val(),
                        'matricule': $('[name="matricule"]').val(),
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.tache==false){
                            $('#LblClignotant').html('L\'étape ' + data.etape + ' pour la commande ' + data.commande  +  ' est terminée');
                            //alert('L\'étape ' + data.etape + ' pour la commande ' + data.commande  +  ' est terminée');
                            return;
                        }
                        if (!data.enregistrement_ok) {
                            $('#LblClignotant').html('Vous avez encore de travail');
                            return;
                        }

                        if (data.enregistrement_ok){

                            switch(data.enregistrement_ok) {
                                case ("fichier_un_a_un"):
                                    if (data.fichier_saisie == false){
                                        $('#LblClignotant').html('Votre fichier est ' + data.lot + ' mais le fichier saisie n\'est pas copié');
                                    }else{
                                        $('#LblClignotant').html('Votre fichier est ' + data.lot);
                                    }
                                    break;
                                case ("suivi_fichier"):
                                    $('#LblClignotant').html('Votre fichier est ' + data.lot + '<br>mais il n\'est pas enregistré dans la table fichier_un_a_un');
                                    break;
                                case ("fichier"):
                                    $('#LblClignotant').html('Votre fichier devrait être ' + data.lot + '<br>appelez votre informaticien');
                                    break;
                                default:
                                    $('#LblClignotant').html(data.enregistrement_ok);
                                    break;
                            }
                        }else{
                            $('#LblClignotant').html('Il n\' a plus de fichier à traiter');
                            return;
                        }

                    }}
            )};
        function insertion_etape(){
            $.ajax({

                url: "http://localhost/mikiry/index.php/routeur/choix/",
                //url: "http://192.168.10.122/mikiry/index.php/routeur/choix/",
                method: 'post',
                data: {
                    'commande': $('[name="commande"]').val()
                },
                dataType: 'json',
                success: function (data) {
                    $('#observation').html('');
                    $('#LblClignotant').html('');
                    if (!data.connect_etape) {
                        $('#LblClignotant').html('Erreur de connection ETAPE');
                        return;
                    }
                if (data.connect_etape.length > 0){
                    //alert(data.connect_etape.length);
                    i = 0;
                var html = '';
                while (i <  data.connect_etape.length){
                    html += '<option value="' + data.connect_etape[i] + '">' + data.connect_etape[i] + '</option>';
                    i = i + 1;
                }
                $('[name="etape"]').html(html);
            }else{
                    alert('Etape non faite');
                }

            }}
            )};
        function connect(){
            $.ajax({
                url: "http://localhost/mikiry/index.php/routeur/authentification/",
                //url: "http://192.168.10.122/mikiry/index.php/routeur/authentification/",
                method: 'post',
                data: {
                    'matricule': $('[name="matricule"]').val(),
                    'pass': $('[name="pass"]').val()
                },
                dataType: 'json',
                success: function(data){
                    $('[name="nom"]').val('');
                    $('[name="prenom"]').val('');
                    $('[name="pseudo"]').val('');
                    $('[name="fonction"]').val('');
                    $('#LblClignotant').html('');
                    $('#observation').html('');
                    $('#LblClignotant').html('');
                    $('[name="nom"]').attr('disabled', 'disabled');
                    $('[name="prenom"]').attr('disabled', 'disabled');
                    $('[name="pseudo"]').attr('disabled', 'disabled');
                    $('[name="fonction"]').attr('disabled', 'disabled');

                    if  (! data.connection) {
                        $('[name="enregistre"]').attr('disabled', 'disabled');
                        $('[name="nom"]').val('Mikiry');
                        $('[name="prenom"]').val('Mikiry');
                        $('[name="pseudo"]').val('Mikiry');
                        $('[name="fonction"]').val('Mikiry');
                        $('#LblClignotant').html('Personnel inconnu<br>ou vous n\'avez pas l\'autorisation');
                        return;
                    }
                    $('[name="nom"]').val(data.personne.NOM);
                    $('[name="prenom"]').val(data.personne.PRENOM);
                    $('[name="pseudo"]').val(data.personne.PSEUDO);
                    $('[name="fonction"]').val(data.personne.FONCTION);


                    if (data.hasWork) {
                        $('#LblClignotant').html('Vous avez encore du travail');
                        $('#observation').html('ETAPE :  ' +  data.zetape + '<br>LOT : ' + data.zlot);
                        //$('[name="enregistre"]').attr('disabled', 'disabled');
                        $('[name="enregistre"]').attr('display', 'hidden');

                        return;
                    }
                    else {
                     //   $('#LblClignotant').html('Vous n\'avez pas de travail');
                        if (!data.pointage){
                            $('#LblClignotant').html('Vous n\'avez encore pas fait du pointage');
                            $('[name="enregistre"]').attr('disabled', 'disabled');
                            return;
                        }

                        $('[name="enregistre"]').attr('enabled', 'enabled');
                        if (data.commandes.length > 0){
                            i = 0;
                            var html = '';
                           // alert(data.commandes.length);
                            while (i <  data.commandes.length){
                                html += '<option value="' + data.commandes[i] + '">' + data.commandes[i] + '</option>';
                                i = i + 1;
                            }
                            $('[name="commande"]').html(html);
                        }

                    }
                    //alert(data.NOM);
                }
            });
        };

    </script>
</head>
<body>
<header>
</header>
<table ALIGN="center" width="30%">
    <tr ><td>
<div style="background-image:url('<?php echo img_url('foote.PNG'); ?>');">
    <h1 style="color:violet;background-image:url('<?php echo img_url('t.PNG'); ?>');" align="center">Enregistrement de travail</h1>
<form name="insertion"  method="POST">
  <table border="0" align="center">
  <body>
    <tr align="center">
      <td>Matricule:</td>
      <td><input   type="text" name="matricule"style="background-color:#fff;
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
	font-size: 18px;" value= "<?php if (!empty ($matricule)) echo $matricule ; else echo "Mikiry" ; ?>"></td>
    </tr>
     <br>
    <tr>
	  <td>Pass:</td>
      <td><input  type="password" name="pass" style="background-color:#fff;
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
	font-size: 18px;" onchange="connect()" value= "<?php if (!empty ($pass)) echo $pass ; else echo "Passe"; ?>"></td>
    </tr>
    <tr>
        <td>Nom</td>
        <td><input  type="text" name="nom" style="background-color:#fff;
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
	font-size: 18px;"></td>
    </tr>
    <tr>
        <td>Prenom</td>
        <td><input  type="text" name="prenom" style="background-color:#fff;
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
	font-size: 18px;"></td>
    </tr>

    <tr>
        <td>Pseudo</td>
        <td><input  type="text" name="pseudo" style="background-color:#fff;
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
	font-size: 18px;"></td>
    </tr>




    <tr>
        <td>Fonction</td>
        <td><input  type="text" name="fonction" style="background-color:#fff;
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
	font-size: 18px;"></td>
    </tr>

    <tr>
        <td>Commande</td>
        <td><select  type="text" name="commande" style="background-color:#fff;
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
	font-size: 18px;" onchange="insertion_etape()"></td>
    </tr>

    <tr>
        <td>Etape</td>
        <td><select  type="text" name="etape" style="background-color:#fff;
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
	font-size: 18px;"></td>
    </tr>

    <tr align="center">
<td>
  </td>
  </tr>
    <tr align="center">
	<p>
      <td colspan="2">
            <img src="<?php echo img_url('login.jpg') ?>" width="78px" height="21px" name="enregistre" border="0" onclick="enreg()" />
      </td>
</tr>
    <tr align="center">
        <td colspan="2"><strong style="color:red"><label id="LblClignotant"></label></strong></td>
        <table name="listelivraison">
        </table>
    </tr>
    <tr align="center">
        <td colspan="2"><strong style="color:blue"><label id="observation"></label></strong></td>
    </tr>
  </body>
  </table>
</form>
</div>
        </td>
    </tr>
</table>
