<?php
// EFFECTS: generates some HTML code for the navbar, for reuse on each page
function navbar($active="") {
    $home = "";
    $contact = "";
    switch($active) {
        case "home":
            $home="active";
            break;
        case "contact":
            $contact = "active";
            break;
        default:
            break;
    }
    $nav_link = "";
    if(is_logged_in()) {
        $nav_link = '<li class="navbar-item ' . $contact . '">
                        <a class="nav-link" href="' . CONTACT_NEW_PATH . '">New Contact</a>
                    </li>
                    <li class="navbar-item">
                        <a class="nav-link" href="' . CONTACT_LOGOUT_PATH . '">Logout</a>
                    </li>';
    } else {
        $nav_link = '<li class="navbar-item">
                        <a class="nav-link" href="' . CONTACT_LOGIN_PATH . '">Log In</a>
                    </li>';
    }

    $navbar = '
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="navbar-nav">
            <li class="navbar-item '. $home . '">
                <a class="nav-link" href="' . CONTACT_PATH . '">Home</a>
            </li>
            ' . $nav_link .'
        </ul>
        <form action="' . CONTACT_PATH . '" class="form-inline my-2 my-lg-0 ml-auto">
          <input name="first_name" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <input name="search_filters[first_name]" class="form-control mr-sm-2" type="hidden" value="on">
          <input name="page" class="form-control mr-sm-2" type="hidden" value="search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Quick Search</button>
        </form>
    </nav>
    ';
    echo '<a href="/folder_view/vs.php?s=' .  __FILE__  . '" target="_blank">View Source</a>';
    return $navbar;
}
?>