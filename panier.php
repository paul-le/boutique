<?php
session_start();
include('fonctions.php');

$connexion = mysqli_connect('Localhost','root','','boutique');


$requetePanier = "SELECT * FROM panier INNER JOIN produits ON panier.id_article = produits.id INNER JOIN utilisateurs ON panier.id_utilisateur = utilisateurs.id WHERE id_utilisateur = '".$_SESSION['id']."'";
$queryPanier = mysqli_query($connexion, $requetePanier);
$resultPanier = mysqli_fetch_all($queryPanier);


var_dump($resultPanier);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Panier</title>
</head>
<body>
	<main>
		<?php
		if (isset($_GET['idUser'])) 
		{?>
			<form method="post" action="">
				<table>
					<thead>
						<tr>
							<td colspan="6">Panier de : <?php echo $_SESSION['login'] ?></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Nom</td>
							<td>Photo</td>
							<td>Quantite</td>
							<td></td>
							<td>Prix</td>
							<td></td>
							

						</tr>
						<?php
						
						$nbProduit = count($resultPanier);
						

						if ($nbProduit == 0) 
						{
							echo "Votre Panier est vide";
						}
						else
						{
							$i = 0 ;
							while ($i != $nbProduit) 
							{
								$idProduit = $resultPanier[$i][0];
								?>
								<tr>
									<td><?php echo $resultPanier[$i][8]; ?></td>
									<td><img src="imgArticle/<?php echo $resultPanier[$i][12] ?>" width ="100" ></td>
									<td><?php echo $resultPanier[$i][3]; ?></td>
									<td>
										<select name="addQuantite<?php echo $resultPanier[$i][0]; ?>">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
										<input type="submit" name="newAdd<?php echo $resultPanier[$i][0]; ?>" value="Add">
									</td>
									<td><?php echo $resultPanier[$i][4]; ?></td>

									<td>
										<input type="submit" name="deleteProduit<?php echo $resultPanier[$i][0]; ?>" value="Supprimer">
									</td>
								</tr>

								<?php

									if (isset($_POST["newAdd$idProduit"])) 
									{
										
										$newQuantiteProduit = $resultPanier[$i][3] + $_POST["addQuantite$idProduit"];
										$requeteUpdateQuantite = "UPDATE panier set quantite = '".$newQuantiteProduit."' WHERE id = '$idProduit' ";
										$queryUpdateQuantite = mysqli_query($connexion, $requeteUpdateQuantite);

										$prixProduit = $resultPanier[$i][10] * $_POST["addQuantite$idProduit"];
										$newPrixProduit = $resultPanier[$i][4] + $prixProduit;

										$newPrix = "UPDATE panier set prix = '".$newPrixProduit."' WHERE id = '$idProduit'";
										$queryNewprix = mysqli_query($connexion, $newPrix);


										$newFullQuantite = $resultPanier[$i][11] - $_POST["addQuantite$idProduit"];
										$requeteUpdateFullQuantite = "UPDATE produits set quantite = '".$newFullQuantite."' WHERE id_article = '$idProduit'";
										$queryUpdateFullQuantite = mysqli_query($connexion, $requeteUpdateFullQuantite);

										header('Location:panier.php?idUser='.$_GET["idUser"].'');

									}

									if (isset($_POST["deleteProduit$idProduit"])) 
									{
										$newFullQuantite = $resultPanier[$i][11] + $resultPanier[$i][3];
										$requeteUpdateFullQuantite = "UPDATE produits set quantite = '".$newFullQuantite."' WHERE id = '".$resultPanier[$i][5]."'";
										$queryUpdateFullQuantite = mysqli_query($connexion, $requeteUpdateFullQuantite);


										$requeteDelete = "DELETE FROM panier WHERE id = '$idProduit'";
										$queryDelete = mysqli_query($connexion, $requeteDelete);

										echo $requeteUpdateFullQuantite.'<br />';
										echo $requeteDelete;
										//header('Location:panier.php?idUser='.$_GET["idUser"].'');
									}
								$i++;
							}	
						}

		
						?>
					</tbody>
				</table>
			</form>
		<?php
		}
		else
		{
			echo "FDF3";
		}
		?>
	</main>

</body>
</html>