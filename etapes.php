
<?php
include "connection.php";

echo "<select name='etape'style=\"background-color:#fff;
	color:#696969;
	-moz-border-radius:30px;
	-webkit-border-radius:30px;
	border-radius:5px;
	width:196px;
	height:34px;
	border:1px solid #DCDCDC;
	box-shadow:inset 0 1px 3px #DCDCDC;
	cursor:pointer; 
	padding-left: 5px; 
	font-size: 18px;\">";
	if(isset($_REQUEST["idCommande"])) {
        $connexion = pg_connect("host=localhost dbname=postgres user=postgres password=postgres") or die('Connexion impossible : ' . pg_last_error());
        $requete = "SELECT DISTINCT \"ETAPE\" from \"ETAPE\" where  \"COMMANDE\"='".$_REQUEST["idCommande"]."'";
        $result = pg_query($requete) or die('Echec  : ' . pg_last_error());
        $isa1 = -1;
        while ($line1 = pg_fetch_array($result)){
            $isa1 += 1;
            $mety1 =strval($isa1);
            echo "<option>".$line1["ETAPE"]."</option>";
        }

 	}
	else
        echo "<option value='-1'>Choisir une commande</option>";
	echo "</select>";
?>