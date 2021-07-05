<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>

    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include_once '../../vendor/autoload.php';
    include_once  '../config/config.php';
    include_once '../config/db.php';
    include '../../layouts/head.php';
    // get queues from asterisk 
    $q = "SELECT extension  FROM queues_config ";
    $queues = $ast_conn->query($q);
    $qs = [];
    while ($row = mysqli_fetch_assoc($queues)) {
        array_push($qs, $row['extension']);
    }

    ?>
    <style>
        .disableCause {
            cursor: pointer;
        }

        .swal2-modal .swal2-content {
            font-family: 'irsns';
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include '../../layouts/header.php' ?>
        <!-- right side column. contains the logo and sidebar -->
        <?php include('../../layouts/sidebar.php')  ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <li class="fa fa-cogs"></li> افزودن
                    <!--                <small>توضیحات</small>-->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= BASE_PATH ?>"><i class="fa fa-home"></i> داشبورد</a></li>
                    <li><a href="<?= BASE_PATH ?>core/settings"><i class="fa fa-cogs"></i> تنظیمات</a></li>
                    <li class="active">ایجاد تنظیمات جدید</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content container-fluid">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">تنظیمات</h3>
                    </div>

                    <?php if (liteUserLimit()) { ?>
                        <div class="alert alert-danger">
                            شما حداکثر صف مجاز را وارد کرده اید.
                            <br>
                            در صورت نیاز به افزودن صف های بیشتر لطفا با پشتیبانی ویپ ایران تماس حاصل نمایید.
                            <br>
                            <a style="text-decoration: none" target="_blank" href="https://voipiran.io">برای تماس با ویپ ایران کلیک کنید</a>
                        </div>
                    <?php } ?>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == 'fail_upload') {
                    ?>
                            <ul style="background-color: red ; color: white;">
                                <li>آپلود ناموفق بود ، لطفا بعدا مجدد تلاش کنید.</li>
                            </ul>
                        <?php
                        }
                        if ($_GET['error'] == 'file_not_support') {
                        ?>
                            <ul style="background-color: red ; color: white;">
                                <li>تنها مجاز به آپلود فایل های wave , mp3 , ogg , flac می باشید.</li>
                            </ul>
                        <?php
                        }
                        if ($_GET['error'] == 'queue_exist') {
                        ?>
                            <ul style="background-color: red ; color: white;">
                                <li>این صف قبلا ایجاد شده است.</li>
                            </ul>
                    <?php
                        }
                    }
                    ?>
                    <form action="store.php" method="post" enctype="multipart/form-data" id="audio">
                        <input type="hidden" name="_token" value="<?= getToken() ?>">
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>نام نظرسنجی</label>
                                    <input type="text" <?= (liteUserLimit()) ? 'disabled' : '' ?> name="survey_name" required value="<?= (isset($_GET['survey_name'])) ? $_GET['survey_name'] : '' ?>" class="form-control" placeholder="نام نظرسنجی">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>وضعیت</label>
                                    <select <?= (liteUserLimit()) ? 'disabled' : '' ?> name="survey_status" class="form-control">
                                        <option value="1">فعال</option>
                                        <option value="0">غیرفعال</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>فایل صوتی</label>
                                    <br>
                                    <small>در صورتی که می خواهید فایل صوتی پیش فرض جایگزین شود ، این گزینه را خالی بگذارید.</small>
                                    <input type="file" <?= (liteUserLimit()) ? 'disabled' : '' ?> name="survey_voice" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>مقادیر نظرسنجی</label>
                                    <select name="survey_string" <?= (liteUserLimit()) ? 'disabled' : '' ?> class="form-control">
                                        <option value="12345">12345</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>صف</label>
                                    <select <?= (liteUserLimit()) ? 'disabled' : '' ?> name="survey_queue" id="survey_queue" class="form-control" required>
                                        <?php
                                        foreach ($qs as $q) {
                                            echo '<option value="' . $q . '" >' . $q . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ضبط پیام مشتری</label>
                                    <?php if (isLiteUser()) {  ?><small v-on:click="disableCause" class="disableCause"> (دلیل غیرفعال بودن)</small> <?php } ?>
                                    <select <?= (isLiteUser()) ? 'disabled' : '' ?> name="customer_voice_status" class="form-control">
                                        <option value="0">غیرفعال</option>
                                        <option value="1">فعال</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>سقف امتیاز برای ضبط پیام</label>
                                    <select <?= (liteUserLimit()) ? 'disabled' : '' ?> name="customer_voice_limit" class="form-control">
                                        <option value="0" >0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5" selected>5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>بیان شماره اپراتور</label>
                                    <?php if (isLiteUser()) {  ?> <small v-on:click="disableCause" class="disableCause"> (دلیل غیرفعال بودن)</small> <?php   } ?>
                                    <select <?= (isLiteUser()) ? 'disabled' : '' ?> name="survey_playagent" id="survey_playagent" class="form-control">
                                        <option value="0">غیرفعال</option>
                                        <option value="1">شماره اپراتور</option>
                                        <option value="2">نام اپراتور</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" <?= (liteUserLimit()) ? 'disabled' : '' ?> class="btn btn-primary">ذخیره</button>
                        </div>
                    </form>
                </div>
            </section>
            <!-- /.content -->
        </div>

        <?php include '../../layouts/footer.php' ?>
        <script src="<?= BASE_PATH  ?>dist/js/audio.js"></script>
        <script>
            // let survey_queue = document.getElementById('survey_queue');
            // let survey_playagent = document.getElementById('survey_playagent');
            // survey_playagent.options[0].value = survey_queue.value;

            // function fillQueue() {
            //     survey_playagent.options[0].value = survey_queue.value;
            // }
        </script>
</body>

</html>