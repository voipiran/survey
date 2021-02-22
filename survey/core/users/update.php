<?php


require_once '../../vendor/autoload.php';
include_once '../config/db.php';
include_once '../config/config.php';

use App\User;


if (postVerify()) {
    $id            = $_POST['id'];
    $full_name     = $_POST['full_name'];
    $queue         = $_POST['queue'];
    $role          = $_POST['role'];
    $password      = $_POST['password'];
    $remove_survey = $_POST['remove_survey'];
    $edit_survey   = $_POST['edit_survey'];
    if (!$password) {
        // password is null don't touch password - retrive the old one
        $user = new User;
        $userInfo = $user->getUser($conn, $id);
        $password = $userInfo['password'];
    } else {
        $password = makePassword($password);
    }
    $t             = "
    UPDATE users SET
        full_name     = '$full_name',
        queue         = '$queue',
        role          = '$role',
        password      = '$password',
        remove_survey = $remove_survey,
        edit_survey   = $edit_survey
    WHERE id            = '$id'
    ";
    $conn->query($t);
    header('Location:' . BASE_PATH . 'core/users/?message=بروزرسانی کاربر با موفقیت انجام شد. & alertType=success', true, 301);
}
echo 'action not authorized!<br>Persmission Required';
