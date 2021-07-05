<?php
include_once '../config/config.php';
include_once '../../vendor/autoload.php';
include_once '../config/db.php';
include_once '../../app/server.php';
removeQueueIfRiched($conn);
checkLicense();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $server['loginSurveyTitle'] ?></title>
    <link rel="stylesheet" href="<?= BASE_PATH ?>/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/dist/css/login.css">
    <script>
        let token        = <?php echo json_encode(getToken()); ?> ;
        let dashboardUrl = " <?= BASE_PATH ?>"
    </script>
</head>

<body>
    <div class="vertical-center">
        <div class="container-fluid ">
            <div class="row justify-content-center">
                <div class="col-lg-12  mainForm">
                    <div class="card" id="app">
                        <div class="card-title text-center  ">
                            <img src="<?= $server['loginLogoPath'] ?>" alt="">
                        </div>
                        <div class="card-body" v-on:keyup.enter="login" >
                            <div class="col-lg-12 text-center form-group">
                                <strong><?= $server['loginSurveyTitle'] ?></strong>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label>نام کاربری: </label>
                                <input type="text" v-model="userName" name="user_name" class="form-control text-left">
                            </div>
                            <div class="col-lg-12 form-group">
                                <label>کلمه عبور: </label>
                                <input type="password" v-model="password" name="password" class="form-control text-left">
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-primary" v-on:click="login" >ورود</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= BASE_PATH ?>dist/js/login.js"></script>
</body>

</html>