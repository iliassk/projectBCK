<!DOCTYPE html>
<html lang="en">
<head>
    <title>ScrumIT - Contributeur </title>
</head>

<body>

<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>

<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header">Contributeur</small></h1>
            <div id="wrapper">

                <?php echo form_open($url.$idPro.'/'.$idDev); ?>


                <div class="table-responsive">
                    <table class="table table-hover">

                        <?php

                        if (is_null($data['nameDev']))
                            $option = '';
                        else
                            $option = 'readonly';

                        echo '<tr><td>* '.form_label("Nom du contributeur :", 'nameL').
                            '</td><td>'.form_input('nameDev', $data['nameDev'], $option).
                            '</td></tr>'.
                            '<tr><td>'.form_label("Administrateur :", 'adminL').
                            '</td><td>'.form_checkbox('admin', '1', $data['admin']).
                            '</td></tr>'.
                            '<tr><td>'.form_label("Scrum Master :", 'scrumL').
                            '</td><td>'.form_checkbox('scrum', '1', $data['scrumMaster']).
                            '</td></tr>'.
                            '<tr><td>'.form_label("Product owner :", 'poL').
                            '</td><td>'.form_checkbox('po', '1', $data['PO']).
                            '</td></tr>';

                        ?>

                    </table>
                </div>

                    <br>

                        <?php
                            echo form_submit('setB', "Valider", 'class = "btn btn-primary"');

                            echo ' <a href='. base_url().'contributors/index/'.$idPro.' class="btn btn-danger" > Annuler</a>';
                        ?>

            </div>
        </div>
    </div>
</div>

<?php $this->load->view("template/footer_view");?>

</body>

</html>
