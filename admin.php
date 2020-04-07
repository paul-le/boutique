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
		<section class="testAdmin">
			<div>ADD CATEGORIE</div>
			<form method="post" action="admin.php">

				Nom :<br /><input type="text" name="categorie"><br />

				<input type="submit" name="addCategorie">

				<?php
				newCategorie();
				?>
			</form>

			
		</section>

		<br />
		<br />

		<section class="testAdmin">
			<div>ADD SUB CAT</div>
			<form method="post" action="admin.php">

				Nom :<br /><input type="text" name="subCat"><br />
				<?php
				$requeteAllCat = "SELECT nom FROM categories";
				$queryAllCat = mysqli_query($connexion, $requeteAllCat);
				$resultAllCat = mysqli_fetch_all($queryAllCat);

				$nbCat = count($resultAllCat);
				
				?>
				

				<select  type="post" name="categorie">
					<option>Categories</option>
					<?php
					for ($i=0; $i < $nbCat ; $i++) 
					{?> 
						<option><?php echo $resultAllCat[$i][0]; ?></option>
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

			
		</section>

		<br />
		<br />

		<section class="testAdmin">
			<div>ADD ARTICLE</div>
			<form method="post" action="admin.php">
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
						<option><?php echo $resultAllCat[$i][0]; ?></option>
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
				

				<input type="submit" name="addArticle">

				<?php
				addArticle();
				?>
				
			</form>
			
		</section>

		<br />
		<br />

		<section class="testAdmin">
			
		</section>
	</main>
	<?php
	include('footer.php');
	?>
</body>
</html>