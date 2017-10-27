<?php
// EFFECTS: renders an alert onto the page if given in the session
// REQUIRES: "flash" must be set, "flash-type" determines the style, if not specified in session
//           defaults to primary
//           On pages with a form this function is called on each request which ends up deleting the
//           flash session variable, use AJAX for pages with form
function alert($has_form=false) {
    $class="primary";
    session_start();
    $flash = @$_SESSION['flash'];
    $flash_type = @$_SESSION['flash-type'];
    if(isset($flash) && !$has_form) {
        if(isset($flash_type)) $class = $flash_type;

        @session_unset($_SESSION['flash-type']);
        @session_unset($_SESSION['flash']);
        $close_js = '
            <script>
                var btn = document.getElementById("alert-close");
                btn.addEventListener("click", function(event) {
                    var trget = event.target.parentNode.parentNode;
                    trget.innerHTML = "";
                    trget.className = "";
                });
            </script>
        ';
        return '<div class="mb-0 alert alert-' . $class . '">'
                    . $flash .'
                    <button type="button" id="alert-close" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>' . $close_js;
    }
    // return an empty div with alert id so javascript can do ajax alerts
    return '<div id="alert"></div>';
}
?>