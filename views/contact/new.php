<?php
    require '../layouts/navbar.php';
    require '../../models/getID.php';
    require '../../controllers/contact_controller.php';
    require '../layouts/alert.php';

    handleNewRequests();

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
        <div class="jumbotron">
            <h1 class="display-3">Contact Form</h1>
            <hr>
            <p>Enter information and stuffs.</p>
        </div>
    </section>
    <section id="contact-form">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <form method="POST" onsubmit="return validateInput()">
                        <div class="form-group">
                            <label for="title">Title*</label>
                            <small id="title_error" class="form-text"></small>
                            <input id="title" name="title" type="text" class="form-control" placeholder="Title"/>
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name*</label>
                            <small id="first_name_error" class="form-text"></small>
                            <input id="first_name" name="first_name" type="text" class="form-control" placeholder="First Name"/>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name*</label>
                            <small id="last_name_error" class="form-text"></small>
                            <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Last Name"/>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="Email"/>
                        </div>
                        <div class="form-group">
                            <label for="site">Website</label>
                            <input id="site" name="site" type="text" class="form-control" placeholder="Website"/>
                        </div>
                        <div class="form-group">
                            <label for="home_number">Home Number</label>
                            <input id="home_number" name="home_number" type="text" class="form-control" placeholder="Home Number"/>
                        </div>
                        <div class="form-group">
                            <label for="office_number">Office Number</label>
                            <input id="office_number" name="office_number" type="text" class="form-control" placeholder="Office Number"/>
                        </div>
                        <div class="form-group">
                            <label for="twitter_url">Twitter URL</label>
                            <input id="twitter_url" name="twitter_url" type="text" class="form-control" placeholder="Twitter URL"/>
                        </div>
                        <div class="form-group">
                            <label for="facebook_url">Facebook URL</label>
                            <input id="facebook_url" name="facebook_url" type="text" class="form-control" placeholder="Facebook URL"/>
                        </div>
                        <div class="form-group">
                            <label for="picture">Picture</label>
                            <input id="picture" name="picture" type="file" class="form-control" placeholder="Picture"/>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <input id="comment" name="comment" type="text" class="form-control" placeholder="Comment"/>
                        </div>

                        <input id="contact-form-submit" class="btn btn-primary" type="submit">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer>
    </footer>
</body>
</html>