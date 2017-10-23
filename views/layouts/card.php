<?php
// EFFECTS: generates some HTML code for the cards
function card($id, $title, $first_name, $last_name) {
  $card = '
        <div id="card_for_' . $id .'" class="card p-3 contact_card">
            <div class="card-body">
                <h4 class="card-title">' . $title . ' ' . $first_name . ' ' . $last_name . '</h4>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">Lots of text</p>
                <div class="row">
                    <div class="ml-md-3">
                        <form action="./show.php" method="GET">
                            <input name="id" type="hidden" class="form-control" value="' . $id .'"/>
                            <input type="submit" class="btn btn-info" value="Show">
                        </form>
                    </div>
                    <div class="ml-md-3">
                        <form action="./edit.php" method="GET">
                            <input name="id" type="hidden" class="form-control" value="' . $id .'"/>
                            <input type="submit" class="btn btn-primary" value="Update">
                        </form>
                    </div>
                    <div class="ml-md-3">
                        <form action="./delete.php" method="POST" onsubmit="return confirm(\'Are you sure?\')">
                            <input name="id" type="hidden" class="form-control" value="' . $id .'"/>
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
        </div>';
  return $card;
}

function nothingToShow() {
    $card = '
    <div class="card text-center mb-lg-3">
      <div class="card-header"></div>
      <div class="card-body">
        <h4 class="card-title">Nothing to show here!</h4>
        <p class="card-text">Looks like the data is empty, click below to add some.</p>
        <a href="../contact/new.php" class="btn btn-dark">Create a new Contact</a>
      </div>
      <div class="card-footer text-muted"></div>
    </div>
    ';
    return $card;
}

?>