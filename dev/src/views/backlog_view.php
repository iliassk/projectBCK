<!DOCTYPE html>
<html lang="en">

    <head>
        <title> ScrumIT - Backlog </title>
    </head>

    <body>

    <?php
    $this->load->view("template/header_list_view");
    $this->load->view("template/nav_list_view");
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div style="width:800px; margin:0 auto;" class="col-lg-12">
                <h1 class = "page-header">Backlog du projet</small></h1>
                <div id="wrapper">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="header">Nom </th>
                                    <th class="header">Coût </th>
                                    <th class="header">Sprint </th>
                                </tr>
                                </thead>

                            <tbody>

                            <?php

                                foreach ($data as $row) {
                                    echo '<tr><td>'.$row->nameUS .
                                        '</td><td>'.$row->costUS.
                                        '</td><td>'.$row->idSprint.
                                        '</td><td> <a href='. base_url().'backlog/setUS/'.$idPro.'/'.$row->idUS.' class="btn btn-primary btn-xs"> Modifier</a> '.
                                        '<a href='. base_url().'backlog/deleteUS/'.$idPro.'/'.$row->idUS.' class="btn btn-danger btn-xs" > Supprimer</a>'.
                                        '</td></tr>';
                                }
                            ?>
                                </tbody>
                                </table>
                        </div>

                        <br>

                            <?php

                            echo form_open('backlog/setUS/'.$idPro.'/0');
                            echo form_submit('addB', "Ajouter une US", 'class = "btn btn-primary"');

                            ?>

                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view("template/footer_list_view");?>

    </body>
</html>