<?php
session_start();
include('fonctions.php');

$connexion = mysqli_connect('Localhost','root','','boutique');

?>



<!DOCTYPE html>
<html>
<head>
	<title>Achat</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
    include('header.php');
    
    ?>
	<main>
		<form method="post" action="">
			<?php

			$achatUser = "SELECT * FROM achats INNER JOIN produits ON achats.id_article = produits.id INNER JOIN utilisateurs ON achats.id_utilisateur = utilisateurs.id";
			$queryAchatUser = mysqli_query($connexion, $achatUser);
			$resultAchat = mysqli_fetch_all($queryAchatUser);

			var_dump($resultAchat);


	

			
                
			?>


			<section id="paiement">
				<section id="insidePaiement">
					
					<?php
					foreach($resultAchat as $achat)
						{?>
							<div>
								<p>1- Adresse de livraison</p>

								
									<?php echo $achat[14]; ?><br />
									<?php echo $achat[17]; ?><br /><br />
								
							</div>
							<div>
								<p>2- Selectionnez un moyen de paiement</p>

								Numéro de la carte : <input type="text" name="" placeholder="XXXX XXXX XXXX XXXX"><br /><br />
								Nom du titulaire : &nbsp&nbsp&nbsp <input type="text" ><br /><br />
								Date d'expiration : <input type="number" value="01" min="01" max="12"> <input type="number" value="2020" min="2020" max="2040"><br /><br />
								Cryptogramme Visuel : <input type="number" placeholder="XXX" min="000" max="999"><br /><br />

							</div>

							<div>
								<p>3- Article</p>

								<img src="imgArticle/<?php echo $achat[12] ?>" width ="100" >  <?php echo $achat[8]; ?>  <?php echo $achat[3]; ?>  <?php echo $achat[4].'€'; ?> <br /><br />

							</div>


							<?php
						}
						?>
				</section>
				<br />

				<a href="index.php"><button>VALIDER</button></a>

			</section>
			
			

		</form>
	</main>
	<?php
    include('footer.php');
    
    ?>
</body>
</html>