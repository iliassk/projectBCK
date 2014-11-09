<!DOCTYPE html>
<html lang="en">
<head>
    <title>ScrumIT - UserStory </title>
</head>

<body>

    <?php
    $this->load->view("template/header_list_view");
    $this->load->view("template/nav_list_view");
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div style="width:800px; margin:0 auto;" class="col-lg-12">
                <h1 class = "page-header">User story</small></h1>
                <div id="wrapper">

                    <?php echo form_open($url.$idPro.'/'.$data['idUS']); ?>

                    <div class="table-responsive">
                        <table class="table table-hover">

                            <?php
                            echo '<tr><td>* '.form_label("nom de l'US :", 'nameL').
                                '</td><td>'.form_input('nameUS', $data['nameUS']).
                                '</td></tr>'.
                                '<tr><td>* '.form_label("Coût de l'US :", 'costL').
                                '</td><td>'.form_input('costUS', $data['costUS']).
                                '</td></tr>'.
                                '<tr><td>'.form_label("Sprint associé :", 'sprintL').
                                '</td><td>'.form_input('idSprint', $data['idSprint']).
                                '</td></tr>';
                            ?>

                        </table>

                    <br>

                            <?php
                                echo form_submit('setB', "Valider", 'class = "btn btn-primary"');

                                echo ' <a href='. base_url().'backlog/init/'.$idPro.' class="btn btn-danger" > Annuler</a>';
                            ?>

                </div>
            </div>
        </div>
    </div>

        <?php $this->load->view("template/footer_list_view");?>
        
</body>

</html>
