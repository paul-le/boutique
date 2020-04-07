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
		<section id="inscriptionForm">
			
			<div id="fullFormInscription">
				<div id="titreInscription">INSCRIPTION</div>
				<form action="" method="post" ><br />

					<div id="formInscription">
						Login :<br /> <input type="text" name="login"><br />
						Mot de Passe :<br /><input type="password" name="password"><br />
						Confirmation Mot de Passe : <br /><input type="password" name="confirmpassword"><br />
					</div>
					<div id="buttonInscription">
						<input type="submit" name="valider">
					</div>

				</form>
				<?php

				include('fonctions.php');
				inscription();
				?>
			</div>
		</section>
	</main>
	<?php
	include('footer.php');
	?>
</body>
</html>

