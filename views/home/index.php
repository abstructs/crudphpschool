<?php
require '../layouts/navbar.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../../vendor/stylesheets/bootstrap.min.css">
        <link rel="stylesheet" href="../../assets/stylesheets/index.css">
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
    </body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: abstruct
 * Date: 2017-10-15
 * Time: 4:19 PM
 */

$first_name = &$_GET['first_name'];
if(isset($first_name)) {
    echo $first_name;
}
?>