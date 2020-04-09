<?php

    session_start();
    var_dump($_SESSION);

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
        <section id="partieGaucheProduits">

        </section>
            <section id="partieCentreTopProduits">
                <section id="testTop">
                    <a href="monpanier.php"><img id="cartIcon" src="Images/carticonpng.png"> Mon panier</a>
                </section>
                    <section id="partieCentreProduits">
                        <section id="partieCentreProduitsGauche">
                            IMAGE
                        </section>
                        <section id="partieCentreProduitsDroite">
                            <section class="nomDuProduit">
                                Nom du produit
                            </section>
                            <section class="descDuProduit">
                                Description du produit
                            </section>
                            <section class="prixDuProduit">
                                Prix du produit & Quantité & Ajouter au panier
                            </section>
                        </section>
                    </section>
                    <section id="commentaireProduitSection">
                        <section id="commentaireProduitTopBar">
                            Commentaires des utilisateurs :
                        </section>
                        <section id="commentaireSurLeProduit">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor quibusdam veritatis vitae molestiae perspiciatis asperiores, odio autem placeat. Alias pariatur praesentium illum ut dolore voluptatibus ipsam eos corrupti porro voluptas!
                        </section>  
                    </section>
        <!-- <section id="partieDroiteProduits">
        </section> -->
    </section>
    </main>
        <?php
    include('footer.php');

    ?>
</body>
</html>