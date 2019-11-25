<?php
    echo("
        <!DOCTYPE html>
        <html lang='en'>
            <meta charset='utf - 8'>
            <head>
                <title>Archive</title>
                <link rel='stylesheet' type='text/css' href='../app/view/List/style_list_archived.css'>
            </head>
            <body>
                <header>
                    <h1><a href='index.php'>TO DOUM</a></h1>
                    <div>
                        <p>Bonjour,");
                        echo($_SESSION['user']);
                        echo("
                        </p>
                        <a id='ajouter' href='index.php?action=logout'><button class='brk-btn'>Se déconnecter</button></a>
                    </div>
                </header>
                <main>
                    <nav>
                        <div id='profil'>
                        <p>Profil</p>
                        <p>Pseudo : " . $_SESSION['user'] . "</p>
                        <p>Email :
                         ");
                    echo($this->data['mail']);
                    echo("
                        </p>
                        </div>
                    </nav>
                    <div id='liste'>                 
                        <div id='titreListe' class='blockList'>
                            <p id='ajoutListetexte'>Désarchiver une tâche</p>
                        </div>
                        <div id='ajoutListe' class='blockList'>
                            <a href='index.php'><p>Revenir à l'index</p></a>
                            <a href='index.php?action=showList&idList=". $_REQUEST['idList'] ."'><p>Retour à la liste</p></a>
                        </div>
                    ");
                    foreach ($this->data['archivedList'] as $ligne) {
                        // Ajout des tâches archivées dans la div list
                        echo ("
                            <div class='blockList'>
                                <p>". $ligne["taskName"]. "</p></br>
                                <a href='index.php?action=unarchived&idList=". $_REQUEST['idList'] ."&idTask=". $ligne['Id_task'] ."'><p>Désarchiver la tache</p></a></br>
                            </div>
                        ");
                    }
                    echo("
                    </div>
                </main>
                <footer><p>Ce site a été créé par : Chambrin Nathan, Bancel Gilles, Guideau Lucas et Fourier Quentin</p></footer>
                </body>
            </html>");