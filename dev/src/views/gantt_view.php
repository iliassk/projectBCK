<title>ScrumIT - Gantt</title>

<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>

<script>
    function getDateColumn() {

    }
</script>


<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header">Gantt du sprint <?php echo $idSprint; ?> </small></h1>
        </div><!-- /.row -->

        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover tablesorter">
                    <thead>
                    <tr>
                        <th class="header">Tâche <i class="fa fa-sort"></i></th>
                        <th class="header">Développeur <i class="fa fa-sort"></i></th>
                        <th class="header">Jour <i class="fa fa-sort"></i></th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php

                    foreach ($data as $row) {
                        echo '<tr><td>'.$row->nameTask.
                            '</td><td>'.$row->nameDev.
                            '</td><td>'.$row->date.
                            '</td><td>';
                        if ($row->nameDev != null)
                            echo '<a href='.base_url().'gantt/deleteFromGantt/'.$idPro.'/'.$idSprint.'/'. $row->idDev.
                                '/'.$row->idTask.'/'.$row->date.' class="btn btn-danger btn-xs"> Supprimer</a>';
                         echo '</td></tr>';
                    }
                    ?>

                    </tbody>
                </table>
            </div>

            <br>

            <?php
            echo form_open('gantt/setGantt/'.$idPro.'/'.$idSprint);
            echo form_submit('addB', "Modifier le gantt", 'class = "btn btn-primary"');
            ?>

    </div>
</div>


<?php $this->load->view("template/footer_view");?>
