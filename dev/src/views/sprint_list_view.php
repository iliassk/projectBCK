<!DOCTYPE html>
<html lang="en">
<head>
    <title> ScumIT - Liste des Sprints </title>
    <style>
        .square {
            float:left;
            position: relative;
            width: 25%;
            padding-bottom : 25%; /* = width for a 1:1 aspect ratio */
            margin:2%;
            background-color: powderblue;
            overflow:hidden;
        }
        .content {
            position:absolute;
            height:90%; /* = 100% - 2*5% padding */
            width:90%; /* = 100% - 2*5% padding */
            padding: 5%;
        }
        .table{
            display:table;
            width:100%;
            height:100%;
        }
        .table-cell{
            display:table-cell;
            vertical-align:middle;
            text-align: center;
        }
    </style>
</head>

<body>

<?php
$this->load->view("template/header_list_view");
$this->load->view("template/nav_list_view");
?>

<div id="page-wrapper">
    <div class="row">
        <div style="width:800px; margin:0 auto;" class="col-lg-12">
            <h1 class = "page-header">Liste des sprints</small></h1>
            <div id="wrapper">

                        <?php
                        foreach($data as $row)
                            echo '<div class=square>
                                <div class=content>
                                <div class=table>
                                <div class=table-cell>'.
                                '<a>Sprint '. $row->idSprint.'</a>'.
                                '</div></div></div></div>'
                        ?>

            </div>
        </div>
    </div>
</div>

<?php $this->load->view("template/footer_list_view");?>

</body>

</html>