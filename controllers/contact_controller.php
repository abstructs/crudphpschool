<?php
require __DIR__ . '/helpers.php';

function handleIndexRequest() {
    return getData();
}

function handleShowRequest() {
    $user_data = findById($_GET['id']);
    foreach($user_data as $key => $value) {
        if($user_data[$key] === null) {
            $user_data[$key] = '';
        }
    }

    return $user_data;
}

function handleDeleteRequest() {
    $id = @$_POST['id'];
    if(isset($id)) {
        if(deleteContact($id)) {
            session_start();
            $_SESSION['flash'] = "Deleted successfully.";
            $_SESSION['flash-type'] = "success";
            header("Location: ./index.php");
        }
    }
    else {
        http_response_code(404);
        die();
    }
}

function handleNewRequests() {
    switch($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $first_name = @$_POST['first_name'];
            $last_name = @$_POST['last_name'];
            $title = @$_POST['title'];
            if(isset($first_name) && isset($last_name) && isset($title)) {
                if(createContact($_POST)) {
                    flash("Contact successfully created!", "success");
                    header("Location: ./index.php");
                }
            }
            break;
    }
}

function handleEditRequests() {
    $user_data = false;
    switch($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $first_name = @$_POST['first_name'];
            $last_name = @$_POST['last_name'];
            $title = @$_POST['title'];
            $id = @$_GET['id'];
            if(isset($first_name) && isset($last_name) && isset($title) &&isset($id)) {
                if(updateContact($id, $_POST)) {
                    flash("Contact successfully edited!", "success");
                    header("Location: ./index.php");
                }
            }
            break;
        case 'GET':
            $id = $_GET['id'];
            if(isset($id)) {
                $user_data = findById($id);
                if(!$user_data) {
                    flash("User doesn't exist.", "danger");
                    header("Location: ./index.php");
                }
                else {
                    return $user_data;
                }
            }
            else {
                flash("No ID given", "danger");
                header("Location: ./index.php");
            }
            break;
    }
}

?>