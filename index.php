<?php

    session_start();

    include('fonctions.php');
    ob_start();

    $connexion = mysqli_connect('Localhost','root','','boutique');

    $requeteListeJeux = "SELECT * FROM produits ORDER BY id DESC LIMIT 5";
    $queryListeJeux = mysqli_query($connexion,$requeteListeJeux);
    $resultatListeJeux = mysqli_fetch_all($queryListeJeux);
    
    $nbProduits = count($resultatListeJeux);

    
    $requeteCom = "SELECT c.*,u.login FROM commentaires AS c INNER JOIN utilisateurs AS u ON c.id_utilisateur = u.id ORDER BY c.id DESC LIMIT 5";
    $queryCom = mysqli_query($connexion,$requeteCom);
    $resultatCom = mysqli_fetch_all($queryCom);
   

    $requeteListeCate="SELECT * FROM categories";
    $queryListeCate = mysqli_query($connexion,$requeteListeCate);
    $resultatListeCate = mysqli_fetch_all($queryListeCate);
   
    $nbCate = count($resultatListeCate);

    $requeteListeSousCate="SELECT * FROM sous_categorie";
    $queryListeSousCate = mysqli_query($connexion,$requeteListeSousCate);
    $resultatListeSousCate = mysqli_fetch_all($queryListeSousCate);
   
    $nbSousCate = count($resultatListeSousCate);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Boutique en ligne</title>
</head>
<body>
    <?php
    include('header2.php');
    ?>
    <main>
    <section id="flexFull">
        <section id="partieGauche">
            <!-- <img id="imgGaucheToast" src="Images/bannieregauche.jpg"> -->
        </section>
            <section id="partieCentreTop">
                <section id="testTop">
                    <a href="panier.php"><img id="cartIcon" src="Images/carticonpng.png"> Mon panier</a>
                </section>
                <section id="partieCentre">
                    <img src="Images/banniere.jpg">
                </section>
                    <section id="mainContent">
                        <section id="mainContentFlexSeparation">
                            <section id="mainTopContent">
                                <section id="mainTopContentCategories">
                                    <section id="comSectionLeft">
                                        <section id="topBarMainLeftIndex">
                                            DERNIERS COMMENTAIRES
                                        </section>
                                        <!-- Commentaires à généré -->
                                        <?php
                                            $i=0;
                                            while($i <= 4)
                                            {
                                                $dateComTest = date(("d-m-Y à H:i:s") , strtotime($resultatCom[$i][5])); ?>

                                        <section id="sectionComGeneration">
                                            <section>
                                                <?php echo "<b>Note</b> : ".$resultatCom[$i][4]."/5  <br><b>".$resultatCom[$i][6]." : </b> ".$resultatCom[$i][3]." <br> <b>".$dateComTest."</b>"; ?>
                                            </section>
                                        </section>

                                            <?php $i++; } ?>
                                        <!--                       -->
                                    </section>
                                </section>
                                <section id="mainTopContentListe">
                                    <section id="topBarMainMiddleIndex">
                                        DERNIERS JEUX AJOUTÉS
                                    </section>
                                    <!-- Jeu à généré -->
                                    <?php 
                                    
                                    $i = 0;

                                    while($i != $nbProduits)
                                    { 
                                        $imageProduit = $resultatListeJeux[$i][7];
                                        $idProduit = $resultatListeJeux[$i][0];

                                        ?>
                                    <section class="dernierJeuIndex">
                                        <section class="imageDuJeuIndex">
                                            <a href="produits.php?id=<?php echo "".$idProduit.""; ?>"><img witdh="10" class="imageDuJeuIndex2" src="imgArticle/<?php echo $imageProduit; ?>">
                                        </section>
                                        <section class="nomDuJeuIndex">
                                            <?php echo $resultatListeJeux[$i][3]; ?></a>
                                        </section>
                                        <section class="prixDuJeuIndex">
                                            <?php echo "".$resultatListeJeux[$i][5]." €"; ?>
                                        </section>
                                        <!-- <section class="panierDuJeuIndex">
                                            <img src="Images/cartindex.png">
                                        </section> -->
                                    </section>
                                    <?php $i++; } ?>
                                    <!--             -->
                                </section>
                                <section id="mainTopContentLastComment">
                                    <section id="topBarMainRightIndex">
                                        CATEGORIES
                                    </section>
                                    <!-- Catégories à généré -->
                                    <section id="cateSectionFlex">
                                        <section id="cateTopSection">
                                            <ul>
                                            <?php
                                                $cateCounter = 0;
                                                while($cateCounter != $nbCate)
                                                { 
                                                    $cateAffichage = $resultatListeCate[$cateCounter][1];
                                                    $cateId = $resultatListeCate[$cateCounter][0] ?>
                                                <li> <a href="allproduits.php?cateid=<?php echo $cateId; ?> "> <?php echo "".$cateAffichage.""; ?> </a> </li>
                                                <?php $cateCounter++; } ?>
                                            </ul>
                                        </section>
                                        <section id="cateBottomSection">
                                        <ul>
                                            <?php
                                                $sousCateCounter = 0;
                                                while($sousCateCounter != $nbSousCate)
                                                { 
                                                    $sousCateAffichage = $resultatListeSousCate[$sousCateCounter][2];
                                                    $sousCateId = $resultatListeSousCate[$sousCateCounter][0] ?>
                                                <li> <a href="allproduits.php?cateid=<?php echo $cateId; ?>&subcateid=<?php echo $sousCateId; ?>"> <?php echo "".$sousCateAffichage.""; ?> </a> </li>
                                                <?php $sousCateCounter++; } ?>
                                            </ul>
                                        </section>
                                    </section>
                                    <!--                     -->
                                </section>
                        </section>
                        <section id="banniereSeparation">

                        </section>
                        <section id="meilleuresVentesTopBar">
                            Meilleures ventes
                        </section>
                        <section id="meilleuresVentes">
                            <img id="imgFirstPlace" src="Images/firstplace.png">
                            <img id="imgSecondPlace" src="Images/secondplace.png">
                            <?php

                            $bestVente = "SELECT * FROM produits ORDER BY vente DESC LIMIT 5";
                            $queryBestVente = mysqli_query($connexion, $bestVente);
                            $resultVente = mysqli_fetch_all($queryBestVente);

                            foreach ($resultVente as $vente) 
                            {
                                echo '<a href="produits.php?id='.$vente[0].'"><img id="allProdImg2" src="imgArticle/'.$vente[7].'" width = "165.2" height = "220"></a>';
                            }
                               


                            ?>
                        </section>
                        </section>
                    </section>
                </section>
        <section id="partieDroite">
            <!-- <img src="Images/bannieredroite.jpg"> -->
        </section>
    </section>
    </main>
    <?php
    include('footer.php');

    ?>
</body>
</html>