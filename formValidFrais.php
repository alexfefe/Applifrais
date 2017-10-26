<html>
    <head>
        <title>Validation des frais de visite</title>
        <?php
        $repInclude = './include/';
        require($repInclude . "_init.inc.php");
        require($repInclude . "_enteteAdmin.inc.html");
        ?>

    </head>
    <body id="bodyvalider">
        <div id="gauche" >
            <div id="coin"><img src="./images/logo.jpg" width="100" height="60"/></div>
            <div id="menu" >
                <h2>Outils</h2>
                <ul><li>Frais</li>
                    <ul>
                        <li><a href="formValidFrais.htm" >Enregistrer opération</a></li>
                    </ul>
                </ul>
            </div>
        </div>
        <div id="droite" >
            <div id="hautValid" ><h1>Validation des Frais</h1></div>	
            <div id="basValid" >
                <form name="formValidFrais" method="post" action="formValidFrais.php">
                    <h1> Validation des frais par visiteur </h1>
                    <label class="titreValid">Choisir le visiteur :</label>
                            <!--<select name="lstVisiteur" ><option value="a131">Villechalane</option></select>-->	
                    <input list="visiteurs" type="text" class="zoneValid" name="monvisiteur"/>
                    
                    <datalist id="visiteurs">
                        <?php
                        $req = "SELECT nom from Visiteur";
                        $idJeuNoms = mysqli_query($idConnexion, $req);
                        $lgNoms = mysqli_fetch_assoc($idJeuNoms);
                        while (is_array($lgNoms)) {
                            $noms = $lgNoms["nom"];
                            ?>
                            <option value="<?php echo $noms; ?>" ></option>
                            <?php
                            $lgNoms = mysqli_fetch_assoc($idJeuNoms);
                        }
                        mysqli_free_result($idJeuNoms);
                        ?>

                    </datalist>              
                    <label class="titreValid">Mois :
                        <?php
                        $lastday = date('t'); 
                        $jour = date('d');
                        $month = date('n');  
                        $year=date('Y');
                        $prevmonth = date('n', strtotime('-1 months'));
                        if ($jour == $lastday || $jour > '20') {
                            $Mymonth = obtenirLibelleMois($month);
                            $Mymonth= $Mymonth.' '.$year;
                            echo $Mymonth;
                        } else {
                            $Mymonth = obtenirLibelleMois($prevmonth);
                            $Mymonth=$Mymonth.' '.$year;
                            echo $Mymonth;
                        }
                        ?> 
                    </label>
                   <!-- <input id="mois" class="zoneValid" type="text" name="dateValid" size="12" -->
                    <input type="submit" name="submit" value="submit"/>
                </form>
                <form name="formValidFraisId" method="post" action="formValidFrais.php">

                    <p class="titreValid" />
                    <div style="clear:left;"><h2>Frais au forfait </h2></div>
                    <?php
               if (isset($_POST['monvisiteur'])){
// demande de la requête pour obtenir la liste des éléments 
// forfaitisés du visiteur connecté pour le mois demandé
                    $visiteur=$_POST['monvisiteur'];
                   
                    $req = obtenirReqEltsForfaitFicheFrais($Mymonth,obtenirIdVisiteur($idConnexion,$visiteur));
                    echo $req;
                    $idJeuEltsFraisForfait = mysqli_query($idConnexion, $req);
                    echo mysqli_error($idConnexion);
                    $lgEltForfait = mysqli_fetch_assoc($idJeuEltsFraisForfait);
// parcours des frais forfaitisés du visiteur connecté
// le stockage intermédiaire dans un tableau est nécessaire
// car chacune des lignes du jeu d'enregistrements doit être doit être
// affichée au sein d'une colonne du tableau HTML
                    $tabEltsFraisForfait = array();
                    while (is_array($lgEltForfait)) {
                        $tabEltsFraisForfait[$lgEltForfait["libelle"]] = $lgEltForfait["quantite"];
                        $lgEltForfait = mysqli_fetch_assoc($idJeuEltsFraisForfait);
                    }
                    mysqli_free_result($idJeuEltsFraisForfait);
                    }
                    ?>
                    <table style="color:white;" border="1">
                        <tr>
                            <!--<th>Repas midi</th><th>Nuitée </th><th>Etape</th><th>Km </th><th>Situation</th>-->
                            <?php
// premier parcours du tableau des frais forfaitisés du visiteur connecté
// pour afficher la ligne des libellés des frais forfaitisés
                            foreach ($tabEltsFraisForfait as $unLibelle => $uneQuantite) {
                                ?>
                                <th><?php echo $unLibelle; ?></th>
                                <?php
                            }
                            ?>
                        </tr>
                       <tr align="center"><!--<td width="80" ><input type="text" size="3" name="repas"/></td>
                               <td width="80"><input type="text" size="3" name="nuitee"/></td> 
                               <td width="80"> <input type="text" size="3" name="etape"/></td>
                               <td width="80"> <input type="text" size="3" name="km" /></td>
                               <td width="80">-->
                            <?php
// second parcours du tableau des frais forfaitisés du visiteur connecté
// pour afficher la ligne des quantités des frais forfaitisés
                            foreach ($tabEltsFraisForfait as $unLibelle => $uneQuantite) {
                                ?>
                                <td class="qteForfait"><?php echo $uneQuantite; ?></td>
                                <?php
                            }
               
                            ?>
                        <select size="3" name="situ">
                            <option value="E">Enregistré</option>
                            <option value="V">Validé</option>
                            <option value="R">Remboursé</option>
                        </select></td>
                        </tr>
                    </table>

                    <p class="titreValid" /><div style="clear:left;"><h2>Hors Forfait</h2></div>
                    <table id="table" border="1">
                        <tr><th>Date</th><th>Libellé </th><th>Montant</th><th>Situation</th></tr>
                        <tr align="center"><td width="100" ><input type="text" size="12" name="hfDate1"/></td>
                            <td width="220"><input type="text" size="30" name="hfLib1"/></td> 
                            <td width="90"> <input type="text" size="10" name="hfMont1"/></td>
                            <td width="80"> 
                                <select size="3" name="hfSitu1">
                                    <option value="E">Enregistré</option>
                                    <option value="V">Validé</option>
                                    <option value="R">Remboursé</option>
                                </select></td>
                        </tr>
                    </table>		
                    <p class="titreValid"></p>
                    <div class="titreValid">Nb Justificatifs</div><input type="text" class="zoneValid" size="4" name="hcMontant"/>		
                    <p class="titreValid" /><label class="titreValid">&nbsp;</label><input class="zoneValid"type="reset" /><input class="zone"type="submit" />
                </form>
                
            </div>
        </div>
    </body>
</html>