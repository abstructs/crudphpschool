<?php


// NOTE: For any controllers that get some data, the corresponding function will return
//       that data. If there is no data to return the function returns false or doesn't return at all.
//       I made this decision because I couldn't think of a way to make the data scope to the file the function
//       is being called in. Regardless it works. Dear future self, don't hate me.


function log_in() {
    if(isset($_SESSION['Logged_In'])) {
        flash("Already logged in!", "danger");
        header("Location: " . CONTACT_PATH);
        exit();
    } else {
        $_SESSION['Logged_In'] = True;
        flash("Successfully logged in!", "success");
        header("Location: " . CONTACT_PATH);
        exit();
    }
}

function log_out() {
    if(isset($_SESSION['Logged_In'])) {
        unset($_SESSION['Logged_In']);
        flash("Successfully logged out!", "success");
        header("Location: " . CONTACT_PATH);
        exit();
    } else {
        flash("Not logged in!", "danger");
        header("Location: " . CONTACT_PATH);
        exit();
    }
}

function is_logged_in() {
    return isset($_SESSION['Logged_In']);
}

function login_required() {
    if(!is_logged_in()) {
        flash("You must be logged in to do that action!", "danger");
        header("Location: " . CONTACT_PATH);
        exit();
    }
}

function handleIndexRequest() {
    return getData();
}

function handleShowRequest() {
    $user_data = findById($_GET['id'], 1)[0];
    foreach($user_data as $key => $value) {
        if($user_data[$key] === null) {
            $user_data[$key] = '';
        }
    }

    return $user_data;
}

function handleDeleteRequest() {
    login_required();
    $id = @$_POST['id'];
    if(isset($id)) {
        if(deleteContact($id)) {
            $_SESSION['flash'] = "Deleted successfully.";
            $_SESSION['flash-type'] = "success";
            header("Location: " . CONTACT_PATH);
        }
    }
    else {
        http_response_code(404);
        die();
    }
}

// EFFECTS: handles get paramaters for the new page
//          creates a contact from first_name, last_name, title
//          and other info.
// REQUIRES: first_name, title and last_name must be present and non-blank
// REQUIRES: first_name, title and last_name must be present and non-blank
function handleNewRequests() {
    login_required();
    switch($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $first_name = @$_POST['first_name'];
            $last_name = @$_POST['last_name'];
            $title = @$_POST['title'];

            if(isset($first_name) && isset($last_name) && isset($title)) {
                if(isset($_FILES['picture'])) {
                    // check if the file type is in the allowed types, returns an alert if not
                    $allowed_types = array("image/png", "image/jpeg");
                    if(!$_FILES['picture']['size'] == 0 && !in_array(getimagesize($_FILES['picture']['tmp_name'])['mime'],
                            $allowed_types)) {
                        flash("File type not supported.", "danger");
                        header("Location: " . CONTACT_PATH);
                        exit();
                    }
                }
                if(!($_FILES['picture']['size'] <= 500000)) {
                    flash("Photo is too large, please reduce file size to 5mb or lower.", "danger");
                    header("Location: " . CONTACT_PATH);
                    exit();
                }
                if(strlen($first_name) < 1 || strlen($last_name) < 1 || strlen($title) < 1) {
                    flash("Required fields left blank.", "danger");
                    header("Location: " . CONTACT_PATH);
                    exit();
                }
                if(createContact($_POST)) {
                    flash("Contact successfully created!", "success");
                    header("Location: " . CONTACT_PATH);
                    exit();
                } else {
                    flash("Something went wrong", "danger");
                    header("Location: " . CONTACT_PATH);
                    exit();
                }
            }
            break;
        default:
            break;
    }
}

function handleEditRequests() {
    login_required();
    $user_data = false;
    switch($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $first_name = @$_POST['first_name'];
            $last_name = @$_POST['last_name'];
            $title = @$_POST['title'];
            $id = @$_GET['id'];
            if(isset($first_name) && isset($last_name) && isset($title) && isset($id)) {
                $allowed_types = array("image/png", "image/jpeg");

                if(!$_FILES['picture']['size'] == 0 && !in_array(getimagesize($_FILES['picture']['tmp_name'])['mime'],
                        $allowed_types)) {
                    flash("File type not supported.", "danger");
                    header("Location: " . CONTACT_PATH);
                    exit();
                }
                if(!($_FILES['picture']['size'] <= 500000)) {
                    flash("Photo is too large, please reduce file size to 5mb or lower.", "danger");
                    header("Location: " . CONTACT_PATH);
                    exit();
                }
                if(updateContact($id, $_POST)) {
                    flash("Contact successfully edited!", "success");
                    header("Location: " . CONTACT_PATH);
                    exit();
                }
            }
            break;
        case 'GET':
            $id = $_GET['id'];
            if(isset($id)) {
                $user_data = findById($id, 1)[0];
                if(!$user_data) {
                    flash("User doesn't exist.", "danger");
                    header("Location: " . CONTACT_PATH);
                    exit();
                }
                else {
                    return $user_data;
                }
            }
            else {
                flash("No ID given", "danger");
                header("Location: " . CONTACT_PATH);
                exit();
            }
            break;
        default:
            flash("User doesn't exist.", "danger");
            header("Location: " . CONTACT_PATH);
            exit();
            break;
    }
    exit();
}

function handleSearchRequests() {
    $include_first_name = @$_GET['search_filters']['first_name'] === "on";
    $include_last_name = @$_GET['search_filters']['last_name'] === "on";
    $first_name = @$_GET['first_name'];
    $last_name = @$_GET['last_name'];

    $first_name_valid = isset($first_name) && !empty($first_name);
    $last_name_valid = isset($last_name) && !empty($last_name);

    if($include_first_name && $include_last_name) {
        if($first_name_valid && $last_name_valid) {
            return findByFirstAndLastName($first_name, $last_name);
        }

        return false;
    }
    else if($include_first_name) {
        if($first_name_valid) {
            return findByFirstName($first_name);
        }
    }
    else if($include_last_name) {
        if($last_name_valid) {
            return findByLastName($last_name);
        }
    }
    return false;
}

echo '<a href="/folder_view/vs.php?s=' .  __FILE__  . '" target="_blank">View Source</a>';
?>