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
        function password(){
            $.ajax({
                url: "http://localhost/mikiry/verifmotdepasse.php",
                method: 'post',
                data: {
                    'motdepasse': $('[name="motdepasse"]').val(),
                    'matricule': $('[name="matricule"]').val()
                },
                dataType: 'json',
                success: function (data) {
                    $('[name="validation"]').attr('disabled', 'disabled');

                    if (data.valide == false) {
                        $('#LblClignotant').html(data.alerte);
                        document.getElementById("validation").src = "image/stop.jpg";
                    } else {
                        $('#LblClignotant').html(data.alerte);
                        document.getElementById("validation").src = "image/login.jpg";
                        $('[name="validation"]').attr('enabled', 'enabled');
                    }
                }
            }
            )};

        function suppression(){
            var element = document.getElementById("validation").src
            var hita = element.indexOf("login");
            if (hita > 0){
                $.ajax({
                        url: "http://localhost/mikiry/suppressionlot.php",
                        method: 'post',
                        data: {
                            'commande': $('[name="commande"]').val(),
                        },
                        dataType: 'json',
                        success: function (data) {
                            if (data.message) {
                                alert(data.message);
                                //$('#LblClignotant').html(data.alerte);
                            }
                        }
                    }
                )
            }else {
                alert('Aucune modification faite');
            }
        };
    </script>
</head>
<body>
<header>
</header>
<table ALIGN="center" width="30%">
    <tr ><td>
            <div style="background-image:url('image/foote.PNG');">
                <h1 style="color:violet;background-image:url('image/t.PNG');" align="center">Transfert fichier</h1>
                <form name="insertion"  method="POST">
                    <table border="0" align="center">
                        <body>
                        <tr align="center">
                            <td></td>
                            <td>Comande:</td>
                            <td><input   type="text" name="commande"style="background-color:#fff;
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
                            <td>Pass:</td>
                            <td><input  type="password" name="motdepasse" style="background-color:#fff;
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
	font-size: 18px;" onchange="password()" value= "<?php if (!empty ($motdepasse)) echo $motdepasse; else echo "Passe"; ?>"></td>
                            <td><img src="image/stop.jpg" width="78px" height="21px" id="validation" border="0"  onclick="suppression()" disable/></td>
                            <td></td>
                        </tr>
                        <tr align="center">
                            <td></td>
                            <td colspan="5"><strong style="color:red"><label id="LblClignotant"></label></strong></td>
                        </tr>
                        </body>
                    </table>
                </form>
            </div>
        </td>
    </tr>
</table>
