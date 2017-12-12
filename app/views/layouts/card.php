<?php
// EFFECTS: generates some HTML code for the cards
function card($id, $title, $first_name, $last_name, $photo_url="") {
    $photo = "";
    if($photo_url != "" && file_exists(IMAGE_PATH . $photo_url)) {
        $photo = '<img class="card-img-top" src="' . IMAGE_PATH . $photo_url . '" alt="contact photo" style="height: 200px; width: 100%;">';
    }
    $additional_actions = "";
    if(is_logged_in()) {
        $additional_actions = '<div class="ml-md-3">
                                    <form action="' . CONTACT_PATH . '" method="GET">
                                        <input name="id" type="hidden" class="form-control" value="' . $id . '"/>
                                        <input name="page" type="hidden" class="form-control" value="edit"/>
                                        <input type="submit" class="btn btn-light" value="Update">
                                    </form>
                                </div>
                                <div class="ml-md-3">
                                    <form action="' . CONTACT_PATH . '" method="POST" onsubmit="return confirm(\'Are you sure?\')">
                                        <input name="id" type="hidden" class="form-control" value="' . $id . '"/>
                                        <input name="action" type="hidden" class="form-control" value="delete"/>
                                        <input type="submit" class="btn btn-warning" value="Delete">
                                    </form>
                                </div>';
    }

  $card = '
        <div id="card_for_' . $id .'" class="card bg-dark text-white p-3 contact_card" style="width: 20rem;">
            ' . $photo . '
            <div class="card-body">
                <h4 class="card-title">' . $title . ' ' . $first_name . ' ' . $last_name . '</h4>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <br>
                <p class="card-text"></p>
                <div class="row">
                    <div class="ml-md-3">
                        <form action="' . CONTACT_PATH .'" method="GET">
                            <input name="id" type="hidden" class="form-control" value="' . $id .'"/>
                            <input name="page" type="hidden" class="form-control" value="show"/>
                            <input type="submit" class="btn btn-secondary" value="Show">
                        </form>
                    </div>
                    ' . $additional_actions . '
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
        <a href="' . CONTACT_NEW_PATH . '" class="btn btn-dark">Create a new Contact</a>
      </div>
      <div class="card-footer text-muted"></div>
    </div>
    ';
    return $card;
}

?>