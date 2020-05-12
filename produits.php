<?php

    session_start();
    include('fonctions.php');
    ob_start();
    $getIdProduit = $_GET['id'];
    $connexion = mysqli_connect('Localhost','root','','boutique');
    $requeteDonneesProduits = "SELECT * FROM produits WHERE id=\"$getIdProduit\"";
    $queryDonneesProduits = mysqli_query($connexion,$requeteDonneesProduits);
    $resultatDonneesProduits = mysqli_fetch_all($queryDonneesProduits);
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
    include('header2.php');
    ?>
    <main>
        <form method="POST" action="">
    <section id="flexFull">
        <section id="partieGaucheProduits">

        </section>
            <section id="partieCentreTopProduits">
                <section id="testTop">
                    <a href="panier.php"><img id="cartIcon" src="Images/carticonpng.png"> Mon panier</a>
                </section>
                    <section id="partieCentreProduits">
                        <section id="partieCentreProduitsGauche">
                            <img src="imgArticle/<?php echo $resultatDonneesProduits[0][7] ?>">
                        </section>
                        <section id="partieCentreProduitsDroite">
                            <section class="nomDuProduit">
                                <?php echo $resultatDonneesProduits[0][3]; ?>
                            </section>
                            <section class="descDuProduit">
                                <?php echo $resultatDonneesProduits[0][4]; ?>
                            </section>
                            <section class="prixDuProduit">
                                <?php echo "Prix : ".$resultatDonneesProduits[0][5]."€<br><br>"; ?> <?php echo "Quantité : ".$resultatDonneesProduits[0][6]."" ?> <br> 
                                <?php if(isset($_SESSION['login'])){ ?>
                                <select  name="quantiteProduit">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
                                </select>
                                <input type="submit" name="addPanier" value="Ajouter au panier">
                                <?php } else {} ?>
                            </section>
                            <!-- <section class="choixQuantiteProduit">
                                <select  name="quantiteProduit">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select> -->
                            <!-- </section> -->
                        </section>
                    </section>
                    <section id="commentaireProduitSection">
                        <section id="commentaireProduitTopBar">
                            Commentaires des utilisateurs :
                        </section>
                        <section id="commentaireSurLeProduit">
                        <?php 

                            // $requeteListeCom = "SELECT * FROM commentaires WHERE id_produit=\"$getIdProduit\" ORDER BY id DESC LIMIT 5";
                            $requeteListeCom = "SELECT c.*,u.login FROM commentaires AS c INNER JOIN utilisateurs AS u ON c.id_utilisateur WHERE id_produit=\"$getIdProduit\" AND u.id = c.id_utilisateur ORDER BY c.id DESC LIMIT 5";
                            $queryListeCom = mysqli_query($connexion,$requeteListeCom);
                            $resultatListeCom = mysqli_fetch_all($queryListeCom);
                            // var_dump($resultatListeCom);
                            $i = 0;
                            $nbCom = count($resultatListeCom);
                            if($nbCom != 0)
                            {
                            while($i != $nbCom)
                            { ?> <section id="commentaireSurLeProduit"> <?php
                                $dateComTest = date(("d-m-Y H:i:s") , strtotime($resultatListeCom[$i][5]));
                                echo "<b>Note</b> : ".$resultatListeCom[$i][4]."/5 | <b>".$resultatListeCom[$i][6]." : </b> ".$resultatListeCom[$i][3]." le <b>".$dateComTest."</b><br><br>";
                                $i++; ?> 
                                </section> 
                            <?php
                            }
                        }
                                
                        ?>
                        <?php if(isset($_SESSION['login'])){ ?>
                        <section id="commentaireFormTopBar">
                            Écrire un commentaire :
                        </section>
                        <section id="commentaireFormProduitSection">
                            <form id="formToast" action="" method="POST">
                                <select type="post" name="noteProduit">
                                    <option>Votre note</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <textarea id="textAreaCommentaire" name="commentaireProduit" rows="7" cols="50" placeholder="Votre commentaire"></textarea>
                                <input type="submit" name="envoyerCommentaire" value="Envoyer">
                            </form>
                            <?php } else {} ?>
                            <?php
                                if(isset($_POST['envoyerCommentaire']))
                                {
                                    if(strlen($_POST['envoyerCommentaire']) != 0 && $_POST['noteProduit'] != "Votre note")
                                    {
                                        $idSession = $_SESSION['id'];
                                        $idProduit = $resultatDonneesProduits[0][0];
                                        $postCom = $_POST['commentaireProduit'];
                                        $postNote = $_POST['noteProduit'];
                                        $insertDate = date("Y-m-d H:i:s", strtotime("now-2"));
                                        $requeteInsertCommentaire = "INSERT INTO commentaires (id_utilisateur,id_produit,commentaire,note,date) VALUES('$idSession','$idProduit','$postCom','$postNote','$insertDate')";
                                        $queryInsertCommentaire = mysqli_query($connexion,$requeteInsertCommentaire);
                                        header('Location:produits.php?id='.$getIdProduit.'');
                                    }
                                    else
                                    {
                                    echo "<br><br><br>Veuillez remplir le champ et choisir une note !";
                                    }
                                }
                                

                                ?>
                        </section>
                    </section>
        <!-- <section id="partieDroiteProduits">
        </section> -->
    </section>
    </form>

    <section>
        <?php
        if (isset($_SESSION["rank"]) && $_SESSION["rank"] == 'ADMIN' && isset($_GET['id']) && isset($_GET['modif'])) 
            {?>
                <form method="post" action="">
                    <section id="partie-modif-flex">

                        <section id="partieCentreProduits">
                            <section id="imgSectionModif">

                                <img src="imgArticle/<?php echo $resultatDonneesProduits[0][7] ?>">

                            </section>
                            <section id="modifierSection">
                                <section class="nomDuProduit">
                                    <input type="text" name="upNameProduit" placeholder="<?php echo $resultatDonneesProduits[0][3]; ?>">
                                </section>
                                <section class="descDuProduit">
                                    <input type="textarea" name="upDescProduit" placeholder="<?php echo $resultatDonneesProduits[0][4]; ?>">
                                </section>
                                <section class="prixDuProduit">
                                    <input type="number" name="upPrixProduit" placeholder="<?php echo "".$resultatDonneesProduits[0][5]; ?>"> <br> Quantité : <input type="number" name="upQuantiteProduit" placeholder="<?php echo "".$resultatDonneesProduits[0][6]."" ?>">
                                </section>
                            </section>
                        </section>
                        
                        <input id="modifier-produit-admin" type="submit" name="updateProduit" value="Modifier">

                    </section>
                </form>
                <?php
                updateProduit();
            }
            ?>
            
        </section>
    </main>
        <?php
    include('footer.php');
    ob_end_flush();
    ?>
