<?php
    $connection = new mysqli('localhost', 'root', '', 'dbabellanaf2');
    if (!$connection){
        die(mysqli_error($mysqli));
    }
?>