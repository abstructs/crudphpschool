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
    </nav>
    ';

    return $navbar;
}
?>