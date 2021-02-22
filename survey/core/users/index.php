<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
    <?php
    include_once  '../config/config.php';
    include_once '../../vendor/autoload.php';
    include_once '../config/db.php';
    include '../../layouts/head.php';
    removeQueueIfRiched($conn);
    checkLicense();

    if (!can('users')) {
        header('Location:' . BASE_PATH . '?message=اجازه دسترسی به این صفحه را ندارید. & alertType=error', true, 301);
    }

    use App\User;

    $user = new User;
    $users = $user->getUsers($conn);

    ?>
    <link href="<?= BASE_PATH ?>dist/css/toastr.min.css" rel="stylesheet" type="text/css" media="all" />
    <style>
        .swal2-content,
        button {
            font-family: irsns;
        }
    </style>
    <link href="<?= BASE_PATH ?>dist/css/daterange/daterangepicker.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?= BASE_PATH ?>dist/css/daterange/datepicker-theme.css" rel="stylesheet" type="text/css" media="all" />
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
    </style>

    <script>
        var BASE_PATH = "<?= BASE_PATH ?>";
        let token = "<?= getToken() ?>";
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
                    <li class="active"><i class="fa fa-users"></i> کاربران </li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content container-fluid">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="col-lg-12">
                                <a href="<?= BASE_PATH ?>/core/users/edit-add.php" class="btn btn-success">افزودن</a>
                            </div>
                        </div>
                        <div class="box-body">
                            <div style="overflow-x: auto">

                            </div>
                            <table class="table table-bordered" id="app">
                                <thead>
                                    <th>نام و نام خانوادگی</th>
                                    <th>نام کاربری</th>
                                    <th>صف</th>
                                    <th>نقش</th>
                                    <th>ویرایش نظرسنجی</th>
                                    <th>حذف نظرسنجی</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <?php

                                    if ($users->num_rows > 0) {
                                        while ($user = $users->fetch_assoc()) {

                                    ?>
                                            <tr>
                                                <td><?= $user['full_name'] ?></td>
                                                <td><?= $user['user_name'] ?></td>
                                                <td><?= ($_SESSION['user']['role'] == 'administrator' && $_SESSION['user']['id'] == $user['id']) ? 'همه صف ها' : $user['queue'] ?></td>
                                                <td><?= $user['role'] ?></td>
                                                <td><span class="label label-<?= ($user['edit_survey']) ? 'success' : 'danger' ?>"><?= ($user['edit_survey']) ? 'بله' : 'خیر' ?></span></td>
                                                <td><span class="label label-<?= ($user['remove_survey']) ? 'success' : 'danger' ?>"><?= ($user['remove_survey']) ? 'بله' : 'خیر' ?></span></td>
                                                <td>
                                                    <?php
                                                    if ($user['id'] != $_SESSION['user']['id']) {
                                                    ?>
                                                        <a href="<?= BASE_PATH ?>/core/users/edit-add.php?id=<?= $user['id'] ?>" class="btn btn-primary">ویرایش</a>
                                                        <button class="btn btn-danger" v-on:click="distroy(<?= $user['id'] ?>)">حذف</button>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include '../../layouts/footer.php' ?>
        <script src="<?= BASE_PATH ?>/dist/js/user.js "></script>
</body>

</html>