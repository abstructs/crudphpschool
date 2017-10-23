<?php
// EFFECTS: renders an alert onto the page if given in the session
// REQUIRES: "flash" must be set, "flash-type" determines the style, if not specified in session
//           defaults to primary
function alert() {
    $class="primary";
    session_start();
    $flash = @$_SESSION['flash'];
    $flash_type = @$_SESSION['flash-type'];
    if(isset($flash)) {
        if(isset($flash_type)) $class = $flash_type;

        @session_unset($_SESSION['flash-type']);
        @session_unset($_SESSION['flash']);
        return '<div class="mb-0 alert alert-' . $class . '">' . $flash .'</div>';
    }
    // return an empty div with alert id so javascript can do ajax alerts
    return '<div id="alert"></div>';
}
?>