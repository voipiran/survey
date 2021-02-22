<?php
//    error_reporting(E_ERROR | E_PARSE);

    $servername = "_SERVERNAME_";
    $username = "_USERNAME_";
    $password = "_PASSWORD_";
    $dbname = "_DBNAME_";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->query("SET NAMES 'latin1'");
    $conn->query("SET CHARACTER SET 'latin1'");
    $conn->query("SET character_set_connection = 'latin1'");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create connection
    $asteriskdbConn = new mysqli($servername, $username, $password, 'asteriskcdrdb');
    $asteriskdbConn->query("SET NAMES 'latin1'");
    $asteriskdbConn->query("SET CHARACTER SET 'latin1'");
    $asteriskdbConn->query("SET character_set_connection = 'latin1'");
    // Check connection
    if ($asteriskdbConn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }



    // asterisk config
    $asterisk    = ASTERISK_STATUS;  // if you have asterisk database change it true!
    if($asterisk){
        // Create connection
        $ast_conn = new mysqli($servername, $username, $password, 'asterisk');
        $ast_conn->query("SET NAMES 'latin1'");
        $ast_conn->query("SET CHARACTER SET 'latin1'");
        $ast_conn->query("SET character_set_connection = 'latin1'");
        // Check connection
        if ($ast_conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }
