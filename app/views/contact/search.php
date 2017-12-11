<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo STYLESHEETS_PATH . "bootstrap.min.css"; ?>">
    <link rel="stylesheet" href="<?php echo STYLESHEETS_PATH . "index.css"; ?>">
    <title>Search</title>
</head>
<body>
<?php echo navbar(); ?>
<?php echo alert(); ?>

<section id="header">
    <div class="jumbotron bg-secondary text-white">
        <h1 class="display-4">Search</h1>
        <hr>
    </div>
</section>
<section id="search-form">
    <header>
    </header>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-6 mx-auto">
                <form method="GET">
                        <label>First Name</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <input name="search_filters[first_name]" type="checkbox">
                          </span>
                            <input name="first_name" type="text" class="form-control" placeholder="Enter First Name">
                        </div>

                        <label>Last Name</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            <input name="search_filters[last_name]" type="checkbox">
                          </span>
                            <input name="last_name" type="text" class="form-control" placeholder="Enter Last Name">
                        </div>
                    <input name="page" value="search" type="hidden">
                    <input class="btn btn-dark mt-3" type="submit" value="Search"></input>
                </form>
            </div>
        </div>
    </div>
</section>
<section id="search-results">
    <header>
        <h4 class="text-center">Results</h4>
    </header>
    <div class="container">

                <?php
                    if(!$search_data) {
                        echo '<p class="text-center">No results found. Try another search.</p>';
                    }
                    else {
                        echo '<div class="card-columns" style="display: inline-block;"><ul>';
                        foreach($search_data as $row) {
                            if(isset($row['id']) && isset($row['title']) && isset($row['first_name']) && isset($row['last_name'])) {
                                echo card($row['id'], $row['title'], $row['first_name'], $row['last_name']);
                            }
                        }
                        echo '</ul></div>';
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