<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title> Backlog </title>
        <link href = "<?php echo base_url(); ?>styles/style1_logsign.css" type="text/css" rel="stylesheet"/>
        <link href = "<?php echo base_url(); ?>styles/style2_logsign.css" type="text/css" rel="stylesheet"/>
        <style>
            table {border-collapse: collapse; width: 100%;}
            table,th, td {border: 1px solid lightgrey;}
            th, td {text-align: center; }
            th {background-color: darkgrey;}
        </style>
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

                                $hidden1 = array('url' => 'backlog/updateUS', 'idPro' => $idPro, 'idUS' => null);
                                echo "<table><th>nom</th><th>coût</th><th>sprint</th><th></th>";
                                foreach ($data as $row) {
                                    echo '<tr><td>'.$row->nameUS .
                                        '</td><td>'.$row->costUS.
                                        '</td><td>'.$row->idSprint.
                                        '</td><td> <a href='. base_url().'backlog/deleteUS/'.$idPro.'/'.$row->idUS.' > Supprimer</a>'.
                                        '<a href='. base_url().'backlog/setUS/'.$idPro.'/'.$row->idUS.' > Modifier</a>'.
                                        '</td></tr>';
                                }
                                echo '</table>';
                            ?>
                        </p>
                        <br>
                        <p>
                            <?php

                            echo form_open('backlog/setUS/'.$idPro.'/0');
                            echo form_submit('addB', "Ajouter une US");

                            ?>
                        </p>


                    </div>
                </div>
            </div>
        </section>
    </div>
    </body>

</html>