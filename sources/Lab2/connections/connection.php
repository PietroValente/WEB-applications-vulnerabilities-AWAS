<?php

function connection() {
    
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "blog";

    $con = new mysqli($host, $username, $password, $database);

    if($con->connect_error) {
        echo $con->connect_error;
    } else {
        return $con;
    }

    $con->close();
}

function DBLessConnection() {
    $host = "localhost";
    $username = "root";
    $password = "";

    $con = new mysqli($host, $username, $password);

    if($con->connect_error) {
        echo $con->connect_error;
    } else {
        return $con;
    }

    $con->close();
}

