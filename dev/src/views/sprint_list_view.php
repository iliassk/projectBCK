
    <title> ScumIT - Liste des Sprints </title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/square.css" />


<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>

<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header">Liste des sprints</small></h1>
        </div>
    </div>

        <div style="width:800px; margin:0 auto;" class="col-lg-24">

            <?php

            foreach($data as $row)
                echo '<a href='.base_url().'sprint/index/'.$idPro.'/'.$row->idSprint.'>'.
                    '<div class=square> <div class=content>
                    <div class=table_bis> <div class=table-cell>'.
                    'Sprint '. $row->idSprint.
                    '</div></div></div></div> </a>';
            ?>


        </div>
</div>

<?php $this->load->view("template/footer_view");?>

