<?php
session_start();

class DB
{
    function connection()
    {
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
        //    echo "Connected successfully";
        return $conn;
    }
}

$server = $_SERVER['SERVER_ADDR'];
define("PATH", "https://$server/survey/");

// all function needs login 
$login = checkLogin();
$cUrl = currentUrl();
if ($login) {
    // logged in 
    // do next();
    if ($cUrl == PATH . 'core/login/' || $cUrl == PATH . 'core/login' || $cUrl == PATH . 'core/login/index.php') {
        header('Location:' . PATH, true, 301);
    }
} else {
    if ($cUrl != PATH . 'core/login/' && $cUrl != PATH . 'core/login/functions.php') {
        header('Location:' . PATH . 'core/login', true, 301);
    }
}

function checkLogin()
{
    if (isset($_SESSION['user'])) {
        return true;
    }
    return false;
}

function currentUrl()
{
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
    );
}

function postVerify()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['_token'])) {
            if (hash_equals($_SESSION['_token'], $_POST['_token'])) {
                return true;
            } else {
                // return false;
            }
        }
    }
    // its false anyway 
    return false;
}

function getToken()
{
    if (empty($_SESSION['_token'])) {
        if (function_exists('mcrypt_create_iv')) {
            $_SESSION['_token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        } else {
            $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
    }
    $token = $_SESSION['_token'];
    return $token;
}

function hash_equals($str1, $str2)
{
    if (strlen($str1) != strlen($str2)) {
        return false;
    } else {
        $res = $str1 ^ $str2;
        $ret = 0;
        for ($i = strlen($res) - 1; $i >= 0; $i--) {
            $ret |= ord($res[$i]);
        }
        return !$ret;
    }
}

function makePassword($password)
{
    $pwdHasher = new PasswordHash(8, FALSE);
    // $hash is what you would store in your database
    $hash = $pwdHasher->HashPassword($password);
    return $hash;
}

function verifyPassword($password, $hash)
{
    $pwdHasher = new PasswordHash(8, FALSE);
    // $hash would be the $hash (above) stored in your database for this user
    $checked = $pwdHasher->CheckPassword($password, $hash);
    if ($checked) {
        return true;
    } else {
        return false;
    }
}

function can($authorize)
{
    switch ($authorize) {
        case 'users':
            $res  = checkCanUsers();
            break;
        case 'settings':
            $res  = checkCanSettings();
            break;
        case 'removeSurvey':
            $res  = checkCanRemoveSurvey();
            break;
        case 'editSurvey':
            $res  = checkCanEditSurvey();
            break;
    }
    return $res;
}

function checkCanEditSurvey()
{
    if ($_SESSION['user']['role'] == 'administrator') {
        return true;
    }
    if ($_SESSION['user']['edit_survey']) {
        return true;
    }
    return false;
}

function checkCanRemoveSurvey()
{
    if ($_SESSION['user']['role'] == 'administrator') {
        return true;
    }
    if ($_SESSION['user']['remove_survey']) {
        return true;
    }
    return false;
}

function checkCanUsers()
{
    if ($_SESSION['user']['role'] == 'administrator') {
        return true;
    }
    return false;
}

function checkCanSettings()
{
    if ($_SESSION['user']['role'] == 'administrator') {
        return true;
    }
    return false;
}

function getAllQueuesParsed()
{
    $db = new DB;
    $conn = $db->connection();
    $queues = $conn->query('SELECT survey_queue FROM settings');
    $qs = [];
    if ($queues->num_rows > 0) {
        while ($q = $queues->fetch_assoc()) {
            array_push($qs, $q['survey_queue']);
        }
    }

    $res  = '';
    $i = 0;
    $length = count($qs);
    foreach ($qs as $q) {
        $i++;
        $res .= "'$q'";
        if ($i < $length) {
            $res .= ',';
        }
    }

    if (empty($res)) {
        $res = 0;
    }

    return $res;
}

function getAllQueues()
{
    $db = new DB;
    $conn = $db->connection();
    $queues = $conn->query('SELECT survey_queue FROM settings');
    $qs = [];
    if ($queues->num_rows > 0) {
        while ($q = $queues->fetch_assoc()) {
            array_push($qs, $q['survey_queue']);
        }
    }

    if (empty($qs)) {
        $qs = 0;
    }
    return $qs;
}

function getUserQueues()
{
    if ($_SESSION['user']['role'] == 'administrator') {
        return getAllQueues();
    }
    $queues = explode(',', $_SESSION['user']['queue']);
    return $queues;
}

function getUserQueuesParsed()
{
    if ($_SESSION['user']['role'] == 'administrator') {
        return getAllQueuesParsed();
    }

    $queues = explode(',', $_SESSION['user']['queue']);
    $res  = '';
    $i = 0;
    $length = count($queues);
    foreach ($queues as $q) {
        $i++;
        $res .= "'$q'";
        if ($i < $length) {
            $res .= ',';
        }
    }
    return $res;
}

function confirmLicense($password, $hash)
{
    $confirmHash = new PasswordHash(8, FALSE);
    // $hash would be the $hash (above) stored in your database for this user
    $checked = $confirmHash->CheckPassword($password, $hash);
    if ($checked) {
        return true;
    } else {
        return false;
    }
}

function license()
{
    $db = new DB;
    $conn = $db->connection();
    $license = $conn->query('SELECT license FROM voipiran_settings');
    $row = $license->fetch_assoc();
    if (confirmLicense('full', json_decode($row['license']))) {
        return 'full';
    }

    if (confirmLicense('lite', json_decode($row['license']))) {
        return 'lite';
    }

    return false;
}

function isLiteUser()
{
    $db = new DB;
    $conn = $db->connection();
    $license = $conn->query('SELECT license FROM voipiran_settings');
    $row = $license->fetch_assoc();

    if (confirmLicense('lite', json_decode($row['license']))) {
        return true;
    }

    return false;
}

function isFullUser()
{
    $db = new DB;
    $conn = $db->connection();
    $license = $conn->query('SELECT license FROM voipiran_settings');
    $row = $license->fetch_assoc();

    if (confirmLicense('full', json_decode($row['license']))) {
        return true;
    }

    return false;
}

function queuesCount()
{
    $db = new DB;
    $conn = $db->connection();
    $queues = $conn->query('SELECT survey_queue FROM settings');
    return $queues->num_rows;
}

function liteUserLimit()
{
    // check if user is a lite user license and have maximum queues 
    if (license() == 'full') {
        // user have fullLicense so no need to limit 
        return false;
    }

    if (license() == 'lite') {
        // user have lite license so check the queues count
        if (queuesCount() >= 1) {
            // user riched maxmimom queues count 
            // limit the user 
            return true;
        }
        // user have lite license but is ok no rich queues 
        return false;
    }

    // probably user licenes is wrong
    return true;
}

function checkLicense()
{
    // just cheking the license 
    if (license() == 'full') {
        // user have fullLicense so no need to limit 
        return true;
    }

    if (license() == 'lite') {
        // user have lite license so check the queues count
        return true;
    }
    // probably user licenes is wrong
    echo '<style>
    body{
        direction:ltr;
        text-align:center;
        color:white;
        background:black;
        font-size:19px;
    }</style>';
    echo '<strong>
        Sorry It Seems License Is Not Correct <br>
        <a href="https://voipiran.io" style="color:#ff0000">Please Contact Us </a>
        </strong>';
    die();
    return;
}

function removeQueueIfRiched($conn)
{
    // check if is liteUser and have extends queues 
    // then remove extendes queues and surveys 
    if (isLiteUser()) {
        if (queuesCount() > 1) {
            $queues = $conn->query('SELECT * FROM settings');
            $qTemp = $conn->query('SELECT * FROM settings');
            $mainQueue = $qTemp->fetch_assoc();
            $mainQueue = $mainQueue['survey_queue'];
            $i = 0;
            if ($queues->num_rows > 0) {
                while ($q = $queues->fetch_assoc()) {
                    $id = $q['id'];
                    if ($i) {
                        // $i is because don't remove first item 
                        $conn->query("DELETE FROM settings WHERE id =  '$id' ");
                    }
                    $i++;
                }
                $conn->query("DELETE FROM survey WHERE survey_location !=  '$mainQueue' ");
            }
        }
    }
}
