<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>New Categorie</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	include('header.php')
	?>
	<main>
		<section id="newCat">
			
			<form method="post" action="newCategorie.php">
				Nom :<br /> <input type="text" name="categorie" required><br />
				<input type="submit" name="addCategorie">
			</form>
			<?php
			include('fonctions.php');
			newCategorie();
			?>
		</section>
	</main>
	<?php
	include('footer.php')
	?>
</body>
</html>