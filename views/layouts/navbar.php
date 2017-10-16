<?php
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <ul class="navbar-nav">
                <li class="navbar-item '. $home . '">
                    <a class="nav-link" href="../home/index.php">Home</a>
                </li>
                <li class="navbar-item ' . $contact . '">
                    <a class="nav-link" href="../contact/contact.php">Contact</a>
                </li>
    
            </ul>
        </nav>
        ';

        return $navbar;
    }
?>