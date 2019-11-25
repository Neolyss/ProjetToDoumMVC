<?php
    // Affichage du formulaire, le css est le même que celle de la page de connexion car affichage très proche
    echo("
            <!DOCTYPE html>
            <html lang='fr'>
            <meta charset='utf-8'>
            <head>
                <title>Register</title>
                <link rel='stylesheet' type='text/css' href='../app/view/User/style_display_login_register.css'>
            </head>
            <body>
                <header>
                    <h1>TO DOUM</h1>
                </header>
                <main>
                    <form method=post action='index.php?action=createUser'>
                        <h2>Création du compte</h2>
                        <p>Nom utilisateur :</p>
                        <input type='text' name='user'>
                        <p>Mot de passe :</p>
                        <input type='password' name='pwd'>
                        <p>Email :</p>
                        <input type='email' name='mail'>
                        <input type='submit' class='brk-btn' value='Se créer un compte'>
                        <a href='index.php'><p class='brk-btn'>Retour</p></a>
                        ");
                        if(isset($_SESSION['error'])) {
                            if ($_SESSION["error"] != "") {
                                echo("
                                    <p class='error'>" . $_SESSION["error"] . "<p>
                                ");
                            }
                        }
                    echo("
                    </form>
                </main>
                <footer><p>Ce site a été créé par : Chambrin Nathan, Bancel Gilles, Guideau Lucas et Fourier Quentin</p></footer>
            </body>
        </html>");
