<?php
echo("
    <!DOCTYPE html>
    <html lang='fr'>
    <meta charset='utf-8'>
        <head>
            <title>Liste</title>
            <link rel='stylesheet' type='text/css' href='../app/view/List/style_display_list.css'>
        </head>
            <body>
                <header>
                    <h1><a href='index.php?action=home'>TO DOUM</a></h1>
                    <div>
                        <p>Bonjour," . $_SESSION['user'] . "<p/>
                        <a id='ajouter' href='index.php?action=logout'><button class='brk-btn'>Se déconnecter</button></a>
                    </div>
                    </header>
                    <main>         
                        <nav>
                            <div id='profil'>
                                <p>Profil</p>
                                <p>Pseudo : " . $_SESSION['user'] . "</p>
                                <p>Email : " . $this->data['mail'] ." </p>
                            </div>
                            <div id='activite'>");
                                // Tâches
                                // Récuperer le nombres des taches en retard et celle en échéance
                            echo ("
                                <p id='retard'>Nombre d'activités en retard : " . $this->data['late'] . "</p>
                                <p id='echeance'>Nombre d'activité à échance : " . $this->data['today'] . "</p>
                            ");
                            echo("</div>
                        </nav>
                        <div id='liste'>                 
                            <div id=\"titreListe\" class='blockList'>
                                <p id='ajoutListeTitre'> Liste : " .$this->data['listName']. "</p>
                            </div>
                            <div id='ajoutListe' class='blockList'>");
                                if($this->data['listRight'] == "admin" || $this->data['listRight'] == "lectureEcriture") { // Si on a les droits de modifier la liste
                                    echo("
                                    <p>Menu de creation de taches :</p>
                                    <a href='index.php?action=newTask&idList=" . $_REQUEST['idList'] . "' id='ajoutListetexte'><p>Ajout d'une nouvelle fiche</p></a>
                                    <a href='index.php?action=listArchived&idList=" . $_REQUEST['idList'] . "' id='ajoutListetexte'><p>Désarchiver une ou plusieurs tâches</p></a>
                                    ");
                                }
                                echo (
                                    "<a href='index.php?action=home'><p>Revenir à la l'index des listes</p></a>
                            </div>
                                    ");
                                // Récuperer les tâches
                                foreach ($this->data['taskList'] as $ligne) { // Affichage des tâches
                                    echo "<div class='blockList'>
                                        <p>". $ligne['taskName']. "</p></br>
                                        <p>". $ligne['taskDate']."</p></br>";
                                        if($this->data['listRight'] == "admin" || $this->data['listRight'] == "lectureEcriture") { // Si on a le droit d'écriture ou admin
                                            echo ("<a href='index.php?action=archive&idTask=".$ligne["Id_task"]."&idList=". $_REQUEST['idList'] ."'><p>Archiver la tache</p></a>");
                                        }
                                    // Lien pour Voir / Modifier la tâche
                                    echo ("    
                                        <a href='index.php?action=showTask&idList=". $_REQUEST['idList'] ."&idTask=". $ligne["Id_task"] ."'><p>Voir / Modifier la tache</p></a>   
                                    </div>");
                                }
                        echo("
                        </div>
                    </main>");
                    if($_REQUEST['action'] == "showTask") {
                        $task = $this->data['task'][0];
                        echo ("
                            <form id='modif' method='post' action='index.php?action=updateTask&idList=". $_REQUEST['idList'] ."&idTask=". $task['Id_task'] ."'>
                                <p> Nom Tache : <input type='text' name='nomTache' value='". $task['taskName'] . "'/></p>
                                <p> Echeance : <input type='datetime-local' name='echeance' value='". $task['taskDate'] ."'/></p>
                                <p> Notes : <input type='text' name='notes' value='". $task['taskNote']."'/></p>
                                <p> Lien : <input type='text' name='lien' value='". $task['taskLink']."'/></p>");
                            if($this->data['listRight'] == "admin" || $this->data['listRight'] == "lectureEcriture") { // Si on a le droit de modifier la tâche
                                echo ("
                                <input type='submit' value='Modifier'/>
                                ");
                            }
                            echo("
                                <a href='index.php?action=showList&idList=". $_REQUEST['idList'] ."'><p>Retour</p></a>
                            </form>");
                            echo ("
                            <div id='background'></div><style>#modif {display: block; display: flex; flex-direction: column; align-items: center; z-index: 1;}</style>");
                    }
                    echo ("<footer><p>Ce site a été créé par : Chambrin Nathan, Bancel Gilles, Guideau Lucas et Fourier Quentin</p></footer>
                </body>
            </html>");