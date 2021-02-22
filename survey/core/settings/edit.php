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
    $id = $_GET['id'];
    $sql = "SELECT * FROM settings WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();


    // get queues from asterisk 
    $q = "SELECT extension  FROM queues_config ";
    $queues = $ast_conn->query($q);
    $qs = [];
    while($qRow = mysqli_fetch_assoc($queues)){
        array_push($qs , $qRow['extension']);
    }
    ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- Main Header -->
    <?php  include '../../layouts/header.php' ?>
    <!-- right side column. contains the logo and sidebar -->
    <?php  include('../../layouts/sidebar.php')  ?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <li class="fa fa-cogs"></li>        ویرایش تنظیمات
                <!--                <small>توضیحات</small>-->
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?=  BASE_PATH ?>"><i class="fa fa-home"></i> داشبورد</a></li>
                <li><a href="<?=  BASE_PATH ?>core/settings"><i class="fa fa-cogs"></i> تنظیمات</a></li>
                <li class="active">ویرایش تنظیمات</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">تنظیمات</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == 'queue_exist'){
                        ?>
                        <ul style="background-color: red ; color: white;">
                            <li>این صف قبلا ایجاد شده است.</li>
                        </ul>
                        <?php
                    }
                }
                ?>
                <form  action="update.php" method="post"  enctype="multipart/form-data" >
                    <div class="box-body">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label >نام نظرسنجی</label>
                                <input type="hidden" name="id"  value="<?= $row['id'] ?>">
                                <input type="hidden" name="old_survey_queue"  value="<?= $row['survey_queue'] ?>">
                                <input type="text" name="survey_name" required value="<?php echo $row['survey_name'] ?>" class="form-control"  placeholder="نام نظرسنجی">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label >وضعیت</label>
                                <select name="survey_status"  class="form-control">
                                    <option value="1" <?=  ($row['survey_status']) ? 'selected' : '' ?> >فعال</option>
                                    <option value="0" <?=  ($row['survey_status']) ? '' : 'selected' ?>>غیرفعال</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group" id="audio">
                                <label >فایل صوتی</label>
                                <input type="hidden" name="s_voice" value="<?=  $row['survey_voice'] ?>">
                                <av-bars
                                        audio-src="<?= BASE_PATH ?>uploads/<?= $row['survey_voice'] ?>">
                                </av-bars>
                                <input type="file" name="survey_voice" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label >مقادیر نظرسنجی</label>
                                <select name="survey_string"   class="form-control">
                                    <option value="12345" <?= ($row['survey_string'] == '12345')  ? 'selected' : '' ?> >12345</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label >صف</label>
                                <select name="survey_queue"  id="survey_queue" class="form-control" required>
                                    <?php 
                                        foreach($qs as $q){
                                            $selected = '';
                                            if($row['survey_queue'] == $q ){
                                                $selected = 'selected';
                                            }
                                            echo '<option value="'.$q.'" '.$selected.' >'.$q.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label >ضبط پیام مشتری</label>
                                <select name="customer_voice_status"  class="form-control">
                                    <option value="1" <?=  ($row['customer_voice_status']) ? 'selected' : '' ?> >فعال</option>
                                    <option value="0" <?=  ($row['customer_voice_status']) ? '' : 'selected' ?>>غیرفعال</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label >سقف امتیاز برای ضبط پیام</label>
                                <select name="customer_voice_limit"  class="form-control">
                                    <option value="0" <?=  ($row['customer_voice_limit'] == 0 ) ? 'selected' : '' ?> > 0 </option>
                                    <option value="1" <?=  ($row['customer_voice_limit'] == 1 ) ? 'selected' : '' ?> > 1 </option>
                                    <option value="2" <?=  ($row['customer_voice_limit'] == 2 ) ? 'selected' : '' ?> > 2 </option>
                                    <option value="3" <?=  ($row['customer_voice_limit'] == 3 ) ? 'selected' : '' ?> > 3 </option>
                                    <option value="4" <?=  ($row['customer_voice_limit'] == 4 ) ? 'selected' : '' ?> > 4 </option>
                                    <option value="5" <?=  ($row['customer_voice_limit'] == 5 ) ? 'selected' : '' ?> > 5 </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>بیان شماره اپراتور</label>
                                <select name="survey_playagent" id="survey_playagent" class="form-control">
                                    <option value="0" <?=  ($row['survey_playagent'] == 0 ) ? 'selected' : '' ?> > غیرفعال </option>
                                    <option value="1" <?=  ($row['survey_playagent'] == 1 ) ? 'selected' : '' ?> > شماره اپراتور </option>
                                    <option value="2" <?=  ($row['survey_playagent'] == 2 ) ? 'selected' : '' ?> > نام اپراتور </option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">ذخیره</button>
                    </div>
                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <?php  include '../../layouts/footer.php'?>
    <?php
    if(isset($_GET['error'])) {
        if($_GET['error'] == 'queue_exist'){
            ?>
            <ul style="background-color: red ; color: white;">
                <li>این صف قبلا ایجاد شده است.</li>
            </ul>
            <?php
        }
    }
    ?>
    <script src="<?=  BASE_PATH  ?>dist/js/audio.js"></script>
</body>
</html>