
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

                        <h1>Tâches</h1>

                        <p>
                            <?php

                                //$hidden1 = array('url' => 'backlog/updateUS', 'idPro' => $idPro, 'idUS' => null);
                                echo "<table><th>nom</th><th>description</th><th>dépendance</th></th><th>coût</th><th>us</th><th></th>";
                                foreach ($tasks as $row) {
                                    echo '<tr><td>'.$row['nameTask'] .
                                        '</td><td>' . $row['descriptionTask'] .
                                        '</td><td>' . $taskDependIdName[$row['taskDepend']] .
                                        '</td><td>' . $row['costTask'] .
                                        '</td><td>' . $row['idUS'] .
                                        '</td><td> <a href='. base_url().'tasks/deleteTask/' .$idPro. '/' .$idSprint. '/' .$row['idTask']. '> Supprimer</a>'.
                                        '<a href='. base_url().'tasks/setTask/' .$idPro. '/' .$idSprint. '/' .$row['idUS']. '/' .$row['idTask']. '> Modifier</a>'.
                                        '</td></tr>';
                                }
                                echo '</table>';
                            ?>
</p>
<br>
<p>
    <?php

    echo form_open('tasks/setTask/' .$idPro. '/' .$idSprint. '/0/0');
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