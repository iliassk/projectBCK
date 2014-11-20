<!DOCTYPE html>
<html lang="en">

<title>ScrumIT - UserStory </title>
<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>

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

                        echo '<tr><td>'.form_label("Tâche de Test :", 'USL');
                        if ($taskInfo['is_test'] == 1)
                            echo '<tr><td>'.form_checkbox('is_test', 'accept', TRUE);
                        else
                            echo '<tr><td>'.form_checkbox('is_test', 'accept', FALSE);
                        echo '</td></tr></table>';
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
