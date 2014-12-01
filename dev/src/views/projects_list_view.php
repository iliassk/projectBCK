<!-- [Vpro] -->

    <?php
    $this->load->view("template/header_list_view");
    $this->load->view("template/nav_list_view");
    ?>
    <div id="page-wrapper">

        <div class="row">
            <div style="width:800px; margin:0 auto;" class="col-lg-12">
                <h1 class = "page-header">Vos Projets</small></h1>
                <ol class="breadcrumb">
                    <?php
                    echo validation_errors();
                    echo form_open("projects/create_project");
                    ?>
                    <div class="col-lg-8">
                    <?php
                    $form_class = array(
                        "name" => "namePro",
                        "id" => "namePro",
                        "class" => "form-control"
                    );
                    echo form_input($form_class);
                    ?>
                    </div>
                    <?php
                    $button_class = array(
                        "name" => "addB",
                        "id" => "addB",
                        "class" => "btn btn-primary",
                        "type" => "submit"
                    );
                    echo form_button($button_class, "Ajouter un nouveau projet");
                    ?>
                </ol>
            </div>
        </div><!-- /.row -->

        <div style="width:800px; margin:0 auto;" class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-hover tablesorter">
                <thead>
                <tr>
                    <th class="header">Projets <i class="fa fa-sort"></i></th>
                    <th class="header">Opérations </th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach($projects as $project)
                {
                ?>
                    <tr>
                        <td><?php echo $project['namePro']?></td>
                        <td>
                            <a href="http://localhost/projectBCK/backlog/index/<?php echo $project['idPro'];?>" class="btn btn-primary btn-xs">Accéder au projet</a>
                            <?php
                                if ($project['admin'] == true)
                                    echo '<a href=http://localhost/projectBCK/projects/delete_project/'.$project['idPro'].' class="btn btn-danger btn-xs">Supprimer le projet</a>';
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>

                </tbody>
            </table>
        </div>
        </div>
    </div><!-- /#page-wrapper -->
    <?php $this->load->view("template/footer_list_view");?>

<!-- [end Vpro] -->