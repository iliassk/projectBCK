<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title> Liste des Sprints </title>
    <link href = "<?php echo base_url(); ?>styles/style1_logsign.css" type="text/css" rel="stylesheet"/>
    <link href = "<?php echo base_url(); ?>styles/style2_logsign.css" type="text/css" rel="stylesheet"/>
    <style>
        .square {
            float:left;
            position: relative;
            width: 30%;
            padding-bottom : 30%; /* = width for a 1:1 aspect ratio */
            margin:2%;
            background-color:lightgrey;
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

<body>
<div class="container">
    <header>
    </header>
    <section>
        <div id="container_icons" >
            <div id="wrapper">
                <div id="login" class="animate form">

                    <h1>
                        Liste des sprints
                    </h1>

                        <?php
                        foreach($data as $row)
                            echo '<div class=square>
                                <div class=content>
                                <div class=table>
                                <div class=table-cell> Sprint '.
                                    $row->idSprint.
                                '</div></div></div></div>'
                        ?>

                </div>
            </div>
        </div>
    </section>
</div>
</body>

</html>