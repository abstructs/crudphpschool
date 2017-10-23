<?php
require '../layouts/navbar.php';
require '../layouts/alert.php';
require '../../controllers/contact_controller.php';

$user_data = handleShowRequest();

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../../vendor/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" href="../../assets/stylesheets/index.css">
        <script src="new.js"></script>
        <title>Contact</title>
    </head>
    <body>
        <?php echo navbar('contact'); ?>
        <?php echo alert(); ?>

        <section id="header">
            <div class="jumbotron bg-dark text-white">
                <h1 class="display-4">Show Contact</h1>
                <hr>
            </div>
        </section>
        <section id="user">
            <ul class="list-group mr-5 ml-5">
                <?php
                foreach($user_data as $key => $value) {
                    echo '<li class="list-group-item">' . $key . ': ' . $value . '</li>';
                }
                ?>
            </ul>
        </section>
        <footer>
            <div id="footer" class="bg-dark"></div>
        </footer>
    </body>
</html>