<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../vendor/autoload.php';
require_once '../config/config.php';
require_once '../config/db.php';


use App\User;

if (isset($_POST['method'])) {
    if (postVerify()) {
        if ($_POST['method'] == 'logOut') {
            logOut();
        }
    }
}

$_POST = json_decode(file_get_contents("php://input"), true);

if (postVerify()) {
    switch ($_POST['method']) {
        case 'loginAttempt':
            $res = loginAttempt($conn);
            break;
        case 'logOut':
            $res = logOut();
            break;
        default:
            echo 'everything is ok but Nothing to do';
            return;
    }
    http_response_code($res['status']);
    echo $res['message'];
    return;
}


function loginAttempt($conn)
{
    try {
        $user = new User;
        $userInfo = $user->getUserByUserName($conn, $_POST['userName']);
        if ($userInfo) {
            $password = $_POST['password'];
            $res = verifyPassword($password, $userInfo['password']);
            if ($res) {
                $_SESSION['user'] = $userInfo;
                return [
                    'message' => "Success",
                    'status'  => 200
                ];
            }
            return [
                'message' => "faild",
                'status'  => 500
            ];
        }

        return [
            'message' => "User Not Found",
            'status'  => 500
        ];
    } catch (\Throwable $th) {
        return [
            'message' => json_encode($th),
            'status'  => 500
        ];
    }
}

function logOut()
{
    unset($_SESSION['user']);
    header('Location:' . BASE_PATH . 'core/login/', true, 301);
    die();
}

echo 'not Authorized';
http_response_code(500);
return;
