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

                    if($_POST['password']==$_POST['confirmpassword'])
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
            $requeteSubCat = "SELECT * FROM sous_categorie WHERE nom = '".$_POST['subCat']."'";
            $querySubCat = mysqli_query($connexion, $requeteSubCat);
            $resultatSubCat = mysqli_fetch_all($querySubCat);

            
            if (empty($resultatSubCat))
            {
                
                $requeteCat = "SELECT * FROM categories WHERE nom = '".$_POST['categorie']."'";
                $queryCat = mysqli_query($connexion, $requeteCat);
                $resultatCat = mysqli_fetch_assoc($queryCat);


                $requeteNewSubCat = "INSERT INTO sous_categorie (id_categorie, nom) VALUES ('".$resultatCat['id']."', '".$_POST['subCat']."')";
                $querySubNewCat = mysqli_query($connexion, $requeteNewSubCat);
                echo $requeteNewSubCat;
                //header('location:admin.php');   
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
            
            define('TARGET', '/files/');    // Repertoire cible
            define('MAX_SIZE', 100000);    // Taille max en octets du fichier
            define('WIDTH_MAX', 800);    // Largeur max de l'image en pixels
            define('HEIGHT_MAX', 800);    // Hauteur max de l'image en pixels

            // Tableaux de donnees
            $tabExt = array('jpg','gif','png','jpeg');    // Extensions autorisees
            $infosImg = array();

            // Variables
            $extension = '';
            $message = '';
            $nomImage = '';

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

                

                // On verifie si le champ est rempli
                if( !empty($_FILES['avatar']['name']) )
                {
                    // Recuperation de l'extension du avatar
                    $extension  = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
 
                    // On verifie l'extension du avatar
                    if(in_array(strtolower($extension),$tabExt))
                    {
                        // On recupere les dimensions du avatar
                        $infosImg = getimagesize($_FILES['avatar']['tmp_name']);
 
                        // On verifie le type de l'image
                        if($infosImg[2] >= 1 && $infosImg[2] <= 14)
                        {
                            // On verifie les dimensions et taille de l'image
                            if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['avatar']['tmp_name']) <= MAX_SIZE))
                            {
                                // Parcours du tableau d'erreurs
                                if(isset($_FILES['avatar']['error']) && UPLOAD_ERR_OK === $_FILES['avatar']['error'])
                                {
                                    // On renomme le avatar
                                    $nomImage = $_POST['nameArticle'].'.'. $extension;
 
                                    // Si c'est OK, on teste l'upload
                                    if(move_uploaded_file($_FILES['avatar']['tmp_name'], TARGET.$nomImage))
                                    {
                                        $message = 'Upload réussi !';
                                    }   
                                    else
                                    {
                                        // Sinon on affiche une erreur systeme
                                        $message = 'Problème lors de l\'upload !';
                                    }
                                }
                                else
                                {
                                    $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
                                }
                            }
                            else
                            {
                                // Sinon erreur sur les dimensions et taille de l'image
                                $message = 'Erreur dans les dimensions de l\'image !';
                            }   
                        }
                        else
                        {
                            // Sinon erreur sur le type de l'image
                            $message = 'Le avatar à uploader n\'est pas une image !';
                        }
                    }
                    else
                    {
                        // Sinon on affiche une erreur pour l'extension
                        $message = 'L\'extension du avatar est incorrecte !';
                    }
                    $requeteNewArticle = "INSERT INTO produits (id_categorie, id_sous_categorie, nom, description, prix, quantite, img) VALUES ('".$resultatCat['id']."', '".$resultatSubCat['id']."', '".$_POST['nameArticle']."', '".$_POST['descArticle']."', '".$_POST['prixArticle']."', '".$_POST['amountArticle']."', '".$nomImage."' ";
                    $queryNewArticle = mysqli_query($connexion, $requeteNewArticle);
                    echo $requeteNewArticle;
                }
                
                
                
            }
            else
            {
                echo "Ce produits existe déja";
            }

        }
    }

}
?>