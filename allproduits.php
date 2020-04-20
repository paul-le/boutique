<?php 

    $connexion = mysqli_connect('Localhost','root','','boutique');

    $getIdAllProduits = $_GET['cateid'];

    $requeteAllProduits = "SELECT * FROM produits WHERE id_categorie=\"$getIdAllProduits\"";
    $queryAllProduits = mysqli_query($connexion,$requeteAllProduits);
    $resultatAllProduits = mysqli_fetch_all($queryAllProduits);

    var_dump($resultatAllProduits);

    if(isset($_GET['subcateid']))
    {
        $getIdAllProduits2 = $_GET['subcateid'];

        $requeteAllProduits2 = "SELECT * FROM produits WHERE id_sous_categorie=\"$getIdAllProduits2\"";
        $queryAllProduits2 = mysqli_query($connexion,$requeteAllProduits2);
        $resultatAllProduits2 = mysqli_fetch_all($queryAllProduits2);

        var_dump($resultatAllProduits2);
    }
?>