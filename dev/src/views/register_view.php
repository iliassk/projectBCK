<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Inscription</title>
        <link href = "<?php echo base_url(); ?>styles/style1_logsign.css" type="text/css" rel="stylesheet"/>
        <link href = "<?php echo base_url(); ?>styles/style2_logsign.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <div class="container">
            <header>
            </header>
            <section>
                <div id="container_icons" >
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <?php
                            echo form_open("register/validateRegistration");

                            /**
                             * Informations pour le champ pseudo
                             */
                            ?>
                            <h1>Inscrivez-vous</h1>
                            <p>
                                <?php
                                /**
                                 * Pour voir les erreurs de validation lors de l'inscription
                                 */
                                echo validation_errors();

                                /**
                                 * Informations pour le champ pseudo
                                 */
                                $attributes = array(
                                    "data-icon" => 'u'
                                );
                                echo form_label("Votre pseudo : ", "nameDev", $attributes);

                                $username = array(
                                    "name" => "nameDev",
                                    "class" => "nameDev",
                                    "data-icon" => "u",
                                    "placeholder" => "monpseudo685",
                                    "required" => "required"
                                );
                                echo form_input($username);
                                ?>
                            </p>
                            <p>
                                <?php
                                /**
                                 * Informations pour le champ email
                                 */
                                $attributes = array(
                                    "data-icon" => 'e'
                                );
                                echo form_label("Votre email : ", "email", $attributes);
                                $mail = array(
                                    "name" => "email",
                                    "class" => "email",
                                    'placeholder' => 'monemail@mail.com',
                                    "required" => "required"
                                );
                                echo form_input($mail);
                                ?>
                            </p>
                            <p>
                                <?php
                                /**
                                 * Informations pour le champ password
                                 */
                                $attributes = array(
                                    "data-icon" => 'p'
                                );
                                echo form_label("Votre mot de passe : ", "password", $attributes);
                                $pass = array(
                                    "name" => "password",
                                    "class" => "password",
                                    'placeholder' => 'ex. X8df!90EO',
                                    "required" => "required"
                                );
                                echo form_password($pass);
                                ?>
                            </p>
                            <p>
                                <?php
                                /**
                                 * Informations pour le champ confirmation de password
                                 */
                                $attributes = array(
                                    "data-icon" => 'p'
                                );
                                echo form_label("Confirmez votre mot de passe : ", "password_confirm", $attributes);
                                $pass2 = array(
                                    "name" => "password_confirm",
                                    "class" => "password_confirm",
                                    'placeholder' => 'ex. X8df!90EO',
                                    "required" => "required"
                                );
                                echo form_password($pass2);
                                ?>
                            </p>
                            <p class="signin button">
                                <input type="submit" value="S'inscrire"/>
                            </p>
                            <p class="change_link">
                                Déjà membre ?
                                <a href="<?php echo base_url()."login" ;?>" class="to_login"> Connexion </a>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>