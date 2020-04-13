<?php
session_start();
include('fonctions.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Panier</title>
</head>
<body>
	<main>
		<?php
		if (isset($_SESSION['id'])) 
		{
			$connexion = mysqli_connect('Localhost','root','','boutique');


			$requetePanier = "SELECT * FROM panier WHERE id_utilisateur = '".$_SESSION['id']."'";
			$queryPanier = mysqli_query($connexion, $requetePanier);
			$resultPanier = mysqli_fetch_all($queryPanier);

			var_dump($resultPanier);
		}
		
		?>
	</main>

</body>
</html>