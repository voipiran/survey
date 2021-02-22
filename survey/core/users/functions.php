<?php
require_once '../../vendor/autoload.php';
require_once '../config/config.php';
require_once '../config/db.php';

// this is for web requests 
if (isset($_POST['method'])) {
    if (postVerify()) {
        if ($_POST['method'] == 'changePassword') {
            $id = $_SESSION['user']['id'];
            $password      = makePassword($_POST['password']);
            $t             = "
                UPDATE users SET
                    password      = '$password'
                WHERE id            = '$id'
            ";
            $conn->query($t);
            header('Location:' . BASE_PATH . 'core/users/change-password.php?message=کلمه عبور با موفقیت تغییر یافت. & alertType=success', true, 301);
            die();
        }
    }
}



// this is for api requests 
$_POST = json_decode(file_get_contents("php://input"), true);


if (postVerify()) {
    switch ($_POST['method']) {
        case 'checkUserName':
            return checkUserName($conn);
        case 'destroyUser':
            $res = destroyUser($conn);
            break;
        default:
            echo 'everything is ok but Nothing to do';
            return;
    }
    http_response_code($res['status']);
    echo $res['message'];
    return;
}

function destroyUser($conn)
{
    try {
        $id = $_POST['id'];
        $conn->query("DELETE FROM users WHERE id = $id");
        // $conn->query($sql);
        return [
            'message' => $sql,
            'status'  => 200
        ];
    } catch (\Throwable $th) {
        return [
            'message' => 'success',
            'status'  => 200
        ];
    }
}

function checkUserName($conn)
{
    $user_name = $_POST['userName'];
    $sql = "SELECT * FROM `users` WHERE `user_name` = '$user_name'";
    $users = $conn->query($sql);
    if ($users->num_rows > 0) {
        http_response_code(500);
        echo 'userName is duplicate';
        return;
    }
    http_response_code(200);
    echo 'userName is ok';
    return;
}
http_response_code(500);
echo 'not permitted';
return;
