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

                        <h1>User story</h1>

                        <p>
                            <?php
                            echo form_open($url.$idPro.'/'.$data['idUS']);

                            echo '<table><tr><td>*'.form_label("nom de l'US :", 'nameL').
                                '</td><td>'.form_input('nameUS', $data['nameUS']).
                                '</td></tr>';
                            echo '<tr><td>*'.form_label("Coût de l'US :", 'costL').
                                '</td><td>'.form_input('costUS', $data['costUS']).
                                '</td></tr>';
                            echo '<tr><td>'.form_label("Sprint associé :", 'sprintL').
                                '</td><td>'.form_input('idSprint', $data['idSprint']).
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
