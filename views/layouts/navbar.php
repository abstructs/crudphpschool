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
    $navbar = '
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="navbar-nav">
            <li class="navbar-item '. $home . '">
                <a class="nav-link" href="../contact/index.php">Home</a>
            </li>
            <li class="navbar-item ' . $contact . '">
                <a class="nav-link" href="../contact/new.php">New Contact</a>
            </li>
        </ul>
        <form action="./search.php" class="form-inline my-2 my-lg-0 ml-auto">
          <input name="first_name" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <input name="search_filters[first_name]" class="form-control mr-sm-2" type="hidden" value="on">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Quick Search</button>
        </form>
    </nav>
    ';

    return $navbar;
}
?>