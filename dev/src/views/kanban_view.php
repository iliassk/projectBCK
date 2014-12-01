
<title> ScumIT - Kanban </title>

<?php
$this->load->view("template/header_view");
$this->load->view("template/nav_view");
?>

<style type="text/css">
    #wrapper{
        background-image: url("../../../assets/images/image1.png");
        padding-top: 5px;
    }
</style>


<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header">Kanban</small></h1>
        </div>
    </div><!-- /.row -->
</div>

<div id="card-container">
    <div id="inner-card-container">
        <?php
        echo $backlogHtml;
        echo $inProgressHtml;
        echo $doneHtml;
        ?>
    </div>
</div>


<!-- turn this into requireJs.. -->
<script src="<?php echo base_url(); ?>js/libraries/require.js"></script>
<script src="<?php echo base_url(); ?>assets/app.js"></script>
<script type="text/javascript">
    require([
        '<?php echo $requirejs; ?>'
     ]);
</script>
<?php $this->load->view("template/footer_view");?>
