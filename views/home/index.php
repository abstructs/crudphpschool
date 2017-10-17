<?php
require '../layouts/navbar.php';
require '../layouts/card.php';
require '../../controllers/helpers.php';

$data = getData();

switch($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $id_to_delete = @$_POST['id_to_delete'];
        if(isset($id_to_delete)) {
            deleteContact($id_to_delete);
            header("Refresh:0");
        }

        break;
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../../vendor/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" href="../../assets/stylesheets/index.css">
        <script src="home.js"></script>
        <title>Home</title>
    </head>
    <body>
    <?php echo navbar('home'); ?>

    <section id="header">
        <div class="jumbotron">
            <h1 class="display-3">Welcome</h1>
            <hr>
            <p>Enter information and stuffs.</p>
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
    </body>
</html>