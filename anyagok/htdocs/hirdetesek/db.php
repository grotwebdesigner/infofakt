<?php

function db_init(){
    $servername = "localhost";
    $username = "infofakt_user";
    $password = "Almafa123!!!";
    $dbname = "infofakt_hirdetesek";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    mysqli_query("SET character_set_results=utf8", $conn);
    mb_language('uni'); 
    mb_internal_encoding('UTF-8');
    mysqli_select_db($dbname, $conn);
    mysqli_query("set names 'utf8'",$conn);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

?>