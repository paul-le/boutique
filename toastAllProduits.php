<?php
session_start();
include ('fonctions.php');
$idUser = $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>TOAST</title>
</head>
<body>
	<main>
		<form method="post" action="">
			<table id="tableProduit">
				<thead>
					<tr>
						<th colspan="7">Liste des produits</th>
					</tr>
				</thead>
				<tbody>
					<tr>

						<td>Catégorie</td>
						<td>Sous-Categorie</td>
						<td>Nom</td>
						<td>Description</td>
						<td>Prix</td>
						<td>Quantité</td>
						<td>PHOTO</td>
						<td></td>
					</tr>
					<?php




					$connexion = mysqli_connect('Localhost','root','','boutique');
					$requeteInfosArticle = "SELECT * FROM produits INNER JOIN categories ON produits.id_categorie = categories.id INNER JOIN sous_categorie ON produits.id_sous_categorie = sous_categorie.id";
					$queryInfosArticle = mysqli_query($connexion, $requeteInfosArticle);
					$resultInfosArticle = mysqli_fetch_all($queryInfosArticle);

	
				


					$nbProduits = count($resultInfosArticle);
					
					

					if (empty($resultInfosArticle)) 
					{
						echo "Aucun Article Disponible";
					}
					else
					{

						
						for ($i = 0; $i != $nbProduits; $i++) 
						{
							$idProduit = $resultInfosArticle[$i][0] ;

							?>
							<tr>

								<td><?php echo $resultInfosArticle[$i][9]; ?></td>
								<td><?php echo $resultInfosArticle[$i][12]; ?></td>
								<td><?php echo $resultInfosArticle[$i][3]; ?></td>
								<td><?php echo $resultInfosArticle[$i][4]; ?></td>
								<td><?php echo $resultInfosArticle[$i][5]; ?>€</td>
								<td><?php echo $resultInfosArticle[$i][6]; ?></td>
								<td>										
									<select  name="quantiteProduit<?php echo $resultInfosArticle[$i][0]; ?>">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
								</td>
								<td><img src="imgArticle/<?php echo $resultInfosArticle[$i][7] ?>" width ="100" ></td>
								<td>

									<input type="submit" name="addPanier<?php echo $resultInfosArticle[$i][0]; ?>" value="Add"></td>

								</tr>
								

								<?php
								
								

								$requeteProduits = "SELECT * FROM produits WHERE id = '$getIdProduit'";
								$queryProduits = mysqli_query($connexion, $requeteProduits);
								$resultProduits = mysqli_fetch_all($queryProduits);

								
								$requeteArticle = "SELECT * FROM panier WHERE id_article = '".$getIdProduit."' ";
								$queryArticle = mysqli_query($connexion, $requeteArticle);
								$resultArticle = mysqli_fetch_all($queryArticle);


								

								if (isset($_POST["addPanier"])) 
								{
									

									$prixProduit = $resultatDonneesProduits[5] * $_POST["quantiteProduit"];

									if (empty($resultArticle)) 
									{
										
										
										$requeteAddArticle = "INSERT INTO panier (id_article, id_utilisateur, quantite, prix) VALUES ('".$getIdProduit."', '".$_SESSION['id']."', '".$_POST["quantiteProduit"]."', '".$prixProduit."')";
										$queryAddArticle = mysqli_query($connexion, $requeteAddArticle);

										$newFullQuantite = $resultProduits[0][6] - $_POST["quantiteProduit"];
										$requeteUpdateFullQuantite = "UPDATE produits set quantite = '".$newFullQuantite."' WHERE id = '$getIdProduit'";
										$queryUpdateFullQuantite = mysqli_query($connexion, $requeteUpdateFullQuantite);

										header('Location:panier.php');
										
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

								
							}

						}

						?>
					</tbody>
				</table>
			</form>
	</main>

</body>
</html>