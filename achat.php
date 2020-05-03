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
    include('header2.php');
    
    ?>
	<main>
		<form method="post" action="">
			<?php

			$achatUser = "SELECT * FROM panier INNER JOIN produits ON panier.id_article = produits.id INNER JOIN utilisateurs ON panier.id_utilisateur = utilisateurs.id";
			$queryAchatUser = mysqli_query($connexion, $achatUser);
			$resultAchat = mysqli_fetch_all($queryAchatUser);

		

	

			
                
			?>


			<section id="paiement">
				<section id="insidePaiement">
					
					
					
							<div>
								<p>1- Adresse de livraison</p>

								
									<?php echo $resultAchat[0][15]; ?><br />
									<?php echo $resultAchat[0][18]; ?><br /><br />
								
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
							<?php

							foreach($resultAchat as $achat)
							{?>
								

									<img src="imgArticle/<?php echo $achat[12] ?>" width ="100" >  <?php echo $achat[8]; ?>  <?php echo $achat[3]; ?>  <?php echo $achat[4].'€'; ?> <br /><br />

								</div>


							<?php
							if (isset($_POST['achat'])) 
							{
								$addAchat = "INSERT INTO achats (id_utilisateur, id_article, quantite, prix) VALUES ('".$_SESSION['id']."', '".$achat[1]."', '".$achat[3]."', '".$achat[4]."')"	;
								$queryAddAchat = mysqli_query($connexion, $addAchat);

								$vente = $achat[13] + 1 ;
								$upVenteProduits = "UPDATE produits SET vente = '".$vente."' WHERE id='".$achat[1]."'";
								$queryUpVente = mysqli_query($connexion, $upVenteProduits);

								$deletePanier = "DELETE FROM panier WHERE id_article = '".$achat[1]."' ";
								$queryDeletePanier = mysqli_query($connexion, $deletePanier); 

								header('location:index.php');
							}
							}
							?>
				</section>
				<br />

				<input type="submit" name="achat" value="Acheter">

			</section>
			
			<?php

			


			?>

		</form>
	</main>
	<?php
    include('footer.php');
    
    ?>
</body>
</html>