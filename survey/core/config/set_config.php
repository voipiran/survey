<?php
try {
    session_start();
    include_once '../../app/PasswordHash.php';
    header('Content-Type: application/json');

    $servername = $_POST['db_host'];
    $username   = $_POST['db_username'];
    $password   = $_POST['db_password'];
    $dbname     = $_POST['db_name'];
    $base_path  = $_POST['base_path'];
    $asterisk_status = $_POST['asterisk_status'];
    $asterisk_status = true; // set it defualt to true for now
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->query("SET NAMES 'latin1'");
    $conn->query("SET CHARACTER SET 'latin1'");
    $conn->query("SET character_set_connection = 'latin1'");
    // Check connection
    if ($conn->connect_error) {
        http_response_code(500);
        echo 'connection faild';
        die("Connection failed: " . $conn->connect_error);
    }

    // Create lsc Table //
    // Not fo now 
    // $conn->query("
    //     CREATE TABLE IF NOT EXISTS `lsc` (
    //       `verify` tinyint(1) NOT NULL
    //     ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    //     ");

    // Create lsc Table //


    // Create settings Table If Not Exist//
    $conn->query("
            CREATE TABLE IF NOT EXISTS `settings` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `survey_name` varchar(30)  CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
                `survey_status` tinyint(4) DEFAULT NULL,
                `survey_voice` varchar(100) DEFAULT NULL,
                `survey_string` varchar(20) DEFAULT NULL,
                `survey_queue` varchar(20) DEFAULT NULL,
                `customer_voice_status` tinyint(4) DEFAULT NULL,
                `customer_voice_limit` tinyint(4) DEFAULT NULL,
                `survey_playagent` varchar(10)  CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
                `created_at` timestamp NULL DEFAULT NULL,
                `updated_at` timestamp NULL DEFAULT NULL,
                UNIQUE KEY `id` (`id`)
            ) ENGINE=InnoDB   AUTO_INCREMENT=60 ;            
        ");
    // Create settings Table //

    // Create survey Table //
    $conn->query("
    CREATE TABLE IF NOT EXISTS `survey` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `date_time` datetime DEFAULT NULL,
        `uniqueid` varchar(30) DEFAULT NULL,
        `agent_number` varchar(30) DEFAULT NULL,
        `agent_name` varchar(30)  CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
        `caller_number` varchar(30) DEFAULT NULL,
        `caller_name` varchar(30)  CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
        `survey_value` varchar(5) DEFAULT NULL,
        `survey_location` varchar(30) DEFAULT NULL,
        `customer_voice_path` varchar(300) DEFAULT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `updated_at` timestamp NULL DEFAULT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB   AUTO_INCREMENT=24 ;
    ");

    // Create survey Table //


    // ------------------ create users table ------------------------------
    $conn->query("
    CREATE TABLE IF NOT EXISTS `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `full_name` varchar(190)   CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
        `user_name` varchar(190) DEFAULT NULL,
        `queue` varchar(190) DEFAULT NULL,
        `role` varchar(190) DEFAULT NULL,
        `password` varchar(190) DEFAULT NULL,
        `remove_survey` tinyint(1) DEFAULT '0',
        `edit_survey` tinyint(1) DEFAULT '0',
        PRIMARY KEY (`id`)
      )  ENGINE=InnoDB   AUTO_INCREMENT=24;");
    // ------------------ create users table ------------------------------


    // -------------------------- create voipiran_settigns insert to voipiran_settings ------------------------------

    $pwdHasher = new PasswordHash(8, FALSE);
    // $hash is what you would store in your database
    $license = $pwdHasher->HashPassword($_POST['license_type']);
    $conn->query("
    CREATE TABLE IF NOT EXISTS `voipiran_settings` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `license` varchar(200) NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
    ");

    $conn->query("
    INSERT INTO `voipiran_settings` (`id`, `license`) VALUES
    (1, '" . json_encode($license) . "');
    ");


    // -------------------------- create voipiran_settigns insert to voipiran_settings ------------------------------

    $user = $conn->query("SELECT * FROM users where user_name = 'admin'");
    if (!$user->num_rows) {
        // have admin 
        $conn->query("INSERT INTO `users` (`id`, `full_name`, `user_name`, `queue`, `role`, `password`, `remove_survey`, `edit_survey`) VALUES
        (1, 'مدیر', 'admin', '', 'administrator', '$2a$08$3rb2XjUtp2ayXt7LiP0/OOf06f29Fp2ixSm1rZp4say96GIxgYTW6' , 1, 1);
        ");
    }

    $user = $conn->query("SELECT * FROM users where user_name = 'admin'");
    $row = $user->fetch_assoc();
    $_SESSION['user']  = $row;


    //Copy Files
    copy('cexample.php', 'config.php');
    copy('dexample.php', 'db.php');

    // put config content 
    $config = file_get_contents('config.php');
    $config = str_replace("VALUE_BASE_PATH", $base_path, $config);
    file_put_contents('config.php', $config);

    // put db content 
    $db = file_get_contents('db.php');
    $db = str_replace("_SERVERNAME_", $servername, $db);
    $db = str_replace("_USERNAME_", $username, $db);
    $db = str_replace("_PASSWORD_", $password, $db);
    $db = str_replace("_DBNAME_", $dbname, $db);
    $db = str_replace("ASTERISK_STATUS", $asterisk_status, $db);
    file_put_contents('db.php', $db);

    // config functions.php 
    $functions = file_get_contents('../../app/CFunctions.php');
    $functions = str_replace("_DETAULTPATH_", $base_path, $functions);
    $functions = str_replace("_SERVERNAME_", $servername, $functions);
    $functions = str_replace("_USERNAME_", $username, $functions);
    $functions = str_replace("_PASSWORD_", $password, $functions);
    $functions = str_replace("_DBNAME_", $dbname, $functions);

    file_put_contents('../../app/Functions.php', $functions);

    // Remove Install.php 
    unlink('../../install.php');

    // All Done 
    http_response_code(200);
    echo 'true';
    die();
} catch (\Throwable $th) {
    http_response_code(500);
    echo json_encode(json_encode($th));
    die();
}
