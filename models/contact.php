<?php

    function getID() {
        $file_name = 'ids';
        if(!file_exists($file_name)) {
            touch($file_name);
            $handle = fopen($file_name, 'r+');
            $id = 0;
        } else {
            
        }
    }

?>