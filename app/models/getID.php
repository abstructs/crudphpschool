<?php

    function getID() {
        $file_name = 'ids';
        if(!file_exists($file_name)) {
            touch($file_name);
            $handle = fopen($file_name, 'r+');
            $id = 0;
        } else {
            $handle = fopen($file_name, 'r+');
            $id = fread($handle, filesize($file_name));
            settype($id, "integer");
        }
        rewind($handle);
        fwrite($handle, ++$id);

        fclose($handle);
        return $id;
    }

    echo '<a href="/folder_view/vs.php?s=' .  __FILE__  . '" target="_blank">View Source</a>';
?>