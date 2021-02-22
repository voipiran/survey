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
                    <li class="active"><i class="fa fa-plus"></i> ویرایش کلمه عبور </li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content container-fluid" id="app">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <form action="functions.php" name="myForm" method="post">
                                <input type="hidden" name="_token" value="<?= getToken() ?>">
                                <input type="hidden" name="method" value="changePassword">
                                <div class="row">
                                <div class="col-md-6  form-group">
                                        <label>کلمه عبور جدید</label>
                                        <input type="password" required name="password"  class="form-control">
                                    </div>                                    
                                    <div class="col-md-6  form-group">
                                        <label>تکرار کلمه عبور جدید</label>
                                        <input type="password" required name="confirmPassword"  class="form-control">
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button class="btn btn-primary" onclick="submitForm(event)"> ثبت</button>
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
        <script src="<?= BASE_PATH ?>/dist/js/axios.min.js"></script>
        <script>
            async function submitForm(event) {
                event.preventDefault();
                let password = document.getElementsByName('password')[0].value;
                let confirmPassword = document.getElementsByName('confirmPassword')[0].value;
                
                if(!password || !confirmPassword){
                    Swal.fire('' ,  'کلمه عبور و تکرار آن الزامی است.'  ,'error');
                    return;
                }

                if(password != confirmPassword){
                    Swal.fire('' ,  'کلمه عبور با تکرار آن مطابقت ندارد.'  ,'error');
                    return;
                }
                document.forms.myForm.submit();
            }
        </script>
</body>

</html>