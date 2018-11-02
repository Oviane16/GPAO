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
        url: 'remplirformulaire.php',
        method: 'post',
        data: {
            'motdepasse': $('[name="motdepasse"]').val(),
            'matricule': $('[name="matricule"]').val(),
        },
        dataType: 'json',
        success: function (data) {
            $('[name="importer"]').attr('disabled', 'disabled');
            $('[name="exporter"]').attr('disabled', 'disabled');
            if (data.valide == 'inconnu') {
                $('#LblClignotant').html('Personnel inconnu');
            } else {
                if (data.valide == 'connu') {
                    $('#LblClignotant').html(data.alerte);
                    $('#prenom').html(data.prenom);
                    $('#fonction').html(data.fonction);
                    $('#pseudo').html(data.pseudo);
                    /*ilaina ireto ambany ireto
                     var element = document.getElementById("pseudo").firstChild;
                     alert(element.nodeValue);*/
                } else {
                    if (data.valide == 'ko') {
                        $('#LblClignotant').html(data.alerte);
                        $('#prenom').html(data.prenom);
                        $('#fonction').html(data.fonction);
                        $('#pseudo').html(data.pseudo);
                    } else {
                        if (data.valide == 'ok') {
                            $('#LblClignotant').html(data.alerte);
                            $('#observation').html(data.etape);
                            $('#prenom').html(data.prenom);
                            $('#fonction').html(data.fonction);
                            $('#pseudo').html(data.pseudo);
                        }
                    }
                }
            }
        }
    })};

function importation(){
    var element = document.getElementById("LblClignotant").firstChild;
    if (element.nodeValue.indexOf('=') != 0){
//        alert(element.nodeValue.indexOf('='));
        $.ajax({
            url: 'importation.php',
            method: 'post',
            data: {
                'matricule': $('[name="matricule"]').val(),
            },
            dataType: 'json',
            success: function (data) {
                if (data.valide == 'inconnu') {
                    $('#LblClignotant').html('Personnel inconnu');
                } else {
                    if (data.valide == 'connu') {
                        $('#LblClignotant').html(data.alerte);
                        $('#prenom').html(data.prenom);
                        $('#fonction').html(data.fonction);
                        $('#pseudo').html(data.pseudo);
                        /*ilaina ireto ambany ireto
                         var element = document.getElementById("pseudo").firstChild;
                         alert(element.nodeValue);*/
                    } else {
                        if (data.valide == 'ko') {
                            $('#LblClignotant').html(data.alerte);
                            $('#prenom').html(data.prenom);
                            $('#fonction').html(data.fonction);
                            $('#pseudo').html(data.pseudo);
                        } else {
                            if (data.valide == 'ok') {
                                $('#LblClignotant').html(data.alerte);
                            }
                        }
                    }
                }
                if (data.message != ''){
                    alert(data.message);
                }
            }
        })
    }else{
        alert('Il n\'a pas de fichier à importer');
    }
};
function exportation(){
    var element = document.getElementById("LblClignotant").firstChild;
    if (element.nodeValue.indexOf('=') != 0){
//        alert(element.nodeValue.indexOf('='));
        $.ajax({
            url: 'exportation.php',
            method: 'post',
            data: {
                'matricule': $('[name="matricule"]').val(),
            },
            dataType: 'json',
            success: function (data) {
                if (data.valide == 'inconnu') {
                    $('#LblClignotant').html('Personnel inconnu');
                }
                if (data.valide == 'connu') {
                    $('#LblClignotant').html(data.alerte);
                    $('#prenom').html(data.prenom);
                    $('#fonction').html(data.fonction);
                    $('#pseudo').html(data.pseudo);
                    /*ilaina ireto ambany ireto
                     var element = document.getElementById("pseudo").firstChild;
                     alert(element.nodeValue);*/
                }
                if (data.valide == 'ko') {
                    $('#LblClignotant').html(data.alerte);
                    $('#prenom').html(data.prenom);
                    $('#fonction').html(data.fonction);
                    $('#pseudo').html(data.pseudo);
                }
                if (data.valide == 'ok') {
                    $('#LblClignotant').html(data.alerte);
                }
                if (data.message != ''){
                    alert(data.message);
                }
            }
        })
    }else{
        alert('Il n\'a pas de fichier à importer');
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
  <td><img src="image/importer.jpg" width="78px" height="21px" name="importer" border="0"  onclick="importation()" disable/></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><label>Pseudo : <label></td>
                            <td><label id="pseudo"></label></td>
                            <td><label>Fonction:<label></td>
                            <td><label id="fonction"></label></td>
                            <td><img src="image/exporter.jpg" width="78px" height="21px" name="exporter" border="0" onclick="exportation()" disable/></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><label>Prenom : <label></td>
                            <td colspan="5"><label id="prenom"></label></td>
                        </tr>
                        <tr align="center">
                            <td></td>
                            <td colspan="5"><strong style="color:red"><label id="LblClignotant"></label></strong></td>
                        </tr>
                        <tr align="center">
                            <td></td>
                            <td colspan="5"><strong style="color:blue"><label id="observation"></label></strong></td>
                        </tr>
                        </body>
                    </table>
                </form>
            </div>
        </td>
    </tr>
</table>
