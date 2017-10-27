<?php
    require '../layouts/navbar.php';
    require '../layouts/alert.php';
    require '../../controllers/contact_controller.php';

    handleNewRequests();
//    echo var_dump($_FILES);
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
        <?php echo alert(true); ?>

        <section id="header">
            <div class="jumbotron bg-dark text-white">
                <h1 class="display-4">New Contact</h1>
                <hr>
            </div>
        </section>
        <section id="contact-form">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 mx-auto">
                        <form method="POST" onsubmit="return validateInput()">
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">Title*</label>
                                    <input id="title" name="title" type="text" class="form-control" placeholder="Title"/>
                                    <small id="title_error" class="form-text"></small>
                                </div>
                                <div class="col">
                                    <label for="first_name">First Name*</label>
                                    <input id="first_name" name="first_name" type="text" class="form-control" placeholder="First Name"/>
                                    <small id="first_name_error" class="form-text"></small>
                                </div>
                                <div class="col">
                                    <label for="last_name">Last Name*</label>
                                    <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Last Name"/>
                                    <small id="last_name_error" class="form-text"></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Email"/>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="home_number">Home Number</label>
                                    <input id="home_number" name="home_number" type="text" class="form-control" placeholder="Home Number"/>
                                </div>
                                <div class="col">
                                    <label for="office_number">Office Number</label>
                                    <input id="office_number" name="office_number" type="text" class="form-control" placeholder="Office Number"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="site">Website</label>
                                    <input id="site" name="site" type="text" class="form-control" placeholder="Website"/>
                                </div>
                                <div class="col">
                                    <label for="twitter_url">Twitter URL</label>
                                    <input id="twitter_url" name="twitter_url" type="text" class="form-control" placeholder="Twitter URL"/>
                                </div>
                                <div class="col">
                                    <label for="facebook_url">Facebook URL</label>
                                    <input id="facebook_url" name="facebook_url" type="text" class="form-control" placeholder="Facebook URL"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="picture">Picture</label>
                                <input id="picture" name="picture" type="file" class="form-control" placeholder="Picture"/>
                            </div>
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <input id="comment" name="comment" type="text" class="form-control" placeholder="Comment"/>
                            </div>

                            <input id="contact-form-submit" class="btn btn-dark" type="submit">
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <div id="footer" class="bg-dark"></div>
        </footer>
    </body>
</html>