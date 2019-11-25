<?php
    echo("
        <!DOCTYPE html>
        <html lang='fr'>
            <meta charset='utf-8'>
            <head>
                <title>Home</title>
                <link rel='stylesheet' type='text/css' href='../app/view/User/style_home.css'>
            </head>
            <body>
                <header>
                    <h1>TO DOUM</h1>
                    <div>
                        <p>Bonjour, ");
                        echo ($_SESSION['user']);
                        echo("
                        </p>
                        <form method=post action='index.php?action=logout'><input type='submit' class='brk-btn' value='Se déconnecter'></form>
                    </div>
                </header>
                <main>
                    <nav>
                        <div id='profil'>");
                        if($_REQUEST['action'] == "modify") { // si le bouton est appuyé
                            //var_dump($this->data);
                            echo ("
                            <p>Modification du Profil</p> 
                            <form method='post' action='index.php?action=update&idUser=". $this->data['idUser'] ."'>
                            <p> Pseudo : <input type='text' name='username' value='". $_SESSION['user']."'/></p>
                            <p> Mail : <input type='text' name='mail' value='". $this->data['mail'] ."'/></p>
                            <input class='brk-btn' type='submit' value='Modifier'>
                            </form>
                            ");
                        }
                        else {
                            echo("
                            <p>Profil</p>
                            <p>Pseudo : " . $_SESSION['user'] ."</p>
                            <p>Email : ");
                                echo($this->data['mail']);
                                echo("
                            </p>
                            <a href='index.php?action=modify'><button class='brk-btn'>Modifier le profil</button></a>
                            ");
                        }
                        echo ("
                        </div>
                        <div id='activite'>");
                        // Récuperer le nombres des taches en retard et celle en échéance
                        echo ("
                            <p id='retard'>Nombre d'activités en retard : ". $this->data['late'] . "</p>
                            <p id='echeance'>Nombre d'activité à échance : ". $this->data['today']. "</p>
                        </div>
                    </nav>
                    <a id='ajouter' href='index.php?action=newList'><button class='brk-btn'>Ajouter une liste</button></a>"); // lien qui permet d'ajouter une liste
                    if (isset($_REQUEST['action'])) {
                        if($_REQUEST['action'] == 'newList') { // Si l'utilisateur souhaite ajouter une liste
                            echo ("<style>#ajouter {display: none}</style>"); // On enlève le lien qui permet d'ajouter une liste
                            // On ajoute un petit formulaire pour ajouter la liste à la base de donnée
                            echo ("
                            <form method='post' action='index.php?action=addList&idUser=". $this->data['idUser'] ."'>
                                <p>Nom liste : 
                                    <input type='text' name='nomList'>
                                    <input class='brk-btn' type='submit' value='Ajouter liste'>
                                </p>
                            </form>
                            <a href='index.php?action=home'><button class='brk-btn'>Annuler</button></a> 
                            ");
                        }
                    }
                    // Affichage des listes dont l'utilisateur possède un droit dessus
                    echo ("
                    <div id='liste'>");
                    //var_dump($this->data['list']);
                    foreach ($this->data['list'] as $list) { // Affichage de toutes les listes disponibles
                        echo "<p><a href='index.php?action=showList&idList=". $list["Id_list"] . "'>". $list["Nom_list"] ."</a> Droit = " . $list['Droit_list']."</p>";
                        // Si l'utilisateur a le droit de donner les droits
                        if($list['Droit_list'] == "admin") {
                            echo ("<a href='index.php?action=right&idList=". $list['Id_list']."'>Modifier droit liste </a>");
                        }
                    }
                echo("
                    </div>
                </main>
                <footer><p>Ce site a été créé par : Chambrin Nathan, Bancel Gilles, Guideau Lucas et Fourier Quentin</p></footer>
            </body>
        </html>");
?>