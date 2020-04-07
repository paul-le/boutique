<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	include('header.php');
	?>
	<main id="mainInscription">
			<section id="partieGauche">
			</section>
			<section id="inscriptionFormSection">
				<form id="inscriptionForm" action="" method="post" ><br>
					<h1>INSCRIPTION</h1>
						Login :<br> <input type="text" name="login" required><br><br>
						Mot de Passe :<br><input type="password" name="password" required><br><br>
						Confirmation Mot de Passe : <br><input type="password" name="confirmpassword" required><br><br>
						Mail :<br> <input type="email" name="mail" required><br><br>
						Adresse :<br> <input type="text" name="adresse" required><br><br>

						<input type="submit" name="valider">

				</form>
				<?php

				include('fonctions.php');
				inscription();
				?>
			</section>
		<section id="partieDroite">
		</section>
	</main>
	<?php
	include('footer.php');
	?>
</body>
</html>

