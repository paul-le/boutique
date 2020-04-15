<?php

function inscription()
{

    if(!isset($_SESSION['login']))
    {


        if(isset($_POST['valider']))
        {

            if(!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['confirmpassword']) )
            {

                $connexion = mysqli_connect('localhost','root','','boutique');
                $requeteUser = "SELECT * FROM utilisateurs WHERE login='".$_POST['login']."'";
                $queryUser = mysqli_query($connexion, $requeteUser);
                $resultatUser = mysqli_fetch_row($queryUser);

                if($resultatUser == 0)
                {

                    if($_POST['password'] == $_POST['confirmpassword'] )
                    {
                        $password = $_POST['password'];
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                        $requeteNewUser = "INSERT INTO utilisateurs (login, password, mail, adresse, rank) VALUES ('".$_POST['login']."','".$passwordHash."', '".$_POST['mail']."', '".$_POST['adresse']."', 'MEMBRE')";
                        $queryNewUser = mysqli_query($connexion, $requeteNewUser);
                        header('location:connexion.php');

                    }

                    else
                    {
                        echo '<div class="erreur">Mot de passe et confirmation de mot de passe différents.</div>'.'</br>';
                    }

                }

                else
                {
                    echo '<div class="erreur">Le login est déjà existant, merci de le modifier et de réessayer de nouveau.</div>'.'<br/>';
                }

            }

            else
            {
                echo '<div class="erreur">Veuillez remplir tous les champs.</div>'.'</br>';
            }

        }
    }
    else
    { 
        header('location:index.php');
    }



}








function connexion()

{
   
    if(!isset($_SESSION['login']))
    {


        if(isset($_POST['valider']))
        {
            if(!empty($_POST['login']) and !empty($_POST['password']))
            {
                $connexion = mysqli_connect('Localhost','root','','boutique');
                $requeteLogUser = "SELECT * FROM utilisateurs WHERE login='".$_POST['login']."'";
                $queryLogUser = mysqli_query($connexion, $requeteLogUser);
                $resultatLogUser = mysqli_fetch_assoc($queryLogUser);
                
                $password=$_POST['password'];


                if($resultatLogUser['login'] != $_POST['login'])
                {
                    echo '<div class="erreur">Login inexistant</div>'.'<br/>';
                }

                else
                {
                    if($_POST['login'] == $resultatLogUser['login'])
                    {
                        if(password_verify($password, $resultatLogUser['password']))
                        {
                            
                            $_SESSION['id'] = $resultatLogUser['id'];
                            $_SESSION['login'] = $resultatLogUser['login'];
                            $_SESSION['password'] = $resultatLogUser['password'];
                            $_SESSION['mail'] = $resultatLogUser['mail'];
                            $_SESSION['adresse'] = $resultatLogUser['adresse'];
                            $_SESSION['rank'] = $resultatLogUser['rank'];
                            
                            header('location:index.php');
                        }
                        else
                        {
                            echo '<div class="erreur">Mot de passe incorrecte</div>'.'<br/>';
                        }
                    }

                }

            }
        }

    }
    else
    { 
        header('location:index.php');  
    }

}


function newCategorie()
{
    if ($_SESSION['rank'] == 'ADMIN') 
    {
       if (isset($_POST['addCategorie'])) 
       {
            $connexion = mysqli_connect('Localhost','root','','boutique');
            $requeteCat = "SELECT * FROM categories WHERE nom = '".$_POST['categorie']."'";
            $queryCat = mysqli_query($connexion, $requeteCat);
            $resultatCat = mysqli_fetch_all($queryCat);

            
            if (empty($resultatCat))
            {
                $requeteNewCat = "INSERT INTO categories (nom) VALUES ('".$_POST['categorie']."')";
                $queryNewCat = mysqli_query($connexion, $requeteNewCat);
                
                header('location:admin.php');   
            }
            else
            {
                echo "Cette categorie existe déja";
            }
        } 
    }
    else
    {
        header('location:index.php');
    }
}


