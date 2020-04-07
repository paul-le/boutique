<html>

	<head>
		<title>Inscription</title>
		<link rel="stylesheet" type="text/css" href="camping.css">
	</head>

	<body id="bodyInscription">
		
		<main id="mainInscription">
			
			<div id="fullFormInscription">
				<div id="titreInscription">INSCRIPTION</div>
				<form action="" method="post" ><br />
					
					<div id="formInscription">
						Login :<br /> <input type="text" name="login"><br />
						Mdp :<br /><input type="password" name="password"><br />
						Conf mdp : <br /><input type="password" name="confirmpassword"><br />
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


		</main>
		
	</body>
</html>