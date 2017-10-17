<?php

require '../../models/contact_schema.php';
// CONSTANTS:
define("DATA_LENGTH", 3);
define("FILE_NAME", $_SERVER['DOCUMENT_ROOT'] . '/db/database');

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

function findBy($column_name) {
    return function($thingToFind) use($column_name) {
        $data = getData();
        foreach($data as $row) {
            // Uses lowercase for robustness although data should be formatted better
            if (strtolower($row[$column_name]) === strtolower(((string)$thingToFind))) {
                return $row;
            }
        }

        return false;
    };

}

function findById($id) { return findBy('id')($id); }
function findByFirstName($first_name) { return findBy('first_name')($first_name); }
function findByLastName($last_name) { return findBy('last_name')($last_name); }

// EFFECTS: Creates a new contact and writes it to the file
function createContact($params) {
    if(!isset($params['first_name']) || !isset($params['last_name']) || !isset($params['title'])) {
        return false;
    }

    $file_name = FILE_NAME;
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
    file_put_contents($file_name, $insert_string . $file);

    fclose($handle);
}

// EFFECTS: removes a contact from the database
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

// DONE: Read
// DONE: Create
// TODO: Update
// DONE: Delete

?>