
    <script language="javascript">
        //document.getElementById('idsubmit').value="Sortie";
        //document.getElementById('idsubmit').value="Entrer";
        function typepointage(){
            $.ajax({
                    url:"http://localhost/mikiry/ajaxpointage2.php",
                    method: 'post',
                    data: {
                        'motdepasse': $('[name="motdepasse"]') . val(),
                        'matricule': $('[name="matricule"]') . val(),
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.pointage!='') {
                            if(data.pointage == "Entrer") {
                                document.getElementById('teny').value = "Entrer";
                                document.getElementById("sary").src = "image/login.jpg";
                            }
                            else
                                if(data.pointage == "Sortir") {
                                    document.getElementById("sary").src = "image/sortir.png";
                                    document.getElementById('teny').value = "Sortir";
                                }
                        }
                        if (data.alerte!=''){
                            alert(data.alerte);
                        }
                    }
                }
            )};
        function enregistrer(){
            $.ajax({
                    url:"http://localhost/mikiry/ajaxpointage.php",
                    method: 'post',
                    data: {
                        'motdepasse': $('[name="motdepasse"]') . val(),
                        'matricule': $('[name="matricule"]') . val(),
                        'position': $('[name="position"]') . val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.typepointage!='') {
                            if(data.typepointage == "Entrer") {
                                document.getElementById("sary").src = "image/login.jpg";
                                document.getElementById('teny').value = "Entrer";
                            }
                            else
                            {
                                document.getElementById("sary").src = "image/sortir.png";
                                document.getElementById('teny').value = "Sortir";
                            }
                        }
                        if (data.alerte!=''){
                            alert(data.alerte);
                        }
                    }
                }
            )};

    </script>
</head>
<body>

<table ALIGN="center" width="30%">
    <tr ><td>
            <div style="background-image:url('image/foote.PNG');">
                <h1 style="color:violet;background-image:url('image/t.PNG');" align="center">Pointage MIKIRY</h1>
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
	font-size: 18px;" onchange="typepointage()" value= "<?php if (!empty ($motdepasse)) echo $motdepasse ; else echo "Passe"; ?>"></td>
                        </tr>
                        <td>Position :</td>
                        <td><input   type="text" name="position" id="teny" style="background-color:#fff;
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
	font-size: 18px;" value= "En attente" disabled></td>
                        </tr>
                        <tr  align="center"><td colspan="2">
                                <button type="button"  name="enregistre"id="sary" class="btn btn-danger btn-large" onclick="enregistrer()">Enregistrer</button>
                            </td></tr>


                        </body>
                    </table>
