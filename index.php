<?php
session_start();

include('fonctions.php');
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
                    <img id="cartIcon" src="Images/carticonpng.png"> Mon panier
                </section>

                <section id="partieCentre">
                    <img src="Images/banniere.jpg">
                </section>
                    <section id="mainContent">
                        <section id="mainContentFlexSeparation">
                            <section id="mainTopContent">
                                <section id="mainTopContentCategories">
                                    DERNIERS COMMENTAIRES
                                </section>
                                <section id="mainTopContentListe">
                                    DERNIERS JEUX AJOUTÉS
                                </section>
                                <section id="mainTopContentLastComment">
                                    CATÉGORIES
                                </section>
                        </section>
                        <section id="banniereSeparation">

                            </section>
                            <section id="meilleuresVentes">
                                Meilleurs ventes
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