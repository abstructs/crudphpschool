<?php

function getData() {
    $file_name = 'database';
    $all_data = [];
    $assoc_data = [];
    if(!file_exists($file_name)) {
        touch($file_name);
    } else {
        $handle = fopen($file_name, 'a+');
        $all_data = explode("\n", fread($handle, filesize($file_name)));
    }

    foreach($all_data as $row) {
        $row_data = explode(",", $row);
        for($i = 0; $i < DATA_LENGTH; $i++) {
            if(!isset($row_data[$i])) {
                $row_data[$i] = null;
            }
        }

        $assoc_data[] = array("id" => $row_data[0], "first_name" => $row_data[1],
            "last_name" => $row_data[2]);
    }

    fclose($handle);

    return $assoc_data;
}

// EFFECTS: Search the data file for an entry with the given ID
// RETURNS: a function that takes a thingToFind and searches for it
//          in the data when called.

function findBy($thingToFindBy) {
    return function($thingToFind) use($thingToFindBy) {
        $data = getData();
        foreach($data as $row) {
// Ensure lowercase so
            if (strtolower($row[$thingToFindBy]) === strtolower(((string)$thingToFind))) {
                return $row;
            }
        }

        return false;
    };

}
function findById($id) { return findBy('id')($id); }
function findByFirstName($first_name) { return findBy('first_name')($first_name); }
function findByLastName($last_name) { return findBy('last_name')($last_name); }

?>