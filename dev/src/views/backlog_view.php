<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title> Backlog </title>
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

                        <h1>Backlog</h1>

                        <p>
                            <?php
                                echo "<table border=1 width=400><th>nom</th><th>coût</th><th>sprint</th>";
                                foreach ($results as $row) {
                                    echo '<tr><td>'. $row->nameUS .'</td><td>'.
                                        $row->costUS.'</td><td></td>'.
                                        $row->idSprint.'</td></tr>';
                                }
                                echo '</table>';
                            ?>
                        </p>
                        <br>
                        <p>
                            <?php
                                echo form_label("Ajouter une US", 'addL');

                                echo '<table><tr><td>*'.form_label("nom de l'US :", 'nameL').
                                    '</td><td>'.form_input('nameUS', '').
                                    '</td></tr>';
                                echo '<tr><td>*'.form_label("Coût de l'US :", 'costL').
                                    '</td><td>'.form_input('costUS', '').
                                    '</td></tr>';
                                echo '<tr><td>'.form_label("Sprint associé :", 'sprintL').
                                    '</td><td>'.form_input('idSprint', '').
                                    '</td></tr></table>';

                                echo form_submit("addB", "Ajouter");
                            ?>
                        </p>

                    </div>
                </div>
            </div>
        </section>
    </div>
    </body>

</html>