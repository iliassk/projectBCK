<!DOCTYPE html>
<html lang="en">
<head>
    <title> ScumIT - Sprint </title>
    <style>
        .square {
            float:left;
            position: relative;
            width: 25%;
            padding-bottom : 25%; /* = width for a 1:1 aspect ratio */
            margin:2%;
            background-color: powderblue;
            overflow:hidden;
        }
        .content {
            position:absolute;
            height:90%; /* = 100% - 2*5% padding */
            width:90%; /* = 100% - 2*5% padding */
            padding: 5%;
        }
        .table{
            display:table;
            width:100%;
            height:100%;
        }
        .table-cell{
            display:table-cell;
            vertical-align:middle;
            text-align: center;
        }
    </style>
</head>

<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title> Tâches </title>
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

                        <h1>Tâches</h1>

                        <p>
                            <?php

                                //$hidden1 = array('url' => 'backlog/updateUS', 'idPro' => $idPro, 'idUS' => null);
                                echo "<table><th>nom</th><th>description</th><th>dépendance</th></th><th>coût</th><th>us</th><th>test</th><th></th>";
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

</html>