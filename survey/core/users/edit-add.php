<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>

    <?php

    include_once '../../vendor/autoload.php';
    include_once  '../config/config.php';
    include_once '../config/db.php';
    include '../../layouts/head.php';

    use App\Setting;
    use App\User;

    $setting = new Setting;
    $queues = $setting->getQueues($conn);
    $userInfo = null;
    $user = new User;
    if (isset($_GET['id'])) {
        // get User Information 
        $userInfo = $user->getUser($conn, $_GET['id']);
    }
    ?>
    <script>
        let queue = null;
        let queues = <?php echo json_encode($queues); ?>;
        let token = <?php echo json_encode(getToken()) ?>
    </script>

    <?php
    if ($userInfo) {

    ?>
        <script>
            queue = <?php echo json_encode($user->getUserQueue($conn, $_GET['id'])) ?>
        </script>
    <?php
    }
    ?>

    <link href="<?= BASE_PATH ?>dist/css/toastr.min.css" rel="stylesheet" type="text/css" media="all" />
    <style>
        .swal2-content,
        button {
            font-family: irsns;
        }

        .labelTitle {
            display: flex;
        }
    </style>
    <link href="<?= BASE_PATH ?>dist/css/daterange/daterangepicker.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?= BASE_PATH ?>dist/css/daterange/datepicker-theme.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>dist/css/vue-multiselect.min.css">
    <style>
        td,
        th,
        table {
            text-align: center;
        }

        .tooltip-inner {
            display: none;
        }

        .tooltip-arrow {

            display: none;
        }

        canvas {
            display: none;
        }

        label[for] {
            cursor: pointer;
        }

        [type=radio] {
            cursor: pointer;
        }
    </style>

    <script>
        var BASE_PATH = "<?= BASE_PATH ?>";
    </script>
    <script src="https://unpkg.com/wavesurfer.js"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include '../../layouts/header.php' ?>
        <!-- right side column. contains the logo and sidebar -->
        <?php include('../../layouts/sidebar.php')  ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <li class="fa fa-users"></li> کاربران
                    <!--                <small>توضیحات</small>-->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= BASE_PATH ?>"><i class="fa fa-home"></i> داشبورد</a></li>
                    <li><a href="<?= BASE_PATH ?>/core/users"><i class="fa fa-users"></i> کاربران</a></li>
                    <li class="active"><i class="fa fa-plus"></i> افزودن کاربر جدید </li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content container-fluid" id="app">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <form action="<?= ($userInfo) ? 'update.php' : 'store.php' ?>" name="myForm" method="post">
                                <input type="hidden" name="_token" value="<?= getToken() ?>">
                                <div class="row">
                                    <div class="col-md-6  form-group">
                                        <label>نام و نام خانوادگی</label>
                                        <input type="text" required name="full_name" value="<?= ($userInfo) ? $userInfo['full_name'] : null  ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6  form-group">
                                        <label>نام کاربری</label>
                                        <input type="text" <?= ($userInfo) ? 'disabled' : '' ?> required name="user_name" value="<?= ($userInfo) ? $userInfo['user_name'] : null  ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6  form-group">
                                        <label>کلمه عبور
                                            <?php if ($userInfo) echo '<small>(در صورتی که نمیخواهید کلمه عبور را تغییر دهید، این فیلد را خالی رها کنید.)</small>'; ?>
                                        </label>
                                        <input type="password" style="position: absolute;opacity:0">
                                        <input type="password" required name="password" class="form-control">
                                    </div>
                                    <div class="col-md-6  form-group">
                                        <label>نقش</label>
                                        <select name="role" required class="form-control">
                                            <!-- <option value="administrator" <?= ($userInfo['role'] == 'administrator') ?  'selected' : '' ?>>administrator</option> -->
                                            <option value="supervisor" <?= ($userInfo['role'] == 'supervisor') ?  'selected' : '' ?>>supervisor</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6  form-group">
                                        <label>صف</label>
                                        <input type="hidden" id="queue" name="queue" v-model="queue" required>
                                        <multiselect v-model="queue" :multiple="true" :options="queues" :show-labels="false" placeholder="صف را انتخاب کنید"></multiselect>
                                    </div>
                                    <div class="col-md-6  form-group">
                                        <label class="labelTitle">قابلیت ویرایش نظر</label>
                                        <input type="radio" required id="yesEdit" name="edit_survey" value="1" <?= ($userInfo['edit_survey'] == 1) ? 'checked' : '' ?>>
                                        <label for="yesEdit">بله</label>
                                        <input type="radio" <?= (!$userInfo) ? 'checked' : '' ?> required id="noEdit" name="edit_survey" value="0" <?= ($userInfo['edit_survey'] == 0) ? 'checked' : '' ?>>
                                        <label for="noEdit">خیر</label>
                                    </div>
                                    <div class="col-md-6  form-group">
                                        <label class="labelTitle">قابلیت حذف نظر</label>
                                        <input type="radio" required id="yesRemove" name="remove_survey" value="1" <?= ($userInfo['remove_survey'] == 1) ? 'checked' : '' ?>>
                                        <label for="yesRemove">بله</label>
                                        ّ <input type="radio" <?= (!$userInfo) ? 'checked' : '' ?> required id="noRemove" name="remove_survey" value="0" <?= ($userInfo['remove_survey'] == 0) ? 'checked' : '' ?>>
                                        <label for="noRemove">خیر</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php
                                        if ($userInfo) {
                                        ?>
                                            <input type="hidden" name="id" value="<?= $userInfo['id'] ?>">
                                        <?php
                                        }
                                        ?>
                                        <button class="btn btn-primary" onclick="submitForm(event)"> <?= ($userInfo) ? 'ثبت تغییرات' : 'ایجاد کاربر' ?> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include '../../layouts/footer.php' ?>
        <script src="<?= BASE_PATH ?>/dist/js/createUser.js"></script>
        <script src="<?= BASE_PATH ?>/dist/js/axios.min.js"></script>
        <script>
            async function submitForm(event) {
                event.preventDefault();
                let full_name = document.getElementsByName('full_name')[0].value;
                let queueValue = document.getElementsByName('queue')[0].value;
                let user_name = document.getElementsByName('user_name')[0].value;

                let password = document.getElementsByName('password')[0].value;
                if (queue) {
                    // if we are in update page  the password maybe blank so its not matter 
                    password = true;
                }

                let role = document.getElementsByName('role')[0].value;
                let edit_survey = document.getElementsByName('edit_survey')[0].value;
                let remove_survey = document.getElementsByName('remove_survey')[0].value;

                if (!full_name || !queueValue || !user_name || !password || !role || !edit_survey || !remove_survey) {
                    Swal.fire('', 'لطفا تمامی فیلد ها را پر کنید.', 'error');
                    return;
                }

                Swal.showLoading();
                if (!queue) {
                    // in edit page the userName is disabled So its not neccessary to check the userName 
                    // Just Check it in Create 
                    try {
                        let data = {
                            method: 'checkUserName',
                            userName: user_name,
                            _token: token
                        }
                        let res = await axios.post('functions.php', data);
                    } catch (error) {
                        console.log(error);
                        Swal.fire('', 'نام کاربری تکراری است.', 'error');
                        return;
                    }
                }
                document.forms.myForm.submit();
            }
        </script>
</body>

</html>