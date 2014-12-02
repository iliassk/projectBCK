<title>ScrumIT - Gantt</title>

<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>

<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header"> Modification du Gantt </small></h1>
        </div>
    </div><!-- /.row -->

        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover">

                    <?php
                    echo form_open('gantt/updateGantt/'.$idPro.'/'.$idSprint);

                    echo '<tr><td>'. form_label("Nom de la tâche :", 'tacheL').
                        "</td><td> <select name='tasks'> <option selected value= ''>  </option>";

                    foreach ($tasks as $row)
                        echo '<option value='.$row->idTask.'>'. $row->nameTask .'</option>';

                    echo '</select> </td></tr>'.
                        '<tr><td>'. form_label("Nom du développeur :", 'devL').
                        "</td><td> <select name='devs'> <option selected value= ''>  </option>";

                    foreach($devs as $row)
                        echo '<option value='.$row->idDev.'>'. $row->nameDev .'</option>';

                    echo '</select> </td></tr>'.
                        '</td></tr><tr><td>'. form_label("Date :", 'dateL').
                        '</td><td>'. form_input('date', 'AAAA-MM-JJ').
                        '</td></tr>';
                    ?>

                </table>
            </div>

            <br>

            <?php
                echo form_submit('addB', "Valider", 'class = "btn btn-primary"');
                echo ' <a href='. base_url().'gantt/index/'.$idPro.'/'.$idSprint.' class="btn btn-danger" > Annuler</a>';
            ?>

    </div>
</div>


<?php $this->load->view("template/footer_view");?>
