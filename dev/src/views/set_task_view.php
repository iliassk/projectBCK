<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title> Modification </title>
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

                    <h1>Tasks</h1>

                    <p>
                        <?php
                        echo form_open($url);

                        echo '<table><tr><td>*'.form_label("Nom de la tâche :", 'nameL').
                            '</td><td>'.form_input('nameTask', $data['nameTask']).
                            '</td></tr>';
                        echo '<tr><td>*'.form_label("Description de la tâche :", 'descriptionL').
                            '</td><td>'.form_input('descriptionTask', $data['descriptionTask']).
                            '</td></tr>';
                        echo '<tr><td>'.form_label("Dépendance :", 'dependenceL').
                            '</td><td>'.form_input('taskDependName',  $taskDependName).
                            '</td></tr>';
                        echo '<tr><td>*'.form_label("Coût de la tâche :", 'costL').
                            '</td><td>'.form_input('costTask', $data['costTask']).
                            '</td></tr>';
                        echo '<tr><td>'.form_label("US associée :", 'USL').
                            '</td><td>'.form_input('idUS', $idUS).
                            '</td></tr>';
                        echo '<tr><td>'.form_label("Tâche de Test :", 'USL').
                            '<tr><td>'.form_checkbox('is_test', 'accept', FALSE).
                            '</td></tr></table>';
                        ?>
                    </p>

                    <p>
                        <?php echo form_submit('setB', "Valider"); ?>
                    </p>

                </div>
            </div>
        </div>
    </section>
</div>
</body>

</html>
