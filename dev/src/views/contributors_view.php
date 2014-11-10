<!DOCTYPE html>
<html lang="en">
<head>
    <title> Liste des contributeurs </title>
</head>

<body>

<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>

<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header">Liste des contributeurs</small></h1>
            <div id="wrapper">

                <div class="table-responsive">
                    <table class="table table-hover tablesorter">
                        <thead>
                        <tr>
                            <th class="header">Nom <i class="fa fa-sort"></i></th>
                            <th class="header">Admin </th>
                            <th class="header">Scrum master </th>
                            <th class="header">Product owner</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php

                        foreach ($data as $row) {
                            echo '<tr><td>'.$row->nameDev .
                                '</td><td>'.$row->admin.
                                '</td><td>'.$row->scrumMaster.
                                '</td><td>'.$row->PO.
                                '</td><td>';
                            if ($admin == true) {
                                echo '<a href='. base_url().'contributors/setContributor/'.$idPro.'/'.$row->idDev.' class="btn btn-primary btn-xs" > Modifier</a> '.
                                    '<a href='. base_url().'contributors/deleteDev/'.$idPro.'/'.$row->idDev.' class="btn btn-danger btn-xs" > Supprimer</a>';
                            }
                            echo '</td></tr>';
                        }
                        ?>

                        </tbody>
                    </table>
                </div>

                <br>

                        <?php
                        if ($admin == true) {
                            echo form_open('contributors/setcontributor/' . $idPro . '/0');
                            echo form_submit('addB', "Ajouter un contributeur", 'class="btn btn-primary "');
                        }
                        ?>

            </div>
        </div>
    </div>
</div>

<?php $this->load->view("template/footer_view");?>

</body>

</html>