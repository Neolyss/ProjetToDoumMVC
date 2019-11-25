<?php
    echo("
        <!DOCTYPE html>
        <html lang='fr'>
            <meta charset='utf-8'>
            <head>
                <title>Right</title>
                <link rel='stylesheet' type='text/css' href='../app/view/Right/style_right.css'>
            </head>
            <body>
                <header>
                    <h1><a href='index.php'>TO DOUM</a></h1>
                        <div>
                            <p>Bonjour, ". $_SESSION['user'] ."</p>
                            <form method=post action='index.php?action=logout'><input type='submit' class='brk-btn' value='Se déconnecter'></form>
                        </div>
                    </header>
                    <main>
                        <nav>
                            <div id='profil'>
                                <p>Profil</p>
                                <p>Pseudo : " . $_SESSION['user'] . "</p>
                                <p>Email : " . $this->data['mail'] ."</p>
                            </div>
                            <div id='activite'>
                                <p id='retard'>Nombre d'activités en retard : " . $this->data['late'] . "</p>
                                <p id='echeance'>Nombre d'activité à échance : " . $this->data['today'] . "</p>
                            </div>
                        </nav>
                        <div id='right_container'>
                            <p>" . $this->data['listName'] . "</p>
                            <a href='index.php'><p>Retour</p></a> 
                            <form method='post' id='formAdd' action='index.php?action=addRight&idList=" . $_REQUEST['idList'] . "'>
                               <p>Utilisateur à ajouter</p>
                               <select name='idUser'>
                               ");
                            foreach ($this->data['users'] as $user) {
                                echo("<option value='" . $user['Id_user'] . "'>" . $user['Username'] . "</option>");
                            }
                            echo("
                               </select>
                               <p>Droits</p>
                               <p><input type='radio' name='droit' value='lecture'>Lecture</p>
                               <p><input type='radio' name='droit' value='lectureEcriture'>Lecture / Ecriture</p>
                               <p><input type='radio' name='droit' value='admin' checked>Admin</p>
                               <input type='submit' class='brk-btn' value='OK'>
                            </form>		       
                        </div>
                    </main>
                    <footer><p>Ce site a été créé par : Chambrin Nathan, Bancel Gilles, Guideau Lucas et Fourier Quentin</p></footer>
                </body>
            </html>");


