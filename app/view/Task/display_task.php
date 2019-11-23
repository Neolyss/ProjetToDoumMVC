<?php
    //if($droit['Droit_list'] == "admin" || $droit['Droit_list'] == "lectureEcriture") { // Si on est admin ou bien on a les droits d'écriture sur la liste
    echo("
        <!DOCTYPE html>
        <html lang='fr'>
            <meta charset='utf-8'>
            <head>
                <title>New Task</title>
                <link rel='stylesheet' type='text/css' href='../app/view/Task/style_display_task.css'>
            </head>
            <body>
            <header>
                <h1>TO DOUM</h1>
                <div>
                    <p>Bonjour, " . $_SESSION['user'] . "</p>
                    <form method=post action='unlogin.php'><input type='submit' class='brk-btn' value='Se déconnecter'></form>
                </div>
            </header>
            <main>
                <form method='post' action='index.php?action=addTask&idList=" . $_REQUEST['idList']. "'>
                    <p>Ajout de tache dans ". $this->data['listName'] ."</p>
                    <p> Nom Tache : <input type='text' name='nomTache'/></p>
                    <p> Echeance : <input type='datetime-local' name='echeance'/></p>
                    <p> Notes : <input type='text' name='notes'/></p>
                    <p> Lien : <input type='text' name='lien'/></p>
                    <input type='submit' class='brk-btn' value='Enregister'/><p>
                ");
                echo("
                </form>
            </main>
            <footer><p>Ce site a été créé par : Chambrin Nathan, Bancel Gilles, Guideau Lucas et Fourier Quentin</p></footer>
            </body>
        </html>");
//}
//else { // Il n'a pas les droits donc problème de sécurité
//    echo "<p style='color: red'>Vous n'avez pas accès à ça ! Il faut être administateur de la liste ou bien avoir le droit d'écriture pour faire ça !</p>
//              <a href='index.php'>Retour</a>";
//}



