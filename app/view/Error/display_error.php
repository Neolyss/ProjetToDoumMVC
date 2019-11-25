<?php
    echo("
        <!DOCTYPE html>
        <html lang='fr'>
            <meta charset='utf-8'>
            <head>
               <title>New Task</title>
               <link rel='stylesheet' type='text/css' href='../app/view/Error/style_display_error.css'>
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
                <div>
                    <h1 id='textErreur'> Erreur ". $this->data . " ! </h1>");
                    if($this->data == '404') {
                        echo ("Cette page n'existe pas");
                    } else {
                        echo ("Vous n'avez pas accès à cette page...");
                    }
                    echo ("
                    <button class='brk-btn'><a href='index.php'>Retour à l'index</a>
                </div>
            </main>
            <footer><p>Ce site a été créé par : Chambrin Nathan, Bancel Gilles, Guideau Lucas et Fourier Quentin</p></footer>
            </body>
        </html>
     ");