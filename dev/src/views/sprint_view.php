
    <title> ScumIT - Sprint </title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/square.css" />


<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>

<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header">Sprint <?php echo $idSprint;?></small></h1>
        </div>
    </div>

    <div style="width:800px; margin:0 auto;" class="col-lg-24">

        <?php

            echo '<a href='.base_url().'tasks/index/'.$idPro.'/'.$idSprint.'>'.
                '<div class=square> <div class=content>
                 <div class=table> <div class=table-cell> Tâches '.
                '</div></div></div></div> </a>';

            echo '<a href='.base_url().'gantt/index/'.$idPro.'/'.$idSprint.'>'.
                '<div class=square> <div class=content>
                 <div class=table> <div class=table-cell> Gantt '.
                '</div></div></div></div> </a>';

            echo '<a href='.base_url().'kanban/index/'.$idPro.'/'.$idSprint.'>'.
                '<div class=square> <div class=content>
                 <div class=table> <div class=table-cell> Kanban '.
                '</div></div></div></div> </a>';

            echo '<a href='.base_url().'tests/index/'.$idPro.'/'.$idSprint.'>'.
                '<div class=square> <div class=content>
                 <div class=table> <div class=table-cell> Tests '.
                '</div></div></div></div> </a>';

            echo '<a href='.base_url().'burndownchart/index/'.$idPro.'/'.$idSprint.'>'.
                '<div class=square> <div class=content>
                 <div class=table> <div class=table-cell> Burn Down Chart '.
                '</div></div></div></div> </a>';

        ?>

    </div>
</div>

<?php $this->load->view("template/footer_view");?>

