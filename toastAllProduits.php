<?php
session_start();
include ('fonctions.php');
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

						$i = 0 ;
						while ($i != $nbProduits) 
						{


							?>
							<tr>

								<td><?php echo $resultInfosArticle[$i][9]; ?></td>
								<td><?php echo $resultInfosArticle[$i][12]; ?></td>
								<td><?php echo $resultInfosArticle[$i][3]; ?></td>
								<td><?php echo $resultInfosArticle[$i][4]; ?></td>
								<td><?php echo $resultInfosArticle[$i][5]; ?>€</td>
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
								$idProduit = $resultInfosArticle[$i][0] ;
								$prixProduit = $resultInfosArticle[$i][5];



								if (isset($_POST["addPanier$idProduit"])) 
								{
									$requeteArticle = "SELECT * FROM panier WHERE id_article = '$idProduit'";
									$queryArticle = mysqli_query($connexion, $requeteArticle);
									$resultArticle = mysqli_fetch_all($queryArticle);

									$requeteProduits = "SELECT * FROM produits WHERE id = '$idProduit'";
									$queryProduits = mysqli_query($connexion, $requeteProduits);
									$resultProduits = mysqli_fetch_all($queryProduits);

									var_dump($resultProduits);

									if (empty($resultArticle)) 
									{
										$requeteAddArticle = "INSERT INTO panier (id_article, id_utilisateur, quantite, prix) VALUES ('".$idProduit."', '".$_SESSION['id']."', '".$_POST["quantiteProduit$idProduit"]."', '".$prixProduit."')";
										$queryAddArticle = mysqli_query($connexion, $requeteAddArticle);

										$newFullQuantite = $resultProduits[0][6] - $_POST["quantiteProduit$idProduit"];
										$requeteUpdateFullQuantite = "UPDATE produits set quantite = '".$newFullQuantite."' WHERE id = '$idProduit'";
										$queryUpdateFullQuantite = mysqli_query($connexion, $requeteUpdateFullQuantite);

										echo $requeteAddArticle;
										echo $requeteUpdateFullQuantite;
									}
									else
									{
										$newQuantiteProduit = $resultArticle[0][3] + $_POST["quantiteProduit$idProduit"];
										$requeteUpdateQuantite = "UPDATE panier set quantite = '".$newQuantiteProduit."' WHERE id_article = '$idProduit' ";
										$queryUpdateQuantite = mysqli_query($connexion, $requeteUpdateQuantite);


										$newFullQuantite = $resultProduits[0][6] - $_POST["quantiteProduit$idProduit"];
										$requeteUpdateFullQuantite = "UPDATE produits set quantite = '".$newFullQuantite."' WHERE id = '$idProduit'";
										$queryUpdateFullQuantite = mysqli_query($connexion, $requeteUpdateFullQuantite);

										echo $requeteUpdateQuantite;
										echo $requeteUpdateFullQuantite;
									}

									


								}



								$i++;
							}

						}

						?>
					</tbody>
				</table>
			</form>
	</main>

</body>
</html>