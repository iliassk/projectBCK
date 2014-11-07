<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Connexion</title>
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
                                echo form_open("login/validateLogin");

                                /**
                                 * Informations pour le champ pseudo
                                 */
                                ?>
                                <h1>Connectez-vous</h1>
                                <p>
                                    <?php
                                    /**
                                     * Pour voir les erreurs de validation des identifiants
                                     */
                                    echo validation_errors();

                                    /**
                                     * Informations pour le champ pseudo
                                     */
                                    $attributes = array(
                                        "data-icon" => 'u'
                                    );
                                    echo form_label("Pseudo : ", "nameDev", $attributes);

                                    $username = array(
                                        "name" => "nameDev",
                                        "class" => "nameDev",
                                        "data-icon" => "u",
                                        "placeholder" => "monpseudo584",
                                        "required" => "required"
                                    );
                                    echo form_input($username);
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
                                    echo form_label("Mot de passe : ", "password", $attributes);
                                    $pass = array(
                                        "name" => "password",
                                        "class" => "password",
                                        'placeholder' => 'ex. X8df!90EO',
                                        "required" => "required"
                                    );
                                    echo form_password($pass);
                                    ?>
                                </p>
                                <p class="login button">
                                    <input type="submit" value="Se connecter" />
                                </p>

                                <p class="change_link">
                                    Pas encore inscrit ?
                                    <a href="<?php echo base_url()."register"; ?>" class="to_register">Inscription</a>
                                </p>

                            </div>
                        </div>
                    </div>
                </section>
        </div>
    </body>
</html>