<?php

require __DIR__ . '../../models/contact_schema.php';
// CONSTANTS:
define("DATA_LENGTH", 3);
define("FILE_NAME", $_SERVER['DOCUMENT_ROOT'] . '/db/database');
define("UPLOAD_PATH", $_SERVER['DOCUMENT_ROOT'] . '/public/system/images/');

// EFFECTS: gets data from the file, if file doesn't exist creates one
// RETURNS: assoc array of the data read from the file
function getData() {
    $file_name = FILE_NAME;
    $all_data = [];
    $assoc_data = [];
    if(!file_exists($file_name)) {
        touch($file_name);
    }
    else {
        $handle = fopen($file_name, 'a+');
        if(filesize($file_name) <= 0) { return []; }
        $all_data = explode("\n", fread($handle, filesize($file_name)));
    }

    foreach($all_data as $row) {
        $row_data = explode(",", $row);
        $i = 0;
        $array_builder = [];

        foreach(CONTACT_SCHEMA as $key => $value) {
            if(!isset($row_data[$i])) {
                $array_builder[$key] = null;
            }
            else {
                $array_builder[$key] = $row_data[$i];
            }
            $i++;
        }


        $assoc_data[] = $array_builder;
    }

    fclose($handle);

    return $assoc_data;
}

// EFFECTS: Search the data file for an entry with the given ID
// RETURNS: a function that takes a thingToFind and searches for it
//          in the data when called.
// REQUIRES: thing must exist in database otherwise returns false
// NOTE: this function isn't really meant to be called by clients,
//       more like a function meant to create other functions.
//       I made this decision because I wanted a reusable way to make
//       functions like "findById" or "findByFirstNameAndLastName" and
//       I realized they were all very similar so I created this to automate the
//       code more.
function findBy($column_name='') {
    if(!empty($column_name)) {
        // EFFECTS: searches the column corresponding to "column name" for the value "thingtofind"
        //          return false if not found
        return function($thingToFind, $max_results=-1) use($column_name) {
            $data = getData();
            $results = [];
            $results_count = 0;
            foreach($data as $row) {
                // Uses lowercase for robustness although data should be formatted better
                if (strtolower($row[$column_name]) === strtolower(((string)$thingToFind))) {
                    array_push($results, $row);
                    $results_count++;
                }

                if($results_count == $max_results) break;
            }
            if(!empty($results)) return $results;
            return false;
        };
    } else {
        // EFFECTS: takes an assoc array with keys for the column to search and values for the value to search
        //          Ex. to search first name you would pass
        //          { ['first_name'] => 'NAME',
        //           ['last_name'] => 'NAME' }
        //          only returns true if every column's value is in the entry
        return function($arr) {
            $data = getData();
            $results = [];
            foreach($data as $row) {
                $cond = true;
                foreach($arr as $key => $value) {
                    if(!(strtolower($arr[$key]) === strtolower(((string)$row[$key])))) {
                        $cond = false;
                        break;
                    }
                }
                if ($cond) array_push($results, $row);
            }

            if(!empty($results)) return $results;
            return false;
        };
    }

}

// RETURNS: boolean or data
// (implementations of "findBy" higher order function)
function findById($id) { return findBy('id')($id); }
function findByFirstName($first_name) { return findBy('first_name')($first_name); }
function findByLastName($last_name) { return findBy('last_name')($last_name); }
function findByFirstAndLastName($first_name, $last_name) {
    return findBy()(array('first_name' => $first_name, 'last_name' => $last_name));
}

// EFFECTS: Creates a new contact and writes it to the file, does some logic for handling photo upload
// MODIFIES: textfile
// REQUIRES: textfile must exist
// RETURNS: boolean
function createContact($params) {
    if(!isset($params['first_name']) || !isset($params['last_name']) || !isset($params['title'])) {
        return false;
    }

    $photo_to_upload = $_FILES['picture'];
    if(isset($photo_to_upload)) {
        // check if the file type is in the allowed types, returns false if not
        $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
        if(!in_array(exif_imagetype($_FILES['picture']['tmp_name']), $allowed_types)) {
            return false;
        }

        // generate a unique name with a randomized salt and the file extension
        $file_name = crypt($photo_to_upload['name'], str_shuffle("1234567890!@#$%^&*()_+/")) . "."
            . pathinfo($photo_to_upload['name'], PATHINFO_EXTENSION);

        // moves the file
        move_uploaded_file($photo_to_upload['tmp_name'], UPLOAD_PATH . $file_name);

        // add filename to params
        $params['picture'] = $file_name;
    }

    $insert_string = '';
    if(!file_exists($file_name)) {
        touch($file_name);
        $id = 0;
        $handle = fopen($file_name, 'r+');
    }
    else {
        $handle = fopen($file_name, 'r+');
        $id = (filesize($file_name) > 0) ? @fread($handle, filesize($file_name)) : 0;
        settype($id, "integer");
        $insert_string = ++$id;
    }

    foreach(CONTACT_SCHEMA as $key => $value) {
        if(!isset($params[$key])) {
            $params[$key] = null;
        }

        $insert_string = $insert_string . $params[$key] . ",";
    }

    $insert_string = trim($insert_string, ",") . "\n";

    $file = file_get_contents($file_name);
    file_put_contents($file_name, $insert_string . trim($file, "\n"));

    fclose($handle);
    return true;
}

// EFFECTS: removes a contact from the database
// MODIFIES: textfile
// REQUIRES: textfile must exist
// RETURNS: boolean
function deleteContact($id) {
    $file_name = FILE_NAME;
    if(!file_exists($file_name) || filesize($file_name) <= 0) {
        return false;
    }

    $handle = fopen($file_name, 'r+');
    $file = fread($handle, filesize($file_name));

    $new_file = '';
    foreach(explode("\n",$file) as $row) {
        $row_data = explode(",", $row);
        if(!isset($row[0]) || ($row_data[0] === (string)$id)) continue;
        $new_file = $new_file . $row . "\n";
    }

    file_put_contents($file_name, $new_file);
    fclose($handle);
    return true;
}

// EFFECTS: Changes the row in the database corresponding with the $id updating any parameters passed into "params" with
//          their new value
// MODIFIES: textfile
// REQUIRES: textfile must exist
// RETURNS: boolean
function updateContact($id, $params) {
    $file_name = FILE_NAME;
    $id = (string)$id;
    $params['id'] = $id;

    if(!file_exists($file_name) || filesize($file_name) <= 0) {
        return false;
    }

    $handle = fopen($file_name, 'r+');
    $file = fread($handle, filesize($file_name));

    $new_file = '';

    // seperate file into rows
    foreach(explode("\n",$file) as $row) {
        // seperate rows by commas
        $row_data = explode(",", $row);
        // find the row with corresponding id
        if($row_data[0] === $id) {
            // overwrite the row with the new data from params
            $row = '';
            // iterate through schema settings schema keys to corresponding values
            foreach(CONTACT_SCHEMA as $key => $value) {
                if(!isset($params[$key])) {
                    $params[$key] = null;
                }

                $row = $row . $params[$key] . ",";
            }
        }

        $new_file = $new_file . $row . "\n";
    }

    file_put_contents($file_name, $new_file);
    fclose($handle);
    return true;

}

function flash($flash, $flash_type="primary") {
//    session_start();
    $_SESSION['flash'] = $flash;
    $_SESSION['flash-type'] = $flash_type;
}

?>