function addSubCat()
{
    if ($_SESSION['rank'] == 'ADMIN') 
    {
        if (isset($_POST['addSubCat'])) 
       {
            $connexion = mysqli_connect('Localhost','root','','boutique');
            $requeteSubCat = "SELECT * FROM sous_categorie INNER JOIN categories ON sous_categorie.id_categorie = categories.id WHERE categories.nom = '".$_POST['categorie']."' AND sous_categorie.nom ='".$_POST['subCat']."' ";
            $querySubCat = mysqli_query($connexion, $requeteSubCat);
            $resultatSubCat = mysqli_fetch_all($querySubCat);

            
            
            
            if (empty($resultatSubCat))
            {
                
                $requeteCat = "SELECT * FROM categories WHERE nom = '".$_POST['categorie']."'";
                $queryCat = mysqli_query($connexion, $requeteCat);
                $resultatCat = mysqli_fetch_assoc($queryCat);


                $requeteNewSubCat = "INSERT INTO sous_categorie (id_categorie, nom) VALUES ('".$resultatCat['id']."', '".$_POST['subCat']."')";
                $querySubNewCat = mysqli_query($connexion, $requeteNewSubCat);
               
                header('location:admin.php');   
            }
            else
            {
                echo "Cette sous categorie existe déja";
            }
        } 
    }
}

function addArticle()
{
    if ($_SESSION['rank'] == 'ADMIN') 
    {


        if (isset($_POST['addArticle'])) 
        {
            
            

            $connexion = mysqli_connect('Localhost','root','','boutique');

            $requeteCat = "SELECT * FROM categories WHERE nom = '".$_POST['categorie']."'";
            $queryCat = mysqli_query($connexion, $requeteCat);
            $resultatCat = mysqli_fetch_assoc($queryCat);
             

            $requeteSubCat = "SELECT * FROM sous_categorie WHERE nom = '".$_POST['subCat']."'";
            $querySubCat = mysqli_query($connexion, $requeteSubCat);
            $resultatSubCat = mysqli_fetch_assoc($querySubCat);

            $requeteArticle = "SELECT * FROM produits WHERE nom = '".$_POST['nameArticle']."'";
            $queryArticle = mysqli_query($connexion, $requeteArticle);
            $resultArticle = mysqli_fetch_all($queryArticle);

            if (empty($resultArticle)) 
            {
                if (isset($_FILES['avatar']) AND !empty($_FILES['avatar'])) 
                {
                    $tailleMax = 2097152 ;
                    $extensionsValides = $arrayName = array('jpg', 'jpeg', 'gif', 'png');
                    if ($_FILES['avatar']['size'] <= $tailleMax) 
                    {
                        $extensionsUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
                        if (in_array($extensionsUpload, $extensionsValides)) 
                        {
                            $chemin = "imgArticle/".$_POST['nameArticle'].".".$extensionsUpload;
                            
                            $deplacement = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                            if ($deplacement) 
                            {
                                $nomImage = $_POST['nameArticle'].".".$extensionsUpload;
                            }
                            else
                            {
                                $msg = "Erreur durant l'importation de votre photo de profil" ;
                            }
                        }
                        else
                        {
                            $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png. ";
                        }

                    }
                    else
                    {
                        $msg = "Votre photo de profil ne doit pas dépasser 2Mo" ;
                    }
                }
                

                
                    $requeteNewArticle = "INSERT INTO produits (id_categorie, id_sous_categorie, nom, description, prix, quantite, img) VALUES ('".$resultatCat['id']."', '".$resultatSubCat['id']."', '".$_POST['nameArticle']."', '".$_POST['descArticle']."', '".$_POST['prixArticle']."', '".$_POST['amountArticle']."', '".$nomImage."') ";
                    $queryNewArticle = mysqli_query($connexion, $requeteNewArticle);
                    echo $requeteNewArticle;

                
            }
            else
            {
                echo "Ce produits existe déja";
            }

        }
    }

}


function searchBar()
{
    if (isset($_POST["search"]) AND strlen($_POST["search"]) != 0) 
    {
        $_POST["searchBar"] = htmlspecialchars($_POST["searchBar"]);
        $recherche = $_POST["searchBar"];

        if (isset($recherche)) 
        {
            $recherche = strtolower($recherche);

            $connexion = mysqli_connect('Localhost','root','','boutique');

            $requeteSearch = "SELECT * FROM produits WHERE nom LIKE '%$recherche%' ";
            $querySearch = mysqli_query($connexion, $requeteSearch);
            $resultSearch = mysqli_fetch_all($querySearch);

            
            

        }
    }
}

    
?>