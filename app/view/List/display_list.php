<?php
// Sécurité à ajouter
//    if(!isset($_SESSION["user"])) {  // Si on n'est pas connecté
//        header("Location: login.php"); // On redirige vers la page Connexion
//        exit();
//    }
//    else {
        // Gestion de droit à ajouter
        //if ($droit) { // Si tu possèdes les droits -> Sécurité pour empêcher d'accéder à une liste via l'URL
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
                                <p>Email : 
                                ");
                                // Mail user
                                echo($this->data['mail']);
                                echo("
                                </p>
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
                                <p id='ajoutListeTitre'> Liste : ");
                                // Nom de la liste
                                echo ($this->data['listName']);
                                echo ("
                                </p>
                            </div>
                            <div id='ajoutListe' class='blockList'>");
                                if($this->data['listRight'] == "admin" || $this->data['listRight'] == "lectureEcriture") { // Si on a les droits de modifier la liste
                                    echo("<p>Menu de creation de taches :</p>
                                    <a href='ajoutTache.php?idList=" . $_REQUEST['idList'] . "' id='ajoutListetexte'><p>Ajout d'une nouvelle fiche</p></a>
                                          <a href='index.php?action=listArchived&idList=" . $_REQUEST['idList'] . "' id='ajoutListetexte'><p>Désarchiver une ou plusieurs tâches</p></a>");
                                }
                                echo ("<a href='index.php?action=home'><p>Revenir à la l'index des listes</p></a>
                            </div>");
                                // Récuperer les tâches
                                //var_dump($this->data['taskList']);
                                foreach ($this->data['taskList'] as $ligne) { // Affichage des tâches
                                    echo "<div class='blockList'>
                                        <p>". $ligne['taskName']. "</p></br>
                                        <p>". $ligne['taskDate']."</p></br>";
                                        if($this->data['listRight'] == "admin" || $this->data['listRight'] == "lectureEcriture") { // Si on a le droit d'écriture ou admin
                                            echo ("<a href='index.php?action=archive&idTask=".$ligne["Id_task"]."&idList=". $_REQUEST['idList'] ."'><p>Archiver la tache</p></a>");
                                        }
                                        // Modifier la tâche
                                    echo ("    
                                        <a href='display_list.php?idList=". $_REQUEST['idList'] ."&idTach=". $ligne["Id_task"] ."&modification=true'><p>Voir / Modifier la tache</p></a>   
                                    </div>");
                                }
                        echo("
                        </div>
                    </main>");
//                    if(isset($_REQUEST['modification'])) {
//                        if (isset($_REQUEST["idTach"])) {
//                            $sql = "SELECT * FROM tache WHERE id_tach ='" . $_REQUEST["idTach"] ."';";
//                            $ligne = $db->query($sql)->fetch();
//                            $date = date_create($ligne['DateLim_tach']);
//                            $date_formate = date_format($date,"Y-m-d\Th:i:s");
//                        }
//                        echo ("
//                            <form id='modif' method='post' action='updateTache.php?idList=". $_REQUEST['idList'] ."&idTach=". $ligne['Id_tach']."'>
//                                <p> Nom Tache : <input type='text' name='nomTache' value='". $ligne["Nom_tach"]. "'/></p>
//                                <p> Echeance : <input type='datetime-local' name='echeance' value='". $date_formate ."'/></p>
//                                <p> Notes : <input type='text' name='notes' value='". $ligne['Notes_tach']."'/></p>
//                                <p> Lien : <input type='text' name='lien' value='". $ligne['Lien_tach']."'/></p>");
//                            if($droit['Droit_list'] == "admin" || $droit['Droit_list'] == "lectureEcriture") { // Si on a le droit de modifier la tâche
//                                echo ("<input type='submit' value='Modifier'/>");
//                            }
//                            echo("
//                                <a href='display_list.php?idList=". $_REQUEST['idList'] ."'><p>Retour</p></a>
//                            </form>");
//                            echo ("
//                            <div id='background'></div><style>#modif {display: block; display: flex; flex-direction: column; align-items: center; z-index: 1;}</style>");
//                        }
                        echo ("<footer><p>Ce site a été créé par : Chambrin Nathan, Bancel Gilles, Guideau Lucas et Fourier Quentin</p></footer>
                </body>
            </html>");
        //Sécurité à rajouter
                    //}
        //else { // Sécurité
            //echo "<p style='color: red'>Vous n'avez pas accès à ça !</p>
                  //<a href='index.php'>Retour</a>";
        //}
//}