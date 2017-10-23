<?php
require '../layouts/navbar.php';
require '../layouts/card.php';
require '../layouts/alert.php';
require '../../controllers/contact_controller.php';

$data = handleIndexRequest();

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../../vendor/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" href="../../assets/stylesheets/index.css">
        <script src="index.js"></script>
        <title>Home</title>
    </head>
    <body>
        <?php echo navbar('home'); ?>
        <?php echo alert(); ?>

        <section id="header">
            <div class="jumbotron bg-dark text-white">
                <h1 class="display-4">Contacts</h1>
                <hr>
            </div>
        </section>
        <section id="show-contacts">
            <div class="container">
                <?php if(count($data) == 0) echo nothingToShow() ?>
                <div class="card-columns" style="display: inline-block;">
                    <?php
                        foreach($data as $row) {
                            if(isset($row['id']) && isset($row['title']) && isset($row['first_name']) && isset($row['last_name'])) {
                                echo card($row['id'], $row['title'], $row['first_name'], $row['last_name']);
                            }
                        }
                    ?>
                </div>
            </div>
        </section>
        <footer>
            <div id="footer" class="bg-dark"></div>
        </footer>
    </body>
</html>