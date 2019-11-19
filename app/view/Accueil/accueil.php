<?php
        echo("
        <!DOCTYPE html>
        <html lang='fr'>
            <meta charset='utf-8'>
            <head>
                <title>Index</title>
                <link rel='stylesheet' type='text/css' href='style_index.css'>
            </head>
            <body>
                <header>
                    <h1>TO DOUM</h1>
                    <div>
                        <p>Bonjour, ");
                        echo ($_SESSION['user']);
                        echo("
                        </p>
                        <form method=post action=\"unlogin.php\"><input type=\"submit\" class=\"brk-btn\" value=\"Se déconnecter\"></form>
                    </div>
                </header>
                <main>
                    <nav>
                        <div id='profil'>");
                        if (isset($_REQUEST['modif'])) { // si le bouton est appuyé

                            echo ("
                            <p>Modification du Profil</p>
                            <form method='post' action='updateUser.php?idUser=". $ligne['Id_user']."'>
                               <p> Pseudo : <input type='text' name='username'value='".$ligne['Username']."'/></p>
                               <p> Mail : <input type='text' name='mail' value='".$ligne['Mail_user']."'/></p>
                               <input class='brk-btn' type='submit' value='Modifier'>
                            </form>
                            ");
                        }
                        else {
                            echo("
                            <p>Profil</p>
                            <p>Pseudo : " . $_SESSION["user"] ."</p>
                            <p>Email : ");

                            echo($ligne["Mail_user"]);
                            echo("
                            </p>
                            <a href='accueil.php?modif=true'><button class='brk-btn'>Modifier le profil</button></a>
                            ");
                        }
                        echo ("
                        </div>
                        <div id='activite'>");
                        // Récuperer le nombres des taches en retard et celle en échéance
                        echo ("
                            <p id='retard'>Nombre d'activités en retard : ". $ligne1['nombreActivite']. "</p>
                            <p id='echeance'>Nombre d'activité à échance : ". $ligne2['nombreActivite']. "</p>
                        </div>
                    </nav>
                    <a id='ajouter' href='accueil.php?ajouter=true'><button class='brk-btn'>Ajouter une liste</button></a>"); // lien qui permet d'ajouter une liste
                    if (isset($_REQUEST['ajouter'])) { // Si l'utilisateur souhaite ajouter une liste
                    echo ("<style>#ajouter {display: none}</style>"); // On enlève le lien qui permet d'ajouter une liste
                    // On ajoute un petit formulaire pour ajouter la liste à la base de donnée
                    echo ("
                    <form method='get' action='ajoutListe.php'>
                        <p>Nom liste : <input type='text' name='nomList'><input class='brk-btn' type='submit' value='Ajouter liste'></p><a href='accueil.php'><button class='brk-btn'>Annuler</button></a>       
                    </form>
                    ");
                    }
                    // Affichage des listes dont l'utilisateur possède un droit dessus
                    echo ("
                    <div id='liste'>");

                    foreach () {
                        echo "<p><a href='liste.php?idList=". $ligne["Id_list"] . "'>". $ligne["Nom_list"] ."</a> Droit = " . $ligne['Droit_list']."</p>";
                        // Si l'utilisateur a le droit de donner les droits
                        if($ligne['Droit_list'] == "admin") {
                            echo ("<a href='gestionDroit.php?idList=". $ligne['Id_list']."'>Modifier droit liste </a>");
                        }
                    }
                echo("
                    </div>
                </main>
                <footer><p>Ce site a été créé par : Chambrin Nathan, Bancel Gilles, Guideau Lucas et Fourier Quentin</p></footer>
            </body>
        </html>");
    }
?>