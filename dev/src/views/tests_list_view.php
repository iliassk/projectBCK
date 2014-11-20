<!-- [Vtest] -->

<!DOCTYPE html>
<html lang="en">


<title>ScrumIT - Tests</title>

<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>

<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header">Tests du sprint</small></h1>
        </div><!-- /.row -->

        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover tablesorter">
                    <thead>
                    <tr>
                        <th class="header">Nom <i class="fa fa-sort"></i></th>
                        <th class="header">Description <i class="fa fa-sort"></i></th>
                        <th class="header">Développeur responsable <i class="fa fa-sort"></i></th>
                        <th class="header">Date d'éxécution <i class="fa fa-sort"></i></th>
                        <th class="header">Résultat<i class="fa fa-sort"></i></th>


                    </tr>
                    </thead>


                    <body>
                    <div class="container">
                        <header>
                        </header>
                        <section>
                            <div id="container_icons" >
                                <div id="wrapper">
                                    <div id="login" class="animate form">

                                        <h1>Tests</h1>

                                        <p>
                            <?php
                            print_r('view');
                            foreach ($testsInfos as $row) {

                                echo '<tr><td>' . $row['taskIdName']['nameTask'] .
                                    '</td><td>' . $row['descriptionTask'];
                                '</td><td>' . $row['respDevIdName']['nameDev'];
                                '</td><td>' . $row['exec_date'];
                                '</td><td>' . $row['result'];

                                echo '</td><td>' . '<a href=' . base_url() . 'tests/setTest/' . $idPro . '/' . $idSprint . '/' . '/' . $row['taskIdName']['idTask'] . '> Modifier</a>';
                            }


?>


<!-- [end Vtest] -->
