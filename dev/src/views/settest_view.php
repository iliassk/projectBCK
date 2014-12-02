<title>ScrumIT - Modification du test</title>

<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>

<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header"> Modification du test </small></h1>
        </div>
    </div><!-- /.row -->

        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover">

                    <?php
                    echo form_open('tests/updateTest/'.$idPro.'/'.$idSprint.'/'.$idTask);

                    echo '<tr><td>'. form_label("Nom du Test :", 'testL').
                        '</td><td>'. form_input('test', $test->nameTask, 'readonly').
                        '</td></tr>'.
                        '<tr><td>'. form_label("Description du Test :", 'descL').
                        '</td><td>'. form_input('desc', $test->descriptionTask, 'readonly').
                        '</td></tr>'.
                        '<tr><td>'. form_label("Nom du developpeur :", 'devL').
                        "</td><td> <select name='dev'> <option selected value=''>  </option>";

                    foreach ($devs as $row)
                        echo '<option value=' . $row->idDev . '>' . $row->nameDev . '</option>';

                    echo '</select> </td></tr>'.
                        '<tr><td>'. form_label("Date :", 'dateL').
                        '</td><td>'. form_input('date', $test->exec_date).
                        '</td></tr>'.
                        '<tr><td>'. form_label("Résultat :", 'resL').
                        '</td><td>'. form_input('result', $test->result).
                        '</td></tr>';
                    ?>

                </table>
            </div>

            <br>

            <?php
            echo form_submit('addB', "Valider", 'class = "btn btn-primary"');
            echo ' <a href='. base_url().'tests/index/'.$idPro.'/'.$idSprint.' class="btn btn-danger" > Annuler</a>';
            ?>

        </div>
    </div>


    <?php $this->load->view("template/footer_view");?>
