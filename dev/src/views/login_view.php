<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login page</title>
        <link href = "<?php echo base_url(); ?>styles/style.css" type="text/css" rel="stylesheet"/>
    </head>

    <body>
        <div class="container">
            <div class="login">
                <h1>Connexion</h1>
                <?php
                echo form_open("login/validateLogin");

                /**
                 * Pour voir les erreurs de validation des identifiants
                 */
                echo validation_errors();

                /**
                 * Informations pour le champ pseudo
                 */
                echo "<p>";
                echo form_label("Pseudo : ", "nameDev");
                $username = array(
                    "name" => "nameDev",
                    "class" => "nameDev",
                    'placeholder' => 'Username or Email'
                );
                echo form_input($username);
                echo "</p>";

                /**
                 * Informations pour le champ password
                 */
                echo "<p>";
                echo form_label("Mot de passe : ", "password");
                $pass = array(
                    "name" => "password",
                    "class" => "password",
                    'placeholder' => 'Password'
                );
                echo form_password($pass);
                echo "</p>";

                /**
                 * Informations pour la session
                 */
                echo "<p>";
                echo form_label(form_checkbox("remember_me"), "remember_me");
                echo form_label("Se souvenir de moi");
                echo "</p>";

                /**
                 * Informations pour le bouton connexion
                 */
                echo "<p class=submitLogin>";
                echo form_submit("loginSubmit", "Connexion");
                echo "</p>";

                echo form_close();
                ?>
            </div>
            <div class="login-help">
                <p>Pas encore inscrit ? <a href="#">Inscription</a>.</p>
            </div>
        </div>
    </body>
</html>