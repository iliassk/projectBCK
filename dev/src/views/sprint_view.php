
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

    <div style="margin:0 auto;" class="col-lg-24">

        <div class="table-responsive">
            <table class="table table-hover">

                <?php
                if ($dates['date_debut'] == 'AAAA-MM-JJ')
                    $up = 0;
                else
                    $up = 1;
                echo form_open('sprint/updateDates/'.$idPro.'/'.$idSprint.'/'.$up);

                echo '<tr><td>'.form_label("Début du sprint :", 'date_dL').
                    '</td><td>'.form_input('date_d', $dates['date_debut']).
                    '</td><td>'.form_label("Fin du sprint :", 'date_fL').
                    '</td><td>'.form_input('date_f', $dates['date_fin']).
                    '</td><td>'.form_submit('addB', "Modifier les dates", 'class = "btn btn-primary"').
                    '</td></tr>';
                ?>

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

		        echo '<a href='.base_url().'test/index/'.$idPro.'/'.$idSprint.'>'.
		            '<div class=square> <div class=content>
		                 <div class=table> <div class=table-cell> Tests '.
		            '</div></div></div></div> </a>';

		        echo '<a href='.base_url().'burndownchart/index/'.$idPro.'/'.$idSprint.'>'.
		            '<div class=square> <div class=content>
		                 <div class=table> <div class=table-cell> Burn Down Chart '.
		            '</div></div></div></div> </a>';

        		?>

            </table>

        </div>

    </div>
</div>

<?php $this->load->view("template/footer_view");?>

