<?php
function card($id, $title, $first_name, $last_name) {
  $card = '
        <div id="card_for_' . $id .'" class="card p-3 contact_card">
            <div class="card-body">
                <h4 class="card-title">' . $title . ' ' . $first_name . ' ' . $last_name . '</h4>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">Lots of text</p>
                <div class="row">
                    <div class="ml-md-3">
                        <form method="POST">
                            <input name="id_to_modify" type="hidden" value="' . $id . '"></input>
                            <input class="btn btn-primary" type="submit" value="Modify"></input>
                        </form>
                    </div>
                    <div class="ml-md-3">
                        <form method="POST">
                            <input name="id_to_delete" type="hidden" value="' . $id . '"></input>
                            <input class="btn btn-danger" type="submit" value="Delete"></input>
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
        <a href="../contact/contact.php" class="btn btn-primary">Create a new Contact</a>
      </div>
      <div class="card-footer text-muted"></div>
    </div>
    ';
    return $card;
}

?>