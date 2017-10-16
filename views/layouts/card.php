<?php
function card($title, $first_name, $last_name) {
  $card = '
        <div class="card p-3">
            <div class="card-body">
                <h4 class="card-title">' . $title . ' ' . $first_name . ' ' . $last_name . '</h4>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">Lots of text</p>
                <a href="#" class="card-link">Modify</a>
                <a href="#" class="card-link">Delete</a>
            </div>
        </div>';
  return $card;
}

?>