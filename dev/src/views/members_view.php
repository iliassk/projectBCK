<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login page</title>
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