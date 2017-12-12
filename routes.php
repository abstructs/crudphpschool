<?php
    define("STYLESHEETS_PATH", './assets/stylesheets/');
    define("JAVASCRIPTS_PATH", './assets/javascripts/');
    define("ASSETS_PATH", './assets/');

    // view
    // contact
    define("CONTACT_PATH", './index.php');
    define("CONTACT_NEW_PATH", './index.php?page=new');
    define("CONTACT_EDIT_PATH", './index.php?page=edit');
    define("CONTACT_SEARCH_PATH", './index.php?page=edit');
    define("CONTACT_DELETE_PATH", './index.php?action=delete');
    define("CONTACT_SHOW_PATH", './index.php?page=show');

    define("CONTACT_LOGIN_PATH", './index.php?action=login');
    define("CONTACT_LOGOUT_PATH", './index.php?action=logout');

    define("UPLOAD_PATH", "./assets/images/");
    define("IMAGE_PATH", "./assets/images/");

    define("ROOT_PATH", "./../");

    echo '<a href="/folder_view/vs.php?s=' .  __FILE__  . '" target="_blank">View Source</a>';
?>