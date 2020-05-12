<?php 
    session_start();
    include('fonctions.php');

    $connexion = mysqli_connect('Localhost','root','','boutique');

    if (isset($_GET['search'])) 
        {
            $recherche = $_GET['search'];
            $recherche = strtolower($recherche);

            

            $requeteSearch = "SELECT * FROM produits WHERE nom LIKE '%$recherche%' ";
            $querySearch = mysqli_query($connexion, $requeteSearch);
            $resultSearch = mysqli_fetch_all($querySearch); 

            

            

        }
    

    elseif(isset($_GET['cateid']) && isset($_GET['subcateid']))
    {
        $getIdAllProduits2 = $_GET['subcateid'];

        $requeteAllProduits2 = "SELECT * FROM produits WHERE id_sous_categorie=\"$getIdAllProduits2\"";
        $queryAllProduits2 = mysqli_query($connexion,$requeteAllProduits2);
        $resultatAllProduits2 = mysqli_fetch_all($queryAllProduits2);

       
        $countSubCatJeux = count($resultatAllProduits2);
      

        
    }
    else
    {
        $getIdAllProduits = $_GET['cateid'];

        $requeteAllProduits = "SELECT * FROM produits WHERE id_categorie=\"$getIdAllProduits\"";
        $queryAllProduits = mysqli_query($connexion,$requeteAllProduits);
        $resultatAllProduits = mysqli_fetch_all($queryAllProduits);
    
        $countCatJeux = count($resultatAllProduits);
        
    }

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
    <title>Liste des produits</title>
</head>
<body>
    <?php
    include('header2.php');
    ?>
    <main id="listeProduitsMain">
        <section id="mainPartieTop">
            <a href="panier.php"><img id="cartIcon" src="Images/carticonpng.png"> Mon panier</a>
        </section>
        <section id="coteGaucheEtDroitFlex">
            <section id="coteGaucheCateAllProd">
                <section id="coteGauchePartieCate">
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
                <section id="coteGauchePartieSousCate">
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
            <section id="coteDroitListe">
                <?php 

                if (isset($_GET['search'])) 
                {
                    $counterGeneration = 0;
                    while($counterGeneration != $_GET['count'])
                    {
                        echo '<a href="produits.php?id='.$resultSearch[$counterGeneration][0].'"><img id="allProdImg2" src="imgArticle/'.$resultSearch[$counterGeneration][7].'" width = "165.2" height = "220"></a>';
                        $counterGeneration++;
                    }
                }

                elseif(isset($_GET['cateid']) && isset($_GET['subcateid']))
                {
                    $counterGeneration = 0;
                    while($counterGeneration != $countSubCatJeux)
                    {
                        echo '<a href="produits.php?id='.$resultatAllProduits2[$counterGeneration][0].'"><img id="allProdImg2" src="imgArticle/'.$resultatAllProduits2[$counterGeneration][7].'" width = "165.2" height = "220"></a>';
                        $counterGeneration++;
                    }
                }
                else
                {
                    $counterGeneration = 0;
                    while($counterGeneration != $countCatJeux)
                    {
                        echo '<a href="produits.php?id='.$resultatAllProduits[$counterGeneration][0].'"> <img id="allProdImg" src="imgArticle/'.$resultatAllProduits[$counterGeneration][7].'" width = "165.2" height = "220"></a>';
                        $counterGeneration++;
                    }
                }
                ?>
            </section>
        </section>
    </main>
    <?php
	include('footer.php');
    ?>
    </body>
    </html>