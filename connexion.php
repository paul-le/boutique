<?php
session_start();
include('fonctions.php');
?>


<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	include('header2.php');
	?>
	<main id="mainConnexion">
		<section id="partieGauche">
		</section>
		<section id="connexionForm">
				<fieldset id="formConnexionSection">
					<legend id="legendCon">Connexion</legend>
					<form id="formConnexion" action="" method="post"><br />

						Login : <br><br><input type="text" name="login" required><br><br>
						Password : <br><br><input type="password" name="password" required><br><br>

						<input  type="submit" name="valider">


					<?php

					
					connexion();

					?>
				</form>
				<br>
				<a href="inscription.php">Vous n'avez pas de compte ?</a>

			</fieldset>
		</section>
		<section id="partieDroite">
		</section>
	</main>
	<?php
	include('footer.php');
	?>
</body>
</html>
