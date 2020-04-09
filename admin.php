<?php

session_start();
$connexion = mysqli_connect('Localhost','root','','boutique');
include('fonctions.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	include('header.php');
	?>
	<main>
		<section id="adminPanel">
			
			<section class="testAdmin">
				<div>ADD CATEGORIE</div>
				<form method="post" action="admin.php">

					Nom :<br /><input type="text" name="categorie"><br />

					<input type="submit" name="addCategorie" value="Ajouter">

					<?php
					newCategorie();
					?>
				</form>

				<section>
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
					 		<input type="submit" name="updateCategorie<?php echo $resultAllCat[$i][0]; ?>" value="Modifier">
					 		<input type="submit" name="deleteCategorie<?php echo $resultAllCat[$i][0]; ?>" value="Supprimer">
					 		
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

			<br />
			<br />

			<section class="testAdmin">
				<div>ADD SUB CAT</div>
				<form method="post" action="admin.php">
					Nom :<br /><input type="text" name="subCat"><br />
					
					<select  type="post" name="categorie">
						<option>Categories</option>
						<?php
						for ($i=0; $i < $nbCat ; $i++) 
							{?> 
								<option><?php echo $resultAllCat[$i][1]; ?></option>
								<?php
							}
							?>
						</select>
						<br />

						<input type="submit" name="addSubCat">

						<?php

						addSubCat();
						
						?>

					</form>

					<section>
						<?php
						$requeteAllSubCat = "SELECT * FROM sous_categorie";
						$queryAllSubCat = mysqli_query($connexion, $requeteAllSubCat);
						$resultAllSubCat = mysqli_fetch_all($queryAllSubCat);
						
						$nbSubCat = count($resultAllSubCat);

						$i = 0;
						while($i != $nbSubCat) 
						{ ?>
							<form method="post" action="">
								Sous-Categorie : <input type="text" name="upSubCat" placeholder="<?php echo $resultAllSubCat[$i][2]; ?>">
								<input type="submit" name="updateSubCat<?php echo $resultAllSubCat[$i][0]; ?>" value="Modifier">
								<input type="submit" name="deleteSubCat<?php echo $resultAllSubCat[$i][0]; ?>" value="Supprimer">
					 		</form>
						<?php
							$idSubCat = $resultAllSubCat[$i][0];
							$nomSubCat = $resultAllSubCat[$i][2];

							if (isset($_POST["updateSubCat$idSubCat"]) AND strlen($_POST['upSubCat']) != 0	) 
							{
								$requeteUpdateSubCat = "UPDATE sous_categorie set nom = '".$_POST['upSubCat']."' WHERE nom = '".$nomSubCat."'";
								$queryUpdateSubCat = mysqli_query($connexion, $requeteUpdateSubCat);
								echo $requeteUpdateSubCat;
								//header('location:admin.php');
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

				<br />
				<br />

				<section class="testAdmin">
					<div>ADD ARTICLE</div>


					<form method="post" action="admin.php" enctype="multipart/form-data">
						Nom : <br /> <input type="text" name="nameArticle"><br />
						Description : <br /> <input type="text" name="descArticle"><br />
						Prix : <br /> <input type="number" step="0.01" name="prixArticle"><br />
						Quantite : <br /> <input type="number" name="amountArticle"> <br /> <br />
						Avatar : <br /> <input type="file" name="avatar"><br /> <br />

						<select type="post" name="categorie">
							<option>Categories</option>
							<?php
							for ($i=0; $i < $nbCat ; $i++) 
								{?> 
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


								<input type="submit" name="addArticle" value="Ajouter">

								<?php
								addArticle();
								?>

							</form>

							<section id="allProduits">

								<table id="tableProduit">
									<thead>
										<tr>
											<th colspan="7">Liste des produits</th>
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
											<td>PHOTO</td>
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
													<td><?php echo $resultInfosArticle[$i][4]; ?></td>
													<td><?php echo $resultInfosArticle[$i][5]; ?>€</td>
													<td><?php echo $resultInfosArticle[$i][6]; ?></td>
													<td><img src="imgArticle/<?php echo $resultInfosArticle[$i][7] ?>" width ="100" ></td>
													<td><a href="produits?id=<?php echo $resultInfosArticle[$i][0]; ?>"><input type="submit" name="updateProduits" value="Modifier"></a></td>
													<?php
													
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

						<br />
						<br />

						<section class="testAdmin">
							
						</section>
		</section>
	</main>
	<?php
	include('footer.php');
	?>
</body>
</html>