<?php

    session_start();
    var_dump($_SESSION);
    include('fonctions.php');
    ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
    include('header.php');
    ?>
    <main>
    <section id="flexFull">
        <section id="partieGauche">
            <!-- <img id="imgGaucheToast" src="Images/bannieregauche.jpg"> -->
        </section>
            <section id="partieCentreTop">
                <section id="testTop">
                    <a href="monpanier.php"><img id="cartIcon" src="Images/carticonpng.png"> Mon panier</a>
                </section>
                <section id="partieCentre">
                    <img src="Images/banniere.jpg">
                </section>
                    <section id="mainContent">
                        <section id="mainContentFlexSeparation">
                            <section id="mainTopContent">
                                <section id="mainTopContentCategories">
                                    <section id="topBarMainLeftIndex">
                                        DERNIERS COMMENTAIRES
                                    </section>
                                </section>
                                <section id="mainTopContentListe">
                                    <section id="topBarMainMiddleIndex">
                                        DERNIERS JEUX AJOUTÉS
                                    </section>
                                    <!-- Jeu à généré -->
                                    <section class="dernierJeuIndex">
                                        <section class="imageDuJeuIndex">
                                            <img witdh="10" class="imageDuJeuIndex2" src="Images/jeutoast2.png">
                                        </section>
                                        <section class="nomDuJeuIndex">
                                            NOM DU JEU
                                        </section>
                                        <section class="prixDuJeuIndex">
                                            PRIX DU JEU
                                        </section>
                                        <section class="panierDuJeuIndex">
                                            PANIER
                                        </section>
                                    </section>
                                    <!--             -->
                                </section>
                                <section id="mainTopContentLastComment">
                                    <section id="topBarMainRightIndex">
                                        CATÉGORIES
                                    </section>
                                </section>
                        </section>
                        <section id="banniereSeparation">

                            </section>
                            <section id="meilleuresVentes">
                                Meilleures ventes
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