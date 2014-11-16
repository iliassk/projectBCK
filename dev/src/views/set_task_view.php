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
                            '</td><td>'.form_input('nameTask', $taskInfo['nameTask']).
                            '</td></tr>';
                        echo '<tr><td>*'.form_label("Description de la tâche :", 'descriptionL').
                            '</td><td>'.form_input('descriptionTask', $taskInfo['descriptionTask']).
                            '</td></tr>';

                        if($taskInfo['taskDepend'] != null) {
                            echo '</td><td>';
                            foreach ($taskInfo['taskDepend'] as $row) {
                                echo '<tr><td>'.form_label("Tâche associée :", 'dependenceL').
                                    '</td><td>'.form_input('taskDepend', $row['nameTaskDepend']).
                                    '</td></tr>';
                            }
                        }
                        else
                            echo '<tr><td>'.form_label("Tâche associée :", 'dependenceL').
                                '</td><td>'.form_input('taskDepend', '').
                                '</td></tr>';

                        echo '<tr><td>*'.form_label("Coût de la tâche :", 'costL').
                            '</td><td>'.form_input('costTask', $taskInfo['costTask']).
                            '</td></tr>';

                        if($taskInfo['usDepend'] != null) {
                            echo '</td><td>';
                            foreach ($taskInfo['usDepend'] as $row) {
                                echo '<tr><td>'.form_label("US associée :", 'USL').
                                    '</td><td>'.form_input('nameUS', $row['nameUS']).
                                    '</td></tr>';
                            }
                        }
                        else
                            echo '<tr><td>'.form_label("US associée :", 'USL').
                            '</td><td>'.form_input('nameUS', '').
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
