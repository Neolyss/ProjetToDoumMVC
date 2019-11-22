<?php
    echo("
        <!DOCTYPE html>
        <html lang='fr'>
            <meta charset='utf-8'>
            <head>
                <title>Login</title>
                <link rel='stylesheet' type='text/css' href='../app/view/User/style_display_login_register.css'>
            </head>
            <body>
                <header>
                    <h1>TO DOUM</h1>
                </header>
                <main>
                    <form method=post action='index.php?action=login'>
                        <h2>Connexion</h2>
                        <p>Nom de compte :</p>
                        <input type='text' name='user'>
                        <p>Mot de passe :</p>
                        <input type='password' name='pwd'>
                        <input type='submit' class='brk-btn' value='Se connecter'>
                        <a href='index.php?action=register'><p class='brk-btn'>Se créer un compte</p></a>
                ");
                if(isset($_SESSION['error'])) {
                    if ($_SESSION['error'] != "") { // Si il y a une erreur, on l'affiche
                        echo("<p class='error'>" . $_SESSION['error'] . "<p>");
                    }
                }
            echo("
                    </form>
                </main>
                <footer><p>Ce site a été créé par : Chambrin Nathan, Bancel Gilles, Guideau Lucas et Fourier Quentin</p></footer>
            </body>
        </html>");