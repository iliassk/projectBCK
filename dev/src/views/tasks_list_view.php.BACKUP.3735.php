<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
=======

>>>>>>> 341c37b452b5aacd422ce94417c1dbae12928a94


<title>ScrumIT - Tâches</title>

<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>

<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
<<<<<<< HEAD
            <h1 class = "page-header">Tâches du sprint</small></h1>
=======
            <h1 class = "page-header">Tâches du Sprint <?php echo $idSprint; ?></small></h1>

>>>>>>> 341c37b452b5aacd422ce94417c1dbae12928a94
        </div><!-- /.row -->

        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover tablesorter">
                    <thead>
                    <tr>
<<<<<<< HEAD
                        <th class="header">Nom <i class="fa fa-sort"></i></th>
                        <th class="header">Description <i class="fa fa-sort"></i></th>
                        <th class="header">Dépendance <i class="fa fa-sort"></i></th>
                        <th class="header">coût <i class="fa fa-sort"></i></th>
                        <th class="header">us <i class="fa fa-sort"></i></th>
                        <th class="header">test <i class="fa fa-sort"></i></th>
=======
                    <th class="header">Nom <i class="fa fa-sort"></i></th>
                    <th class="header">Description <i class="fa fa-sort"></i></th>
                    <th class="header">Dépendance <i class="fa fa-sort"></i></th>
                    <th class="header">coût <i class="fa fa-sort"></i></th>
                    <th class="header">us <i class="fa fa-sort"></i></th>
                    <th class="header">test <i class="fa fa-sort"></i></th>
>>>>>>> 341c37b452b5aacd422ce94417c1dbae12928a94


                    </tr>
                    </thead>

<<<<<<< HEAD

    <body>
    <div class="container">
        <header>
        </header>
        <section>
            <div id="container_icons" >
                <div id="wrapper">
                    <div id="login" class="animate form">

                        <h1>Tâches</h1>

                        <p>
                            <?php

                                //$hidden1 = array('url' => 'backlog/updateUS', 'idPro' => $idPro, 'idUS' => null);
                               // echo "<table><th>nom</th><th>description</th><th>dépendance</th></th><th>coût</th><th>us</th><th>test</th><th></th>";
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
                                        '</td><td> <a href='. base_url().'tasks/deleteTask/' .$idPro. '/' .$idSprint. '/' .$row['idTask']. '> Supprimer</a>'.
                                        '<a href='. base_url().'tasks/setTask/' .$idPro. '/' .$idSprint. '/' . '/' .$row['idTask']. '> Modifier</a>'.
                                        '</td></tr>';
                                }
                                echo '</table>';
                            ?>
</p>
<br>
<p>
    <?php

    echo form_open('tasks/setTask/' .$idPro. '/' .$idSprint. '/0');
    echo form_submit('addB', "Ajouter une Tache");

    ?>
</p>


</div>
</div>
</div>
</section>
</div>
</body>

<?php $this->load->view("template/footer_view");?>
=======
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
                        '</td><td> <a href='. base_url().'tasks/setTask/' .$idPro. '/' .$idSprint. '/' . '/' .$row['idTask']. ' class="btn btn-primary btn-xs"> Modifier</a> '.
                        '<a href='. base_url().'tasks/deleteTask/' .$idPro. '/' .$idSprint. '/' .$row['idTask']. ' class="btn btn-danger btn-xs"> Supprimer</a>'.
                        '</td></tr>';
                }
                ?>

                </tbody>
            </table>

            </div>
            <?php

            echo form_open('tasks/setTask/' .$idPro. '/' .$idSprint. '/0');
            echo form_submit('addB', "Ajouter une Tache", 'class="btn btn-primary btn-xs');

            ?>

            </div>
        </div>

<?php $this->load->view("template/footer_view");?>

>>>>>>> 341c37b452b5aacd422ce94417c1dbae12928a94
