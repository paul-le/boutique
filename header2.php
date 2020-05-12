<header>
        <section id="sectionTopHeader">
             <form id="formHeaderToast" method="post" action="">
                <input id="formHeaderInput" type="search" name="searchBar" placeholder="Rechercher">
                <input id="formHeaderSubmit" type="submit" name="search" value="">
                <?php
                searchBar();
                ?>
            </form>
            <h1 id="headerH1">Welcome</h1>
        </section>
        <section id="sectionBottomHeader">
            <section id="imagesHeader">
                <a href="index.php"><img id="bottomLogo" src="Images/logo.png"></a>
                <a href="index.php"><img id="topLogo" src="Images/logov2.png"></a>
            </section>
            <!-- <section id="sectionBottomHeaderDroite"> -->
                <ul id="headerNavBar">
                    <?php if(isset($_SESSION['login']) && $_SESSION['rank'] == "MEMBRE" ) { ?>
                        <li>
                            <a href="profil.php?id=<?php echo "".$_SESSION['id']."" ?>"><img id="iconAccount" src="Images/iconacc.png">Mon compte </a>
                        </li>
                        <li>
                            <a href="deconnect.php"><img src="Images/decoicon.png">Deconnexion</a>
                        </li>
                    <?php } elseif(isset($_SESSION['login']) && $_SESSION['rank'] == "ADMIN"){ ?>
                        <li>
                            <a href="profil.php?id=<?php echo "".$_SESSION['id']."" ?> "><img id="iconAccount" src="Images/iconacc.png">Mon compte </a>
                        </li>
                        <li>
                            <a href="admin.php"><img id="iconAccount" src="Images/iconacc.png">Administrateur </a>
                        </li>
                        <li>
                            <a href="deconnect.php"><img src="Images/decoicon.png">Deconnexion</a>
                        </li>
                    <?php } else { ?>
                        <li>
                        <a href="connexion.php"><img id="iconAccount" src="Images/iconacc.png">Mon compte </a>
                        </li>
                    <?php } ?>

                    
                </ul>
            <!-- </section> -->
        </section>
    </header>