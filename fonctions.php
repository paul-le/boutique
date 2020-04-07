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



?>