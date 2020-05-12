<?php
session_start();
include('fonctions.php');

$connexion = mysqli_connect('Localhost','root','','boutique');

if (isset($_SESSION['id'])) 
{
	
	$requetePanier = "SELECT * FROM panier INNER JOIN produits ON panier.id_article = produits.id INNER JOIN utilisateurs ON panier.id_utilisateur = utilisateurs.id WHERE id_utilisateur = '".$_SESSION['id']."'";
	$queryPanier = mysqli_query($connexion, $requetePanier);
	$resultPanier = mysqli_fetch_all($queryPanier);
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Panier</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
    include('header.php');
    
    ?>
	<main id="panierMain">
		<section id="fullFlexPanier">
			<form method="post" action="">
				<table id="tablePanier">
					<thead>
						<tr id="panierName">
							<?php
							if (isset($_SESSION['login']))
							{?>
								<td colspan="6">Panier de : <?php echo $_SESSION['login'] ?></td>
								
							<?php
							}
							?>
						</tr>
					</thead>
					<tbody id="tbodyPanier">
						<tr id="tableTopPartie">
							<td>Nom</td>
							<td>Photo</td>
							<td>Quantite</td>
							<td></td>
							<td>Prix</td>
							<td></td>
						</tr>
							<?php
							if (isset($_SESSION['id'])) 
							{
						
								$nbProduit = count($resultPanier);
								if ($nbProduit == 0) 
								{
									echo "Votre Panier est vide";
								}
								else
								{
									$i = 0 ;
									$prixTotal = 0;
									while ($i != $nbProduit) 
									{

										$idProduit = $resultPanier[$i][0];
										$idArticle = $resultPanier[$i][1];
										?>
										<tr id="generationItemPanier">
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
											$requeteUpdateFullQuantite = "UPDATE produits set quantite = '".$newFullQuantite."' WHERE id = '$idArticle'";
											$queryUpdateFullQuantite = mysqli_query($connexion, $requeteUpdateFullQuantite);

											
											header('Location:panier.php');

										}
										
										if (isset($_POST["deleteProduit$idProduit"])) 
										{
											$newFullQuantite = $resultPanier[$i][11] + $resultPanier[$i][3];
											$requeteUpdateFullQuantite = "UPDATE produits set quantite = '".$newFullQuantite."' WHERE id = '".$resultPanier[$i][5]."'";
											$queryUpdateFullQuantite = mysqli_query($connexion, $requeteUpdateFullQuantite);


											$requeteDelete = "DELETE FROM panier WHERE id = '$idProduit'";
											$queryDelete = mysqli_query($connexion, $requeteDelete);

											
											header('Location:panier.php');
										}



										
										$prixTotal += $resultPanier[$i][4];

										$quantiteProduits = $resultPanier[$i][3];
										$prixArticle = $resultPanier[$i][4];
										if (isset($_POST["paiement"])) 
										{


											header('Location:achat.php');
										}
										
										
										$i++;
									}
									?>
									<tr>
										<td colspan="6"> <br> <b>Montant Total : <?php echo $prixTotal ; ?> € </b></td>
									</tr>
									<tr id="paiementButton">
										<td colspan="6"><a href="achat.php" target=" "><input type="submit" name="paiement" value="Paiement"></a></td>
									</tr>

									<?php
								}

							}
							?>

						</tbody>
					</table>
				</form>
			</section>
	</main>
	<?php
    include('footer.php');

    ?>

</body>
</html>