<!-- [Vpro] -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Liste des projets</title>
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
                <div id="projects_view" class="animate form">
    <h1>Vos Projets</h1>

    <br>
    <?php

    foreach($projects as $project)
    {

            echo
                '<td><a href='. base_url().'projects/project_page/'. $project['namePro'].' >' .$project['namePro']. '</a>'.
                '</td><td> <a href='. base_url().'projects/delete_project/'.$project['idPro'].' > Supprimer</a> '.'</td><br>';



    }





                            echo form_open("projects/create_project");


                            ?>
                            <h1>Créer un projet</h1>
                            <p>

                            <?php
                                echo form_label("nom du projet :", 'namePro'). form_input('namePro');
                                    ?>

                    <p>
                        <?php echo form_submit('addB', "Créer"); ?>
                    </p>

                        </div>
                    </div>
                </div>
            </section>
        </div>


    </div>

    </body>

    </html>

<!-- [end Vpro] -->