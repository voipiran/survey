<?php
require_once '../../vendor/autoload.php';
include_once '../config/db.php';
include_once '../config/config.php';

if (postVerify()) {
    $full_name     = $_POST['full_name'];
    $user_name     = $_POST['user_name'];
    $queue         = $_POST['queue'];
    $role          = $_POST['role'];
    $password      = $_POST['password'];
    $remove_survey = $_POST['remove_survey'];
    $edit_survey   = $_POST['edit_survey'];
    $password      = makePassword($password);
    $t             = "
    INSERT INTO users
    ( full_name  , user_name , queue	 , role , password  , remove_survey , edit_survey)
    VALUES
    ( '$full_name' , '$user_name' , '$queue' , '$role' , '$password' , '$remove_survey' , '$edit_survey')
";
    $conn->query($t);
    header('Location:' . BASE_PATH . 'core/users/?message=کاربر با موفقیت ایجاد شد & alertType=success', true, 301 );
}
echo 'action not authorized!<br>Persmission Required';
