<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	include('header.php');
	?>
	<main id="mainConnexion">
		<section id="partieGauche">
		</section>
		<section id="connexionForm">
				<div id="formConnexionSection">
					<h1>Connexion</h1>
					<form id="formConnexion" action="" method="post"><br />

						Login : <br><br><input type="text" name="login" required><br><br>
						Password : <br><br><input type="password" name="password" required><br><br>

						<input  type="submit" name="valider">


					<?php

					include('fonctions.php');
					connexion();

					?>
				</form>
				<br>
				<a href="inscription.php">Vous n'avez pas de compte ?</a>

			</div>
		</section>
		<section id="partieDroite">
		</section>
	</main>
	<?php
	include('footer.php');
	?>
</body>
</html>
