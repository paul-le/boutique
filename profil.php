<?php

    session_start();
    ob_start();
    $connexion = mysqli_connect("localhost", "root" ,"","boutique");
    $getId = $_GET['id'];

    $requeteInfosProfil = "SELECT * FROM utilisateurs WHERE id ='".$getId."'";
    $queryInfosProfil = mysqli_query($connexion,$requeteInfosProfil);
    $resultatInfosProfil = mysqli_fetch_all($queryInfosProfil);

    var_dump($resultatInfosProfil);
    
    if(!isset($_SESSION['login']))
    {
        header("Location:connexion.php");
    }


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
    include('header.php');
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
                                    $requeteCheckInfos = "SELECT login,mail FROM utilisateurs WHERE login = \"$loginUpdatePost\"";
                                    $queryCheckInfos = mysqli_query($connexion,$requeteCheckInfos);
                                    $resultatCheckInfos = mysqli_fetch_all($queryCheckInfos);

                                    if(!empty($_POST['login']) && !empty($resultatCheckInfos))
                                    {
                                        echo "Ce login est déjà pris !";
                                    }
                                    
                                    if(empty($resultatCheckInfos) && !empty($_POST['login']))
                                    {
                                        $requeteUpdateInfos = "UPDATE utilisateurs SET login = '".$_POST['login']."' WHERE id=\"$getId\"";
                                        $queryUpdateInfos = mysqli_query($connexion,$requeteUpdateInfos);
                                        header('Location:profil.php?id='.$getId.'');
                                    }
                                    if(!empty($_POST['email']))
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
                                } ?>

                        </form>
                    </section>
                
                    <section id="autreInfosProfil">
                        Commentaires envoyés , articles achetés , "panier ?".
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

    <?php 

        if(isset($_POST['modifierRang']))
    {
        $rangUpdatePost = $_POST['rankSwap'];
        $requeteRangUpdate = "UPDATE utilisateurs SET rank = \"$rangUpdatePost\" WHERE utilisateurs.id = '".$_GET['id']."'";
        $queryRangUpdate = mysqli_query($connexion,$requeteRangUpdate);
        header('Location:profil.php?id='.$getId.'');
    }









        // ob_end_flush()