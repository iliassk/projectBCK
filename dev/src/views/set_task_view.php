
<title>ScrumIT - Tâches </title>

<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>


<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header"> Tâche </small></h1>
        </div>
    </div><!-- /.row -->


    <div style="width:800px; margin:0 auto;" class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-hover">

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

                        echo '<tr><td>'.form_label("Tâche de Test :", 'USL').'</td><td>';
                        if ($taskInfo['is_test'] == 1)
                            echo form_checkbox('is_test', 'accept', TRUE);
                        else
                            echo form_checkbox('is_test', 'accept', FALSE);
                        echo '</td></tr>';
                ?>

            </table>

            <br>

            <?php
                echo form_submit('setB', "Valider", 'class = "btn btn-primary"');
                echo ' <a href='. base_url().'tasks/index/'.$idPro.'/'.$idSprint.' class="btn btn-danger" > Annuler</a>';
            ?>

        </div>
    </div>

    <?php $this->load->view("template/footer_view");?>
