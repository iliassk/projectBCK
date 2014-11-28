
<title>ScrumIT - Tâches</title>

<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>

<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header">Tâches du Sprint <?php echo $idSprint; ?></small></h1>
        </div>


    </div><!-- /.row -->

        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover tablesorter">
                    <thead>
                    <tr>
                        <th class="header">Nom <i class="fa fa-sort"></i></th>
                        <th class="header">Description <i class="fa fa-sort"></i></th>
                        <th class="header">Dépendance <i class="fa fa-sort"></i></th>
                        <th class="header">coût <i class="fa fa-sort"></i></th>
                        <th class="header">us <i class="fa fa-sort"></i></th>
                        <th class="header">test <i class="fa fa-sort"></i></th>

                    </tr>
                    </thead>


                <tbody>
                <?php

                //$hidden1 = array('url' => 'backlog/updateUS', 'idPro' => $idPro, 'idUS' => null);
                foreach ($tasksInfo as $row) {

                    echo '<tr><td>'.$row['nameTask'] .
                        '</td><td>' . $row['descriptionTask'];


                    if($row['tasksDepend'] != null) {
                        echo '</td><td>';
                        foreach ($row['tasksDepend'] as $row2) {
                            echo  $row2['nameTaskDepend'] . ', ';
                        }
                    }
                    else
                        echo '</td><td>' . '-';
                    echo
                        '</td><td>' . $row['costTask'];

                    if($row['usDepend'] != null) {
                        echo '</td><td>';
                        foreach ($row['usDepend'] as $row2) {
                            echo $row2['nameUS'] . ', ';
                        }
                    }
                    else
                        echo '</td><td>' . '-';

                    echo '</td><td>'.$row['is_test'];

                    echo
                        '</td><td> <a href='. base_url().'tasks/setTask/' .$idPro. '/' .$idSprint. '/' .$row['idTask']. ' class="btn btn-primary btn-xs"> Modifier</a> '.
                        '<a href='. base_url().'tasks/deleteTask/' .$idPro. '/' .$idSprint. '/' .$row['idTask']. ' class="btn btn-danger btn-xs"> Supprimer</a>'.
                        '</td></tr>';
                }
                ?>

                </tbody>
            </table>

            </div>
            <?php

            echo form_open('tasks/setTask/' .$idPro. '/' .$idSprint. '/0');
            echo form_submit('addB', "Ajouter une Tache", 'class="btn btn-primary');

            ?>

            </div>
        </div>

<?php $this->load->view("template/footer_view");?>

