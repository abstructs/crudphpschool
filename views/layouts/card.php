<?php
// EFFECTS: generates some HTML code for the cards
function card($id, $title, $first_name, $last_name, $photo_url="default.jpg") {
  $card = '
        <div id="card_for_' . $id .'" class="card bg-dark text-white p-3 contact_card" style="width: 20rem;">
            <img class="card-img-top" src="' . IMAGE_PATH . $photo_url . '" alt="Card image cap" style="height: 200px; width: 100%;">
            <div class="card-body">
                <h4 class="card-title">' . $title . ' ' . $first_name . ' ' . $last_name . '</h4>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <br>
                <p class="card-text"></p>
                <div class="row">
                    <div class="ml-md-3">
                        <form action="./show.php" method="GET">
                            <input name="id" type="hidden" class="form-control" value="' . $id .'"/>
                            <input type="submit" class="btn btn-secondary" value="Show">
                        </form>
                    </div>
                    <div class="ml-md-3">
                        <form action="./edit.php" method="GET">
                            <input name="id" type="hidden" class="form-control" value="' . $id .'"/>
                            <input type="submit" class="btn btn-light" value="Update">
                        </form>
                    </div>
                    <div class="ml-md-3">
                        <form action="./delete.php" method="POST" onsubmit="return confirm(\'Are you sure?\')">
                            <input name="id" type="hidden" class="form-control" value="' . $id .'"/>
                            <input type="submit" class="btn btn-warning" value="Delete">
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