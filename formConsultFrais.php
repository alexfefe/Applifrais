<html>
    <?php
    $repInclude = './include/';
    require($repInclude . "_init.inc.php");
    require($repInclude . "_enteteAdmin.inc.html");
    ?>
<!--<head>
    <meta charset="UTF-8"/>
	<title>Suivi des frais de visite</title>
	<style type="text/css">
		 body {background-color: white; color:5599EE; } 
			.titre { width : 180 ;  clear:left; float:left; } 
			.zone { float : left; color:7091BB } 
	</style>
</head> -->
<body id="bodyAdmin">
<div id="gauche">
<div id="coin">
    <img src="./images/logo.jpg" width="100" height="60"/>
</div>
<div id="menu" >
	<h2>Outils</h2>
	<ul><li>Frais</li>
		<ul>
			<li><a href="formSaisieFrais.htm" >Nouveau</a></li>
			<li><a href="formConsultFrais.htm">Consulter</a></li>
		</ul>
	</ul>
</div>
</div>
<div id="droite" >
	<div id="haut">
            <h1>Suivi de remboursement des Frais</h1>
        </div>	
	<div id="bas" >
	<form id="formConsultFrais" method="post" action="chercheFrais.php">
		<h1> Période </h1>
			<label class="titre">Mois/Année :</label> <input class="zone" type="text" name="dateConsult" size="12" />
		<p class="titre" />
		<div style="clear:left;">
                    <h2>Frais au forfait </h2>
                </div>
		<table border="1">
			<tr>
                            <th>Repas midi</th>
                            <th>Nuitée </th>
                            <th>Etape</th><th>Km </th>
                            <th>Situation</th>
                            <th>Date opération</th>
                            <th>Remboursement</th>
                        </tr>
			<tr align="center">
                            <td width="80"> <label size="3" name="repas"/></td>
			    <td width="80"> <label size="3" name="nuitee"/></td> 
			    <td width="80"> <label size="3" name="etape"/></td>
			    <td width="80"> <label size="3" name="km" /></td>
			    <td width="80"> <label size="3" name="situation" /></td>	
			    <td width="80"> <label size="3" name="dateOper" /></td>	
			    <td width="80"> <label size="3" name="dateOper" /></td>						
			</tr>
		</table>
		
		<p class="titre" />
                <div style="clear:left;">
                    <h2>Hors Forfait</h2>
                </div>
              
		<table border="1">
			<tr><th>Date</th><th>Libellé </th><th>Montant</th><th>Situation</th><th>Date opération</th></tr>
			<tr align="center"><td width="100" ><label size="12" name="hfDate1"/></td>
				<td width="220"><label size="30" name="hfLib1"/></td> 
				<td width="90" ><label size="10" name="hfMont1"/></td>
				<td width="80"> <label size="3" name="hfSitu1" /></td>
				<td width="80"> <label size="3" name="hfDateOper1" /></td>		
				</tr>
		</table>	
		<p class="titre"></p>
                    <div style="clear:left;">
                    <h2>Hors Classification</h2>
                </div>
                <table border="1">
			<tr><th>Nb Justificatifs</th><th>Montant </th><th>Situation</th><th>Date opération</th></tr>
			<tr align="center"><td width="100" ><label size="12" name="hfDate1"/></td>
				<td width="220"><label size="30" name="hfLib1"/></td> 
				<td width="90" ><label size="10" name="hfMont1"/></td>
				<td width="80"> <label size="3" name="hfSitu1" /></td>		
			</tr>
		</table>	
		<!--<div class="titre">Nb Justificatifs</div><input type="text" class="zone" size="4" name="hcMontant"/>-->
	</form>
	</div>
</div>
</body>
</html>