<?php
//    error_reporting(E_ERROR | E_PARSE);
    header('Content-Type: application/json');

    $servername = $_GET['db_host'];
    $username   = $_GET['db_username'];
    $password   = $_GET['db_password'];
    $dbname     =  $_GET['db_name'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->query("SET NAMES 'utf8'");
    $conn->query("SET CHARACTER SET 'utf8'");
    $conn->query("SET character_set_connection = 'utf8'");
    // Check connection
    if ($conn->connect_error) {
        echo 'connection faild' ;
        http_response_code(500);
        die("Connection failed: " . $conn->connect_error);
    }

    // asterisk config
    $asterisk    = false;  // if you have asterisk database change it true!
    if($asterisk){
        // Create connection
        $ast_conn = new mysqli($servername, $username, $password, $dbname);
        $ast_conn->query("SET NAMES 'utf8'");
        $ast_conn->query("SET CHARACTER SET 'utf8'");
        $ast_conn->query("SET character_set_connection = 'utf8'");
        // Check connection
        if ($ast_conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }

    http_response_code(200);
    echo 'Success Configuration' ;
    
?>