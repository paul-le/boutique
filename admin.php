<?php

session_start();
$connexion = mysqli_connect('Localhost','root','','boutique');
include('fonctions.php');
ob_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	include('header2.php');
	?>
	<main>
		<section id="adminPanel">
			<section id="flexTopAdminPanel">
				<section id="flexTopAdminPanel2">
					<section id="topBarAjouterCate">
						Ajouter une catégorie :
					</section>
					<section>
						<section id="testToast2">
							<form method="post" action="admin.php">

								Nom : <input type="text" name="categorie">

								<input id="buttonAdmin" type="submit" name="addCategorie" value="Ajouter">
								<br><br>
								<?php
								newCategorie();
								?>
							</form>
						</section>
					<section class="testAdmin1">
						<?php
						$requeteAllCat = "SELECT * FROM categories";
						$queryAllCat = mysqli_query($connexion, $requeteAllCat);
						$resultAllCat = mysqli_fetch_all($queryAllCat);

						$nbCat = count($resultAllCat);

						$i = 0;
						while($i != $nbCat) 
						{?> 
							
							<form method="post" action="">
								Categorie : <input type="text" name="upCat" placeholder="<?php echo $resultAllCat[$i][1]; ?>">
								<input id="buttonAdmin" type="submit" name="updateCategorie<?php echo $resultAllCat[$i][0]; ?>" value="Modifier">
								<input id="buttonAdmin" type="submit" name="deleteCategorie<?php echo $resultAllCat[$i][0]; ?>" value="Supprimer">
								<br><br>
							</form>
						<?php
							
							$idCat = $resultAllCat[$i][0];
							$nomCat = $resultAllCat[$i][1];
							
							if (isset($_POST["updateCategorie$idCat"]) AND strlen($_POST['upCat']) != 0) 
							{

								
								$requeteUpdateCat = "UPDATE categories set nom = '".$_POST['upCat']."' WHERE nom = '".$nomCat."' ";
								$queryUpdateCat = mysqli_query($connexion, $requeteUpdateCat);
								header('location:admin.php');
							}
							if (isset($_POST["deleteCategorie$idCat"])) 
							{
								$requeteDeleteCat = "DELETE FROM categories WHERE id = '".$idCat."'";
								$queryDeleteCat = mysqli_query($connexion, $requeteDeleteCat);
								header('location:admin.php');

							}

							$i++ ;
						}
						?>
						</section>				
					</section>
				</section>
				<section id="flexTopAdminPanel3">
					<section id="topBarAjouterSubCate">
							Ajouter une sous-catégorie :
					</section>
					<section class="testToast">
						<form method="post" action="admin.php">
							Nom :<input type="text" name="subCat">
					
						<select  type="post" name="categorie">
							<option>Catégories</option>
							<?php
							for ($i=0; $i < $nbCat ; $i++) 
								{?> 
									<option><?php echo $resultAllCat[$i][1]; ?></option>
									<?php
								}
								?>
							</select>
							<input id="buttonAdmin" type="submit" name="addSubCat"><br><br>
							<?php

							addSubCat();

							?>

						</form>
						</section>
						<section class="testAdmin2">
						<section>
							<?php
							$requeteAllSubCat = "SELECT * FROM sous_categorie";
							$queryAllSubCat = mysqli_query($connexion, $requeteAllSubCat);
							$resultAllSubCat = mysqli_fetch_all($queryAllSubCat);

							$requeteSubCat = "SELECT * FROM sous_categorie INNER JOIN categories ON sous_categorie.id_categorie = categories.id";
							$querySubCat = mysqli_query($connexion, $requeteSubCat);
							$resultatSubCat = mysqli_fetch_all($querySubCat);
							
							$nbSubCat = count($resultAllSubCat);
							
							$i = 0;
							while($i != $nbSubCat) 
							{ ?>
								<form method="post" action="">
									<?php echo $resultatSubCat[$i][4]; ?> > Sous-Categorie : <input type="text" name="upSubCat" placeholder="<?php echo $resultAllSubCat[$i][2]; ?>">
									<input id="buttonAdmin" type="submit" name="updateSubCat<?php echo $resultAllSubCat[$i][0]; ?>" value="Modifier">
									<input id="buttonAdmin" type="submit" name="deleteSubCat<?php echo $resultAllSubCat[$i][0]; ?>" value="Supprimer">
								</form><br>
							<?php
								$idSubCat = $resultAllSubCat[$i][0];
								$nomSubCat = $resultAllSubCat[$i][2];

								if (isset($_POST["updateSubCat$idSubCat"]) AND strlen($_POST['upSubCat']) != 0	) 
								{
									$requeteUpdateSubCat = "UPDATE sous_categorie set nom = '".$_POST['upSubCat']."' WHERE nom = '".$nomSubCat."'";
									$queryUpdateSubCat = mysqli_query($connexion, $requeteUpdateSubCat);
									
									header('location:admin.php');
								}
								if (isset($_POST["deleteSubCat$idSubCat"])) 
								{
									$requeteDeleteSubCat = "DELETE FROM sous_categorie WHERE id = '".$idSubCat."'";
									$queryDeleteSubCat = mysqli_query($connexion, $requeteDeleteSubCat);
									header('location:admin.php');

								}
								$i++;
							}
							?>
						</section>
					</section>
				</section>
			</section>
			<br><br>
				<section id="flexTopAdminPanel4">
					<section id="flexTopArticleTest">
						<section id="flexAjouterArticle">
						<section id="topBarAjouterArticle">
							Ajouter un article :
						</section>
							<section class="testAdmin3">
								<form method="post" action="admin.php" enctype="multipart/form-data">
									Nom : <br /> <input type="text" name="nameArticle"><br />
									Description : <br /> <input type="text" name="descArticle"><br />
									Prix : <br /> <input type="number" step="0.01" name="prixArticle"><br />
									Quantite : <br /> <input type="number" name="amountArticle"> <br /> <br />
									Image : <br /> <input type="file" name="avatar"><br /> <br />
									<select type="post" name="categorie">
										<option>Categories</option>
							<?php
							for ($i=0; $i < $nbCat ; $i++) 
								{ ?> 
									<option><?php echo $resultAllCat[$i][1]; ?></option>
									<?php
								}
								?>
							</select>
							<br />
							<br />

							<?php
							$requeteAllSubCat = "SELECT nom FROM sous_categorie";
							$queryAllSubCat = mysqli_query($connexion, $requeteAllSubCat);
							$resultAllSubCat = mysqli_fetch_all($queryAllSubCat);

							$nbSubCat = count($resultAllSubCat);

							?>

							<select type="post" name="subCat">
								<option>Sous-Categorie</option>
								<?php
								for ($i=0; $i < $nbSubCat; $i++) 
									{?> 
										<option><?php echo $resultAllSubCat[$i][0]; ?></option>
										<?php
									}
									?>
								</select>
								<br />
								<br />
								<input id="buttonAdmin2" type="submit" name="addArticle" value="Ajouter">

								<?php
								addArticle();
								?>

							</form>
								</section>
					</section>
							<section id="allProduits">
							<section id="topBarListeProduits">
								Liste des produits :
							</section>
							<section id="listeProduitsTable">
							<form method="POST" action="">
								<table id="tableProduit">
									<thead>
										<tr>
											<th id="tHeadListeProduit" colspan="10">Liste des produits</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>ID</td>
											<td>Catégorie</td>
											<td>Sous-Categorie</td>
											<td>Nom</td>
											<td>Description</td>
											<td>Prix</td>
											<td>Quantité</td>
											<td>Image</td>
											<td></td>
										</tr>
										<?php
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
													<td><?php echo $resultInfosArticle[$i][0]; ?></td>
													<td><?php echo $resultInfosArticle[$i][9]; ?></td>
													<td><?php echo $resultInfosArticle[$i][12]; ?></td>
													<td><?php echo $resultInfosArticle[$i][3]; ?></td>
													<td><section id="descListeProduits"><?php echo $resultInfosArticle[$i][4]; ?></section></td>
													<td><?php echo $resultInfosArticle[$i][5]; ?>€</td>
													<td><?php echo $resultInfosArticle[$i][6]; ?></td>
													<td id="imgArticleListeProduit"><img src="imgArticle/<?php echo $resultInfosArticle[$i][7] ?>"></td>
													<td><a href="produits?id=<?php echo $resultInfosArticle[$i][0]; ?>"><input id="buttonAdmin2" type="submit" name="updateProduits<?php echo $resultInfosArticle[$i][0] ; ?>" value="Modifier"></a>
													<br><br>
													<input id="buttonAdmin2" type="submit"  name="supprimerProduit<?php echo $resultInfosArticle[$i][0] ; ?>" value="Supprimer">
													</td>
													<?php

														$idProduitDelete = $resultInfosArticle[$i][0];
													
														if(isset($_POST["supprimerProduit$idProduitDelete"]))
														{
															$requeteDeleteProduit="DELETE FROM produits WHERE id=\"$idProduitDelete\"";
															$queryDeleteProduit=mysqli_query($connexion,$requeteDeleteProduit);
															header('location:admin.php');
														}

														if(isset($_POST["updateProduits$idProduitDelete"]))
														{
															header('location:produits.php?id='.$idProduitDelete.'&&modif');
														}
													?>	
												</tr>

												<?php

											$i++;
											}

										}

										?>
									</tbody>
								</table>
								</section>
							</section>
							</form>
						</section>
									</section>
						<br />
						<br />
				</section>
	</main>
	<?php
	include('footer.php');
	ob_end_flush();
	?>
</body>
</html>