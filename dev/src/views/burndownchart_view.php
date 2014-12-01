
<title> ScumIT - Burn Down Chart </title>

<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>
<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header">Burn Down Chart du Sprint <?php echo $idSprint; ?></small></h1>
        </div><!-- /.row -->
    </div>
</div>

<tbody>


</tbody>


<script src="<?php echo base_url(); ?>assets/js/charts/Chart.js"></script>
<script src="<?php echo base_url(); ?>assets/js/charts/burndownchart.js"></script>


<?php if (!$sprintValid) { ?>

    <canvas id="myChart" width="0" height="0"></canvas>

<input type='hidden' id="nbEntries" value="<?php echo 0; ?>">
<input type='hidden' id="actualEntries" value="<?php echo 0; ?>">

    Pensez à préciser les dates de début et de fin du sprint.


<?php
    }else {
    ?>

    <canvas id="myChart" width="700" height="400"></canvas>

    <input type='hidden' id="nbEntries" value="<?php echo count($estimated_coordinates); ?>">
    <input type='hidden' id="actualEntries" value="<?php echo count($real_coordinates); ?>">

    <?php
    $index = 0;
    foreach ($estimated_coordinates as $coord) {

        ?>
        <input type="hidden" id="entry<?php echo $index; ?>" class="days" value="<?php echo $coord['date']; ?>">
        <?php
        $index++;
    }
    ?>


    <?php
    $index = 0;
    foreach ($estimated_coordinates as $coord) {

        ?>
        <input type="hidden" id="estim<?php echo $index; ?>" class="inputEstimated"
               value="<?php echo $coord['cost']; ?>">
        <?php
        $index++;
    }
    ?>


    <?php
    $index = 0;
    foreach ($real_coordinates as $coord) {

        ?>
        <input type="hidden" id="real<?php echo $index; ?>" class="inputReal" value="<?php echo $coord['cost']; ?>">
        <?php
        $index++;
    }

}?>




<?php $this->load->view("template/footer_view");?>

