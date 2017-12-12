<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo STYLESHEETS_PATH . "bootstrap.min.css"; ?>">
    <link rel="stylesheet" href="<?php echo STYLESHEETS_PATH . "index.css"; ?>">
    <script src="<?php echo JAVASCRIPTS_PATH . "new.js"; ?>"></script>
    <title>Contact</title>
</head>
<body>
<?php echo navbar(); ?>
<?php echo alert(true); ?>

<section id="header">
    <div class="jumbotron bg-dark text-white">
        <h1 class="display-4">Edit Contact</h1>
        <hr>
    </div>
</section>
<section id="contact-form">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <form method="POST" onsubmit="return validateInput();" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="update">
                    <div class="form-row">
                        <div class="col">
                            <label for="title">Title*</label>
                            <input value="<?php echo $user_data['title']; ?>" id="title" name="title" type="text" class="form-control" placeholder="Title"/>
                            <small id="title_error" class="form-text"></small>
                        </div>
                        <div class="col">
                            <label for="first_name">First Name*</label>
                            <input value="<?php echo $user_data['first_name']; ?>" id="first_name" name="first_name" type="text" class="form-control" placeholder="First Name"/>
                            <small id="first_name_error" class="form-text"></small>
                        </div>
                        <div class="col">
                            <label for="last_name">Last Name*</label>
                            <input value="<?php echo $user_data['last_name']; ?>" id="last_name" name="last_name" type="text" class="form-control" placeholder="Last Name"/>
                            <small id="last_name_error" class="form-text"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="<?php echo $user_data['email']; ?>" id="email" name="email" type="email" class="form-control" placeholder="Email"/>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="home_number">Home Number</label>
                            <input value="<?php echo $user_data['home_number']; ?>" id="home_number" name="home_number" type="text" class="form-control" placeholder="Home Number"/>
                        </div>
                        <div class="col">
                            <label for="office_number">Office Number</label>
                            <input value="<?php echo $user_data['office_number']; ?>" id="office_number" name="office_number" type="text" class="form-control" placeholder="Office Number"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="site">Website</label>
                            <input value="<?php echo $user_data['site']; ?>" id="site" name="site" type="text" class="form-control" placeholder="Website"/>
                        </div>
                        <div class="col">
                            <label for="twitter_url">Twitter URL</label>
                            <input value="<?php echo $user_data['twitter_url']; ?>" id="twitter_url" name="twitter_url" type="text" class="form-control" placeholder="Twitter URL"/>
                        </div>
                        <div class="col">
                            <label for="facebook_url">Facebook URL</label>
                            <input value="<?php echo $user_data['facebook_url']; ?>" id="facebook_url" name="facebook_url" type="text" class="form-control" placeholder="Facebook URL"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="picture">Picture</label>
                        <br>
                        <?php
                            $user_photo = $user_data['picture'];
                            $user_photo_path = IMAGE_PATH . $user_photo;

                            if(file_exists($user_photo_path) && $user_photo != "") {
                                echo '<img style="height: 200px;" src="' . $user_photo_path . '"/>';
                            }
                        ?>
                        <input value="<?php echo $user_data['picture']; ?>" id="picture" name="picture" type="file" class="form-control" placeholder="Picture"/>
                        <small id="picture_error" class="form-text"></small>
                        <?php
                            if(file_exists($user_photo_path) && $user_photo != "") {
                                echo '<label for="remove_picture">
                                        <input name="remove_picture" type="checkbox"/>
                                        Remove Photo
                                    </label>';
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <input value="<?php echo $user_data['comment']; ?>" id="comment" name="comment" type="text" class="form-control" placeholder="Comment"/>
                    </div>

                    <input id="contact-form-submit" class="btn btn-dark" type="submit">
                </form>
            </div>
        </div>
    </div>
</section>
<a href="/folder_view/vs.php?s=<?php echo __FILE__?>" target="_blank">View Source</a>
</body>
</html>