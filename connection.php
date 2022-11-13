<?php
    //Connection
    
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'seminar_hall';
    $con = mysqli_connect($hostname,$username,$password,$database);

    if (!$con) {
        echo mysqli_connect_error($con);
    } else {
        // echo 'Successfully connected';
    }
?>