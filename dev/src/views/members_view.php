<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login page</title>
        <style>
            body{
                font-family: Cambria, Palatino, "Palatino Linotype", "Palatino LT STD", Georgia, serif;
                background: #fff url(<?php echo base_url();?>styles/images/bg.jpg) repeat top left;
                font-weight: 400;
                font-size: 15px;
                color: #1d3c41;
                overflow-y: scroll;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Espace membres</h1>

            <?php
            echo "<pre>";
            print_r ($this->session->all_userdata());
            echo "</pre>";
            ?>

            <a href = "<?php base_url(); ?>logout ">Se déconnecter</a>

        </div>
    </body>
</html>