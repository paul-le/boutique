<?php

    session_start();
    include('fonctions.php');
    ob_start();
    $connexion = mysqli_connect("localhost", "root" ,"","boutique");
    $getId = $_GET['id'];

    $requeteInfosProfil = "SELECT * FROM utilisateurs WHERE id ='".$getId."'";
    $queryInfosProfil = mysqli_query($connexion,$requeteInfosProfil);
    $resultatInfosProfil = mysqli_fetch_all($queryInfosProfil);


    
    if(!isset($_SESSION['login']))
    {
        header("Location:connexion.php");
    }

    $requeteComProfil = "SELECT * FROM commentaires WHERE id_utilisateur=\"$getId\"";
    $queryComProfil = mysqli_query($connexion,$requeteComProfil);
    $resultatComProfil = mysqli_fetch_all($queryComProfil);
   
    $nbCom = count($resultatComProfil);

    $requeteListeArt = "SELECT * FROM achats INNER JOIN produits ON achats.id_article = produits.id INNER JOIN utilisateurs ON achats.id_utilisateur = utilisateurs.id WHERE id_utilisateur = \"$getId\"";
    $queryListeArt = mysqli_query($connexion,$requeteListeArt);
    $resultatListeArt = mysqli_fetch_all($queryListeArt);
    
    $nbJeux = count($resultatListeArt);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
    include('header2.php');
    ?>
    <main>
        <section id="fullFlexProfil">
            <section id="partieDroite">
            </section>
            <section id="mainProfilSection1">
                <section id="topBarProfil">
                    Profil de <?php echo "".$resultatInfosProfil[0][1].""; ?>
                </section>
                <section id="mainProfilSection2">
                    <section id="formProfil">
                    <?php if($_SESSION['login'] == $resultatInfosProfil[0][1] || $_SESSION['id'] == "1" ) { ?>
                        <h1>Modifier les informations du profil</h1><br>
                        <form action="" method="POST">
                            <label>Pseudo</label><br>
                            <input type="text" name="login" placeholder="<?php echo "".$resultatInfosProfil[0][1].""; ?> "><br><br>
                            <label>Mot de passe</label><br>
                            <input type="password" name="password"><br><br>
                            <label>Confirmation du mot de passe</label><br>
                            <input type="password" name="passwordcon"><br><br>
                            <label>Email</label><br>
                            <input type="email" name="email" placeholder="<?php echo "".$resultatInfosProfil[0][3].""; ?>"><br><br>
                            <label>Adresse</label><br>
                            <input type="text" name="adresse" placeholder="<?php echo "".$resultatInfosProfil[0][4].""; ?>"><br><br>
                            <input type="submit" name="modifier" value="Modifier"><br><br>
                    <?php } ?>
                            <?php if($_SESSION['rank'] == "ADMIN" && $_GET['id'] != "1"){ ?>

                            <select action="" type="POST" name="rankSwap">
                                <option>Changer de rang</option>
                                <option value="ADMIN">Administrateur</option>
                                <option value="MEMBRE">Membre</option>
                            </select><br><br>
                            <input type="submit" name="modifierRang" value="Modifer le rang">
                            
                            <?php } else {}

                                if(isset($_POST['modifier']))
                                {
                                    $loginUpdatePost = $_POST['login'];
                                    $mailUpdatePost = $_POST['email'];
                                    $requeteCheckInfos = "SELECT login FROM utilisateurs WHERE login = \"$loginUpdatePost\"";
                                    $queryCheckInfos = mysqli_query($connexion,$requeteCheckInfos);
                                    $resultatCheckInfos = mysqli_fetch_all($queryCheckInfos);
                                    $requeteCheckInfos2 = "SELECT mail FROM utilisateurs WHERE mail =\"$mailUpdatePost\"";
                                    $queryCheckInfos2 = mysqli_query($connexion,$requeteCheckInfos2);
                                    $resultatCheckInfos2 = mysqli_fetch_all($queryCheckInfos2);

                                    if(!empty($_POST['login']) && !empty($resultatCheckInfos))
                                    {
                                        echo "<br><br>Ce login est déjà pris !";
                                    }
                                    elseif(empty($resultatCheckInfos) && !empty($_POST['login']))
                                    {
                                        $requeteUpdateInfos = "UPDATE utilisateurs SET login = '".$_POST['login']."' WHERE id=\"$getId\"";
                                        $queryUpdateInfos = mysqli_query($connexion,$requeteUpdateInfos);
                                        header('Location:profil.php?id='.$getId.'');
                                    }

                                    if(empty($_POST['email']) && !empty($resultatCheckInfos2))
                                    {
                                        echo "<br><br>Cet email est déjà utilisé !";
                                    }

                                    elseif(empty($resultatCheckInfos2) && !empty($_POST['email']))
                                    {
                                            $requeteUpdateInfos2 = "UPDATE utilisateurs SET mail = '".$_POST['email']."' WHERE id=\"$getId\"";
                                            $queryUpdateInfos2 = mysqli_query($connexion,$requeteUpdateInfos2);
                                            header('Location:profil.php?id='.$getId.'');
                                    }
                                                  
                                    if(!empty($_POST['password']))
                                    {
                                        if($_POST['password'] == $_POST['passwordcon'])
                                        {
                                        $mdpHash = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 12));
                                        $requeteUpdatePass = "UPDATE utilisateurs SET password ='$mdpHash' WHERE id = \"$getId\"";
                                        $queryUpdatePass = mysqli_query($connexion,$requeteUpdatePass);
                                        header('Location:profil.php?id='.$getId.'');
                                        }
                                        else
                                        {
                                            echo "Les mots de passes sont différents !";
                                        }
                                    }
                                } 

                                if(isset($_POST['modifierRang']))
                                {
                                    if($_POST['rankSwap'] != "Changer de rang")
                                    {
                                    $rangUpdatePost = $_POST['rankSwap'];
                                    $requeteRangUpdate = "UPDATE utilisateurs SET rank = \"$rangUpdatePost\" WHERE utilisateurs.id = '".$_GET['id']."'";
                                    $queryRangUpdate = mysqli_query($connexion,$requeteRangUpdate);
                                    header('Location:profil.php?id='.$getId.'');
                                    }
                                    else
                                    { 
                                        echo "Veuillez choisir un rang !";
                                    } 
                                } ?>

                        </form>
                    </section>
                
                    <section id="autreInfosProfil">
                        <section id="aboveListeComProfil">
                            Liste des commentaires envoyés :
                        </section>
                        <section id="listeComProfil">
                            <?php
                                $countCom = 0;
                                while($countCom != $nbCom)
                                {
                                    echo "<b>Note</b> :".$resultatComProfil[$countCom][4]."/5 | <b>".$resultatComProfil[$countCom][3]."</b><br>";
                                    $countCom++;
                                }
                            ?>
                        </section>
                        <section id="aboveListeArtProfil">
                            Liste des articles achetés :
                        </section>
                        <section id="articleAcheteProfil">
                            <?php
                                $countJeux = 0;
                                while($countJeux != $nbJeux)
                                {
                                    echo "<a href=produits.php?id=".$resultatListeArt[$countJeux][5].">".$resultatListeArt[$countJeux][8]."</a><br>";
                                    $countJeux++;
                                }
                                ?>
                        </section>
                    </section>
                </section>
            </section>
            <section id="partieGauche">

            </section>
        </section>
    </main>
    <?php 
    include('footer.php');
    ?>
</body>
</html>