<?php

    session_start();
    include('fonctions.php');
    var_dump($_SESSION);
    ob_start();
    $getIdProduit = $_GET['id'];
    $connexion = mysqli_connect('Localhost','root','','boutique');
    $requeteDonneesProduits = "SELECT * FROM produits WHERE id=\"$getIdProduit\"";
    $queryDonneesProduits = mysqli_query($connexion,$requeteDonneesProduits);
    $resultatDonneesProduits = mysqli_fetch_all($queryDonneesProduits);
    var_dump($resultatDonneesProduits);

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
                                <?php echo "".$resultatDonneesProduits[0][5]."€"; ?> <br> <?php echo "Quantité : ".$resultatDonneesProduits[0][6]."" ?> <br> Ajouter au panier
                            </section>
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
                            while($i != 4)
                            { ?> <section id="commentaireSurLeProduit"> <?php
                                $dateComTest = date(("d-m-Y H:i:s") , strtotime($resultatListeCom[$i][5]));
                                echo "<b>Note</b> : ".$resultatListeCom[$i][4]."/5 | <b>".$resultatListeCom[$i][6]." : </b> ".$resultatListeCom[$i][3]." le <b>".$dateComTest."</b><br><br>";
                                $i++; ?> 
                                </section> 
                            <?php
                            }
                        }
                                
                        ?>
                        
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
    </main>
        <?php
    include('footer.php');
    ob_end_flush();
    ?>
</body>
</html>