</body>
</html>

<?php

$requeteProduits = "SELECT * FROM produits WHERE id = '$getIdProduit'";
$queryProduits = mysqli_query($connexion, $requeteProduits);
$resultProduits = mysqli_fetch_all($queryProduits);

$requeteArticle = "SELECT * FROM panier WHERE id_article = '".$getIdProduit."' ";
$queryArticle = mysqli_query($connexion, $requeteArticle);
$resultArticle = mysqli_fetch_all($queryArticle);

if (isset($_POST["addPanier"])) 
{


   $prixProduit = $resultatDonneesProduits[0][5] * $_POST["quantiteProduit"];

   if (empty($resultArticle)) 
   {


      $requeteAddArticle = "INSERT INTO panier (id_article, id_utilisateur, quantite, prix) VALUES ('".$getIdProduit."', '".$_SESSION['id']."', '".$_POST["quantiteProduit"]."', '".$prixProduit."')";
      $queryAddArticle = mysqli_query($connexion, $requeteAddArticle);

      $newFullQuantite = $resultProduits[0][6] - $_POST["quantiteProduit"];
      $requeteUpdateFullQuantite = "UPDATE produits set quantite = '".$newFullQuantite."' WHERE id = '$getIdProduit'";
      $queryUpdateFullQuantite = mysqli_query($connexion, $requeteUpdateFullQuantite);
										// header('Location:panier.php');

  }
  else
  {
      if ($resultProduits[0][6] > 0) 
      {

         $newQuantiteProduit = $resultArticle[0][3] + $_POST["quantiteProduit"];
         $requeteUpdateQuantite = "UPDATE panier set quantite = '".$newQuantiteProduit."' WHERE id_article = '$getIdProduit' ";
         $queryUpdateQuantite = mysqli_query($connexion, $requeteUpdateQuantite);

         $newPrixProduit = $prixProduit + $resultArticle[0][4];

         $newPrix = "UPDATE panier set prix = '".$newPrixProduit."' WHERE id_article = '$getIdProduit'";
         $queryNewprix = mysqli_query($connexion, $newPrix);


         $newFullQuantite = $resultProduits[0][6] - $_POST["quantiteProduit"];
         $requeteUpdateFullQuantite = "UPDATE produits set quantite = '".$newFullQuantite."' WHERE id = '$getIdProduit'";
         $queryUpdateFullQuantite = mysqli_query($connexion, $requeteUpdateFullQuantite);

         header('Location:panier.php');

     }
     else
     {
         echo "PRODUIT EPUISE";
     }
 }
}
?>